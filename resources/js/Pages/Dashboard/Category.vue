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
      {{ $page.props.title }}

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
    </template>

    <div class="py-4 px-12">
      <div v-for="kategori in categories" :key="kategori.id">
        {{ kategori.name }}
      </div>
    </div>
  </Dashboard>
</template>