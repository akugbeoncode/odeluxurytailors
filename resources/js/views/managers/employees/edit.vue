<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Edit {{ capitalizeWordsInPhrase(employee.lastname) }} {{ capitalizeWordsInPhrase(employee.othernames) }}'s Profile</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'EmployeeManagerEmployeeAccountDetails',
              params: {
                loggedUserID: loggedUser.id,
                employeeID: employeeID
              }
            }" 
            class="btn btn-outline-danger"
          >
            <i class="fa fa-times"></i>
            Cancel 
          </router-link>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="card-box">
              <h3 class="card-title">Basic Informations</h3>
              <div class="row">
                  <div class="col-md-12">
                      <div class="profile-img-wrap">
                          <img class="inline-block" :src="employee.photo" alt="user">
                      </div>
                      <div class="profile-basic">
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Last Name</label>
                                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('lastname')" type="text" class="form-control floating" v-model="employee.lastname">
                                  </div>
                                  <small v-if="errors.lastname && (errors.lastname.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.lastname[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Other Names</label>
                                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('othernames')" type="text" class="form-control floating" v-model="employee.othernames">
                                  </div>
                                  <small v-if="errors.othernames && (errors.othernames.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.othernames[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Date of Birth</label>
                                      <div class="cal-icon">
                                          <input @input="clearErrorStatusOnInput('dob')" class="form-control" type="date" :min="getMinDate()"  :max="getMaxDate()" v-model="employee.dob" disabled>
                                      </div>
                                  </div>
                                  <small v-if="errors.dob && (errors.dob.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.dob[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus select-focus">
                                      <label class="focus-label">Gender</label>
                                      <select @change="clearErrorStatusOnInput('gender_id')" class="select form-control floating focused" v-model="employee.gender_id" disabled>
                                        <option value="">Select Gender</option>
                                        <option v-for="gender in genders" :key="gender.id" :value="gender.id">{{gender.name}} ({{gender.code}})</option>
                                      </select>
                                  </div>
                                  <small v-if="errors.gender_id && (errors.gender_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.gender_id[0]}}</small>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-box">
              <h3 class="card-title">Contact Informations</h3>
              <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Address</label>
                          <textarea @input="clearErrorStatusOnInput('address')" type="text" class="form-control floating" v-model="employee.address"></textarea>
                      </div>
                      <small v-if="errors.address && (errors.address.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.address[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">Country</label>
                      <select @change="clearErrorStatusOnInput('country_id')" class="select form-control floating focused" v-model="employee.country_id" disabled>
                          <option value="">Select Country</option>
                          <option v-for="country in countries" :key="country.id" :value="country.id">{{country.name}} ({{country.code}})</option>
                      </select>
                    </div>
                    <small v-if="errors.country_id && (errors.country_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.country_id[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">State</label>
                      <select @change="clearErrorStatusOnInput('state_id')" class="select form-control floating focused" v-model="employee.state_id" disabled>
                          <option value="">Select State</option>
                          <option v-for="state in countryStates" :key="state.id" :value="state.id">{{state.name}}</option>
                      </select>
                    </div>
                    <small v-if="errors.state_id && (errors.state_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.state_id[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">City</label>
                      <select @change="clearErrorStatusOnInput('city_id')" class="select form-control floating focused" v-model="employee.city_id" disabled>
                          <option value="">Select City</option>
                          <option v-for="city in stateCities" :key="city.id" :value="city.id">{{city.name}}</option>
                      </select>
                    </div>
                    <small v-if="errors.city_id && (errors.city_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.city_id[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Email</label>
                          <input @input="clearErrorStatusOnInput('email')" type="email" class="form-control floating" v-model="employee.email" readonly disabled>
                      </div>
                      <small v-if="errors.email && (errors.email.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.email[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Phone Number</label>
                          <input @input="clearErrorStatusOnInput('phone')" @keypress="isPhoneNumber($event)" type="text" class="form-control floating" v-model="employee.phone">
                      </div>
                      <small v-if="errors.phone && (errors.phone.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.phone[0]}}</small>
                  </div>
              </div>
          </div>
          <div class="card-box">
            <h3 class="card-title">Employment Information</h3>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Employee ID</label>
                  <input @input="clearErrorStatusOnInput('employee_id')" type="text" class="form-control floating text-center" v-model="employee.employee_id" readonly disabled>
                </div>
                <small v-if="errors.employee_id && (errors.employee_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.employee_id[0]}}</small>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group form-focus select-focus">
                  <label class="focus-label">Role</label>
                  <select @change="clearErrorStatusOnInput('role_id')" class="select form-control floating focused" v-model="employee.role_id">
                      <option value="">Select Employee Role</option>
                      <option v-for="role in roles" :key="role.id" :value="role.id" :hidden="role.code === 'super_user'">{{role.title}}</option>
                  </select>
                </div>
                <small v-if="errors.role_id && (errors.role_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.role_id[0]}}</small>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group form-focus focused">
                   <label class="focus-label">Hire Date</label>
                  <div class="cal-icon">
                      <input @input="clearErrorStatusOnInput('hire_date')" class="form-control" type="date" :min="getMinDate()"  :max="getTodayMaxDate()"  v-model="employee.hire_date" disabled>
                  </div>
                </div>
                <small v-if="errors.hire_date && (errors.hire_date.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.hire_date[0]}}</small>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus select-focus">
                  <label class="focus-label">Report's To</label>
                  <select @input="clearErrorStatusOnInput('reports_to')" class="select form-control floating focused" v-model="employee.reports_to">
                      <option value="">Select Employee Head</option>
                      <option v-for="manager in managers" :key="manager.id" :hidden="manager.lastname === 'System' && manager.othernames === 'Administrator'" :value="manager.id">{{`${manager.lastname} ${manager.othernames} (${manager.employee_id})`}}</option>
                  </select>
                </div>
                <small v-if="errors.reports_to && (errors.reports_to.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.reports_to[0]}}</small>
              </div>
            </div>
          </div>
          <div class="text-center m-t-20">
            <button v-if="!isLoading" @click.prevent="attemptUpdatingEmployeeRecord" class="btn btn-primary btn-lg" type="button">Update Empolyee Record</button>
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
  import { axiosGetRequest } from '../../../helpers/axiosGetRequest';

  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';

  import { isEmptyObject } from '../../../helpers/isEmptyObject';
  import { processDate } from '../../../helpers/processDateTime';

  export default {
    name: 'EmployeeManagerEditEmployeeAccount',

    data() {
      return {
        employeeID: '',
        employee: {},
        errors: {
          lastname: [],
          othernames: [],
          email: [],
          phone: [],
          dob: [],
          hire_date: [],
          address: [],
          employee_id: [],
          country_id: [],
          state_id: [],
          city_id: [],
          photo: [],
          reports_to: [],
          role_id: [],
          gender_id: [],
        },

        genders: [],
        countries: [],
        states: [],
        cities: [],
        roles: [],
        managers: [],
        countryStates: [],
        stateCities: []
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
      addMoreGuarantors() {
        this.employee.guarantors.push({
          fullname: '',
          phone: '',
          email: '',
          address: ''
        });
      },

      removeGuarantorForm(guarantorIndex) {
        if (confirm(`Delete Guarantor ${guarantorIndex + 1} Form?`)) {
          this.employee.guarantors.splice(guarantorIndex, 1)
        }
      },

      updateStateOptions() {
        if (!this.employee.country_id) {
          this.countryStates = [];
        } else {
          this.countryStates = [];
          this.states.map(state => {
            if (state.country_id == this.employee.country_id) {
              this.countryStates.push(state);
            }
          })
        }
      },

      updateCityOptions() {
        if (!this.employee.state_id) {
          this.stateCities = [];
        } else {
          this.stateCities = [];
          this.cities.map(city => {
            if (city.state_id == this.employee.state_id) {
              this.stateCities.push(city);
            }
          })
        }
      },

      isLetter(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if(/^[A-Za-z ]+$/.test(char)) return true; // Match with regex 
        else e.preventDefault(); // If not match, don't add to input text
      },

      isPhoneNumber(e) {
        let char = String.fromCharCode(e.keyCode); // Get the character
        if(/^[0-9+()-]+$/.test(char)) return true; // Match with regex 
        else e.preventDefault(); // If not match, don't add to input text
      },

      getMinDate() {
        const today = new Date()
        const minYear = today.getFullYear() - 100
        return `${minYear}-01-01`
      },
      
      getMaxDate() {
        const today = new Date()
        const minYear = today.getFullYear() - 17
        return `${minYear}-12-31`
      },

      getTodayMaxDate() {
        const today = new Date()
        const minYear = today.getFullYear()
        return `${minYear}-12-31`
      },

      async getEmployeeFromBackendService() {
        let response = null;
        await axiosGetRequest('/managers/employees/' + this.employeeID, this.tokenType, this.token).then((res) => {
          response = res;
        });
        if (response && response.status === 200) {
          return response.data;
        } else {
          return [];
        }
      },

      capitalizeWordsInPhrase(word) {
        return capitalizeWordsInPhrase(word);
      },
      
      fullnameInitials(fulname) {
        return fullnameInitials(fulname);
      },

      isEmptyObject(obj) {
        return isEmptyObject(obj);
      },

      processDateDOB(dateInfo) {
        const dateInstance = processDate(dateInfo);
        return dateInstance.split(',')[0];
      },

      validateEmployeeFormData() {
        return true;
      },

      clearErrorStatusOnInput(fieldName) {
        if (this.employee[fieldName].length > 0) {
          this.errors[fieldName] = []
        }
        this.errorMessage = ""

        if (fieldName === 'country_id') {
          this.updateStateOptions()
        }

        if (fieldName === 'state_id') {
          this.updateCityOptions()
        }
      },

      attemptUpdatingEmployeeRecord() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();

            formData.append('lastname', this.employee.lastname);
            formData.append('othernames', this.employee.othernames);
            formData.append('email', this.employee.email);
            formData.append('phone', this.employee.phone);
            formData.append('dob', this.employee.dob);
            formData.append('hire_date', this.employee.hire_date);
            formData.append('address', this.employee.address);
            formData.append('employee_id', this.employee.employee_id);
            formData.append('country_id', this.employee.country_id);
            formData.append('state_id', this.employee.state_id);
            formData.append('city_id', this.employee.city_id);
            formData.append('reports_to', this.employee.reports_to);
            formData.append('role_id', this.employee.role_id);
            formData.append('gender_id', this.employee.gender_id);
            formData.append("_method", "put");

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post(`/managers/employees/${this.employee.id}`, formData, {
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              }
            }).then(response => {
              if (response.status === 200) {
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});

                this.$router.push({
                  name: 'EmployeeManagerEmployeeAccountDetails',
                  params: {
                    loggedUserID: this.loggedUser.id,
                    employeeID: this.employee.id
                  }
                });
              }
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            }).catch(error => {
              console.log(`ATTEMPT CREATING EMPLOYEE RECORD ERROR:`, error); 
              try {
                if (error.response.status === 422 || error.status === 422) {
                  if (error.response.data.errors.lastname && error.response.data.errors.lastname.length > 0) {
                    this.errors.lastname = error.response.data.errors.lastname
                  }

                  if (error.response.data.errors.othernames && error.response.data.errors.othernames.length > 0) {
                    this.errors.othernames = error.response.data.errors.othernames
                  }

                  if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                    this.errors.email = error.response.data.errors.email
                  }

                  if (error.response.data.errors.phone && error.response.data.errors.phone.length > 0) {
                    this.errors.phone = error.response.data.errors.phone
                  }

                  if (error.response.data.errors.phone && error.response.data.errors.phone.length > 0) {
                    this.errors.phone = error.response.data.errors.phone
                  }

                  if (error.response.data.errors.dob && error.response.data.errors.dob.length > 0) {
                    this.errors.dob = error.response.data.errors.dob
                  }

                  if (error.response.data.errors.hire_date && error.response.data.errors.hire_date.length > 0) {
                    this.errors.hire_date = error.response.data.errors.hire_date
                  }

                  if (error.response.data.errors.address && error.response.data.errors.address.length > 0) {
                    this.errors.address = error.response.data.errors.address
                  }

                  if (error.response.data.errors.employee_id && error.response.data.errors.employee_id.length > 0) {
                    this.errors.employee_id = error.response.data.errors.employee_id
                  }

                  if (error.response.data.errors.country_id && error.response.data.errors.country_id.length > 0) {
                    this.errors.country_id = error.response.data.errors.country_id
                  }
                  
                  if (error.response.data.errors.state_id && error.response.data.errors.state_id.length > 0) {
                    this.errors.state_id = error.response.data.errors.state_id
                  }

                  if (error.response.data.errors.city_id && error.response.data.errors.city_id.length > 0) {
                    this.errors.city_id = error.response.data.errors.city_id
                  }

                  if (error.response.data.errors.reports_to && error.response.data.errors.reports_to.length > 0) {
                    this.errors.reports_to = error.response.data.errors.reports_to
                  }

                  if (error.response.data.errors.role_id && error.response.data.errors.role_id.length > 0) {
                    this.errors.role_id = error.response.data.errors.role_id
                  }

                  if (error.response.data.errors.gender_id && error.response.data.errors.gender_id.length > 0) {
                    this.errors.gender_id = error.response.data.errors.gender_id
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
              } catch(err) {
                console.log("LOGIN TRY CATCH ERROR: ", err)
              }

              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            });
          }).catch((error) => { 
            console.log(`IS LOADING LOGIN ERROR: ${error}`); 
            this.$store.dispatch(IS_LOADING, false)
              .then(() => { 
                console.log(`isLoading false === ${this.isLoading}`); 
              }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
          });
      }
    },

    created() {
      this.employeeID = this.$route.params.employeeID;

      this.$store.dispatch(IS_LOADING, true)
        .then(() => { 
          axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.get('/create-employee-account-resources')
            .then(async (response) => {
              if (response.status === 200) {
                this.genders = response.data.genders;
                this.countries = response.data.countries;
                this.states = response.data.states;
                this.cities = response.data.cities;
                this.roles = response.data.roles;
                this.managers = response.data.managers;
              }
              this.employee = await this.getEmployeeFromBackendService();
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  if (this.employee.guarantors.length <= 0) {
                    this.employee.guarantors.push({ fullname: '', phone: '', email: '', address: '' });
                    this.updateStateOptions();
                    this.updateCityOptions();
                  }
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            })
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
</style>