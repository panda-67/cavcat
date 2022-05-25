<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import Footer from "@/Components/Footer.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";

  defineProps({
    title: String,
    products: Object,
    galeries: Object,
    categories: Object,
  });

  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });
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
  <Head title="Welcome" />

  <BreezeAuthenticatedLayout>
    <!-- Latest Gallery -->
    <div class="carousel w-full">
      <div id="slide1" class="carousel-item relative w-full">
        <img
          v-if="galeries[0]"
          :src="showImage() + galeries[0].image"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
          alt=""
        />
        <img
          v-else
          src="https://api.lorem.space/image/car?w=300&h=600&hash=500B67FB"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
        />

        <div
          class="
            absolute
            mx-8
            flex
            justify-between
            transform
            -translate-y-1/2
            left-5
            right-5
            top-1/2
          "
        >
          <a href="#slide4" class="btn btn-sm btn-circle">❮</a>
          <a href="#slide2" class="btn btn-sm btn-circle">❯</a>
        </div>
      </div>
      <div id="slide2" class="carousel-item relative w-full">
        <img
          v-if="galeries[1]"
          :src="showImage() + galeries[1].image"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
          alt=""
        />
        <img
          v-else
          src="https://api.lorem.space/image/car?w=800&h=200&hash=500B67FB"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
        />
        <div
          class="
            absolute
            mx-8
            flex
            justify-between
            transform
            -translate-y-1/2
            left-5
            right-5
            top-1/2
          "
        >
          <a href="#slide1" class="btn btn-sm btn-circle">❮</a>
          <a href="#slide3" class="btn btn-sm btn-circle">❯</a>
        </div>
      </div>
      <div id="slide3" class="carousel-item relative w-full">
        <img
          v-if="galeries[2]"
          :src="showImage() + galeries[2].image"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
          alt=""
        />
        <img
          v-else
          src="https://api.lorem.space/image/house?w=800&h=600&hash=500B67FB"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
        />

        <div
          class="
            absolute
            mx-8
            flex
            justify-between
            transform
            -translate-y-1/2
            left-5
            right-5
            top-1/2
          "
        >
          <a href="#slide2" class="btn btn-sm btn-circle">❮</a>
          <a href="#slide4" class="btn btn-sm btn-circle">❯</a>
        </div>
      </div>
      <div id="slide4" class="carousel-item relative w-full">
        <img
          v-if="galeries[3]"
          :src="showImage() + galeries[3].image"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
          alt=""
        />
        <img
          v-else
          src="https://api.lorem.space/image/car?w=800&h=600&hash=500B67FB"
          class="
            w-full
            h-96
            md:h-140
            mx-6
            my-auto
            md:mt-10 md:mx-10
            rounded-lg
            md:rounded-xl
            object-cover
          "
        />

        <div
          class="
            absolute
            mx-8
            flex
            justify-between
            transform
            -translate-y-1/2
            left-5
            right-5
            top-1/2
          "
        >
          <a href="#slide3" class="btn btn-sm btn-circle">❮</a>
          <a href="#slide1" class="btn btn-sm btn-circle">❯</a>
        </div>
      </div>
    </div>

    <!-- Latest Products -->
    <div class="mx-auto">
      <div class="col-span-4 mx-3 my-4 md:mx-4">
        <div class="bg-base grid md:gap-2 grid-cols-2 lg:grid-cols-4">
          <div v-for="stock in products" :key="stock.id">
            <div class="py-3 font-roboto w-full px-2 md:px-4 flex flex-col">
              <div>
                <Link :href="route('products.show', stock.slug)">
                  <div v-if="stock.display">
                    <img
                      :src="showImage() + stock.display"
                      class="rounded-lg object-fill w-40 h-28 md:w-80 md:h-56"
                    />
                  </div>
                  <div v-else>
                    <img
                      class="rounded-lg object-fill w-40 h-28 md:w-80 md:h-56"
                      src="https://cdn.pixabay.com/photo/2021/11/16/08/01/animal-6800387__340.jpg"
                      alt=""
                    />
                  </div>
                </Link>
                <div class="flex flex-col mb-2">
                  <div
                    class="
                      pb-1
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
                      text-xs
                      sm:text-base
                      font-normal font-sans
                      hover:text-blue-500
                      text-gray-700
                      capitalize
                    "
                  >
                    <Link
                      :href="route('products.show', stock.slug)"
                      as="button"
                      type="button"
                      class="text-left"
                    >
                      {{ stock.title }}
                    </Link>
                  </div>
                  <div class="text-xs sm:text-sm font-thin">
                    <h2>
                      Dalam
                      <strong>
                        <Link
                          :href="route('category', stock.category.slug)"
                          as="button"
                          type="button"
                          class="text-left"
                        >
                          {{ stock.category.name }}
                        </Link>
                      </strong>
                    </h2>
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center mb-2">
                <div
                  class="
                    flex flex-col
                    sm:flex-row sm:gap-4
                    items-start
                    md:items-center
                  "
                >
                  <div
                    class="
                      py-2
                      text-gray-600 text-sm
                      md:text-lg
                      font-mono font-bold
                    "
                  >
                    <p>{{ formatter.format(stock.price) }}</p>
                  </div>
                </div>
                <div
                  v-if="$page.props.auth.user"
                  class="flex gap-2 items-center text-gray-500"
                >
                  <Link
                    :href="route('products.edit', stock)"
                    as="button"
                    type="button"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="
                        h-5
                        md:h-7
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
                    :href="route('products.destroy', stock)"
                    method="delete"
                    as="button"
                    type="button"
                    preserve-scroll
                  >
                    <RemoveButton class="hover:bg-red-600 border-none" />
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </BreezeAuthenticatedLayout>
</template>