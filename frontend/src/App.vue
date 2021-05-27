<template>
  <div id="app">
    <nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
      <div class="mb-2 sm:mb-0 inner">
        <a href="/" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">RandyC</a><br>
        <span class="text-xs text-grey-dark">Dev test</span>
      </div>
      <div class="sm:mb-0 self-center flex flex-row">
        <router-link to="/" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1">Home</router-link>
        <router-link to="/profile" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1" v-show="user">Profile</router-link>
        <router-link to="/login" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1" v-show="!user">Login</router-link>
        <router-link to="/register" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1" v-show="!user">Register</router-link>
        <div @click="logout"  class="cursor-pointer text-md no-underline text-black hover:text-blue-dark ml-2 px-1" v-show="user">Logout</div>
      </div>
    </nav>
    <main role="main">
      <router-view />
    </main>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters("auth", ["user"])
  },

  mounted() {
    if (localStorage.getItem("authToken")) {
      this.getUserData();
    }
  },

  methods: {
    ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),

    logout() {
      this.sendLogoutRequest().then(() => this.$router.push('/login'));
      
    }
  }
};
</script>

<style>
  @import 'assets/style.css';
</style>
