<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatusTypesNavLayout from '../Layouts/StatusTypesNavLayout.vue'

const props = defineProps({
   status_type:{
      type: Object
   },
   customer:{
      type: Object
   },
   permissions:{
      type: Object
   },
   navStatusTypes:{
      type: Array
   },
   navCurrentStatusTypeId: Number,
   statusTypeHeading: String,
   webrouteName: String
});
</script>

<template>
   <Head title="Customer Details"/>
   <AuthenticatedLayout>

      <StatusTypesNavLayout
         :status_type="status_type"
         :permissions="permissions"
         :navStatusTypes="navStatusTypes"
         :navCurrentStatusTypeId="navCurrentStatusTypeId"
         :statusTypeHeading="statusTypeHeading"
         :webrouteName="webrouteName"
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
                  <p>{{customer.county_title}}</p>
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
               <span class="text-md text-gray-700">
                  {{customer.customer_status_title}}
               </span>
            </div>     
         </div>
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>