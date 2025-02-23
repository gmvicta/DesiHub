<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { Carousel } from 'flowbite';

// Mock data for carousel items (replace with actual data from your backend)
const carouselItems = ref([
  {
    id: 1,
    image: '/placeholder.svg?height=400&width=800',
    title: 'New Vape Flavor',
    description: 'Try our latest fruity blend!',
  },
  {
    id: 2,
    image: '/placeholder.svg?height=400&width=800',
    title: 'Limited Edition Kit',
    description: 'Get our exclusive starter kit now!',
  },
  {
    id: 3,
    image: '/placeholder.svg?height=400&width=800',
    title: 'Summer Sale',
    description: 'Up to 30% off on selected items!',
  },
]);

// Mock data for vape products (replace with actual data from your backend)
const products = ref([
  {
    id: 1,
    name: 'Classic Vape Pen',
    image: '/placeholder.svg?height=200&width=200',
    price: 29.99,
  },
  {
    id: 2,
    name: 'Fruit Medley E-Liquid',
    image: '/placeholder.svg?height=200&width=200',
    price: 14.99,
  },
  {
    id: 3,
    name: 'Advanced Mod Kit',
    image: '/placeholder.svg?height=200&width=200',
    price: 79.99,
  },
  {
    id: 4,
    name: 'Menthol Pods (4-pack)',
    image: '/placeholder.svg?height=200&width=200',
    price: 19.99,
  },
]);

onMounted(() => {
  const carouselElement = document.getElementById('default-carousel');
  if (carouselElement) {
    const options = {
      interval: 3000,
      indicators: true,
      ride: 'carousel'
    };
    const carousel = new Carousel(carouselElement, options);

    // Manually set up event listeners for prev and next buttons
    const prevButton = carouselElement.querySelector('[data-carousel-prev]');
    const nextButton = carouselElement.querySelector('[data-carousel-next]');

    if (prevButton) {
      prevButton.addEventListener('click', () => carousel.prev());
    }
    if (nextButton) {
      nextButton.addEventListener('click', () => carousel.next());
    }
  }
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Desipulos</h2>
        <!-- Search Bar -->
        <div class="mt-4 sm:mt-0">
          <input type="text" placeholder="Search products..." class="border rounded-md px-3 py-2" />
        </div>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Carousel Section -->
        <div class="mb-8 relative h-56 overflow-hidden rounded-lg md:h-96">
          <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
              <div v-for="(item, index) in carouselItems" :key="item.id" :class="['hidden duration-700 ease-in-out', index === 0 ? '!block' : '']" data-carousel-item>
                <img :src="item.image" :alt="item.title" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" />
                <div class="absolute inset-0 flex flex-col justify-end bg-black bg-opacity-50 p-4 text-white">
                  <h3 class="text-2xl font-bold">{{ item.title }}</h3>
                  <p>{{ item.description }}</p>
                </div>
              </div>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
              <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
              </span>
            </button>
            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
              <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
              </span>
            </button>
          </div>
        </div>

        <!-- Products Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-4">Featured Products</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
              <div v-for="product in products" :key="product.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover" />
                <div class="p-4">
                  <h4 class="font-semibold text-lg mb-2">{{ product.name }}</h4>
                  <p class="text-gray-600">${{ product.price.toFixed(2) }}</p>
                  <button class="mt-2 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template> 