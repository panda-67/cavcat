<script setup>
  import { computed } from "vue";
  import { Link } from "@inertiajs/inertia-vue3";

  const props = defineProps(["href", "active"]);

  const classes = computed(() =>
    props.active
      ? "text-white bg-gray-800 hover:text-gray-900 hover:bg-gray-300 flex flex-col items-center py-2 overflow-hidden shadow-sm sm:rounded-lg"
      : "text-gray-600 bg-white hover:text-gray-900 hover:bg-gray-300 flex flex-col items-center py-2  overflow-hidden shadow-sm sm:rounded-lg"
  );
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
