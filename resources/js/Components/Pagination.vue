<script setup>
  import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    links: Array
  });
</script>
<template>
    <div>
      <Link 
        :is="link.url ? 'Link' : 'span'"
        v-for="link in links"
        :key="link.label"
        :href="link.url"
        v-html="link.label"
        class="px-1"
        :class="{ 'text-gray-400 pointer-events-none': !link.url, 'font-bold' : link.active }"   
      />
    </div>
</template>