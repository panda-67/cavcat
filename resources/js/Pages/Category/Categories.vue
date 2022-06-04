<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import Footer from "@/Components/Footer.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";

  defineProps({
    categories: Object,
  });
</script>

<template>
  <Head title="Kategori" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Kategori</h2>
    </template>

    <div class="mx-6 my-4 md:mx-16 md:my-8 flex flex-col items-center md:flex-row md:justify-center">
      <div
        v-for="kategori in categories"
        :key="kategori.id"
        class="flex flex-col gap-4 justify-center"
        style="width: 700px"
      >
        <Link :href="route('category', kategori.slug)">
          <div
            class="
              py-4
              px-12
              font-light
              bg-white
              text-center
              w-full
              hover:bg-gray-300
            "
          >
            {{ kategori.name }}
          </div>
        </Link>
      </div>
    </div>
    <Footer />
  </BreezeAuthenticatedLayout>
</template>