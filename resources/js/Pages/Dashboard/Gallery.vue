<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import Pagination from "@/Components/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";

  defineProps({
    title: String,
    galeries: Object,
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
  <Head>
    <title>{{ $page.props.title }}</title>
  </Head>
  <Dashboard>
    <template #halaman>
      {{ $page.props.title }}
      <Link
        :href="route('galleries.create')"
        as="button"
        type="button"
        class="btn btn-xs md:btn-sm btn-ghost capitalize"
      >
        Tambah Galeri
      </Link>
    </template>

    <div
      v-for="galery in galeries.data"
      :key="galery.id"
      class="mx-6 my-4 grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3"
    >
      <div class="flex">
        <img
          :src="showImage() + galery.image"
          :alt="galery.title"
          class="rounded-lg object-cover"
        />
        <div class="absolute transform translate-y-16 translate-x-2">
          <div class="flex justify-start gap-1 items-center">
            <Link
              :href="route('galleries.edit', galery)"
              as="button"
              type="button"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="
                  h-7
                  hover:cursor-pointer
                  rounded-md
                  text-white
                  hover:bg-gray-500 hover:text-gray-100
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
              :href="route('galleries.destroy', galery)"
              method="delete"
              
              preserve-scroll
            >
              <RemoveButton class="hover:bg-gray-500 border-none text-white" />
            </Link>
          </div>
          <p class="text-gray-200 text-sm font-semibold lg:text-lg">{{ galery.title }}</p>
        </div>
      </div>
    </div>
    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Pagination :links="galeries.links" class="my-8 px-8 sm:px-0" />
    </div>
  </Dashboard>
</template>