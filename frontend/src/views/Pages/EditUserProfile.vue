<template>
    <div class="flex justify-center p-20">

    <div class="max-w-max ">
        <div class="bg-white shadow-xl rounded-lg py-3 px-6 relative">
          <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                <div class="mb-4">
                    <img class="mx-auto w-40 h-40 rounded-full object-cover object-center" v-if="item.imageUrl" :src="item.imageUrl" alt="Image Upload" />
                </div>
                <label class="cursor-pointer my-6 flex justify-center">
                    <span class="mt-2 leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">Select Image</span>
                    <input type="file" accept="image/*" @change="onChange" class="hidden" />
                </label>

              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                    Name
                </label>
                <input
                    v-model="user.name"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="name"
                    type="text" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                    Email
                </label>
                <input
                    v-model="user.email"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="email"
                    type="email" />
                </div>

              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="phone">
                    Phone
                </label>
                <input
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="phone"
                    type="phone" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="mobile">
                    Mobile
                </label>
                <input
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="mobile"
                    type="mobile" />
                </div>
              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="address">
                        Address
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="address"
                        type="address" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="city">
                        City
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="city"
                        type="city" />
                </div>
              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="state">
                    State
                </label>
                <input
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="state"
                    type="state" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="zip">
                    Zip
                </label>
                <input
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="zip"
                    type="zip" />
                </div>
              </div>

            <div class="mb-6 text-center">
              <button @click="update"
                class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
                type="button">Update</button>
            </div>
            <hr class="mb-6 border-t" />
          </form>
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
        item: {
            image : null,
            imageUrl: null
        }
    };
  },

  mounted() {
    //
  },

  computed: {
    ...mapGetters("auth", ["user"])
  },

  methods: {
    ...mapActions("auth", ["getPosts", "removePost"]),

    update() {
      this.removePost().then(() => this.getPosts());
    },

    onChange(e) {
      const file = e.target.files[0]
      this.image = file
      this.item.imageUrl = URL.createObjectURL(file)
    }
  }
};
</script>