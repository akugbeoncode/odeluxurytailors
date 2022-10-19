<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
        <h4 v-if="!isEmptyObject(category)" class="page-title">{{ capitalizeWordsInPhrase(category.name) }} Category</h4>
        <h4 v-else class="page-title">Unknown Category</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <a
          @click.prevent="loadAddProductPage"
          class="btn btn-success text-white mr-2"
        >
          <i class="fa fa-plus"></i>
          Add Product
        </a>
        <router-link 
          :to="{
            name: 'EditCategory',
            params: {
              loggedUserID: loggedUser.id,
              categoryID: categoryID
            }
          }" 
          class="btn btn-warning mr-2"
        >
          <i class="fas fa-edit"></i>
          Edit
        </router-link>
        <router-link 
          :to="{
            name: 'AllCategories',
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
    <div class="row mb-3">
      <div class="col-md-6 offset-md-3">
          <ul class="list-group list-group-flush">
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Name</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ isEmptyObject(category) ? '' : capitalizeWordsInPhrase(category.name) }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Parent</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ hasParent ? '' : 'No Parent' }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Meta Names</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light" v-html="!isEmptyObject(category) && category.meta_name ? getMetaNamesattributes(category.meta_name) : '<span>No Meta Data</span>'"></strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Description</div><div class="col-1">:</div> <div style="min-height: 100px;" class="col-8"><span class="text-light" v-html="category.description ? category.description : 'Not Define...'"></span></div>
                </div>
            </li>
          </ul>
      </div>              
    </div>
    <div class="row">
      <div class="col-md-8 offset-md-2 mt-5">
        <h3 class="h2 text-center page-title"><strong>Product List (In Current Category)</strong></h3>
        <hr class="alert-warning" />
      </div>
    </div>
    <div class="row filter-row" v-if="!isCollectionListEmpty">
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
              <div class="row">
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
                                      employeeID: employee.id
                                    }
                                  }"
                                >{{ fullnameInitials(employee.lastname + " " + employee.othernames) }}</router-link>
                                <h2>
                                  <router-link
                                    :to="{
                                      name: 'EmployeeManagerEmployeeAccountDetails',
                                      params: {
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
  import { axiosGetRequest } from '../../../../helpers/axiosGetRequest';

  import { IS_LOADING, BACK_URL } from "../../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase } from '../../../../helpers/wordsHelper';

  import { isEmptyObject } from "../../../../helpers/isEmptyObject";

  export default {
    name: 'CategoryDetails',

    data() {
      return {
        categoryID: null,

        category: {},
        dataCollection: [],

        search: {
          ids: '',
          product_name: '',
          product_variant: ''
        },

        per: 10,
        first: null,
        last: null,
        pages: [],
        current: null,
        previous: null,
        next: null,

        emptyMessage: 'Product List is empty!'
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

      hasParent() {
        return parseInt(this.category.parent_id) > 0 ? true : false;
      },

      isCollectionListEmpty() {
        return this.pages.length > 0 ? false : true;
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
      async getCategoryFromBackendService() {
        let response = null;
        await axiosGetRequest('/managers/categories/' + this.categoryID, this.tokenType, this.token).then((res) => {
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

      isEmptyObject(obj) {
        return isEmptyObject(obj);
      },

      getMetaNamesattributes(metaNames) {
        let HTMLString = '';
        let metaNameArray = metaNames.split(',');
        metaNameArray.map( metaItem => {
          HTMLString += `<span class="badge bg-light text-dark mr-2 p-2">${metaItem}</span>`
        });
        return HTMLString;
      },

      loadAddProductPage() {
        this.$store.dispatch(BACK_URL, {
          name: 'CategoryDetails',
          params: {
            loggedUserID: this.loggedUser.id,
            categoryID: this.category.id
          }
        }).then(() => {  
          this.$router.push({
            name: 'AddProduct',
            params: {
              loggedUserID: this.loggedUser.id,
            }
          });
        })
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'category details');

      this.categoryID = this.$route.params.categoryID;

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          this.category = await this.getCategoryFromBackendService();
          console.log(this.category);
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