<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import Pagination from "@/Layouts/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";
  import { reactive } from "vue";

  defineProps({
    title: String,
    galeries: Object,
    categories: Object,
  });
</script>
<script>
  export default {
    methods: {
      showImage() {
        return "/storage/";
      },
    },
  };
</script>
<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ title }}
      </h2>
    </template>

    <div v-for="galery in galeries.data" :key="galery.id" class="mx-6 my-4">
      <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <label for="modal-{{ galery.id }}" class="">
          <div>
            <img
              :src="showImage() + galery.image"
              alt=""
              class="rounded-t-lg"
            />
            <div
              class="
                flex flex-col
                justify-between
                p-2
                rounded-b-lg
                border-2 border-t-0
                border-gray-300
              "
            >
              <div class="text-gray-700 text-sm lg:text-lg">
                <p>{{ galery.title }}</p>
              </div>
              <div v-if="$page.props.auth.user" class="flex justify-end gap-1 items-center text-gray-500">
                <Link
                  :href="route('galeries.edit', galery)"
                  as="button"
                  type="button"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="
                      h-7
                      hover:cursor-pointer
                      rounded-md
                      hover:bg-green-500 hover:text-gray-100
                    "
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                  </svg>
                </Link>
                <Link
                  :href="route('galeries.destroy', galery)"
                  method="delete"
                  as="button"
                  type="button"
                  preserve-scroll
                >
                  <RemoveButton class="hover:bg-red-600 border-none" />
                </Link>
              </div>
            </div>
          </div>
        </label>
        <input
          type="checkbox"
          id="modal-{{ galery.id }}"
          class="modal-toggle"
        />
        <div class="modal h-screen w-screen flex items-center">
          <div class="sm:h-screen">
            <div class="rounded-lg flex flex-col items-end">
              <img
                class="rounded-lg sm:h-screen"
                :src="showImage() + galery.image"
                alt="{{ galery.title }}"
              />
              <label for="modal-{{ galery.id }}" class="w-max -mt-12 mx-4">
                <svg
                  class="h-6 lg:h-10 text-red-600 hover:text-blue-500"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    class=""
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="3"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>