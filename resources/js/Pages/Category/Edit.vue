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
  <Head>
    <title>Edit - {{ Inertia.page.props.category.name }}</title>
  </Head>

  <CategoriesLayout>
    <template #title>
      {{ Inertia.page.props.category.name }}
    </template>
    <template #manager>
      <div class="form-control mt-2">
        <form @submit.prevent="submit">
          <div class="flex justify-center gap-2 mb-4">
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
              class="btn btn-sm btn-accent text-white w-max"
            >
              Edit
            </button>
            <Link
              :href="route('dashboard.category')"
              class="btn btn-sm btn-base capitalize"
            >
              Tutup
            </Link>
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
    </template>
  </CategoriesLayout>
</template>