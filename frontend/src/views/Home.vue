<template>
  <div class="home flex justify-center">
    <div class="posts mt-2">
      <div class="flex flex-row items-center space-x-3">
        <button @click="addPost" class="p-0 w-10 h-10 bg-blue-900 rounded-full hover:bg-blue-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
          <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-5 h-5 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
          </svg>
        </button>
        <div @click="addPost" class="text-xl py-5 cursor-pointer">Add post</div>
      </div>
      <div v-for="(post, index) in posts" :key="index" class="flex flex-col space-y-8">
        <div class="relative post rounded overflow-hidden shadow-lg my-2 hover:shadow-xl w-96">
          <div class="px-6 py-4 mt-2">
            <div class="font-bold text-xl mb-2 cursor-pointer" @click="viewPost(post.id)" >{{ post.title }}</div>
            <p class="text-grey-darker text-base">
              {{ post.body }}
            </p>
          </div>
          <div class="flex flex-row justify-between">
            <div class="px-6 py-4 flex flex-row space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
              </svg> 
              <span>{{ post.comments.length }}</span>
            </div>
            <div v-if="post.user_post" class="flex flex-row space-x-3 pr-4">
              <div class="py-4">
                <svg @click="editPost(post.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 focus:outline focus:shadow-outline hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </div>
              <div class="py-4">
                <svg @click="deletePost(post.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 focus:outline focus:shadow-outline hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Home",

  data() {
    return {
      success: null,
      error: null,
      isOpen: false,
    };
  },

  mounted() {
    this.getPosts();
  },

  computed: {
    ...mapGetters("auth", ["posts"])
  },

  methods: {
    ...mapActions("auth", ["getPosts", "removePost"]),

    addPost() {
      return this.$router.push({name: 'AddPost'});
    },

    editPost(id) {
      return this.$router.push({name: 'EditPost', params: {postid: id}});
    },

    deletePost(id) {
      this.removePost(id).then(() => this.getPosts());
    },

    viewPost(id) {
      return this.$router.push({name: 'ViewPost', params: {postid: id}});
    }
  }
};
</script>

<style lang="scss">
  //
</style>
