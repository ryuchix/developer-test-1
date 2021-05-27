<template>
    <div class="flex justify-center">
      <div class="flex flex-col">
        <div class="relative post rounded overflow-hidden shadow-lg my-2 hover:shadow-xl w-96">
          <div class="px-6 py-4 mt-2">
            <div class="font-bold text-xl mb-2">{{ post.title }}</div>
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
        <div class="text-xl mt-4">Comments</div>

        <div v-for="(comment, k) in post.comments" :key="k" class="relative post rounded overflow-hidden shadow-lg my-2 hover:shadow-xl w-96">
          <div class="px-6 py-4 mt-2">
            <p class="text-grey-darker text-base">
              {{ comment.comment }}
            </p>
          </div>
          <div class="flex flex-row justify-end">
            <div v-if="comment.user_comment" class="flex flex-row space-x-3 pr-4">
              <div class="py-4">
                <svg @click="editComment(comment.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 focus:outline focus:shadow-outline hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </div>
              <div class="py-4">
                <svg @click="deleteComment(comment.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 focus:outline focus:shadow-outline hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </div>
            </div>
          </div>
        </div>
        <form method="POST" class="py-5" @submit.prevent="add">
          <div class="relative w-full mb-3">
            <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="message">Message</label>
              <textarea v-model="comment.comment" maxlength="300" name="feedback" id="feedback" rows="4"  class="border-0 px-3 py-3 bg-gray-300 placeholder-black text-gray-800 rounded text-sm shadow focus:outline-none focus:bg-gray-400 w-full" placeholder="" required>
            </textarea>
          </div>
          <div class="text-center mt-6">
            <button class="bg-blue-900 rounded-full hover:bg-blue-700 text-white text-center mx-auto active:bg-yellow-400 text-sm font-bold uppercase px-6 py-3 shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">Add comment</button>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "ViewPost",

  data() {
    return {
      success: null,
      error: null,
      postid: this.$route.params.postid,
      comment: {
        post_id: this.$route.params.postid,
        comment: null
      }
    };
  },

  computed: {
    ...mapGetters("auth", ["post"])
  },

  mounted() {
    this.getPost(this.postid)
  },

  methods: {
    ...mapActions("auth", ["getPost", "addComment"]),

    editPost(id) {
      return this.$router.push({name: 'EditPost', params: {postid: id}});
    },

    deletePost(id) {
      return this.$router.push({name: 'EditPost', params: {postid: id}});
    },

    viewPost(id) {
      return this.$router.push({name: 'ViewPost', params: {postid: id}});
    }, 

    add() {
      this.addComment(this.comment).then(() => {
        this.getPost(this.postid)
      });
    },

    editComment(id) {
      return this.$router.push({name: 'EditComment', params: {commentid: id}});
    },

    deleteComment(id) {
      return this.$router.push({name: 'EditComment', params: {commentid: id}});
    },
  }
};
</script>
