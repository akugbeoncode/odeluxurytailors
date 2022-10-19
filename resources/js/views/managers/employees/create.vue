<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Create Employee Account</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'EmployeeManagerViewAllEmployees',
              params: {
                loggedUserID: loggedUser.id
              },
              query: {
                role: ''
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
                          <img class="inline-block" :src="profilePhoto" alt="user">
                          <div class="fileupload btn">
                              <span class="btn-text">edit</span>
                              <input class="upload" type="file" ref="file" @change="onFileSelected($event)" accept="image/*" required>
                          </div>
                      </div>
                      <div class="profile-basic">
                          <div class="row">
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Last Name</label>
                                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('lastname')" type="text" class="form-control floating" v-model="form.lastname">
                                  </div>
                                  <small v-if="errors.lastname && (errors.lastname.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.lastname[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Other Names</label>
                                      <input @keypress="isLetter($event)" @input="clearErrorStatusOnInput('othernames')" type="text" class="form-control floating" v-model="form.othernames">
                                  </div>
                                  <small v-if="errors.othernames && (errors.othernames.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.othernames[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus focused">
                                      <label class="focus-label">Date of Birth</label>
                                      <div class="cal-icon">
                                          <input @input="clearErrorStatusOnInput('dob')" class="form-control" type="date" :min="getMinDate()"  :max="getMaxDate()" v-model="form.dob">
                                      </div>
                                  </div>
                                  <small v-if="errors.dob && (errors.dob.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.dob[0]}}</small>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <div class="form-group form-focus select-focus">
                                      <label class="focus-label">Gender</label>
                                      <select @change="clearErrorStatusOnInput('gender_id')" class="select form-control floating focused" v-model="form.gender_id">
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
                          <textarea @input="clearErrorStatusOnInput('address')" type="text" class="form-control floating" v-model="form.address"></textarea>
                      </div>
                      <small v-if="errors.address && (errors.address.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.address[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">Country</label>
                      <select @change="clearErrorStatusOnInput('country_id')" class="select form-control floating focused" v-model="form.country_id">
                          <option value="">Select Country</option>
                          <option v-for="country in countries" :key="country.id" :value="country.id">{{country.name}} ({{country.code}})</option>
                      </select>
                    </div>
                    <small v-if="errors.country_id && (errors.country_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.country_id[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">State</label>
                      <select @change="clearErrorStatusOnInput('state_id')" class="select form-control floating focused" v-model="form.state_id">
                          <option value="">Select State</option>
                          <option v-for="state in countryStates" :key="state.id" :value="state.id">{{state.name}}</option>
                      </select>
                    </div>
                    <small v-if="errors.state_id && (errors.state_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.state_id[0]}}</small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="form-group form-focus select-focus">
                      <label class="focus-label">City</label>
                      <select @change="clearErrorStatusOnInput('city_id')" class="select form-control floating focused" v-model="form.city_id">
                          <option value="">Select City</option>
                          <option v-for="city in stateCities" :key="city.id" :value="city.id">{{city.name}}</option>
                      </select>
                    </div>
                    <small v-if="errors.city_id && (errors.city_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.city_id[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Email</label>
                          <input @input="clearErrorStatusOnInput('email')" type="email" class="form-control floating" v-model="form.email">
                      </div>
                      <small v-if="errors.email && (errors.email.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.email[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Phone Number</label>
                          <input @input="clearErrorStatusOnInput('phone')" @keypress="isPhoneNumber($event)" type="text" class="form-control floating" v-model="form.phone">
                      </div>
                      <small v-if="errors.phone && (errors.phone.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.phone[0]}}</small>
                  </div>
              </div>
          </div>
          <div class="card-box">
            <h3 class="card-title">Guarantor Information</h3>
            <div v-for="(guarantor, guarantorIndex) in form.guarantors" :key="guarantorIndex" class="row">
              <div class="col-md-12 mb-3">
                <div class="d-flex justify-content-between">
                  <span><h4 class="card-title">Guarantor {{ guarantorIndex + 1}} Form</h4></span>
                  <span>
                    <a @click.prevent="removeGuarantorForm(guarantorIndex)" v-if="guarantorIndex > 0" class="badge rounded-pill bg-danger mr-3" style="cursor: pointer;"><i class="fa fa-times"></i></a>
                  </span>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Full Name</label>
                  <input @keypress="isLetter($event)" type="text" class="form-control floating" v-model="guarantor.fullname">
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Email</label>
                  <input type="email" class="form-control floating" v-model="guarantor.email">
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Phone Number</label>
                  <input @keypress="isPhoneNumber($event)" type="text" class="form-control floating" v-model="guarantor.phone">
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Address</label>
                  <input type="text" class="form-control floating" v-model="guarantor.address">
                </div>
              </div> 
            </div>
            <div class="add-more">
              <a @click.prevent="addMoreGuarantors" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add More Guarantor</a>
            </div>
          </div>
          <div class="card-box">
            <h3 class="card-title">Employment Information</h3>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus focused">
                  <label class="focus-label">Employee ID</label>
                  <input @input="clearErrorStatusOnInput('employee_id')" type="text" class="form-control floating text-center" v-model="form.employee_id" readonly>
                </div>
                <small v-if="errors.employee_id && (errors.employee_id.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.employee_id[0]}}</small>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group form-focus select-focus">
                  <label class="focus-label">Role</label>
                  <select @change="clearErrorStatusOnInput('role_id')" class="select form-control floating focused" v-model="form.role_id">
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
                      <input @input="clearErrorStatusOnInput('hire_date')" class="form-control" type="date" :min="getMinDate()"  :max="getTodayMaxDate()" v-model="form.hire_date">
                  </div>
                </div>
                <small v-if="errors.hire_date && (errors.hire_date.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.hire_date[0]}}</small>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group form-focus select-focus">
                  <label class="focus-label">Report's To</label>
                  <select @input="clearErrorStatusOnInput('reports_to')" class="select form-control floating focused" v-model="form.reports_to">
                      <option value="">Select Employee Head</option>
                      <option v-for="manager in managers" :key="manager.id" :hidden="manager.lastname === 'System' && manager.othernames === 'Administrator'" :value="manager.id">{{`${manager.lastname} ${manager.othernames} (${manager.employee_id})`}}</option>
                  </select>
                </div>
                <small v-if="errors.reports_to && (errors.reports_to.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.reports_to[0]}}</small>
              </div>
            </div>
          </div>
          <div class="text-center m-t-20">
            <button v-if="!isLoading" @click.prevent="attemptCreatingEmployeeRecord" class="btn btn-primary btn-lg" type="button">Create Empolyee Account</button>
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

  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../store/store_helpers/constantVariables";

  export default {
    name: 'EmployeeManagerCreateEmployeeAccount',

    data() {
      return {
        profileImage: '/storage/images/uploads/profile/default_profile_image.png',
        genders: [],
        countries: [],
        states: [],
        cities: [],
        roles: [],
        managers: [],
        countryStates: [],
        stateCities: [],
        selectedFile: null,

        form: {
          lastname: '',
          othernames: '',
          email: '',
          phone: '',
          dob: '',
          hire_date: '',
          address: '',
          employee_id: '',
          country_id: '',
          state_id: '',
          city_id: '',
          photo: '',
          reports_to: '',
          guarantors: [
            {
              fullname: '',
              phone: '',
              email: '',
              address: ''
            }
          ],
          role_id: '',
          gender_id: '',
        },
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
        errorMessage: ""
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

      isExecutiveOrAbove() {
        if (this.loggedUser.role.code === 'super_user' || this.loggedUser.role.code === 'executive') {
          return true;
        }
        return false;
      },

      profilePhoto() {
        return this.form.photo ? this.form.photo : this.profileImage;
      }
    },

    methods: {
      addMoreGuarantors() {
        this.form.guarantors.push({
          fullname: '',
          phone: '',
          email: '',
          address: ''
        });
      },

      removeGuarantorForm(guarantorIndex) {
        if (confirm(`Delete Guarantor ${guarantorIndex + 1} Form?`)) {
          this.form.guarantors.splice(guarantorIndex, 1)
        }
      },

      updateStateOptions() {
        if (!this.form.country_id) {
          this.countryStates = [];
        } else {
          this.countryStates = [];
          this.states.map(state => {
            if (state.country_id == this.form.country_id) {
              this.countryStates.push(state);
            }
          })
        }
      },

      updateCityOptions() {
        if (!this.form.state_id) {
          this.stateCities = [];
        } else {
          this.stateCities = [];
          this.cities.map(city => {
            if (city.state_id == this.form.state_id) {
              this.stateCities.push(city);
            }
          })
        }
      },

      onFileSelected(event) {
        const files = event.target.files
        let filename = files[0].name
        if(filename.lastIndexOf(".") <=  0) {
          return alert("Please upload a valid file!");
        }
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.form.photo = fileReader.result
        })
        fileReader.readAsDataURL(files[0])
        this.selectedFile = files[0]
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

      attemptCreatingEmployeeRecord() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();

            formData.append('is_file_set', false);

            if (this.selectedFile) {
              formData.append('file', this.$refs.file.files[0]);
              formData.set('is_file_set', true);
            }

            formData.append('lastname', this.form.lastname);
            formData.append('othernames', this.form.othernames);
            formData.append('email', this.form.email);
            formData.append('phone', this.form.phone);
            formData.append('dob', this.form.dob);
            formData.append('hire_date', this.form.hire_date);
            formData.append('address', this.form.address);
            formData.append('employee_id', this.form.employee_id);
            formData.append('country_id', this.form.country_id);
            formData.append('state_id', this.form.state_id);
            formData.append('city_id', this.form.city_id);
            formData.append('reports_to', this.form.reports_to);
            formData.append('role_id', this.form.role_id);
            formData.append('gender_id', this.form.gender_id);
            formData.append('guarantors', JSON.stringify(this.form.guarantors));

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post('/managers/employees', formData, {
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              }
            }).then(response => {
              if (response.status === 200) {
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});

                this.$router.push({
                  name: 'EmployeeManagerViewAllEmployees',
                  params: {
                    loggedUserID: this.loggedUser.id
                  },
                  query: {
                    role: ''
                  }
                });
              }
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            }).catch(error => {
              // console.log(`ATTEMPT CREATING EMPLOYEE RECORD ERROR:`, error); 
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
      },

      validateEmployeeFormData() {
        return true;
      },

      clearErrorStatusOnInput(fieldName) {
        if (this.form[fieldName].length > 0) {
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
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'new account');

      this.$store.dispatch(IS_LOADING, true)
        .then(()=>{
            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.get('/employee-account-resources')
            .then(response => {
              if (response.status === 200) {
                this.genders = response.data.genders;
                this.countries = response.data.countries;
                this.states = response.data.states;
                this.cities = response.data.cities;
                this.roles = response.data.roles;
                this.managers = response.data.managers;
                this.form.employee_id = response.data.employee_id;

                this.countries.map(country => {
                  if (country.code === "NG") {
                    this.form.country_id = country.id;
                  }
                });

                this.updateStateOptions();
              }
              this.$store.dispatch(IS_LOADING, false)
                .then(() => { 
                  console.log(`isLoading false === ${this.isLoading}`); 
                }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            })
            .catch(error => {
              console.log(`CREATE EMPLOYEE API DATA ERROR: ${error}`); 
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
    color: #ffffff;
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