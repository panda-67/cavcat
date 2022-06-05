<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import Pagination from "@/Components/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";

  defineProps({
    title: String,
    products: Object,
    categories: Object,
  });

  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
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
        :href="route('products.create')"
        as="button"
        type="button"
        class="btn btn-xs md:btn-sm btn-ghost capitalize"
      >
        Tambah Produk
      </Link>
    </template>

    <div class="mt-4 mx-2">
      <div class="flex flex-col gap-2">
        <div
          v-for="stock in products.data"
          :key="stock.id"
          class="
            flex flex-col
            md:flex-row
            pl-6
            pt-4
            md:p-0
            bg-white
            rounded-lg
            shadow-lg
            justify-center
            items-center
          "
        >
          <div class="w-36 ml-4">
            <Link :href="route('products.show', stock.slug)">
              <div v-if="stock.display">
                <img
                  :src="showImage() + stock.display"
                  class="rounded-lg object-fill w-32 h-28"
                />
              </div>
              <div v-else>
                <img
                  class="rounded-lg object-fill w-32 h-28"
                  src="https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg"
                  alt=""
                />
              </div>
            </Link>
          </div>
          <div class="py-3 font-roboto w-full px-4">
            <div class="flex flex-col mb-2">
              <div
                class="
                  pb-1
                  mb-2
                  border-b
                  w-max
                  border-gray-400
                  text-xs
                  sm:text-base
                  font-light
                  tracking-wider
                  text-gray-500
                  capitalize
                "
              >
                {{ stock.merk }}
              </div>
              <div
                class="
                  text-xs
                  sm:text-base
                  font-normal font-sans
                  hover:text-blue-500
                  text-gray-700
                  capitalize
                "
              >
                <Link
                  :href="route('products.show', stock.slug)"
                  as="button"
                  type="button"
                >
                  {{ stock.title }}
                </Link>
              </div>
            </div>

            <div class="flex justify-between items-end mb-2">
              <div
                class="
                  flex flex-col
                  sm:flex-row sm:gap-4
                  items-start
                  md:items-center
                "
              >
                <div
                  class="
                    py-2
                    text-gray-600 text-sm
                    sm:text-base
                    font-mono font-medium
                  "
                >
                  <p>{{ formatter.format(stock.price) }}</p>
                </div>
                <div class="text-xs sm:text-sm font-thin">
                  <h2>
                    Dalam
                    <strong>
                      <Link :href="route('category', stock.category.slug)">
                        {{ stock.category.name }}
                      </Link>
                    </strong>
                  </h2>
                </div>
              </div>
              <div class="flex gap-2 items-center text-gray-500">
                <Link
                  :href="route('products.edit', stock.id)"
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
                  :href="route('products.destroy', stock)"
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
        </div>
      </div>
    </div>
    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Pagination :links="products.links" class="my-8 px-8 sm:px-0" />
    </div>
  </Dashboard>
</template>