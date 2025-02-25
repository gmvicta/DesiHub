<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Mock data for loyalty points (replace with actual data from your backend)
const userPoints = ref(0);
const pointsHistory = ref([]);
const isLoading = ref(true);

onMounted(async () => {
  // Simulate API call to fetch user's loyalty points data
  await new Promise(resolve => setTimeout(resolve, 1000));
  
  userPoints.value = 1250;
  pointsHistory.value = [
    { id: 1, date: '2023-10-15', description: 'Purchase: Classic Vape Pen', points: 50, type: 'earned' },
    { id: 2, date: '2023-10-10', description: 'Redeemed: Fruit Medley E-Liquid', points: -100, type: 'redeemed' },
    { id: 3, date: '2023-09-28', description: 'Purchase: Advanced Mod Kit', points: 150, type: 'earned' },
    { id: 4, date: '2023-09-15', description: 'Welcome Bonus', points: 500, type: 'earned' },
  ];
  
  isLoading.value = false;
});
</script>

<template>
  <Head title="Loyalty Points" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Loyalty Points</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div v-if="isLoading" class="text-center">
              <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
              <p class="mt-2">Loading your loyalty points...</p>
            </div>
            
            <div v-else>
              <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Your Current Points Balance</h3>
                <p class="text-3xl font-bold text-blue-600">{{ userPoints }} points</p>
              </div>

              <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Points History</h3>
                <div class="overflow-x-auto">
                  <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                      <tr>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-right">Points</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="transaction in pointsHistory" :key="transaction.id" class="border-b">
                        <td class="py-2 px-4">{{ transaction.date }}</td>
                        <td class="py-2 px-4">{{ transaction.description }}</td>
                        <td :class="[
                          'py-2 px-4 text-right',
                          transaction.type === 'earned' ? 'text-green-600' : 'text-red-600'
                        ]">
                          {{ transaction.type === 'earned' ? '+' : '-' }}{{ Math.abs(transaction.points) }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">About Our Loyalty Program</h3>
                <ul class="list-disc list-inside space-y-2">
                  <li>Earn 1 point for every $1 spent on our products.</li>
                  <li>Redeem your points for discounts on future purchases.</li>
                  <li>Points expire 12 months after they are earned.</li>
                  <li>Refer a friend and earn 500 bonus points when they make their first purchase!</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

