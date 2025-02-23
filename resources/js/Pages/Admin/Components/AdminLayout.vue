<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
 
       <!-- nav bar start -->
        <Navbar/>
       <!-- end -->
       <!-- side bar start -->
       <Sidebar/>
        <!-- end -->

       <slot/>


    </div>
 </template>
 
 <script setup>
 import { onMounted } from 'vue'
 import { initFlowbite } from 'flowbite'
 import Navbar from './Navbar.vue'
 import Sidebar from './Sidebar.vue'
 
 // initialize components based on data attribute selectors
 onMounted(() => {
     initFlowbite();
 })
 </script>