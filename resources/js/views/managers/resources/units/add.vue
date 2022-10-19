<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
          <h4 class="page-title">Add Product Unit</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'ProductUnits',
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
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <label class="focus-label">Name</label>
                  <input type="text" @input="clearErrorStatusOnInput('name')" class="form-control" v-model="form.name">
                </div>
              <small v-if="errors.name && (errors.name.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.name[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <label class="focus-label">Code</label>
                  <input type="text" @input="clearErrorStatusOnInput('code')" class="form-control" v-model="form.code">
                </div>
              <small v-if="errors.code && (errors.code.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.code[0]}}</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <label class="focus-label">Base Unit</label>
                  <input type="number" @input="clearErrorStatusOnInput('base_unit')" class="form-control" v-model="form.base_unit">
                </div>
              <small v-if="errors.base_unit && (errors.base_unit.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.base_unit[0]}}</small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <label class="focus-label">Operator</label>
                  <select @input="clearErrorStatusOnInput('operator')" class="select form-control floating focused" v-model="form.operator">
                      <option value="">Select Operator</option>
                      <option value="*">*</option>
                      <option value="/">/</option>
                  </select>
                </div>
              <small v-if="errors.operator && (errors.operator.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.operator[0]}}</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                  <label class="focus-label">Operational Value</label>
                  <input type="number" @input="clearErrorStatusOnInput('operational_value')" class="form-control" v-model="form.operational_value">
                </div>
              <small v-if="errors.operational_value && (errors.operational_value.length > 0)"  class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.operational_value[0]}}</small>
            </div>
            <div class="col-md-6 mt-5">
              <div class="form-group form-focus focused">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checkbox" v-model="form.is_active"> Enable Brand
                    </label>
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
          <button v-if="!isLoading" @click.prevent="attemptAddingProductUnit" class="btn btn-primary btn-lg" type="button">Add Product Unit</button>
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
    name: 'AddProductUnit',

    data() {
      return {
        form: {
          name: '',
          code: '',
          base_unit: 1,
          operator: '',
          operational_value: 1,
          is_active: 0,
          description: ''
        },

        errors: {
          name: [],
          code: [],
          base_unit: [],
          operator: [],
          operational_value: [],
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

      attemptAddingProductUnit() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();
            let contentType = 'application/json';

            formData.append('name', this.form.name);
            formData.append('code', this.form.code);
            formData.append('base_unit', this.form.base_unit);
            formData.append('operator', this.form.operator);
            formData.append('operational_value', this.form.operational_value);
            formData.append('is_active', this.form.is_active);
            formData.append('description', this.form.description);

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post('/managers/units', formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
              if (response.status === 200) {
                // notify of successful create operation
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});
                  
                this.$router.push({
                  name: 'ProductUnits',
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
      EventBus.$emit('active-menu-label-updated', 'add unit');
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