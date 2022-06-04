<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { reactive } from "vue";

  defineProps({
    title: String,
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
</script>

<template>
  <Head title="Dashboard - Kategori" />
  <Dashboard>
    <template #halaman>
      {{ Inertia.page.props.title }}

      <span v-if="Inertia.page.component == 'Dashboard/Category'">
        <label
          for="kategori"
          class="btn btn-xs md:btn-sm btn-ghost capitalize modal-button"
        >
          Tambah Kategori
        </label>
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
                  <button type="submit" class="btn btn-sm btn-info capitalize">
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
      </span>
      <span v-else>
        <slot name="title" />
      </span>
    </template>

    <div>
      <slot name="manager" />
    </div>

    <div class="overflow-x-auto mt-4 mx-4">
      <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
          <tr>
            <th class="bg-gray-600 text-white">No</th>
            <th class="bg-gray-600 text-white">Name</th>
            <th class="bg-gray-600 text-white">Action</th>
          </tr>
        </thead>
        <tbody v-for="(kategori, index) in Inertia.page.props.categories" :key="kategori.id">
          <tr>
            <th>{{ index + 1 }}</th>
            <td>{{ kategori.name }}</td>
            <td>
              <Link
                :href="route('category.edit', kategori.id)"
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
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Dashboard>
</template>