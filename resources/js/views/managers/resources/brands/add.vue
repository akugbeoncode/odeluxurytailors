<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
          <h4 class="page-title">Add Brand</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'AllBrands',
            params: {
              loggedUserID: loggedUser.id
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
                <img class="inline-block" :src="form.logo ? form.logo : imageURL" alt="Brand Logo">
                <div class="fileupload btn">
                    <span class="btn-text">Brand Logo</span>
                    <input class="upload" type="file" @change="onFileSelected($event)" accept="image/*">
                </div>
              </div>
              <div class="profile-basic">
                <div class="row">
                  <div class="col-md-12 mb-4 mt-3">
                    <div class="form-group form-focus focused">
                      <label class="focus-label">Brand Name</label>
                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('name')" type="text" class="form-control floating text-center" v-model="form.name">
                    </div>
                    <small v-if="errors.name && (errors.name.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.name[0]}}</small>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group form-focus focused">
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" name="checkbox" v-model="form.is_active"> Enable Brand
                          </label>
                      </div>                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                  <label class="focus-label">Description</label>
                  <textarea @input="clearErrorStatusOnInput('description')" class="form-control" v-model="form.description"></textarea>
                </div>
              <small v-if="errors.description && (errors.description.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.description[0]}}</small>
            </div>
          </div>
        </div>
        <div class="text-center m-t-20">
          <button v-if="!isLoading" @click.prevent="attemptAddingBrand" class="btn btn-primary btn-lg" type="button">Add Brand</button>
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
  import axios from 'axios';
  import { mapGetters } from "vuex";

  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../../store/store_helpers/constantVariables";

  export default {
    name: 'AddBrand',

    data() {
      return {
        categories: [],
        imageURL: '/images/imageicon.png',

        form: {
          name: '',
          logo: '',
          selectedFile: null,
          brand_logo: '',
          is_active: 0,
          description: ''
        },

        errors: {
          name: [],
          selectedFile: [],
          description: []
        },
        errorMessage: ""
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
          this.form.logo = fileReader.result
        })
        fileReader.readAsDataURL(files[0])
        this.form.selectedFile = files[0]
      },

      attemptAddingBrand() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();
            let contentType = 'application/json';

            formData.append('name', this.form.name);
            formData.append('is_active', this.form.is_active);
            formData.append('description', this.form.description);

            if (this.form.selectedFile) {
              contentType = 'multipart/form-data';
              formData.append('file_upload', this.form.selectedFile);
            }

            formData.append('content_type', contentType);

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post('/managers/brands', formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
              if (response.status === 200) {
                // notify of successful create operation
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});
                  
                this.$router.push({
                  name: 'AllBrands',
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
              // console.log(`ATTEMPT CREATING EMPLOYEE RECORD ERROR:`, error); 

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
                } else if (error.response.status === 403 || error.status === 403) {
                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'warning', message: error.response.data.message })
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
        if (this.form[fieldName].length > 0) {
          this.errors[fieldName] = []
        }
        this.errorMessage = ""
      },
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'add brand');

      this.$store.dispatch(IS_LOADING, true)
        .then(()=>{
            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.get('/add-category-resources')
            .then(response => {
              if (response.status === 200) {
                this.categories = response.data.categories;
              }
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            })
            .catch(error => {
              console.log(`ADD BRAND API DATA ERROR: ${error}`); 
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            });
        }).catch(error => {
          console.log(`IS LOADING LOGIN ERROR: ${error}`); 
          this.$store.dispatch(IS_LOADING, false)
            .then(() => { 
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        });
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