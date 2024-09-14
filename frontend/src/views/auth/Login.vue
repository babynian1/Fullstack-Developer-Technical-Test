<template>
  <main v-bind:style="{ 'background-image': '@/assets/image/hero.png' }">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card login-card">
            <div class="card-body">
              <center>
                <img src="@/assets/logo.png" width="100" class="img-responsive img" alt="Login Image" />
              </center>
              <div v-if="errno" class="alert alert-danger">
                <p class="text-sm"> {{ errno }}</p>
              </div>
              <h5 class="card-title">Sign In</h5>
              <form @submit.prevent=OnLogin()>
                <div class="mb-3 form-group">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Enter username" v-model.trim="username" required />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter password"  v-model="password" required/>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
              </form>
              <div class="text-center mt-3">
                <a href="#" class="text-decoration-none">Forgot Password?</a>
                <br />
                <span>Don't have an account? <a href="#" class="text-decoration-none">Sign Up</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import DoLogin from "@/service/DoLogin";
import { mapActions, mapMutations, mapGetters } from "vuex";
import { LOGIN_ACTION, SHOW_LOADING, IS_AUTH } from "@/store/storeconstant";


export default {
  name: 'LoginWeb',
  data() {
    return {
      username: '',
      password: '',
      errors: [],
      errno: '',
    };
  },
  methods: {
    ...mapGetters('auth', {
      auth : IS_AUTH,
    }),
    ...mapActions('loading', {
      login: LOGIN_ACTION,
    }),
    ...mapMutations({
      showLoading: SHOW_LOADING,
    }),
    async OnLogin() {

      this.showLoading(true);

      let validations = new DoLogin(
        this.username,
        this.password,
      );

      this.errors = validations.checkValidations();

      if (this.errors.lenght > 0) {
        return false;
      }

      await this.login(
        {
          username: this.username,
          password: this.password
        }
      ).catch((error) => {
        this.showLoading(false);
        console.log('front : ' +error)
        this.errno = error.message;
      });

      this.showLoading(false);
      if(this.errno != ''){
        this.$router.push('/login');
      } else {
        // this.$router.push('/');
      }
    }
  },
  mounted(){
      if(!this.auth){
          this.$router.replace('/');
      }
  },

};
</script>

<style scoped>
.container {
  width: 100%;
  max-width: 612px;
  border-radius: 16px;
}

.login-card {
  border-radius: 20px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.card-body {
  padding: 2rem;
}

.card-title {
  font-size: 32px;
  margin-bottom: 1.5rem;
}

.form-control {
  border-radius: 10px;
  padding: 0.55rem;
  border-radius: 100px;
  border: 1px 0px 0px 0px;
}

.btn {
  border-radius: 10px;
  font-size: 1rem;
  padding: 0.75rem;
  background-color: #666666 !important;
  color: white;
  border-radius: 100px;
}

.btn:hover {
  background-color: #003a80;
}

a {
  color: #0249A6;
}

a:hover {
  color: #e0a800;
}
</style>
