<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import BreezeNavLink from "@/Components/NavLink.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { computed } from "vue";

  defineProps({
    stock: Object,
  });

  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });

  const insertBetween = (items, insertion) => {
    return items.flatMap((value, index, array) =>
      array.length - 1 !== index ? [value, insertion] : value
    );
  };

  const breadcrumbs = computed(() =>
    insertBetween(Inertia.page.props.breadcrumbs || [], "/")
  );
</script>
<script>
  export default {
    methods: {
      showImage() {
        return "/storage/";
      },
    },
  };
</script>

<template>
  <Head>
    <title>{{ stock.title }}</title>
  </Head>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-thin text-base leading-tight">
        <nav class="flex" v-if="breadcrumbs">
          <div class="ml-1" v-for="page in breadcrumbs" :key="page.id">
            <span v-if="page === '/'">/</span>
            <Link
              v-else
              :href="page.url"
              class="hover:text-blue-500"
              :class="{ 'text-gray-300': page.current }"
              >{{ page.title }}
            </Link>
          </div>
          <Link
            type="button"
            as="button"
            class="hover:text-blue-500"
            :href="route('category', stock.category.slug)"
          >
            {{ stock.category.name }}
          </Link>
          <div class="text-gray-500">&nbsp;/ {{ stock.title }}</div>
        </nav>
      </h2>
    </template>

    <div
      class="
        flex flex-col
        gap-5
        md:gap-2
        lg:grid lg:grid-cols-3
        mx-10
        mt-4
        lg:my-8
      "
    >
      <div class="flex justify-center w-full col-span-1">
        <div v-if="stock.display">
          <img
            :src="showImage() + stock.display"
            class="rounded-lg object-fill w-80 h-56"
          />
        </div>
        <div v-else>
          <img
            class="rounded-lg object-fill w-80 h-56"
            src="https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg"
            alt=""
          />
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
              "
            >
              {{ stock.title }}
            </div>
            <!-- <div class="text-xs font-thin mt-1">
              <h2>
                Dalam
                
              </h2>
            </div> -->
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