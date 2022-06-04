<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import ALink from "@/Components/AdminLink.vue";
  import { Link } from "@inertiajs/inertia-vue3";

  defineProps({
    title: Object,
  });
</script>

<template>
  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <slot name="halaman" />
        </h2>
        <div class="px-3">
          <strong class="capitalize">{{ $page.props.auth.user.name }}</strong>
          you're logged in!
        </div>
      </div>
    </template>

    <!-- Flash message -->
    <div
      v-if="$page.props.flash.message"
      class="
        flex
        justify-start
        items-center
        bg-green-200
        py-2
        px-6
        mt-3
        rounded
        border-b-2 border-green-300
        md:max-w-md
        mx-auto
      "
    >
      <div
        class="
          alert-icon
          flex
          items-center
          bg-green-100
          border-2 border-green-500
          justify-center
          h-10
          w-10
          flex-shrink-0
          rounded-full
        "
      >
        <span class="text-green-500">
          <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
            <path
              fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </span>
      </div>
      <div class="alert-content font-poppins ml-4 flex flex-col">
        <div class="alert-title font-medium md:text-lg text-green-800">
          Success
        </div>
        <div class="alert-description text-sm text-green-600">
          {{ $page.props.flash.message }}
        </div>
      </div>
    </div>

    <!-- Layout -->
    <div class="grid gap-2 grid-flow-col grid-cols-5 mx-4">
      <!-- Content -->
      <div class="col-span-4">
        <slot />
      </div>

      <!-- Side Item -->
      <div class="col-span-1 my-4">
        <div class="flex flex-col gap-2">
          <div class="w-full">
            <ALink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Produk
            </ALink>
          </div>
          <div class="w-full">
            <ALink
              :href="route('dashboard.gallery')"
              :active="route().current('dashboard.gallery')"
            >
              Galeri
            </ALink>
          </div>
          <div class="w-full">
            <ALink
              :href="route('dashboard.category')"
              :active="route().current('dashboard.category')"
            >
              Kategori
            </ALink>
          </div>
          <div class="w-full">
            <ALink
              :href="route('dashboard.setting')"
              :active="route().current('dashboard.setting')"
            >
              Setting
            </ALink>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
