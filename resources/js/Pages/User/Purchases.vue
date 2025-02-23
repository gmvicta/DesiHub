<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import PurchaseDetailsModal from '@/Pages/User/Components/PurchaseDetailsModal.vue';

// Mock data for purchases (replace with actual data from your backend)
const purchases = ref([
  {
    id: 1,
    product: 'Classic Vape Pen',
    price: 29.99,
    date: '2023-10-01',
    status: 'Delivered',
    image: '/placeholder.svg?height=100&width=100', // Placeholder image
    orderNumber: 'ORD123456',
  },
  {
    id: 2,
    product: 'Fruit Medley E-Liquid',
    price: 14.99,
    date: '2023-10-05',
    status: 'Pending',
    image: '/placeholder.svg?height=100&width=100', // Placeholder image
    orderNumber: 'ORD123457',
  },
  {
    id: 3,
    product: 'Advanced Mod Kit',
    price: 79.99,
    date: '2023-10-10',
    status: 'Delivered',
    image: '/placeholder.svg?height=100&width=100', // Placeholder image
    orderNumber: 'ORD123458',
  },
]);

const selectedPurchase = ref(null);
const isModalOpen = ref(false);

const openModal = (purchase) => {
  selectedPurchase.value = purchase;
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
  selectedPurchase.value = null;
};
</script>

<template>
  <Head title="My Purchases" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Purchases</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <div v-if="purchases.length === 0" class="text-gray-500">
              You have no purchases yet.
            </div>
            <div v-else>
              <div class="space-y-4">
                <div v-for="purchase in purchases" :key="purchase.id" class="border p-4 rounded-lg shadow">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <img :src="purchase.image" alt="Product Image" class="w-24 h-24 object-cover rounded" />
                      <div class="ml-4">
                        <h3 class="font-semibold text-lg">{{ purchase.product }}</h3>
                        <p class="text-gray-600">Order Number: {{ purchase.orderNumber }}</p>
                        <p class="text-gray-600">Price: ${{ purchase.price.toFixed(2) }}</p>
                        <p class="text-gray-600">Date: {{ purchase.date }}</p>
                        <p class="text-gray-600">Status: <span :class="{'text-green-500': purchase.status === 'Delivered', 'text-yellow-500': purchase.status === 'Pending'}">{{ purchase.status }}</span></p>
                      </div>
                    </div>
                    <button @click="openModal(purchase)" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Purchase Details -->
    <PurchaseDetailsModal
      v-if="isModalOpen && selectedPurchase"
      :purchase="selectedPurchase"
      :isOpen="isModalOpen"
      @close="closeModal"
    />
  </AuthenticatedLayout>
</template>