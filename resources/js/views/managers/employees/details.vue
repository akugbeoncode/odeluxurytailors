<template>
  <div class="content" v-if="!isEmptyObject(employee)">
    <div class="row">
      <div class="col-sm-7 col-4">
        <h4 class="page-title">{{ capitalizeWordsInPhrase(employee.lastname) }} {{ capitalizeWordsInPhrase(employee.othernames) }}'s Profile</h4>
      </div>

      <div class="col-sm-5 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'EmployeeManagerEditEmployeeAccount',
            params: {
              loggedUserID: loggedUser.id,
              employeeID: employeeID
            }
          }"
          class="btn btn-primary mr-2"
        >
          <i class="fa fa-edit m-r-5"></i> Edit Profile
        </router-link>
        <router-link 
          :to="{
            name: 'EmployeeManagerViewAllEmployees',
            params: {
              loggedUserID: loggedUser.id
            }
          }" 
          class="btn btn-outline-secondary"
        >
          <i class="fas fa-arrow-circle-left"></i>
          Back
        </router-link>
      </div>
    </div>
    <div class="card-box">
      <div class="row">
        <div class="col-md-12">
          <div class="profile-view">
            <div class="profile-img-wrap">
                <div class="profile-img">
                    <a href="#"><img class="avatar" :src="employee.photo" :alt="`${fullnameInitials(capitalizeWordsInPhrase(employee.lastname) + ' ' + capitalizeWordsInPhrase(employee.othernames))}`"></a>
                </div>
            </div>
            <div class="profile-basic">
                <div class="row">
                    <div class="col-md-5">
                        <div class="profile-info-left">
                            <h3 class="user-name m-t-0 m-b-0">{{ capitalizeWordsInPhrase(employee.lastname) }} {{ capitalizeWordsInPhrase(employee.othernames) }}</h3>
                            <small class="text-muted">{{  capitalizeWordsInPhrase(employee.role.title) }}</small>
                            <div class="staff-id">Employee ID : {{employee.employee_id}}</div>
                            <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <ul class="personal-info">
                            <li>
                                <span class="title">Phone:</span>
                                <span class="text"><a href="#">{{ employee.phone }}</a></span>
                            </li>
                            <li>
                                <span class="title">Email:</span>
                                <span class="text"><a href="#">{{ employee.email }}</a></span>
                            </li>
                            <li>
                                <span class="title">Birthday:</span>
                                <span class="text"> {{ processDateDOB(employee.dob) }} </span>
                            </li>
                            <li>
                                <span class="title">Address:</span>
                                <span class="text"> {{employee.address}} </span>
                            </li>
                            <li>
                                <span class="title">Gender:</span>
                                <span class="text">{{employee.gender.name}}</span>
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
  import { axiosGetRequest } from '../../../helpers/axiosGetRequest';

  import { IS_LOADING } from "../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';

  import { isEmptyObject } from '../../../helpers/isEmptyObject';
  import { processDate } from '../../../helpers/processDateTime';

  export default {
    name: 'EmployeeManagerEmployeeAccountDetails',

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
      }
    },

    created() {
      this.employeeID = this.$route.params.employeeID;

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          this.employee = await this.getEmployeeFromBackendService();
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
</style>