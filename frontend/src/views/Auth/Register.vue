<template>
  <div class="container mx-auto">
    <div class="flex justify-center px-6 my-12">
      <!-- Row -->
      <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <!-- Col -->
        <div
          class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
          style="background-image: url('https://source.unsplash.com/oWTW-jNGl9I/600x800')"
        ></div>
        <!-- Col -->
        <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
          <div class="px-8 mb-4 text-center">
            <h3 class="pt-4 mb-2 text-2xl">Register</h3>
          </div>
          <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                Name
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                id="name"
                :class="{ 'is-invalid': errors.name }"
                v-model="details.name"
                type="text"
                placeholder="Randy Corpuz" />
              <div class="invalid-feedback" v-if="errors.name">
                {{ errors.name[0] }}
              </div>
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                Email
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                id="email"
                :class="{ 'is-invalid': errors.email }"
                v-model="details.email"
                type="email"
                placeholder="Enter Email Address..." />
              <div class="invalid-feedback" v-if="errors.email">
                {{ errors.email[0] }}
              </div>
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                Password
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="password"
                :class="{ 'is-invalid': errors.password }"
                id="password"
                v-model="details.password"
                placeholder="Password" />
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
            </div>
            <div class="mb-4">
              <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                Confirm Password
              </label>
              <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="password"
                id="password_confirmation"
                v-model="details.password_confirmation"
                placeholder="Confirm password" />
            </div>
            <div class="mb-6 text-center">
              <button @click="register"
                class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
                type="button">Register</button>
            </div>
            <hr class="mb-6 border-t" />
            <div class="text-center">
              <router-link to="/login" class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800">Login!</router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Home",

  data: function() {
    return {
      details: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    };
  },

  computed: {
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
  },

  methods: {
    ...mapActions("auth", ["sendRegisterRequest"]),

    register: function() {
      this.sendRegisterRequest(this.details).then(() => {
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>

<style lang="scss">
  .invalid-feedback {
    @apply text-red-600;
    @apply text-xs;
    @apply mt-2;
  }
</style>
