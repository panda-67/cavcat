<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import Pagination from "@/Components/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import DHead from "@/Layouts/DashboardHead.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link } from "@inertiajs/inertia-vue3";
</script>
<template>
  <DHead :title="$page.props.title" />
  <Dashboard>
    <template #halaman>
      {{ $page.props.title }}
      <span v-if="Inertia.page.component == 'Dashboard/Setting/Show'">
        <Link
          :href="route('setting.edit', Inertia.page.props.settings)"
          as="button"
          type="button"
          class="btn btn-xs md:btn-sm btn-ghost capitalize"
        >
          Edit Setting
        </Link>
      </span>
      <slot v-else name="tombol" />
    </template>
    <div
      v-if="Inertia.page.component == 'Dashboard/Setting/Show'"
      class="flex gap-4 flex-col justify-start my-4 mx-2"
    >
      <div class="rounded-lg bg-white py-5 px-4">
        <h2 class="font-semibold text-lg">Nama Web</h2>
        <p class="py-2">
          {{ Inertia.page.props.settings.app_name }}
        </p>
      </div>
      <div class="rounded-lg bg-white py-5 px-4">
        <h2 class="font-semibold text-lg">Logo</h2>
        <img :src="/storage/ + Inertia.page.props.settings.app_logo" alt="" class="max-h-60" />
      </div>
      <div class="rounded-lg bg-white py-5 px-4">
        <h2 class="font-semibold text-lg">Deskripsi</h2>
        <p class="py-2">
          {{ Inertia.page.props.settings.app_description }}
        </p>
      </div>
    </div>
    <slot v-else name="form" />
  </Dashboard>
</template>
