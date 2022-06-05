<script setup>
  import CategoriesLayout from "@/Pages/Dashboard/Category.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { reactive } from "vue";

  defineProps({
    title: String,
    categories: Object,
  });

  let form = useForm({
    name: Inertia.page.props.category.name,
    _method: "PATCH",
  });

  let submit = () => {
    Inertia.post(route("category.update", Inertia.page.props.category), form);
  };
</script>
<template>
  <CategoriesLayout>
    <template #title>
      {{ Inertia.page.props.category.name }}
    </template>
    <template #tombol>
      <Link
        :href="route('dashboard.category')"
        class="btn btn-sm btn-ghost capitalize"
      >
        Tutup
      </Link>
    </template>
    <template #manager>
      <div class="form-control mt-2">
        <form @submit.prevent="submit">
          <div class="flex items-center justify-center gap-2 mb-4 mx-auto">
            <label for="name">Kategori</label>
            <input
              v-model="form.name"
              type="text"
              name="name"
              id="name"
              class="input input-sm input-accent"
            />
            <div v-if="$page.props.errors.name" class="text-sm text-red-700">
              {{ $page.props.errors.name }}
            </div>
            <button
              type="submit"
              class="btn btn-sm btn-accent capitalize text-white"
            >
              Edit
            </button>
          </div>
        </form>
        <div class="flex justify-center">
          <div
            v-if="$page.props.flash.message"
            class="alert text-accent -mt-2 alert-sm w-max"
          >
            {{ $page.props.flash.message }}
          </div>
          <div v-if="$page.props.errors.name" class="text-sm text-red-700 pl-2">
            {{ $page.props.errors.name }}
          </div>
        </div>
      </div>
    </template>
  </CategoriesLayout>
</template>