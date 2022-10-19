<template>
  <div class="content">
    <div class="row">
      <div class="col-sm-7 col-4">
        <h4 class="page-title">Change Profile Image</h4>
      </div>

      <div class="col-sm-5 col-8 text-right m-b-30">
        
      </div>
    </div>
    <div class="card-box">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="row">
                  <div class="col-12" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <div class="profile-img-wrap">
                        <img class="inline-block" :src="loggedUserInstance.photo" alt="user">
                        <div class="fileupload btn">
                            <span class="btn-text">edit</span>
                            <input class="upload" type="file" ref="file" @change="onFileSelected($event)" accept="image/*" required>
                        </div>
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <button :disabled="!enableImageUploadButton" @click="attemptToUpdateProfileImage" type="button" class="btn mr-3" :class="{ 'btn-secondary': !enableImageUploadButton, 'btn-success': enableImageUploadButton }"><i class="fas fa-upload"></i> Upload Image</button>
                    <button @click="attemptToRemoveProfileImage" type="button" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Remove Image</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  import { IS_LOADING, ADD_ALERT_MESSAGE, UPDATE_LOGGED_USER_DETAILS } from "../../../store/store_helpers/constantVariables";

  export default {
    name: 'LoggedUserChangeProfileImage',

    data() {
      return {
        selectedFile: null,
        loggedUserInstance: {}
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

      enableImageUploadButton() {
        return this.selectedFile ? true : false;
      }
    },

    methods: {
      onFileSelected(event) {
        const files = event.target.files
        let filename = files[0].name

        if(filename.lastIndexOf(".") <=  0) {
          return alert("Please upload a valid file!");
        }

        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.loggedUserInstance.photo = fileReader.result
        })

        fileReader.readAsDataURL(files[0])
        this.selectedFile = files[0]
      },

      attemptToUpdateProfileImage() {
        this.$store.dispatch(IS_LOADING, true)
          .then(() => { 
            const formData = new FormData();
            let contentType = 'application/json';

            if (this.selectedFile) {
              contentType = 'multipart/form-data';
              formData.append('file_upload', this.selectedFile);
            }
            formData.append('content_type', contentType);
            formData.append("_method", "put");

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post(`user-profile/${this.loggedUserInstance.id}/changed-logged-user-profile-image`, formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
              if (response.status == 200) {
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                  .then(() => { console.log("Alert message update.");});

                this.$store.dispatch(UPDATE_LOGGED_USER_DETAILS, { loggedUser: response.data.user })
                  .then(() => { console.log("logged user record updated.");});

                this.$router.push({
                  name: 'EditLoggedUserProfileDetails',
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

      attemptToRemoveProfileImage() {
        if ( confirm(`Do you want to remove your profile image?`) ) {
          this.$store.dispatch(IS_LOADING, true)
            .then(() => { 
              const formData = new FormData();
              let contentType = 'application/json';
              formData.append('content_type', contentType);
              formData.append("_method", "put");

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.post(`user-profile/${this.loggedUserInstance.id}/changed-logged-user-profile-image`, formData, {
              headers: {
                  'Content-Type': contentType
              }
            }).then(response => {
                if (response.status === 200) {
                  this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: response.data.message })
                    .then(() => { console.log("Alert message update.");});

                  this.$store.dispatch(UPDATE_LOGGED_USER_DETAILS, { loggedUser: response.data.user })
                    .then(() => { console.log("logged user record updated.");});

                  this.$router.push({
                    name: 'EditLoggedUserProfileDetails',
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
                this.$store.dispatch(IS_LOADING, false)
                  .then(() => { 
                    console.log(`isLoading false === ${this.isLoading}`); 
                  }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
                // console.log(`ATTEMPT CREATING EMPLOYEE RECORD ERROR:`, error); 

                if (error.response.status === 422 || error.status === 422) {
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
        }
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'change logged user photo');

      this.loggedUserInstance = this.loggedUser;
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
</style>