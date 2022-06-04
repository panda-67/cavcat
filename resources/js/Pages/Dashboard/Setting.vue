<script setup>
  import Dashboard from "@/Layouts/Dashboard.vue";
  import Pagination from "@/Components/Pagination.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
</script>
<template>
  <Head title="Dashboard - Setting" />
  <Dashboard>
    <template #halaman>
      {{ $page.props.title }}
      
    </template>
    <div>Halaman Setting</div>
  </Dashboard>
</template>
