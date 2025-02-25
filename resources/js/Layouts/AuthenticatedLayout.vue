<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const showingNotificationDropdown = ref(false);

// Example notifications
const notifications = ref([
    { id: 1, message: 'Your order has been shipped!', date: '2023-10-01' },
    { id: 2, message: 'New product added to your wishlist.', date: '2023-10-05' },
    { id: 3, message: 'Your profile has been updated.', date: '2023-10-10' },
]);

const toggleNotificationDropdown = () => {
    showingNotificationDropdown.value = !showingNotificationDropdown.value;
};

// Close dropdown when clicking outside
const closeNotificationDropdown = (event) => {
    if (!event.target.closest('.notification-dropdown')) {
        showingNotificationDropdown.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', closeNotificationDropdown);
});

onUnmounted(() => {
    document.removeEventListener('click', closeNotificationDropdown);
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Home
                                </NavLink>
                                <NavLink :href="route('products')" :active="route().current('products')">
                                    Products
                                </NavLink>
                                <NavLink :href="route('points.redemption')"
                                    :active="route().current('points.redemption')">
                                    Points Redemption
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Clickable Cart Indicator -->
                            <div class="mr-4 flex items-center">
                                <Link :href="route('cart')" class="text-gray-500 hover:text-gray-700">
                                Cart (0) <!-- Placeholder for cart count -->
                                </Link>
                                <!-- Notification Dropdown -->
                                <div class="ml-2 relative notification-dropdown">
                                    <span @click="toggleNotificationDropdown"
                                        class="text-sm text-red-500 cursor-pointer">
                                        Notifications
                                    </span>
                                    <transition enter-active-class="transition ease-out duration-200"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                        <div v-if="showingNotificationDropdown"
                                            class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                                            <div class="py-2">
                                                <div v-if="notifications.length === 0" class="px-4 py-2 text-gray-500">
                                                    No notifications.
                                                </div>
                                                <div v-else>
                                                    <div v-for="notification in notifications" :key="notification.id"
                                                        class="px-4 py-2 text-gray-800 hover:bg-gray-100">
                                                        <p class="text-sm">{{ notification.message }}</p>
                                                        <p class="text-xs text-gray-500">{{ notification.date }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('purchases')" :active="route().current('purchases')">
                                            My Purchases
                                        </DropdownLink>
                                        <DropdownLink :href="route('loyalty.points')" :active="route().current('loyalty.points')">
                                            Loyalty Points
                                        </DropdownLink>
                                      
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('products')" :active="route().current('products')">
                            Products
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('points.redemption')"
                            :active="route().current('points.redemption')">
                            Points Redemption
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('purchases')" :active="route().current('purchases')">
                                My Purchases
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('loyalty.points')" :active="route().current('loyalty.points')">
                                Loyalty Points
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

