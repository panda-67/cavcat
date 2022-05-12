<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

let form = useForm({
  name: null,
});

let submit = () => {
  Inertia.post(route('products.store'), form);
};

defineProps({
  inns: Object,
});
</script>

<template>
  <Head title="Create" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Create Product</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div class="flex flex-col max-w-md justify-around space-y-3">
                <label for="name">Product Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  id="name"
                  class="input input-accent"
                />
                <div
                  v-if="$page.props.errors.name"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.name }}
                </div>
                <button type="submit" class="btn btn-sm btn-accent w-max">
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>