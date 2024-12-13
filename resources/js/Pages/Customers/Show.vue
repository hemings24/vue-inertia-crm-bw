<script setup>
import {Head,Link} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
   customer:{
      type: Object
      //required: true
   },
   counties:{
      type: Array
   },
   status_items:{
      type: Array
   }
});
</script>

<template>
   <Head title="Show Customer"/>

   <AuthenticatedLayout>
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

         <div class="mb-4">
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

      <div class="py-4 space-x-2">
         <Link :href="route('customers.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Back
         </Link>
      </div>

   </AuthenticatedLayout>
</template>