<template>
  <Spinner v-if="showLoading"></Spinner>
  <NavbarHead />
  <router-view></router-view>
  
</template>

<script>
import NavbarHead from '@/components/Navbar.vue';
import { mapState, mapGetters } from 'vuex';
import Spinner from '@/components/Spinner.vue';
import { IS_AUTH } from '@/store/storeconstant';


export default {
  name: 'App',
  computed: {
      ...mapGetters('auth', {
          auth : IS_AUTH,
      }),
      ...mapState({
      showLoading: state => state.showLoading
    })
  },
  components: {
    NavbarHead,
    Spinner
  },
}
</script>
