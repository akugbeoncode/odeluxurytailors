<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
        <h4 v-if="!isEmptyObject(unit)" class="page-title">{{ capitalizeWordsInPhrase(unit.name) }} ({{unit.code.toUpperCase()}}) Product Unit</h4>
        <h4 v-else class="page-title">Unknown Category</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'EditProductUnit',
            params: {
              loggedUserID: loggedUser.id,
              unitID: unitID
            }
          }" 
          class="btn btn-warning mr-2"
        >
          <i class="fas fa-edit"></i>
          Edit
        </router-link>
        <router-link 
          :to="{
            name: 'ProductUnits',
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
                  <div class="col-3">Name</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ capitalizeWordsInPhrase(unit.name) }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Code</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ isEmptyObject(unit) ? '' : unit.code.toUpperCase() }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Base Unit</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ unit.base_unit }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Operator</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ unit.operator }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Operational Value</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ unit.operational_value }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Status</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ unit.is_active === 0 ? "Disabled" : "Enabled" }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Description</div><div class="col-1">:</div> <div class="col-8" style="min-height: 100px;"><span class="text-light" v-html="unit.description ? unit.description : 'Not Define...'"></span></div>
                </div>
            </li>
          </ul>
      </div>              
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";
  import { axiosGetRequest } from '../../../../helpers/axiosGetRequest';

  import { IS_LOADING } from "../../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase } from '../../../../helpers/wordsHelper';

  import { isEmptyObject } from "../../../../helpers/isEmptyObject";

  export default {
    name: 'CategoryDetails',

    data() {
      return {
        unitID: null,

        unit: {},
        dataCollection: [],

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
      async getUnitFromBackendService() {
        let response = null;
        await axiosGetRequest('/managers/units/' + this.unitID, this.tokenType, this.token).then((res) => {
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
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'category details');

      this.unitID = this.$route.params.unitID;

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          this.unit = await this.getUnitFromBackendService();
          console.log(this.unit);
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