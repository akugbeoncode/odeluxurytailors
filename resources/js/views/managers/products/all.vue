<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">All Products</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <a
            @click.prevent="loadAddProductPage"
            class="btn btn-success text-white mr-2"
          >
            <i class="fa fa-plus"></i>
            Add Product
          </a>
        </div>
    </div>
    <div class="row filter-row" v-if="!isCollectionListEmpty">
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus focused">
            <label class="focus-label">Product ID</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.product_id">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus focused">
            <label class="focus-label">Product Name</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.name">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus">
            <label class="focus-label">Product Code</label>
            <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.code">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
          <a @click.prevent="searchProducts" class="btn btn-success btn-block text-white"><strong> Search </strong></a>
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
                            <th>Code</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in pages[current-1]" :key="product.id">
                            <td>
                                <router-link 
                                  class="avatar"
                                  :to="{
                                    name: 'ProductDetails',
                                    params: {
                                      loggedUserID: loggedUser.id,
                                      productID: product.id
                                    }
                                  }"
                                >{{ fullnameInitials(product.name) }}</router-link>
                                <h2>
                                  <router-link
                                    :to="{
                                      name: 'ProductDetails',
                                      params: {
                                        loggedUserID: loggedUser.id,
                                        productID: product.id
                                      }
                                    }"
                                  >
                                    {{capitalizeWordsInPhrase(product.name)}}
                                    <span>{{ product.generic_name ? capitalizeWordsInPhrase(product.generic_name) : "" }}</span>
                                  </router-link>
                                </h2>
                            </td>
                            <td>{{ product.code }}</td>
                            <td>{{ product.brand.name }}</td>
                            <td>{{ product.category.name }}</td>
                            <td>{{ product.quantity }}</td>
                            <td>{{ product.unit.name }} ({{product.unit.code}})</td>
                            <td> NGN {{ product.unit_price }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a @click.prevent="toggleActionMenuOptions($event)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <router-link 
                                          :to="{
                                            name: 'EditProductDetails',
                                            params: {
                                              loggedUserID: loggedUser.id,
                                              productID: product.id
                                            }
                                          }"
                                          class="dropdown-item"
                                        >
                                          <i class="fa fa-edit m-r-5"></i> Edit
                                        </router-link>
                                        <a class="dropdown-item" @click.prevent="attemptDeletingProductRecord(product.id, $event)"><i class="fa fa-trash m-r-5"></i> Delete</a>
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
  import { IS_LOADING, ADD_ALERT_MESSAGE, BACK_URL } from "../../../store/store_helpers/constantVariables";
  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';
  import { generatePagination } from '../../../helpers/pagination'
  import { searchWithThreeParameters } from '../../../helpers/searchWithThreeParameters'
  import { searchWithTwoParameters } from '../../../helpers/searchWithTwoParameters'
  import { searchWithOneParameter } from '../../../helpers/searchWithOneParameter'

  export default {
    name: 'AllProducts',

    data() {
      return {
        search: {
          product_id: '',
          name: '',
          code: ''
        },

        per: 10,
        first: null,
        last: null,
        pages: [],
        current: null,
        previous: null,
        next: null,

        emptyMessage: 'Product List is empty!',

        dataCollection: []
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
      loadAddProductPage() {
        this.$store.dispatch(BACK_URL, {
          name: 'AllProducts',
          params: {
            loggedUserID: this.loggedUser.id,
          }
        }).then(() => {  
          this.$router.push({
            name: 'AddProduct',
            params: {
              loggedUserID: this.loggedUser.id,
            }
          });
        })
      },

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

      attemptDeletingProductRecord(productID, event) {
        this.toggleParentMenuOptions(event);
        if (confirm(`Do you want to delete "${this.getProductName(this.getProductRecordByID(productID))}" product record?`)) {
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
                this.dataCollection = collections;
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

      getProductRecordByID(productID) {
        let targetProductRecord = null;

        this.dataCollection.map((product) => {
          if (product.id === productID) {
            targetProductRecord = product;
          }
        });

        return targetProductRecord;
      },

      async getDataCollectionFromBackendService() {
        let response = null;
        let url = '/managers/products';
      
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

      searchProducts() {
        if (this.search.employee_id && this.search.lastname && this.search.othernames) {
          this.searchUsersWithThreeParameters('id', this.search.product_id, 'name', this.search.name, 'code', this.search.code)
        } else if (
          (this.search.product_id && this.search.name) ||
          (this.search.product_id && this.search.code) ||
          (this.search.name && this.search.code)
        ) {
          if (this.search.product_id && this.search.name) {
            this.searchUsersWithTwoParameters('id', this.search.product_id, 'name', this.search.name)
          } else if (this.search.product_id && this.search.code) {
            this.searchUsersWithTwoParameters('id', this.search.product_id, 'code', this.search.code)
          } else if (this.search.lastname && this.search.othernames) {
            this.searchUsersWithTwoParameters('name', this.search.name, 'code', this.search.code)
          }
        } else if (this.search.product_id || this.search.name || this.search.code) {
          if (this.search.product_id) {
            this.searchUsersWithOneParameters('id', this.search.product_id)
          } else if (this.search.name) {
            this.searchUsersWithOneParameters('name', this.search.name)
          } else if (this.search.code) {
            this.searchUsersWithOneParameters('code', this.search.code)
          }
        }
      },

      updateSearchOperationOnAllInputEmpty() {
        if (!this.search.product_id && !this.search.name && !this.search.code) {
          this.$store.dispatch(IS_LOADING, true)
            .then(async () => {  
              console.log(`isLoading true === ${this.isLoading}`); 

              const collections = await this.getDataCollectionFromBackendService();
              
              this.dataCollection = collections

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

     watch: {
      question: function (newQuestion, oldQuestion) {
        this.answer = 'Waiting for you to stop typing...'
        this.debouncedGetAnswer()
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'all products');

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          const collections = await this.getDataCollectionFromBackendService();
          this.dataCollection = collections.data;
          this.updatePagination();
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