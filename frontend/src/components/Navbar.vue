<template>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <RouterLink to="/" v-bind:class="'navbar-brand'">channelName</RouterLink>
        

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink to="/" v-bind:class="'nav-link'">Home</RouterLink>
            </li>
            <li class="nav-item dropdown" v-if="auth">
              <a class="nav-link dropdown-toggle" href="#" id="browseDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Browse
              </a>
              <ul class="dropdown-menu" aria-labelledby="browseDropdown">
                <li><a class="dropdown-item" href="#">Category 1</a></li>
                <li><a class="dropdown-item" href="#">Category 2</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown" v-if="auth">
              <a class="nav-link dropdown-toggle" href="#" id="libraryDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                My Library
              </a>
              <ul class="dropdown-menu" aria-labelledby="libraryDropdown">
                <li><a class="dropdown-item" href="#">Saved</a></li>
                <li><a class="dropdown-item" href="#">Watch Later</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">{{ username }}</li>
            
            
          </ul>
        </div>
        <RouterLink to="/logout" v-bind:class="'btn btn-warning'" v-if="auth">Logout</RouterLink>
        <RouterLink to="/register" v-bind:class="'btn btn-warning'" v-else-if="isLogin">Sign Up</RouterLink>
        <RouterLink to="/login" v-bind:class="'btn btn-warning'" v-else>Sign In</RouterLink>
      </div>
    </nav>
</template>


<script>
export default {
  name: 'NavbarHead',
  computed : {
    isLogin(){
      return this.$route.name === 'login'
    }
  }
}
</script>

<style scoped>

</style>