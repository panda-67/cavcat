<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  category: Object,
});
</script>

<template>
  <Head title="Kategori" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Kategori</h2>
    </template>

    <div class="mx-6 my-4 md:mx-16 md:my-8 flex justify-center">
      <div
        v-for="kategori in category"
        :key="kategori.id"
        class="flex flex-col gap-4 justify-center"
        style="width: 700px"
      >
        <!-- @foreach ($category as $kategori) -->
        <!-- <a href="{{ route('category', $kategori->slug) }}">
                    <div class="py-4 px-12 font-light bg-white text-center w-full hover:bg-gray-300">{{ $kategori->name }}</div>
                </a> -->
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
        <!-- @endforeach -->
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>