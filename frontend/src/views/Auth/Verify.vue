<template>
  <div class="container mx-auto verify">
    <div class="flex justify-center px-6 my-12">
      <div class="w-full flex justify-center">
        <div class="alert alert-danger" role="alert" v-if="error">
          {{ error }}
        </div>
        <h1 v-show="!error">Please wait..</h1>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["hash"],

  data() {
    return {
      error: null
    };
  },

  mounted() {
    this.sendVerifyRequest(this.hash)
      .then(() => {
        this.$router.push("/");
      })
      .catch(error => {
        console.log(error.response);
        this.error = "Error verifying email";
      });
  },

  computed: {
    ...mapGetters("auth", ["user"])
  },

  methods: {
    ...mapActions("auth", ["sendVerifyRequest"])
  }
};
</script>
