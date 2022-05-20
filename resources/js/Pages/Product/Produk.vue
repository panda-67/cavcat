<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import Pagination from "@/Layouts/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";
  import { reactive } from "vue";

  defineProps({
    title: String,
    products: Object,
    categories: Object,
    categoryName: String,
  });

  let form = useForm({
    name: null,
  });

  let submit = () => {
    Inertia.post(route("category.store"), form, {
      onFinish: () => form.reset(),
      preserveScroll: true,
    });
  };

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
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div
        class="
          flex
          gap-2
          justify-start
          font-semibold
          text-lg
          bg-white
          text-gray-800
          leading-tight
          w-full
        "
      >
        <div class="dropdown dropdown-start pb-1">
          <div tabindex="0" class="px-1">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              class="inline-block w-5 stroke-current cursor-pointer"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
            </svg>
          </div>
          <ul
            tabindex="0"
            class="
              dropdown-content
              text-sm
              font-normal
              shadow-md
              px-3
              pt-4
              bg-base-100
              rounded-md
              w-max
            "
          >
            <p class="font-bold mb-1 border-b pb-1 border-gray-300">Kategori</p>
            <Link
              v-for="category in categories"
              :key="category.id"
              :href="route('category', category.slug)"
              as="button"
              type="button"
              class="flex flex-col pt-2 hover:text-blue-500"
            >
              <li>{{ category.name }}</li>
            </Link>
            <li
              class="
                mt-1
                -mx-3
                py-1
                px-3
                rounded-md
                bg-gray-800
                text-white
                hover:bg-white hover:text-gray-800
              "
            >
              <Link :href="route('produk')"> All Product </Link>
            </li>
          </ul>
        </div>
        <div class="flex items-center">
          <div v-if="categoryName" class="font-semibold flex gap-2">
            <div class="ml-2">
              <p class="text-2xs font-extralight -mb-1.5 -ml-3">Kategori</p>
              <p class="text-sm md:text-lg">{{ categoryName }}</p>
            </div>
          </div>
          <div v-else class="ml-2">
            <p class="text-2xs font-extralight -mb-1.5 -ml-3">Semua</p>
            <p class="text-sm md:text-lg">Produk</p>
          </div>
        </div>
      </div>
    </template>

    <div class="md:grid md:grid-cols-4">
      <div class="col-span-4 mx-2 my-4 sm:px-4">
        <div
          class="
            bg-base
            grid
            gap-2
            md:gap-4
            grid-cols-2
            md:grid-cols-3
            lg:grid-cols-4
          "
        >
          <div v-for="stock in products.data" :key="stock.id">
            <div class="py-3 font-roboto w-full px-6 flex flex-col">
              <div>
                <Link :href="route('products.show', stock.slug)">
                  <div v-if="stock.display">
                    <img
                      :src="showImage() + stock.display"
                      class="rounded-lg object-fill w-80 h-56"
                    />
                  </div>
                  <div v-else>
                    <img
                      class="rounded-lg object-fill w-80 h-56"
                      src="https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg"
                      alt=""
                    />
                  </div>
                </Link>
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
                      class="text-left"
                    >
                      {{ stock.title }}
                    </Link>
                  </div>
                  <div class="text-xs sm:text-sm font-thin">
                    <h2>
                      Dalam
                      <strong
                        ><a
                          href="{{ route('category', stock.category.slug) }}"
                          >{{ stock.category.name }}</a
                        ></strong
                      >
                    </h2>
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center mb-2">
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
                      text-gray-600 text-lg
                      sm:text-base
                      font-mono font-bold
                    "
                  >
                    <p>{{ formatter.format(stock.price) }}</p>
                  </div>
                </div>
                <div class="flex gap-2 items-center text-gray-500">
                  <Link
                    :href="route('products.edit', stock)"
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
    </div>
    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Pagination :links="products.links" class="my-8 px-8 sm:px-0" />
    </div>
  </BreezeAuthenticatedLayout>
</template>
