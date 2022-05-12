<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import RemoveButton from "@/Components/RemoveButton.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  stock: Object,
  breads: Array,
});

const formatter = new Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
  minimumFractionDigits: 2,
});
</script>

<template>
  <Head title="Show" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">
        {{ stock.title }}
      </h2>
    </template>

    <div
      class="
        flex flex-col
        gap-6
        md:gap-2
        lg:grid lg:grid-cols-3
        mx-10
        mt-4
        lg:my-8
      "
    >
      <div class="flex w-full col-span-1 aspect-w-10 aspect-h-8">
        <div
          v-if="stock.display"
          class="
            lg:w-80 lg:h-64 lg:ml-4
            xl:ml-12
            rounded-lg
            bg-center bg-gray-300 bg-cover bg-current bg-opacity-40
          "
          style="background-image: url('{{ asset('storage/' . stock.display) }}'); background-blend-mode: multiply"
        >
          <div class=""></div>
        </div>

        <div
          v-else
          class="
            lg:w-80 lg:h-64 lg:ml-4
            xl:ml-12
            rounded-lg
            bg-center bg-transparent
            from-slate-100
            to-gray-900
            bg-cover bg-opacity-40
          "
          style="
            background-image: url('https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg');
            background-blend-mode: multiply;
          "
        >
          <div class=""></div>
        </div>
      </div>
      <div
        class="
          text-left
          flex flex-col
          justify-start
          mt-4
          sm:mt-0
          mx-4
          col-span-2
        "
      >
        <div class="font-roboto">
          <div class="flex flex-col">
            <div
              class="
                pb-2
                mb-2
                border-b
                w-max
                border-gray-400
                text-xs
                sm:text-base
                font-light
                tracking-wider
                text-gray-500
                capitalize
              "
            >
              {{ stock.merk }}
            </div>
            <div
              class="
                text-sm
                sm:text-lg
                font-normal font-sans
                text-gray-700
                capitalize
              "
            >
              {{ stock.title }}
            </div>
            <div class="text-xs font-thin mt-1">
              <h2>
                Dalam
                <strong
                  ><a
                    class="hover:text-blue-500"
                    href="{{ route('category', stock.category.slug) }}"
                    >{{ stock.category.name }}</a
                  ></strong
                >
              </h2>
            </div>
          </div>
          <div
            class="
              my-6
              text-xs
              sm:text-base
              font-light
              tracking-tight
              text-gray-600
            "
          >
            {{ stock.description }}
          </div>
          <div
            class="
              flex
              justify-between
              text-gray-600 text-sm
              sm:text-xl
              font-mono font-bold
            "
          >
            <div
              v-if="$page.props.auth.user"
              class="flex items-center gap-2 w-full py-2"
            >
              <Link
                :href="route('products.edit', stock)"
                as="button"
                type="button"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    h-6
                    hover:cursor-pointer
                    rounded-md
                    hover:bg-green-500 hover:text-gray-100
                  "
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                  />
                </svg>
              </Link>
              <Link
                :href="route('dashboard')"
                :active="route().current('dashboard')"
                class="hover:text-blue-400"
              >
                Dashboard
              </Link>
            </div>
            <div>
              <p>{{ formatter.format(stock.price) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>