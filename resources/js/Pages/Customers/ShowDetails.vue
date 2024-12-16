<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatusTypesNavLayout from './Layouts/StatusTypesNavLayout.vue'

const props = defineProps({
   customer:{
      type: Object
   },
   counties:{
      type: Array
   },
   status_items:{
      type: Array
   },
   navStatusItem: Number,
   status_types:{
      type: Array
   },
   permissions:{
      type: Object
   }
});
</script>

<template>
   <Head title="Customer Details"/>
   <AuthenticatedLayout>

      <StatusTypesNavLayout
         :customer="customer"
         :navStatusItem="navStatusItem"
         :status_types="status_types"
         :permissions="permissions"
      >
         <div>
            <div class="mb-4">
               <label for="company" class="text-md font-semibold text-black-900">
                  Company:
               </label>
               <span class="text-md text-gray-700"> 
                  {{customer.company}}
               </span>
            </div>

            <div class="mb-4">
               <label for="name" class="text-md font-semibold text-black-900">
                  Name:
               </label>
               <span class="text-md text-gray-700"> 
                  {{customer.title_prefix}}
                  {{customer.first_name}}
                  {{customer.last_name}}
               </span>
            </div>

            <div class="mb-4">
               <label for="address" class="text-md font-semibold text-black-900">
                  Address:
               </label>
               <div class="text-md text-gray-700"> 
                  <p>{{customer.address1}}</p>
                  <p>{{customer.address2}}</p>
                  <p>{{customer.address3}}</p>
                  <p>{{customer.city}}</p>
                  <p>{{customer.postcode}}</p>
                  <p v-for="county in counties" :key="county.id">
                     <span v-if="county.id===customer.county">
                        {{county.title}}
                     </span>
                  </p>
               </div>
            </div>

            <div class="mb-4">
               <label for="phone" class="text-md font-semibold text-black-900">
                  Phone:
               </label>
               <span class="text-md text-gray-700"> 
                  {{customer.phone}}
               </span>
            </div>

            <div class="mb-4">
               <label for="email" class="text-md font-semibold text-black-900">
                  Email:
               </label>
               <span class="text-md text-gray-700"> 
                  {{customer.email}}
               </span>
            </div>

            <div class="mb-4">
               <label for="notes" class="text-md font-semibold text-black-900">
                  Notes:
               </label>
               <p class="text-md text-gray-700"> 
                  {{customer.notes}}
               </p>
            </div>

            <div>
               <label for="customer_status" class="text-md font-semibold text-black-900">
                  Status:
               </label>
               <span v-for="status_item in status_items" :key="status_item.id" class="text-md text-gray-700">
                  <span v-if="status_item.id===customer.customer_status">
                     {{status_item.title}}
                  </span>
               </span>
            </div>     
         </div>
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>