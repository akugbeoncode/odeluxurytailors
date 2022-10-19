<template>
  <div class="main-wrapper account-wrapper">
    <div class="account-page">
      <div class="container">
        <h3 class="h1 col-12 text-center mt-3 mb-5 text-color-theme"><strong>Ode Luxury Tailors Management System</strong></h3>
        <div class="account-box">
          <div class="account-wrapper">
            <div class="account-logo">
                <a href="index.html"><img src="/images/OLTs_transparent_bg.png" alt="Preadmin"></a>
            </div>
            <form>
                <div class="mb-3">
                  <div class="form-group form-focus focused">
                    <label class="focus-label">Email</label>
                    <input @input="clearErrorStatusOnInput('email')" class="form-control floating" autocomplete="off" v-model="form.email" type="text">
                  </div>
                  <small v-if="errors.email && (errors.email.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-2">{{errors.email[0]}}</small>
                </div>
                <div class="mb-3 ml-0">
                  <div class="form-group form-focus focused mb-0">
                    <label class="focus-label">Password</label>
                    <input @input="clearErrorStatusOnInput('password')" class="form-control floating" autocomplete="off" v-model="form.password" type="password">
                  </div>
                  <small v-if="errors.password && (errors.password.length > 0)" class="form-text text-danger d-flex justify-content-left ml-0 mb-3">{{errors.password[0]}}</small>
                </div>
                <div class="form-group text-center pt-3">
                    <button v-if="!isLoading" @click.prevent="attemptLogin" class="btn btn-primary btn-block account-btn" type="button">Login</button>
                    <button v-else :disabled="isLoading" class="btn btn-primary btn-block account-btn" type="button">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Loading...  
                    </button>
                </div>
                <div class="text-center mt-5">
                    <a href="#">Forgot your password?</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import { mapGetters } from "vuex";
  import { IS_LOADING, ATTEMPT_LOGIN, MANAGER, TAILOR, LAUNDRY, FRONT_DESK, ATTEMPT_LOGOUT } from "../store/store_helpers/constantVariables";
  import { isEmptyObject } from '../helpers/isEmptyObject'
  
  export default {
    name: 'Login',

    data() {
      return {
        slide: 0,
        sliding: null,
        passwordType: 'password',
        emailType: 'email',

        form: {
          email: "",
          password: ""
        },
        errors: {
          email: [],
          password: []
        },
        errorMessage: ""
      }
    },

    computed: {
      ...mapGetters(["isLoading"]),

      isValidEmail () {
        return this.errors.email.length <= 0 ? null : false
      },

      isValidPassword () {
        return this.errors.password.length <= 0 ? null : false
      }
    },

    methods: {
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      },

      isEmptyObject(obj) {
        return isEmptyObject(obj)
      },

      clearErrorStatusOnInput(fieldName) {
        if (this.form[fieldName].length > 0) {
          this.errors[fieldName] = []
        }
        this.errorMessage = ""
      },

      attemptLogin() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            this.$store.dispatch(ATTEMPT_LOGIN, { email: this.form.email, password: this.form.password })
              .then((response) => {
                if (response.status === 200 && response.data.access_token) {
                  if (response.data.user.role.access_level === MANAGER) {
                    this.$router.push({
                      name: 'ManagerUserAccountDashboard',
                      params: {
                        loggedUserID: response.data.user.id
                      }
                    })
                  } else if (response.data.user.role.access_level === TAILOR) {
                    this.$router.push({
                      name: 'TailorUserAccountDashboard',
                      params: {
                        loggedUserID: response.data.user.id
                      }
                    })
                  } else if (response.data.user.role.access_level === FRONT_DESK) {
                    this.$router.push({
                      name: 'ServiceUserAccountDashboard',
                      params: {
                        loggedUserID: response.data.user.id
                      }
                    })
                  } else if (response.data.user.role.access_level === LAUNDRY) {
                    this.$router.push({
                      name: 'LaundryUserAccountDashboard',
                      params: {
                        loggedUserID: response.data.user.id
                      }
                    })
                  } else {
                    this.$store.dispatch(ATTEMPT_LOGOUT)
                    .then(() => {
                      this.$router.push({
                        name: 'ManagementLogin'
                      })
                    }).catch((error) => {
                      console.log("LOGOUT ATTEMPT FAILED ERROR: ", error);
                    });
                  }
                }
                this.$store.dispatch(IS_LOADING, false)
                  .then(() => { 
                    console.log(`isLoading false === ${this.isLoading}`); 
                  }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
              }).catch((error) => {
                console.log(error)
                try {
                  if (error.status === 422) {
                    if (error.data.email && error.data.email.length > 0) {
                      this.errors.email = error.data.email
                    }

                    if (error.data.password && error.data.password.length > 0) {
                      this.errors.password = error.data.password
                    }
                  } else if (error.status === 401) {
                    this.errorMessage = "Invalid email OR password!"
                  } else {

                  }
                } catch(err) {
                  console.log("LOGIN TRY CATCH ERROR: ", err)
                }

                this.$store.dispatch(IS_LOADING, false)
                  .then(() => { 
                    console.log(`isLoading false === ${this.isLoading}`); 
                  }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
              })
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
      if (this.isLoading) {
        this.$store.dispatch(IS_LOADING, false)
          .then(() => { 
            console.log(`isLoading false === ${this.isLoading}`); 
          }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      }
    }
  }
</script>

<style lang="scss" scoped>
  .account-page {padding: 40px 0;}
  .account-title {font-size: 32px;font-weight: normal;margin: 0 0 40px;text-align: center;}
  .account-box {margin: 0 auto !important;width: 400px !important; border:1px solid #2d2d2d;background-color:#1a1a1a;}
  .account-wrapper {padding: 30px;}
  .account-logo {margin-bottom: 20px;text-align: center;}
  .account-box .form-group {margin-bottom: 25px;}
  .account-box .account-btn {border-radius: 0;font-size: 22px;padding: 10px 26px;border:0;}
  .account-box .account-btn:hover, .account-box .account-btn:focus {border:0;opacity:0.8;}
  .account-box a {color: #d4af37;font-size: 16px;}
  .account-box a:hover {color: #00bf6f;}
  .account-box .form-control {border: 1px solid #353535;height: 50px;}
  .account-box label {color: #7f8fa4;font-size: 16px;font-weight: normal;}
  .account-logo img {width: 100px;}

  .form-group, .form-focus { margin-bottom: 0 !important;}

  .text-color-theme {
    color: #d4af37;
  }

  @media only screen and (max-width: 575.98px) {
    .account-box {width:100% !important;margin-bottom: 20px;}
    .account-page {width:100% !important;}
    body {font-size:12px;}
  }

  .account-wrapper { overflow-x: hidden;}

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