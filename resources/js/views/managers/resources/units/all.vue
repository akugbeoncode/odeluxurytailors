<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Product Units</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'AddProductUnit',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="btn btn-primary"
          >
            <i class="fa fa-plus"></i>
            Add Product Unit 
          </router-link>
        </div>
    </div>
    <div class="row filter-row" v-if="!isCollectionListEmpty">
      <div class="col-md-8 offset-md-2">
        <div class="row">
          <div class="col-sm-6 col-md-8">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">{{ searchFieldLabel }}</label>
                <input @input.prevent="updateSearchOperationOnAllInputEmpty" type="text" class="form-control floating" v-model="search.name">
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
              <a @click.prevent="searchRequest" class="btn btn-success btn-block text-white"><strong> Search </strong></a>
          </div>
        </div>
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
              <div class="row staff-grid-row" style="min-height: calc(100vh - 345px);">
                <div class="col-12">
                  <div class="row">
                    <div
                      class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 mt-3"
                      v-for="item in pages[current-1]"
                      :key="item.id"
                    >
                      <div class="profile-widget">
                          <div class="fill-background-img">
                              <a href="#"><img class="background-img" :src="item.image" alt="" style="width: 100%; height: 100%; z-index: 0;"></a>
                          </div>
                          <div class="link-details">
                            <div class="dropdown profile-action">
                                <a href="#" @click.prevent="toggleActionMenuOptions($event)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; right: 0px; transform: translate3d(23px, 27px, 0px);">
                                    <router-link
                                      :to="{
                                        name: 'EditProductUnit',
                                        params: {
                                          loggedUserID: loggedUser.id,
                                          unitID: item.id
                                        }
                                      }"
                                      class="dropdown-item"
                                    >
                                      <i class="fa fa-edit m-r-5"></i> Edit
                                    </router-link>
                                    <a class="dropdown-item" @click.prevent="attemptDeletingProductUnit(item.id, $event)"><i class="fa fa-trash m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <router-link
                              :to="{
                                name: 'ProductUnitDetails',
                                params: {
                                  loggedUserID: loggedUser.id,
                                  unitID: item.id
                                }
                              }"
                            >
                              <h4 class="user-name text-left m-t-10 m-b-0 h3 text-ellipsis text-light pl-3">{{ item.name }}</h4>
                              <div
                                class="small text-left text-light pl-3 mt-2"
                                style="height: 100%;"
                              >
                                <strong>Description</strong> <br> <span v-html="item.description ? item.description : 'Not Define...'"></span>
                              </div>
                            </router-link>
                          </div>
                      </div>
                    </div>
                  </div>
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
  import { IS_LOADING, ADD_ALERT_MESSAGE } from "../../../../store/store_helpers/constantVariables";
  import { generatePagination } from '../../../../helpers/pagination'
  import { searchWithThreeParameters } from '../../../../helpers/searchWithThreeParameters'
  import { searchWithTwoParameters } from '../../../../helpers/searchWithTwoParameters'
  import { searchWithOneParameter } from '../../../../helpers/searchWithOneParameter'

  export default {
    name: 'AllCategory',

    data() {
      return {
        dataCollection: [],
        searchFieldLabel: 'Product unit name',

        search: {
          name: ''
        },

        per: 10,
        first: null,
        last: null,
        pages: [],
        current: null,
        previous: null,
        next: null,

        emptyMessage: 'Product unit List is empty!'
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),

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

      async getDataCollectionFromBackendService() {
        let response = null;
        let url = '/managers/units';
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

      toggleSelectedOptionMenu(event) {
        let targetElement = this.getTargetElement(event);

        if (targetElement.parentNode.classList.contains('submenu')) {
          if (targetElement.classList.contains('subdrop')) {
            targetElement.classList.remove('subdrop');
            targetElement.nextElementSibling.style.display = "none"; 
          } else {
            targetElement.classList.add('subdrop');
            targetElement.nextElementSibling.style.display = "block"; 
          }
        }
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

      attemptDeletingProductUnit(unitID, event) {
        this.toggleParentMenuOptions(event);
        if (confirm(`Do you want to delete "${this.getProductUnitByID(unitID).name}" unit?`)) {
          this.$store.dispatch(IS_LOADING, true)
          .then(() => {

            axios.defaults.headers.common['Authorization'] =  `${this.tokenType} ${this.token}`;
            axios.delete(`/managers/units/${unitID}`, {
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              }
            }).then(async (res) => {
              if (res.status === 200) {
                this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'success', message: res.data.message })
                  .then(() => { console.log("Alert message update.");});
                const collections = await this.getDataCollectionFromBackendService();
                this.dataCollection = collections.data;
                this.updatePagination();
                this.$store.dispatch(IS_LOADING, false)
                  .then(() => {  
                    console.log(`isLoading false === ${this.isLoading}`); 
                  }).catch((error) => { console.log(`IS LOADING LOGIN ERROR: ${error}`); });
              }
            }).catch((error) => {

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

      getProductUnitByID(unitID) {
        let targetUnit = null;

        this.dataCollection.map((unit) => {
          if (unit.id === unitID) {
            targetUnit = unit;
          }
        });

        return targetUnit;
      },

      searchUsersWithThreeParameters(label1, param1, label2, param2, label3, param3) {
        this.$store.dispatch(IS_LOADING, true)
          .then(async () => {  
            console.log(`isLoading true === ${this.isLoading}`); 

            const collections = await this.getDataCollectionFromBackendService();
            const temp = searchWithThreeParameters(collections.data, label1, param1, label2, param2, label3, param3)
            
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
            const temp = searchWithTwoParameters(collections.data, label1, param1, label2, param2)
        
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
            const temp = searchWithOneParameter(collections.data, label1, param1)
            
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

      searchRequest() {
        if (this.search.name) {
          this.searchUsersWithOneParameters('name', this.search.name)
        }
      },

      updateSearchOperationOnAllInputEmpty() {
        if (!this.search.name) {
          this.$store.dispatch(IS_LOADING, true)
            .then(async () => {  
              console.log(`isLoading true === ${this.isLoading}`); 

              const collections = await this.getDataCollectionFromBackendService();
              
              this.dataCollection = collections.data

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
      EventBus.$emit('active-menu-label-updated', 'all units');

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
    min-height: calc(100vh - 70px);
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

  .profile-widget {
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 200px;
  }

  .fill-background-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 200px;
    overflow: hidden;
  }

  .link-details {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 200px;
    background: rgba(0,0,0,0.7);
    z-index: 1000 !important;
  }

  .category-details-link {
    width: 100%;
    height: 100%;
  }

  select option {
    background: #353535;
    padding-top: 50px;
  }
</style>