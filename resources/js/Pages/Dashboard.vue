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
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ title }}
      </h2>
    </template>

    <div class="py-4 mx-10">
      <div class="max-w-7xl mx-auto">
        <div
          class="
            flex flex-col
            md:flex-row
            justify-between
            items-center
            p-4
            bg-white
            overflow-hidden
            shadow-sm
            sm:rounded-lg
          "
        >
          <div class="px-3">
            <strong class="capitalize">{{ $page.props.auth.user.name }}</strong>
            you're logged in!
          </div>
          <div class="flex flex-col md:flex-row gap-2">
            <div>
              <label
                for="kategori"
                class="btn btn-xs md:btn-sm btn-outline capitalize modal-button"
                >Tambah Kategori</label
              >
              <input type="checkbox" id="kategori" class="modal-toggle" />
              <div class="modal">
                <div class="modal-box">
                  <div class="form-control mt-2">
                    <form @submit.prevent="submit">
                      <div class="flex justify-center gap-2 mb-4">
                        <input
                          v-model="form.name"
                          type="text"
                          name="name"
                          id="name"
                          placeholder="Nama Kategori"
                          class="input input-sm input-accent"
                        />
                        <button
                          type="submit"
                          class="btn btn-sm btn-info capitalize"
                        >
                          Tambah
                        </button>
                        <label for="kategori" class="btn btn-sm capitalize"
                          >Tutup</label
                        >
                      </div>
                      <div class="flex justify-center">
                        <div
                          v-if="$page.props.flash.message"
                          class="alert text-accent -mt-2 alert-sm w-max"
                        >
                          {{ $page.props.flash.message }}
                        </div>
                        <div
                          v-if="$page.props.errors.name"
                          class="text-sm text-red-700 pl-2"
                        >
                          {{ $page.props.errors.name }}
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <Link
              :href="route('galeries.create')"
              as="button"
              type="button"
              class="btn btn-xs md:btn-sm btn-outline capitalize"
            >
              Tambah Galeri
            </Link>
            <Link
              :href="route('products.create')"
              as="button"
              type="button"
              class="btn btn-xs md:btn-sm btn-outline capitalize"
            >
              Tambah Produk
            </Link>
          </div>
        </div>
      </div>
    </div>

    <div
      v-if="$page.props.flash.message"
      class="
        flex
        justify-start
        items-center
        bg-green-200
        py-2
        px-6
        mt-3
        rounded
        border-b-2 border-green-300
        md:max-w-md
        mx-auto
      "
    >
      <div
        class="
          alert-icon
          flex
          items-center
          bg-green-100
          border-2 border-green-500
          justify-center
          h-10
          w-10
          flex-shrink-0
          rounded-full
        "
      >
        <span class="text-green-500">
          <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
            <path
              fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </span>
      </div>
      <div class="alert-content font-poppins ml-4 flex flex-col">
        <div class="alert-title font-medium md:text-lg text-green-800">
          Success
        </div>
        <div class="alert-description text-sm text-green-600">
          {{ $page.props.flash.message }}
        </div>
      </div>
    </div>

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
          <div class="w-36 ml-4">
            <Link :href="route('products.show', stock.slug)">
              <div
                v-if="stock.display"
                class="aspect-w-10 aspect-h-8 rounded-lg bg-center bg-cover"
                style="background-image: url('{{ asset('storage/' . stock.display) }}'); background-blend-mode: multiply"
              ></div>
              <div
                v-else
                class="aspect-w-10 aspect-h-8 rounded-lg bg-center bg-cover"
                style="
                  background-image: url('https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg');
                  background-blend-mode: multiply;
                "
              ></div>
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
  </BreezeAuthenticatedLayout>
</template>
