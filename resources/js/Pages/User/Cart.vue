<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

// Mock data for cart items (replace with actual data from your backend or state management)
const cartItems = ref([
  {
    id: 1,
    name: 'Classic Vape Pen',
    price: 29.99,
    quantity: 1,
    image: '/placeholder.svg?height=200&width=200',
  },
  {
    id: 2,
    name: 'Fruit Medley E-Liquid',
    price: 14.99,
    quantity: 2,
    image: '/placeholder.svg?height=200&width=200',
  },
]);

const totalAmount = computed(() => {
  return cartItems.value.reduce((total, item) => total + item.price * item.quantity, 0);
});

const removeFromCart = (id) => {
  cartItems.value = cartItems.value.filter(item => item.id !== id);
};
</script>

<template>
  <Head title="Cart" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your Cart</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <div v-if="cartItems.length === 0" class="text-gray-500">
              Your cart is empty.
            </div>
            <div v-else>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="item in cartItems" :key="item.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                  <img :src="item.image" :alt="item.name" class="w-full h-48 object-cover" />
                  <div class="p-4">
                    <h4 class="font-semibold text-lg mb-2">{{ item.name }}</h4>
                    <p class="text-gray-600">${{ item.price.toFixed(2) }}</p>
                    <p class="text-gray-600">Quantity: {{ item.quantity }}</p>
                    <button @click="removeFromCart(item.id)" class="mt-2 w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                      Remove
                    </button>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <h3 class="font-semibold">Total: ${{ totalAmount.toFixed(2) }}</h3>
                <button class="mt-2 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                  Checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>