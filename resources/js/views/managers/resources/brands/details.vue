<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
        <h4 v-if="!isEmptyObject(brand)" class="page-title">{{ capitalizeWordsInPhrase(brand.name) }} Brand</h4>
        <h4 v-else class="page-title">Unknown Brand</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'EditBrand',
            params: {
              loggedUserID: loggedUser.id,
              brandID: brandID
            }
          }" 
          class="btn btn-warning mr-2"
        >
          <i class="fas fa-edit"></i>
          Edit
        </router-link>
        <router-link 
          :to="{
            name: 'AllBrands',
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
                  <div class="col-3">Name</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light">{{ isEmptyObject(brand) ? '' : capitalizeWordsInPhrase(brand.name) }}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Logo</div><div class="col-1">:</div> <div class="col-8"><img :src="brand.image" alt="" width="45px" height="25px"></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Status</div><div class="col-1">:</div> <div class="col-8"><strong class="text-light" style="text-transform: capitalize;">{{brand.is_active == 1 ? 'Enabled' : 'Disabled'}}</strong></div>
                </div>
            </li>
            <li class="list-group-item transparent-bg">
                <div class="row">
                  <div class="col-3">Description</div><div class="col-1">:</div> <div class="col-8" style="min-height: 100px;"><strong class="text-light" style="text-transform: capitalize;">{{brand.description ? '' : 'No Description'}}</strong></div>
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
    name: 'brandDetails',

    data() {
      return {
        brandID: null,

        brand: {},
        dataCollection: []
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
      async getBrandFromBackendService() {
        let response = null;
        await axiosGetRequest('/managers/brands/' + this.brandID, this.tokenType, this.token).then((res) => {
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
      EventBus.$emit('active-menu-label-updated', 'brand details');

      this.brandID = this.$route.params.brandID;

      this.$store.dispatch(IS_LOADING, true)
        .then(async () => { 
          this.brand = await this.getBrandFromBackendService();
          console.log(this.brand);
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