<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

// Example products data
const products = ref([
  {
    id: 1,
    name: 'Classic Vape Pen',
    image: '/placeholder.svg?height=200&width=200',
    price: 29.99,
    description: 'A sleek and reliable vape pen for everyday use.',
    category: 'Vape Pens'
  },
  {
    id: 2,
    name: 'Fruit Medley E-Liquid',
    image: '/placeholder.svg?height=200&width=200',
    price: 14.99,
    description: 'A delicious blend of mixed fruit flavors.',
    category: 'E-Liquids'
  },
  {
    id: 3,
    name: 'Advanced Mod Kit',
    image: '/placeholder.svg?height=200&width=200',
    price: 79.99,
    description: 'High-performance mod kit for experienced vapers.',
    category: 'Mod Kits'
  },
  {
    id: 4,
    name: 'Menthol Pods (4-pack)',
    image: '/placeholder.svg?height=200&width=200',
    price: 19.99,
    description: 'Refreshing menthol flavor in convenient pods.',
    category: 'Pods'
  },
  {
    id: 5,
    name: 'Coil Replacement Set',
    image: '/placeholder.svg?height=200&width=200',
    price: 9.99,
    description: 'Compatible coils for various vape devices.',
    category: 'Accessories'
  },
  {
    id: 6,
    name: 'Vape Carrying Case',
    image: '/placeholder.svg?height=200&width=200',
    price: 24.99,
    description: 'Protective case for your vape and accessories.',
    category: 'Accessories'
  }
]);

const searchQuery = ref('');
const selectedCategory = ref('All');

// Categories for the dropdown
const categories = ref(['All', 'Vape Pens', 'E-Liquids', 'Mod Kits', 'Pods', 'Accessories']);

// Computed property to filter products based on search query and selected category
const filteredProducts = computed(() => {
  return products.value.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesCategory = selectedCategory.value === 'All' || product.category === selectedCategory.value;
    return matchesSearch && matchesCategory;
  });
});

// Function to format currency in PHP
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
  }).format(amount);
};

const addToCart = (product) => {
  // Implement add to cart functionality
  console.log('Added to cart:', product);
};

const buyNow = (product) => {
  // Implement buy now functionality
  console.log('Buying now:', product);
};
</script>

<template>
  <Head title="Products" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-2xl font-semibold mb-6">Our Products</h3>
            <div class="flex justify-between mb-4">
              <!-- Search Bar -->
              <input
                type="text"
                v-model="searchQuery"
                placeholder="Search products..."
                class="border rounded-md px-3 py-2"
              />
              <!-- Categories Dropdown -->
              <select v-model="selectedCategory" class="border rounded-md px-3 py-2">
                <option v-for="category in categories" :key="category" :value="category">
                  {{ category }}
                </option>
              </select>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
              <div v-for="product in filteredProducts" :key="product.id" class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover" />
                <div class="p-4">
                  <h4 class="font-semibold text-lg mb-2">{{ product.name }}</h4>
                  <p class="text-gray-600 mb-2">{{ formatCurrency(product.price) }}</p>
                  <p class="text-sm text-gray-500 mb-4">{{ product.description }}</p>
                  <div class="flex space-x-2">
                    <button @click="addToCart(product)" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                      Add to Cart
                    </button>
                    <button @click="buyNow(product)" class="flex-1 bg-green-600 text-black py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                      Buy Now
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>