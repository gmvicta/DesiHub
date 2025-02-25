<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Mock data for user points and products (replace with actual data from your backend)
const userPoints = ref(5000);
const products = ref([
  { id: 1, name: 'Classic Vape Pen', image: '/placeholder.svg?height=200&width=200', pointsCost: 1000 },
  { id: 2, name: 'Fruit Medley E-Liquid', image: '/placeholder.svg?height=200&width=200', pointsCost: 500 },
  { id: 3, name: 'Advanced Mod Kit', image: '/placeholder.svg?height=200&width=200', pointsCost: 2500 },
  { id: 4, name: 'Menthol Pods (4-pack)', image: '/placeholder.svg?height=200&width=200', pointsCost: 750 },
]);

const cart = ref([]);

const addToCart = (product) => {
  if (userPoints.value >= product.pointsCost) {
    cart.value.push(product);
    userPoints.value -= product.pointsCost;
  } else {
    alert('Not enough points to redeem this product.');
  }
};

const removeFromCart = (index) => {
  const removedProduct = cart.value.splice(index, 1)[0];
  userPoints.value += removedProduct.pointsCost;
};

const totalPointsCost = computed(() => {
  return cart.value.reduce((total, product) => total + product.pointsCost, 0);
});

const redeemPoints = () => {
  // Here you would typically make an API call to process the redemption
  alert(`Redemption successful! You've spent ${totalPointsCost.value} points.`);
  cart.value = [];
};
</script>

<template>
  <Head title="Points Redemption" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Points Redemption</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="mb-6">
            <h3 class="text-lg font-semibold">Your Points Balance: {{ userPoints }}</h3>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="product in products" :key="product.id" class="border rounded-lg p-4 flex flex-col">
              <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover rounded-lg mb-4">
              <h4 class="font-semibold text-lg mb-2">{{ product.name }}</h4>
              <p class="text-gray-600 mb-4">Points: {{ product.pointsCost }}</p>
              <button 
                @click="addToCart(product)" 
                class="mt-auto bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300"
                :disabled="userPoints < product.pointsCost"
              >
                Redeem with Points
              </button>
            </div>
          </div>

          <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Your Redemption Cart</h3>
            <div v-if="cart.length === 0" class="text-gray-500">
              Your cart is empty. Redeem some products!
            </div>
            <div v-else>
              <div v-for="(item, index) in cart" :key="index" class="flex justify-between items-center border-b py-2">
                <span>{{ item.name }} ({{ item.pointsCost }} points)</span>
                <button @click="removeFromCart(index)" class="text-red-600 hover:text-red-800">
                  Remove
                </button>
              </div>
              <div class="mt-4 flex justify-between items-center">
                <span class="font-semibold">Total Points: {{ totalPointsCost }}</span>
                <button 
                  @click="redeemPoints" 
                  class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300"
                  :disabled="cart.length === 0"
                >
                  Confirm Redemption
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

