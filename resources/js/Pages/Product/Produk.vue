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

<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div
        class="
          flex
          gap-3
          justify-start
          font-semibold
          text-lg
          bg-white
          text-gray-800
          leading-tight
          w-full
          px-4
          sm:px-6
          lg:px-12
          py-2
        "
      >
        <div class="dropdown dropdown-start pb-1 ml-4">
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
            <p class="font-semibold mb-2 border-b border-gray-700">Kategori</p>

            <Link
              v-for="category in categories"
              :key="category.id"
              :href="route('category', category.slug)"
              as="button"
              type="button"
            >
              <li>{{ categoryname }}</li>
            </Link>
            <li class="mt-1 -mx-3 py-1 px-3 rounded-md bg-gray-800 text-white">
              <Link :href="route('produk')"> All Product </Link>
            </li>
          </ul>
        </div>
        <div class="flex items-center">
          @if ($categoryName)
          <div class="font-semibold flex gap-2 ml-3">
            <div class="ml-1">
              <p class="text-2xs font-extralight -mb-1.5 -ml-3">Kategori</p>
              <p class="text-sm md:text-lg">{{ $categoryName }}</p>
            </div>
          </div>
          @else
          <div class="">
            <p class="text-sm md:text-lg font-semibold">Produk</p>
          </div>
          @endif
        </div>
      </div>
    </template>

    <div class="mt-4">
      <div class="mx-6 px-4 flex flex-col gap-2">
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
          <div class="py-3 font-roboto w-full px-6">
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
                    <strong
                      ><a href="{{ route('category', stock.category.slug) }}">{{
                        stock.category.name
                      }}</a></strong
                    >
                  </h2>
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
    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Pagination :links="products.links" class="my-8 px-8 sm:px-0" />
    </div>
  </BreezeAuthenticatedLayout>
</template>
