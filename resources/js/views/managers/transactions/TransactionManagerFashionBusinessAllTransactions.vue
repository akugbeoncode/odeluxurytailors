<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">OLTs Fashion Services Transactions</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'TransactionManagerRegisterNewFashionTransaction',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="btn btn-primary"
          >
            <i class="fa fa-plus"></i> New Transaction
          </router-link>
        </div>
    </div>
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Transaction ID</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Client ID</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Transaction Date</label>
                <input type="date" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>
    <div class="row" v-if="true">
      <div class="col-md-8 offset-md-2 mt-5">
        <div class="jumbotron mt-5">
          <h3 class="h3 text-center">{{ emptyMessage }}</h3>
        </div>
      </div>
    </div>
    <div class="row" v-else>
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
              <div class="row">
                <div class="col-12">
                  <table class="table table-striped custom-table datatable text-white">
                    <thead>
                        <tr class="text-white">
                            <th style="width:25%;">Transaction Ref</th>
                            <th>Client Details</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Pickup Status</th>
                            <th>Pickup Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in pages[current-1]" :key="item.id">
                            <td>
                                <router-link 
                                  class="avatar"
                                  :to="{
                                    name: 'TransactionManagerFashionBusinessTransactionRecordDetails',
                                    params: {
                                      transactionID: item.id
                                    }
                                  }"
                                >{{ fullnameInitials(item.client.lastname + " " + item.client.othernames) }}</router-link>
                                <h2>
                                  <router-link
                                    :to="{
                                      name: 'TransactionManagerFashionBusinessTransactionRecordDetails',
                                      params: {
                                        transactionID: item.id
                                      }
                                    }"
                                  >
                                    {{item.id}}
                                  </router-link>
                                </h2>
                            </td>
                            <td>{{capitalizeWordsInPhrase(item.client.lastname)}} {{capitalizeWordsInPhrase(item.client.othernames)}} ({{ item.client.email }})</td>
                            <td>{{ computePaymentStatus(item.total, item.deposit) }}</td>
                            <td>{{ item.status.name }}</td>
                            <td>{{ item.pickup_status.name }}</td>
                            <td>{{ item.pickup_date }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a @click.prevent="toggleSelectedOptionMenu($event)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

  export default {
    name: 'TransactionManagerFashionBusinessAllTransactions',

    data() {
      return {
        dataCollection: [],
    
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

        emptyMessage: 'Transaction List is empty!'
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

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
      computePaymentStatus(total, deposit) {
        return 'Unpaid';
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
      EventBus.$emit('active-menu-label-updated', 'fashion business transactions');
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