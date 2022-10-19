<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
          <h4 class="page-title">Add Product</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="backURL" 
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
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Name</label>
                <input @input="clearErrorStatusOnInput('name')" type="text" class="form-control floating text-center" v-model="form.name">
              </div>
              <small v-if="errors.name && (errors.name.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.name[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Generic Name</label>
                <input @input="clearErrorStatusOnInput('generic_name')" type="text" class="form-control floating text-center" v-model="form.generic_name">
              </div>
              <small v-if="errors.generic_name && (errors.generic_name.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.generic_name[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Code</label>
                <div class="input-group">
                  <input type="text" class="form-control" v-model="form.code" readonly>
                  <button @click="generateProductCode($event)" class="btn btn-outline-secondary right-input-btn" type="button"><i class="fas fa-sync-alt" :class="{ 'fa-spin': loadingCode }"></i></button>
                </div>
              </div>
              <small v-if="errors.code && (errors.code.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.code[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Category</label>
                <select @input="clearErrorStatusOnInput('category')" class="select form-control floating focused" v-model="form.category">
                  <option value="">Select Cateory</option>
                  <option v-for="item in categories" :key="item.id" :value="item.id">{{item.name}}</option>
                </select>
              </div>
              <small v-if="errors.category && (errors.category.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.category[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Brand</label>
                <select @input="clearErrorStatusOnInput('brand')" class="select form-control floating focused" v-model="form.brand">
                  <option value="">Select Brand</option>
                  <option v-for="item in brands" :key="item.id" :value="item.id">{{item.name}}</option>
                </select>
              </div>
              <small v-if="errors.brand && (errors.brand.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.brand[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Unit Cost Price</label>
                <input type="number" @input="clearErrorStatusOnInput('unit_cost_price')" min="0" class="form-control floating focused" v-model="form.unit_cost_price">
              </div>
              <small v-if="errors.unit_cost_price && (errors.unit_cost_price.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.unit_cost_price[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Unit Selling Price</label>
                <input type="number" @input="clearErrorStatusOnInput('unit_selling_price')" min="0" class="form-control floating focused" v-model="form.unit_selling_price">
              </div>
              <small v-if="errors.unit_selling_price && (errors.unit_selling_price.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.unit_selling_price[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Quantity Alert</label>
                <input type="number" @input="clearErrorStatusOnInput('quantity_alert')" min="0" class="form-control floating focused" v-model="form.quantity_alert">
              </div>
              <small v-if="errors.quantity_alert && (errors.quantity_alert.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.quantity_alert[0]}}</small>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Product Unit</label>
                <select @input="clearErrorStatusOnInput('product_unit')" class="select form-control floating focused" v-model="form.product_unit">
                  <option value="">Select Unit</option>
                  <option v-for="item in units" :key="item.id" :value="item.id">{{item.name}} ({{item.code}})</option>
                </select>
              </div>
              <small v-if="errors.product_unit && (errors.product_unit.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.product_unit[0]}}</small>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Sale Unit</label>
                <select @input="clearErrorStatusOnInput('sale_unit')" class="select form-control floating focused" v-model="form.sale_unit">
                  <option value="">Select Unit</option>
                  <option v-for="item in units" :key="item.id" :value="item.id">{{item.name}} ({{item.code}})</option>
                </select>
              </div>
              <small v-if="errors.sale_unit && (errors.sale_unit.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.sale_unit[0]}}</small>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group form-focus focused">
                <label class="focus-label">Purchase Unit</label>
                <select @input="clearErrorStatusOnInput('purchase_unit')" class="select form-control floating focused" v-model="form.purchase_unit">
                  <option value="">Select Unit</option>
                  <option v-for="item in units" :key="item.id" :value="item.id">{{item.name}} ({{item.code}})</option>
                </select>
              </div>
              <small v-if="errors.purchase_unit && (errors.purchase_unit.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.purchase_unit[0]}}</small>
            </div>
            <div class="col-md-4 mt-2">
              <div class="form-group form-focus focused">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkbox" v-model="form.has_inventory"> Enable Inventory
                    </label>
                </div>                    
              </div>
            </div>
            <div class="col-md-4 mt-2">
              <div class="form-group form-focus focused">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkbox" v-model="form.is_active"> Enable Product
                    </label>
                </div>                    
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label class="form-label">Add Product Images</label>
              <input @change="onFileSelected" class="form-control floating focused" type="file" multiple>
            </div>
            <div class="col-md-12 mb-3" v-if="showProductImage">
              <h4 class="h4">Product Images</h4>
              <hr>
              <div class="container-fluid">
                <ul class="row" style="margin: 0; padding: 0; min-height: 80px;">
                  <li class="col-md-3 col-sm-6 list-image">
                    <img src="jdjdjdjjd" alt="Product Image">
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                  <label class="focus-label">Product Meta</label>
                  <textarea @input="clearErrorStatusOnInput('product_meta')" class="form-control" v-model="form.product_meta"></textarea>
                </div>
              <small v-if="errors.product_meta && (errors.product_meta.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.product_meta[0]}}</small>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group-ckeditor">
                <label class="focus-label">Product Details</label>
                <ckeditor class="form-control" v-model="form.product_details" style="padding: 0; height: inherit;"></ckeditor>
              </div>
              <small v-if="errors.product_details && (errors.product_details.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.product_details[0]}}</small>
            </div>
          </div>
        </div>
        <div class="text-center m-t-20">
            <button v-if="!isLoading" @click.prevent="attemptAddingProduct" class="btn btn-primary btn-lg" type="button">Add Product</button>
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
  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../store/store_helpers/constantVariables";

  export default {
    name: 'Add',

    data() {
      return {
        categories: [],
        brands: [],
        units: [],

        form: {
          name: '',
          generic_name: '',
          code: '',
          category: '',
          brand: '',
          product_unit: '',
          sale_unit: '',
          purchase_unit: '',
          unit_cost_price: 0,
          unit_selling_price: 0,
          quantity_alert: 0,
          has_inventory: 0,
          is_active: 0,
          product_meta: '',
          product_details: '',
        },
        errors: {
          name: [],
          generic_name: [],
          code: [],
          category: [],
          brand: [],
          product_unit: [],
          sale_unit: [],
          purchase_unit: [],
          unit_cost_price: [],
          unit_selling_price: [],
          quantity_alert: [],
          product_meta: [],
          product_details: [],
        },

        selectedFiles: null,
        loadingCode: false,
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType', 'backURL' ]),

      showProductImage() {
        return this.selectedFiles ? true : false;
      }
    },

    methods: {
      generateProductCode(e) {
        e.target.setAttribute("disabled", true);
        this.form.code = "Generating Code ...";
        this.loadingCode = true;
        axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
          axios.get('/generate-product-code')
          .then((response) => {
            e.target.setAttribute("disabled", false);
            this.form.code = response.data.product_code;
            this.loadingCode = false;
          }).catch(() => {
            e.target.setAttribute("disabled", false);
            this.form.code = "";
            this.loadingCode = false;
          });
      },

      getInteger(value) {
        let returnValue = null;
        try {
          returnValue = parseInt(value)
        } catch (error) {
          returnValue = ''
        }
        return returnValue;
      },

      onFileSelected(event) {
        const files = event.target.files
        let filename = files[0].name
        if(filename.lastIndexOf(".") <=  0) {
          return alert("Please upload a valid file!");
        }
        
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.form.categoryImage = fileReader.result
        })


        fileReader.readAsDataURL(files[0])
        this.form.selectedFile = files[0]
      },

      attemptAddingProduct() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();
            let contentType = 'application/json';

            formData.append('name', this.form.name);
            formData.append('generic_name', this.form.generic_name);
            formData.append('code', this.form.code);
            formData.append('category', this.getInteger(this.form.category));
            formData.append('brand', this.getInteger(this.form.brand));
            formData.append('product_unit', this.getInteger(this.form.product_unit));
            formData.append('sale_unit', this.getInteger(this.form.sale_unit));
            formData.append('purchase_unit', this.getInteger(this.form.purchase_unit));
            formData.append('unit_cost_price', this.form.unit_cost_price);
            formData.append('unit_selling_price', this.form.unit_selling_price);
            formData.append('quantity_alert', this.form.quantity_alert);
            formData.append('has_inventory', this.form.has_inventory);
            formData.append('is_active', this.form.is_active);
            formData.append('product_meta', this.form.product_meta);
            formData.append('product_details', this.form.product_details);

            if (this.form.selectedFile) {
              contentType = 'multipart/form-data';
              formData.append('file_upload', this.form.selectedFile);
            }

            formData.append('content_type', contentType);

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post('/managers/products', formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
              if (response.status === 200) {
                // notify of successful create operation
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});
                  
                this.$router.push({
                  name: 'AllProducts',
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

                  if (error.response.data.errors.code && error.response.data.errors.code.length > 0) {
                    this.errors.code = error.response.data.errors.code
                  } 

                  if (error.response.data.errors.category && error.response.data.errors.category.length > 0) {
                    this.errors.category = error.response.data.errors.category
                  }

                  if (error.response.data.errors.brand && error.response.data.errors.brand.length > 0) {
                    this.errors.brand = error.response.data.errors.brand
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
      EventBus.$emit('active-menu-label-updated', 'add');
      
      this.$store.dispatch(IS_LOADING, true)
        .then(()=>{
            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.get('/product-resources')
            .then(response => {
              if (response.status === 200) {
                this.categories = response.data.categories;
                this.brands = response.data.brands;
                this.units = response.data.units;
              }
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            })
            .catch(error => {
              console.log(`ADD CATEGORY API DATA ERROR: ${error}`); 
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

  .right-input-btn,
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

  .right-input-btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    color: #fff;
  }

  .right-input-btn:focus {
    outline: none !important;
    box-shadow: none !important;
  }

  input[type=file]::file-selector-button {
    border-radius: 0 !important;
    background: #d4af37;
    border: 2px solid #d4af37;
  }

  .list-image {
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .list-image img {
    width: 80px;
    height: 80px;
    border: 1px solid #AAA;
    margin-bottom: 20px;
  }

  .form-group-ckeditor {

  }
</style>