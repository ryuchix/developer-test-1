<template>
    <div class="flex justify-center">
      <form method="POST" class="p-12" @submit.prevent="update">
        <div class="relative w-full mb-3">
          <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="title">Title</label>
          <input v-model="post.title" type="text" name="title" id="title" class="border-0 px-3 py-3 rounded text-sm shadow w-full
              bg-gray-300 placeholder-black text-gray-800 outline-none focus:bg-gray-400" placeholder=" "
                  style="transition: all 0.15s ease 0s;" required />
        </div>
        <div class="relative w-full mb-3">
          <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="message">Message</label>
          <textarea v-model="post.body" maxlength="300" name="feedback" id="feedback" rows="4" cols="80" class="border-0 px-3 py-3 bg-gray-300 placeholder-black text-gray-800 rounded text-sm shadow focus:outline-none focus:bg-gray-400 w-full" placeholder="" required>
          </textarea>
        </div>
        <div class="text-center mt-6">
          <button class="bg-blue-900 rounded-full hover:bg-blue-700 text-white text-center mx-auto active:bg-yellow-400 text-sm font-bold uppercase px-6 py-3 shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">Update Post</button>
        </div>
      </form>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "EditPost",

  data() {
    return {
      success: null,
      error: null,
      postid: this.$route.params.postid,
    };
  },

  computed: {
    ...mapGetters("auth", ["post"])
  },

  mounted() {
      this.getPost(this.postid)
  },

  methods: {
    ...mapActions("auth", ["getPost", "updatePost"]),

    update() {
        this.updatePost(this.post).then(() => this.$router.push({name: 'Home'}));
    }
  }
};
</script>
