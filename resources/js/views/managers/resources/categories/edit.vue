<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Edit Category</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'CategoryDetails',
              params: {
                loggedUserID: loggedUser.id,
                categoryID: categoryID
              }
            }" 
            class="btn btn-outline-danger"
          >
            <i class="fas fa-times"></i>
            Cancel
          </router-link>
        </div>
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card-box">
          <div class="row">
            <div class="col-md-12">
              <div class="profile-img-wrap">
                <img class="inline-block" :src="category.image" alt="Category Image">
                <div class="fileupload btn">
                    <span class="btn-text">Add Image</span>
                    <input class="upload" type="file" @change="onFileSelected($event)" accept="image/*">
                </div>
              </div>
              <div class="profile-basic">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <div class="form-group form-focus focused">
                      <label class="focus-label">Category Name</label>
                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('name')" type="text" class="form-control floating text-center" v-model="category.name">
                    </div>
                    <small v-if="errors.name && (errors.name.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.name[0]}}</small>
                  </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">Parent Category</label>
                      <select @input="clearErrorStatusOnInput('parent_id')" class="select form-control floating focused" v-model="category.parent_id">
                          <option value="0">Select Parent Category</option>
                          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                      </select>
                    </div>
                    <small v-if="errors.parent_id && (errors.parent_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.parent_id[0]}}</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                  <label class="focus-label">Meta Data</label>
                  <textarea @input="clearErrorStatusOnInput('meta_name')" class="form-control" v-model="category.meta_name"></textarea>
                </div>
              <small v-if="errors.meta_name && (errors.meta_name.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.meta_name[0]}}</small>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                  <label class="focus-label">Description</label>
                  <textarea @input="clearErrorStatusOnInput('description')" class="form-control" v-model="category.description"></textarea>
                </div>
              <small v-if="errors.description && (errors.description.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.description[0]}}</small>
            </div>
          </div>
        </div>
        <div class="text-center m-t-20">
          <button v-if="!isLoading" @click.prevent="attemptCategoryUpdate" class="btn btn-primary btn-lg" type="button">Update Category Record</button>
          <button v-else :disabled="isLoading" class="btn btn-success btn-lg" type="button">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...  
          </button>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";
  import { axiosGetRequest } from '../../../../helpers/axiosGetRequest';
  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../../store/store_helpers/constantVariables";

  export default {
    name: 'EditCategory',

    data() {
      return {
        categories: [],
        categoryID: null,
        category: {},
        errors: {
          name: [],
          parent_id: [],
          selectedFile: [],
          meta_name: [],
          description: []
        },
        selectedFile: null
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
        isLetter(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if(/^[A-Za-z ]+$/.test(char)) return true; // Match with regex 
        else e.preventDefault(); // If not match, don't add to input text
      },

      onFileSelected(event) {
        const files = event.target.files
        let filename = files[0].name
        if(filename.lastIndexOf(".") <=  0) {
          return alert("Please upload a valid file!");
        }
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.category.image = fileReader.result
        })
        fileReader.readAsDataURL(files[0])
        this.selectedFile = files[0]
      },

      attemptCategoryUpdate() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            let formData = new FormData();
            let contentType = 'application/json';

            formData.append('name', this.category.name);
            formData.append('parent_id', this.category.parent_id);
            formData.append('meta_name', this.category.meta_name);
            formData.append('description', this.category.description);

            if (this.selectedFile) {
              contentType = 'multipart/form-data';
              formData.append('file_upload', this.selectedFile);
            }

            formData.append('content_type', contentType);
            formData.append("_method", "put");

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post(`/managers/categories/${this.categoryID}`, formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
              if (response.status === 200) {
                // notify of successful create operation
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});
                console.log(response);
                this.$router.push({
                  name: 'AllCategories',
                  params: {
                    loggedUserID: this.loggedUser.id
                  }
                });
              }

              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            }).catch(error => {
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
              console.log(`ATTEMPT CREATING EMPLOYEE RECORD ERROR:`, error.response); 

              if (error.response.status === 422 || error.status === 422) {
                  if (error.response.data.errors.name && error.response.data.errors.name.length > 0) {
                    this.errors.name = error.response.data.errors.name
                  }

                  if (error.response.data.errors.parent_id && error.response.data.errors.parent_id.length > 0) {
                    this.errors.parent_id = error.response.data.errors.parent_id
                  }

                  if (error.response.data.errors.meta_name && error.response.data.errors.meta_name.length > 0) {
                    this.errors.meta_name = error.response.data.errors.meta_name
                  }

                  if (error.response.data.errors.description && error.response.data.errors.description.length > 0) {
                    this.errors.description = error.response.data.errors.description
                  }

                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: "Invalid input. Please verify that all input data are valid." })
                  .then(() => { console.log("Alert message update.");});
                } else if (error.response.status === 401 || error.status === 401) {
                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: "Unauthorize user request!" })
                  .then(() => { console.log("Alert message update.");});
                } else if (error.response.status === 400 || error.status === 400) {
                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: error.response.data.message })
                  .then(() => { console.log("Alert message update.");});
                } else {
                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: "Server error. Please try again" })
                  .then(() => { console.log("Alert message update.");});
                }
            })
          }).catch(error => {
          console.log(`IS LOADING LOGIN ERROR: ${error}`); 
          this.$store.dispatch(IS_LOADING, false)
            .then(() => { 
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        });

      },

      clearErrorStatusOnInput(fieldName) {
        if (this.category[fieldName].length > 0) {
          this.errors[fieldName] = []
        }
        this.errorMessage = ""
      },

      async getCategoryFromBackendService() {
        let response = null;
        await axiosGetRequest('/managers/categories/' + this.categoryID, this.tokenType, this.token).then((res) => {
          response = res;
        });
        if (response && response.status === 200) {
          return response.data;
        } else {
          return [];
        }
      },
    },

    created() {
      if (this.isLoading) {
        this.$store.dispatch(IS_LOADING, false)
          .then(() => { 
            console.log(`isLoading false === ${this.isLoading}`); 
          }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      }

      EventBus.$emit('active-menu-label-updated', 'edit category');

      this.categoryID = this.$route.params.categoryID

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          this.category = await this.getCategoryFromBackendService();
          console.log(this.category);
          this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }

  .page-title {
    color: #d4af37;
  }

  .form-group { margin-bottom: 0 !important; }

  .form-control:focus {background: inherit;}

  small {
    margin: 0 !important;
  }

  select:focus,
  input:focus,
  textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #d4af37;
    outline-width: 0
  }

  select option {
    background: #353535;
    padding-top: 50px;
  }
</style>