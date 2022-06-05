<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import Setting from "@/Pages/Dashboard/Setting/Show.vue";
  import Pagination from "@/Components/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";

  let form = useForm({
    app_name: Inertia.page.props.settings.app_name,
    app_logo: Inertia.page.props.settings.app_logo,
    app_description: Inertia.page.props.settings.app_description,
    _method:"PATCH"
  });

  let submit = () => {
    Inertia.post(route("setting.update", Inertia.page.props.settings), form, {
      forceFormData: true,
    });
  };

  defineProps({
    settings: Object,
  });
</script>
<template>
  <Head>
    <title>{{ $page.props.title }}</title>
  </Head>
  <Setting>
    <template #tombol>
      <Link
        :href="route('setting')"
        as="button"
        type="button"
        class="btn btn-xs md:btn-sm btn-ghost capitalize"
      >
        Tutup
      </Link>
    </template>
    <template #form>
      <div class="">
        <form
          @submit.prevent="submit"
          class="flex gap-4 flex-col justify-start my-4 mx-2"
        >
          <div class="rounded-lg bg-white py-5 px-4">
            <h2 class="font-semibold text-lg">Nama Web</h2>
            <input
              v-model="form.app_name"
              type="text"
              name="app_name"
              id="app_name"
              class="input input-accent w-full"
              autofocus="autofocus"
            />
          </div>
          <div class="rounded-lg bg-white py-5 px-4">
            <h2 class="font-semibold text-lg">Logo</h2>
            <img :src="/storage/ + Inertia.page.props.settings.app_logo" alt="" class="mask mask-circle max-h-72" />
            <input
              type="file"
              @input="form.app_logo = $event.target.files[0]"
              name="app_logo"
              id="app_logo"
              class="input input-ghost w-full"
            />
          </div>
          <div class="rounded-lg bg-white py-5 px-4">
            <h2 class="font-semibold text-lg">Deskripsi</h2>
            <textarea
              id="app_description"
              cols="30"
              rows="15"
              v-model="form.app_description"
              type="text"
              name="app_description"
              class="textarea textarea-accent w-full"
            ></textarea>
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              class="btn btn-sm btn-accent capitalize text-white w-max"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </template>
  </Setting>
</template>