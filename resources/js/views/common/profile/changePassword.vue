<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-title">Change Password</h4>
        <form class="col-md-8 offset-md-2">
          <div class="row">
              <div class="col-sm-12 m-t-20 text-primary">
                <h3 class="h4 text-light"><u><strong>Hint</strong></u></h3>
                <p>
                  The password change MUST be in compliance with the set of rules listed below:
                </p>
                <ul>
                  <li>Password MUST be atleast 8 character long</li>
                  <li>Password MUST contain atleast an upper case character</li>
                  <li>Password MUST contain atleast a lower case character</li>
                  <li>Password MUST contain atleast a numeric character (0 – 9)</li>
                  <li>Password MUST contain atleast a special character</li>
                </ul>
              </div>
          </div>
          <div class="row">
            <div class="card-box">
              <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Old password</label>
                          <input @input="clearErrorStatusOnInput('old_password')" type="password" class="form-control floating" v-model="form.old_password">
                      </div>
                      <small v-if="errors.old_password && (errors.old_password.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.old_password[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">New password</label>
                          <input @input="clearErrorStatusOnInput('new_password')" type="password" class="form-control floating" v-model="form.new_password">
                      </div>
                      <small v-if="errors.new_password && (errors.new_password.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.new_password[0]}}</small>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group form-focus focused">
                          <label class="focus-label">Confirm password</label>
                          <input @input="clearErrorStatusOnInput('confirm_password')" type="password" class="form-control floating" v-model="form.confirm_password">
                      </div>
                      <small v-if="errors.confirm_password && (errors.confirm_password.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.confirm_password[0]}}</small>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-12 text-center m-t-20">
                  <button @click.prevent="attemptLoggedUserPasswordUpdate" type="button" class="btn btn-primary btn-lg">Update Password</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';

  import { isEmptyObject } from '../../../helpers/isEmptyObject';
  import { processDate } from '../../../helpers/processDateTime';

  export default {
    name: 'LoggedUserChangeProfilePassword',

    data() {
      return {
        form: {
          old_password: '',
          new_password: '',
          confirm_password: '',
        },
        errors: {
          old_password: [],
          new_password: [],
          confirm_password: [],
        }
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
      attemptLoggedUserPasswordUpdate() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
          const formData = new FormData();

          formData.append('old_password', this.form.old_password);
          formData.append('new_password', this.form.new_password);
          formData.append('confirm_password', this.form.confirm_password);
          
          formData.append("_method", "put");

          axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
          axios.post(`/user-profile/${this.loggedUser.id}/changed-logged-user-password`, formData, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
          }).then(response => {
            if (response.status === 200) {
              this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                .then(() => { console.log("Alert message update.");});

              this.$router.push({
                name: 'LoggedUserProfileDetails',
                params: {
                  loggedUserID: this.loggedUser.id,
                  loggedUserRouteDetails: this.loggedUser.role.access_level
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
                if (error.response.data.errors.old_password && error.response.data.errors.old_password.length > 0) {
                  this.errors.old_password = error.response.data.errors.old_password
                }

                if (error.response.data.errors.new_password && error.response.data.errors.new_password.length > 0) {
                  this.errors.new_password = error.response.data.errors.new_password
                }

                if (error.response.data.errors.confirm_password && error.response.data.errors.confirm_password.length > 0) {
                  this.errors.confirm_password = error.response.data.errors.confirm_password
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

      clearErrorStatusOnInput(fieldName) {
        if (this.form[fieldName]){
          if (this.form[fieldName].length > 0) {
            this.errors[fieldName] = []
          }
        }
       
        this.errorMessage = ""
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
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'change logged user password');
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