<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Employees</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'EmployeeManagerCreateEmployeeAccount',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="btn btn-primary"
          >
            <i class="fa fa-plus"></i>
            Add Employee 
          </router-link>
        </div>
    </div>
    <div class="row filter-row">
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus focused">
            <label class="focus-label">Employee ID</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.employee_id">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus focused">
            <label class="focus-label">Employee Lastname</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.lastname">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus">
            <label class="focus-label">Employee Othernames</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.othernames">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
          <a @click.prevent="searchEmployees" class="btn btn-success btn-block text-white"><strong> Search </strong></a>
      </div>
    </div>
    <div class="row" v-if="isCollectionListEmpty">
      <div class="col-md-8 offset-md-2 mt-5">
        <div class="jumbotron mt-5">
          <h3 class="h3 text-center">{{ emptyMessage }}</h3>
        </div>
      </div>
    </div>
    <div class="row" v-if="!isCollectionListEmpty">
        <div class="col-md-12">
            <div class="table-responsive">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div style="display: flex !important; flex-direction: row !important; color: #d4af37; font-weight: 700;">
                    <label>Show&nbsp;&nbsp;
                    <select @change="updatePagination" v-model="per" class="form-control form-control-sm" style="width: 70px !important; display: inline-block !important;">
                      <option :value="10">10</option>
                      <option :value="25">25</option>
                      <option :value="50">50</option>
                      <option :value="100">100</option>
                    </select> 
                    &nbsp;&nbsp;entries</label>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row" style="min-height: calc(100vh - 330px);">
                <div class="col-12">
                  <table class="table table-striped custom-table datatable text-white">
                    <thead>
                        <tr class="text-white">
                            <th style="width:25%;">Name</th>
                            <th>Employee ID</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Hired Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in pages[current-1]" :key="employee.id">
                            <td>
                                <router-link 
                                  class="avatar"
                                  :to="{
                                    name: 'EmployeeManagerEmployeeAccountDetails',
                                    params: {
                                      loggedUserID: loggedUser.id,
                                      employeeID: employee.id
                                    }
                                  }"
                                >{{ fullnameInitials(employee.lastname + " " + employee.othernames) }}</router-link>
                                <h2>
                                  <router-link
                                    :to="{
                                      name: 'EmployeeManagerEmployeeAccountDetails',
                                      params: {
                                        loggedUserID: loggedUser.id,
                                        employeeID: employee.id
                                      }
                                    }"
                                  >
                                    {{capitalizeWordsInPhrase(employee.lastname)}} {{capitalizeWordsInPhrase(employee.othernames)}}
                                    <span>{{ capitalizeWordsInPhrase((employee.role ? employee.role.title : '')) }}</span>
                                  </router-link>
                                </h2>
                            </td>
                            <td>{{ employee.employee_id }}</td>
                            <td>{{ employee.email }}</td>
                            <td>{{ employee.phone }}</td>
                            <td>{{ capitalizeWordsInPhrase((employee.role ? employee.role.title : '')) }}</td>
                            <td>{{ employee.hire_date }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a @click.prevent="toggleActionMenuOptions($event)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <router-link 
                                          :to="{
                                            name: 'EmployeeManagerEditEmployeeAccount',
                                            params: {
                                              loggedUserID: loggedUser.id,
                                              employeeID: employee.id
                                            }
                                          }"
                                          class="dropdown-item"
                                        >
                                          <i class="fa fa-edit m-r-5"></i> Edit
                                        </router-link>
                                        <a class="dropdown-item" @click.prevent="attemptDeletingEmployeeRecord(employee.id, $event)"><i class="fa fa-trash m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" role="status" aria-live="polite">
                    Showing {{pageItemStartCount}} to {{pageItemEndCount}} of {{dataCollection.length}} entries
                  </div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <li 
                        class="paginate_button page-item previous" 
                        :class="{
                          disabled: prevDisabled
                        }"
                      >
                        <a @click.prevent="prevNextUpdate(-1)" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Prev</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link"><strong>{{current}}</strong> of <strong>{{last}}</strong></a>
                      </li>
                      <li class="paginate_button page-item next" :class="{disabled: nextDisabled}">
                        <a @click.prevent="prevNextUpdate(1)" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                      </li>
                    </ul>
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
  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../store/store_helpers/constantVariables";
  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';
  import { generatePagination } from '../../../helpers/pagination'
  import { searchWithThreeParameters } from '../../../helpers/searchWithThreeParameters'
  import { searchWithTwoParameters } from '../../../helpers/searchWithTwoParameters'
  import { searchWithOneParameter } from '../../../helpers/searchWithOneParameter'

  export default {
    name: 'EmployeeManagerViewAllEmployees',

    data() {
      return {
        dataCollection: [],
        roles: [],

        search: {
          employee_id: '',
          lastname: '',
          othernames: ''
        },

        per: 10,
        first: null,
        last: null,
        pages: [],
        current: null,
        previous: null,
        next: null,

        emptyMessage: 'Employee List is empty!'
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

      role() {
        const queryParam = this.$route.query.role;
        console.log(queryParam);
        return queryParam;
      },

      isCollectionListEmpty() {
        return this.dataCollection.length > 0 ? false : true;
      },

      prevDisabled() {
        return this.current <= this.first;
      }, 

      nextDisabled() {
        return this.current >= this.last;
      },

      pageItemStartCount() {
        let startCount = ((this.current -1) * this.per) + 1;
        return startCount < 0 ? 0 : startCount;
      },

      pageItemEndCount() {
        if (this.pageItemStartCount <= 0) {
          return 0
        }
        return this.pageItemStartCount + (this.per > this.dataCollection.length ? (this.dataCollection.length-1) : (this.pages[(this.current-1)].length - 1));
      }
    },

    methods: {
      toggleActionMenuOptions(event) {
        let targetElement = this.getTargetElement(event);

        if (targetElement.parentNode.classList.contains('show')) {
          targetElement.parentNode.classList.remove('show');
          targetElement.nextElementSibling.classList.remove('show');
        } else {
          targetElement.parentNode.classList.add('show');
          targetElement.nextElementSibling.classList.add('show');
        }
      },

      toggleParentMenuOptions(event) {
        let targetElement = this.getTargetElement(event);

        if (targetElement.parentNode.classList.contains('show')) {
          targetElement.parentNode.classList.remove('show');
          targetElement.parentNode.parentNode.classList.remove('show');
        }
      },

      getTargetElement(events) {
        if (events.target.tagName === "A") {
          return events.target;
        } else if (events.target.parentNode.tagName === "A") {
          return events.target.parentNode;
        } else if (events.target.parentNode.parentNode.tagName === "A") {
          return events.target.parentNode.parentNode;
        } else {
          return null;
        }
      },

      attemptDeletingEmployeeRecord(employeeID, event) {
        this.toggleParentMenuOptions(event);
        if (confirm(`Do you want to delete "${this.getEmployeeFullname(this.getEmployeeRecordByID(employeeID))}" employee record?`)) {
          this.$store.dispatch(IS_LOADING, true)
          .then(() => {

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.delete(`managers/employees/${employeeID}`, {
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              }
            }).then(async (res) => {
              console.log(res);
              if (res.status === 200) {
                const collections = await this.getDataCollectionFromBackendService();
                this.dataCollection = collections.users;
                this.roles = collections.roles;
                this.updatePagination();
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: res.data.message })
                  .then(() => { console.log("Alert message update.");});
                this.$store.dispatch(IS_LOADING, false)
                  .then(() => { console.log(`isLoading false === ${this.isLoading}`); }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
              }
            }).catch((error) => {
              this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: res.data.message })
                .then(() => { console.log("Alert message update.");});
            });
          })
          .catch(error => {
            console.log(`IS LOADING LOGIN ERROR: ${error}`); 
            this.$store.dispatch(IS_LOADING, false)
              .then(() => { 
                console.log(`isLoading false === ${this.isLoading}`); 
              }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
          });
        }
      },

      getEmployeeFullname(employeeRecord) {
        if (employeeRecord) {
          return `${this.capitalizeWordsInPhrase(employeeRecord.lastname)} ${this.capitalizeWordsInPhrase(employeeRecord.othernames)}`;
        } else {
          return "Unknown User Fullname";
        }
      },

      getEmployeeRecordByID(employeeID) {
        let targetEmployeeRecord = null;

        this.dataCollection.map((employee) => {
          if (employee.id === employeeID) {
            targetEmployeeRecord = employee;
          }
        });

        return targetEmployeeRecord;
      },

      async getDataCollectionFromBackendService() {
        let response = null;
        let url = '/managers/employees';
        if (this.$route.query.role) {
          url = '/managers/employees?role=' + this.$route.query.role;
        }
        await axiosGetRequest(url, this.tokenType, this.token).then((res) => {
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

      updatePagination() {
        const paginationData = generatePagination(this.dataCollection, this.per);

        console.log(paginationData);

        this.first = paginationData.first;
        this.last = paginationData.last;
        this.pages = paginationData.pages;
        this.current = paginationData.current;
        this.previous = paginationData.previous;
        this.next = paginationData.next;
      },

      prevNextUpdate(params) {
        if (this.prevDisabled && params == -1) { return null;} else if (this.nextDisabled && params == 1) { return null;}
        this.current += params;
        this.previous += params; 
        this.next += params;
      },

      searchUsersWithThreeParameters(label1, param1, label2, param2, label3, param3) {
        this.$store.dispatch(IS_LOADING, true)
          .then(async () => {  
            console.log(`isLoading true === ${this.isLoading}`); 

            const collections = await this.getDataCollectionFromBackendService();
            const temp = searchWithThreeParameters(collections.users, label1, param1, label2, param2, label3, param3)
            
            this.dataCollection = temp

            this.updatePagination()

            if (this.dataCollection.length >= 0) {
              this.emptyMessage = "Search result is empty."
            }

            this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
          }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      },

      searchUsersWithTwoParameters(label1, param1, label2, param2) {
        this.$store.dispatch(IS_LOADING, true)
          .then(async () => {  
            console.log(`isLoading true === ${this.isLoading}`); 

            const collections = await this.getDataCollectionFromBackendService();
            const temp = searchWithTwoParameters(collections.users, label1, param1, label2, param2)
        
            this.dataCollection = temp

            this.updatePagination()

            if (this.dataCollection.length >= 0) {
              this.emptyMessage = "Search result is empty."
            }

            this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
          }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      },
      
      searchUsersWithOneParameters(label1, param1) {
        this.$store.dispatch(IS_LOADING, true)
          .then(async () => {  
            console.log(`isLoading true === ${this.isLoading}`); 

            const collections = await this.getDataCollectionFromBackendService();
            const temp = searchWithOneParameter(collections.users, label1, param1)
            
            this.dataCollection = temp

            this.updatePagination()

            if (this.dataCollection.length  >= 0) {
              this.emptyMessage = "Search result is empty."
            }

            this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
          }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      },

      searchEmployees() {
        if (this.search.employee_id && this.search.lastname && this.search.othernames) {
          this.searchUsersWithThreeParameters('employee_id', this.search.employee_id, 'lastname', this.search.lastname, 'othernames', this.search.othernames)
        } else if (
          (this.search.employee_id && this.search.lastname) ||
          (this.search.employee_id && this.search.othernames) ||
          (this.search.lastname && this.search.othernames)
        ) {
          if (this.search.employee_id && this.search.lastname) {
            this.searchUsersWithTwoParameters('employee_id', this.search.employee_id, 'lastname', this.search.lastname)
          } else if (this.search.employee_id && this.search.othernames) {
            this.searchUsersWithTwoParameters('employee_id', this.search.employee_id, 'othernames', this.search.othernames)
          } else if (this.search.lastname && this.search.othernames) {
            this.searchUsersWithTwoParameters('lastname', this.search.lastname, 'othernames', this.search.othernames)
          }
        } else if (this.search.employee_id || this.search.lastname || this.search.othernames) {
          if (this.search.employee_id) {
            this.searchUsersWithOneParameters('employee_id', this.search.employee_id)
          } else if (this.search.lastname) {
            this.searchUsersWithOneParameters('lastname', this.search.lastname)
          } else if (this.search.othernames) {
            this.searchUsersWithOneParameters('othernames', this.search.othernames)
          }
        }
      },

      updateSearchOperationOnAllInputEmpty() {
        if (!this.search.employee_id && !this.search.lastname && !this.search.othernames) {
          this.$store.dispatch(IS_LOADING, true)
            .then(async () => {  
              console.log(`isLoading true === ${this.isLoading}`); 

              const collections = await this.getDataCollectionFromBackendService();
              
              this.dataCollection = collections.users

              this.updatePagination()

              if (this.dataCollection.length  >= 0) {
                this.emptyMessage = "Search result is empty."
              }

              this.$store.dispatch(IS_LOADING, false)
              .then(() => {  
                console.log(`isLoading false === ${this.isLoading}`); 
              }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        }
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'employees');
      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          const collections = await this.getDataCollectionFromBackendService();
          this.dataCollection = collections.users;
          this.roles = collections.roles;
          this.updatePagination();
          this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
    },

    watch: {
      async role() {
        this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          const collections = await this.getDataCollectionFromBackendService();
          this.dataCollection = collections.users;
          this.roles = collections.roles;
          this.updatePagination();
          this.$store.dispatch(IS_LOADING, false)
            .then(() => {  
              console.log(`isLoading false === ${this.isLoading}`); 
            }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
        }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
      }
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

  .form-control:focus { background: inherit; }

  select:focus,
  input:focus,
  textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #d4af37;
    outline-width: 0
  }

  .pagination {
    display: flex;
    justify-content: right;
  }

  a {
    cursor: pointer;
    text-decoration: none;
  }

  // .page-item:first-child  {
  //   background: #d4af37 !important;
  // }

  .paginate_button {
    font-weight: 700;
  }

  select option {
    background: #353535;
    padding-top: 50px;
  }
</style>