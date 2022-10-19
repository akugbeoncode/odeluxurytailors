<template>
  <div class="content" v-if="!isEmptyObject(loggedUser)">
    <div class="row">
      <div class="col-sm-7 col-4">
        <h4 class="page-title">{{ capitalizeWordsInPhrase(loggedUser.lastname) }} {{ capitalizeWordsInPhrase(loggedUser.othernames) }}'s Profile</h4>
      </div>

      <div class="col-sm-5 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'EditLoggedUserProfileDetails',
            params: {
              loggedUserID: loggedUserID,
              loggedUserRouteDetails: loggedUser.role.access_level
            }
          }"
          class="btn btn-primary mr-2"
        >
          <i class="fa fa-edit m-r-5"></i> Edit Profile
        </router-link>
      </div>
    </div>
    <div class="card-box">
      <div class="row">
        <div class="col-md-12">
          <div class="profile-view">
            <div class="profile-img-wrap">
                <div class="profile-img">
                    <a href="#"><img class="avatar" :src="loggedUser.photo" :alt="`${fullnameInitials(capitalizeWordsInPhrase(loggedUser.lastname) + ' ' + capitalizeWordsInPhrase(loggedUser.othernames))}`"></a>
                </div>
            </div>
            <div class="profile-basic">
                <div class="row">
                    <div class="col-md-5">
                        <div class="profile-info-left">
                            <h3 class="user-name m-t-0 m-b-0">{{ capitalizeWordsInPhrase(loggedUser.lastname) }} {{ capitalizeWordsInPhrase(loggedUser.othernames) }}</h3>
                            <small class="text-muted">{{  capitalizeWordsInPhrase(loggedUser.role.title) }}</small>
                            <div class="staff-id">Employee ID : {{loggedUser.employee_id}}</div>
                            <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <ul class="personal-info">
                            <li>
                                <span class="title">Phone:</span>
                                <span class="text"><a href="#">{{ loggedUser.phone }}</a></span>
                            </li>
                            <li>
                                <span class="title">Email:</span>
                                <span class="text"><a href="#">{{ loggedUser.email }}</a></span>
                            </li>
                            <li>
                                <span class="title">Birthday:</span>
                                <span class="text"> {{ processDateDOB(loggedUser.dob) }} </span>
                            </li>
                            <li>
                                <span class="title">Address:</span>
                                <span class="text"> {{loggedUser.address}} </span>
                            </li>
                            <li>
                                <span class="title">Gender:</span>
                                <span class="text">{{loggedUser.gender.name}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';

  import { isEmptyObject } from '../../../helpers/isEmptyObject';
  import { processDate } from '../../../helpers/processDateTime';

  export default {
    name: 'LoggedUserProfileDetails',

    data() {
      return {
        employeeID: '',
        employee: {},
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
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
      EventBus.$emit('active-menu-label-updated', 'logged user profile');
      this.loggedUserID = this.$route.params.loggedUserID;
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