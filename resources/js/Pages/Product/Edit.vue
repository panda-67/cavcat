<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { reactive } from "vue";

  let form = useForm({
    title: Inertia.page.props.product.title,
    category_id: Inertia.page.props.product.category_id,
    merk: Inertia.page.props.product.merk,
    description: Inertia.page.props.product.description,
    price: Inertia.page.props.product.price,
    display: Inertia.page.props.product.display,
    _method: "PUT",
  });

  let submit = () => {
    Inertia.post(route("products.update", Inertia.page.props.product), form, {
      forceFormData: true,
    });
  };

  defineProps({
    categories: Object,
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
    <title>Edit - {{ Inertia.page.props.product.title }}</title>
  </Head>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">
        <Link :href="route('dashboard')"> Dashboard </Link>
        /
        <span class="text-gray-500"
          >{{ Inertia.page.props.product.title }} / Edit</span
        >
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div class="flex flex-col max-w-md justify-around space-y-3">
                <label for="title">Judul Produk</label>
                <input
                  v-model="form.title"
                  type="text"
                  name="title"
                  id="title"
                  class="input input-accent"
                />
                <div
                  v-if="$page.props.errors.title"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.title }}
                </div>

                <label for="category_id">Kategori</label>
                <select
                  v-model="form.category_id"
                  name="category_id"
                  id="category_id"
                  class="select select-accent w-full min-w-max rounded-md"
                >
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div
                  v-if="$page.props.errors.category_id"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.category_id }}
                </div>

                <label for="merk">Merek</label>
                <input
                  v-model="form.merk"
                  type="text"
                  name="merk"
                  id="merk"
                  class="input input-accent"
                />
                <div
                  v-if="$page.props.errors.merk"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.merk }}
                </div>

                <label for="description">Deskripsi</label>
                <input
                  v-model="form.description"
                  type="text"
                  name="description"
                  id="description"
                  class="input input-accent"
                />
                <div
                  v-if="$page.props.errors.description"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.description }}
                </div>

                <label for="price">Harga</label>
                <input
                  v-model="form.price"
                  type="text"
                  name="price"
                  id="price"
                  class="input input-ghost"
                />
                <div
                  v-if="$page.props.errors.price"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.price }}
                </div>

                <label for="display">Gambar</label>
                <img
                  v-if="Inertia.page.props.product.display"
                  :src="showImage() + Inertia.page.props.product.display"
                  class="rounded-lg object-fill w-80 h-56"
                />
                <input
                  type="file"
                  @input="form.display = $event.target.files[0]"
                  name="display"
                  id="display"
                  class="input input-ghost"
                />
                <progress
                  v-if="form.progress"
                  :value="form.progress.percentage"
                  max="100"
                >
                  {{ form.progress.percentage }}%
                </progress>
                <div
                  v-if="$page.props.errors.display"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.display }}
                </div>

                <div class="space-x-2">
                  <button
                    type="submit"
                    class="btn btn-sm btn-accent capitalize text-white w-max"
                  >
                    Simpan
                  </button>
                  <Link
                    :href="route('dashboard')"
                    as="button"
                    type="button"
                    class="btn btn-sm btn-primary"
                  >
                    Kembali
                  </Link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>