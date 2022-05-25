<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { reactive } from "vue";

  let form = useForm({
    title: null,
    image: null,
  });

  let submit = () => {
    Inertia.post(route("galeries.store"), form, {
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
      previewImage(e) {
        const file = e.target.files[0];
        this.url = URL.createObjectURL(file);
      },
    },
  };
</script>


<template>
  <Head>
    <title>Galeri - Tambah</title>
  </Head>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">
        <Link :href="route('dashboard.gallery')"> Dashboard </Link>
        / <span class="text-gray-500">Tambah Galeri</span>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div class="flex flex-col max-w-md justify-around space-y-3">
                <label for="title">Judul</label>
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

                <label for="display">Gambar</label>
                <input
                  type="file"
                  @input="form.image = $event.target.files[0]"
                  @change="previewImage"
                  name="image"
                  id="image"
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
                  v-if="$page.props.errors.image"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.image }}
                </div>

                <div class="space-x-2">
                  <button
                    type="submit"
                    class="btn btn-sm btn-accent text-white w-max"
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