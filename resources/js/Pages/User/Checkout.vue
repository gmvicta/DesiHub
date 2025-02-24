<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

// Mock data for delivery address (for UI purposes)
const deliveryAddress = ref({
  name: 'Jomer Bautista',
  phone: '09288403485',
  address: 'Campo, brgy Suqui Calapan City',
  city: 'Calapan City',
  zip: '5200',
});

// Mock data for cart items (replace with actual data from your backend or state management)
const cartItems = ref([
  {
    id: 1,
    name: 'Classic Vape Pen',
    price: 29.99,
    quantity: 1,
    image: '/placeholder.svg?height=80&width=80',
  },
  {
    id: 2,
    name: 'Fruit Medley E-Liquid',
    price: 14.99,
    quantity: 2,
    image: '/placeholder.svg?height=80&width=80',
  },
]);

// Payment methods
const paymentMethods = ref([
  { id: 'cod', name: 'Cash on Delivery' },
  { id: 'gcash', name: 'GCash' },
  { id: 'credit_card', name: 'Credit Card' },
]);

const selectedPayment = ref('cod');

const subtotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + item.price * item.quantity, 0);
});

const totalAmount = computed(() => {
  return subtotal.value; // No delivery fee since it's removed
});

const placeOrder = () => {
  // Here you would typically send the order details to your backend
  console.log('Order placed with the following details:', {
    deliveryAddress: deliveryAddress.value,
    cartItems: cartItems.value,
    paymentMethod: selectedPayment.value,
    totalAmount: totalAmount.value,
  });

  // Redirect to order confirmation page using Inertia
  Inertia.post('/order', {
    deliveryAddress: deliveryAddress.value,
    cartItems: cartItems.value,
    paymentMethod: selectedPayment.value,
    totalAmount: totalAmount.value,
  });
};
</script>

<template>
  <Head title="Checkout" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <form @submit.prevent="placeOrder">
              <!-- Delivery Address -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Delivery Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input v-model="deliveryAddress.name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input v-model="deliveryAddress.phone" type="tel" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                  </div>
                  <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input v-model="deliveryAddress.address" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input v-model="deliveryAddress.city" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">ZIP Code</label>
                    <input v-model="deliveryAddress.zip" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                  </div>
                </div>
              </div>

              <!-- Product Summary -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Product Summary</h3>
                <div v-for="item in cartItems" :key="item.id" class="flex items-center justify-between mb-2 pb-2 border-b">
                  <div class="flex items-center">
                    <img :src="item.image" :alt="item.name" class="w-16 h-16 object-cover rounded mr-4" />
                    <div>
                      <h4 class="font-medium">{{ item.name }}</h4>
                      <p class="text-sm text-gray-600">Quantity: {{ item.quantity }}</p>
                    </div>
                  </div>
                  <span class="font-medium">${{ (item.price * item.quantity).toFixed(2) }}</span>
                </div>
              </div>

              <!-- Payment Method -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Payment Method</h3>
                <div v-for="method in paymentMethods" :key="method.id" class="flex items-center mb-2">
                  <input
                    type="radio"
                    :id="method.id"
                    :value="method.id"
                    v-model="selectedPayment"
                    class="mr-2"
                  />
                  <label :for="method.id">{{ method.name }}</label>
                </div>
              </div>

              <!-- Order Summary -->
              <div class="mb-6 bg-gray-100 p-4 rounded">
                <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                <div class="flex justify-between mb-2">
                  <span>Subtotal:</span>
                  <span>${{ subtotal.toFixed(2) }}</span>
                </div>
                <div class="flex justify-between font-semibold text-lg">
                  <span>Total:</span>
                  <span>${{ totalAmount.toFixed(2) }}</span>
                </div>
              </div>

              <!-- Place Order Button -->
              <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-300">
                  Place Order
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>