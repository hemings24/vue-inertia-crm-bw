<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatusTypesNavLayout from '../Layouts/StatusTypesNavLayout.vue'

const props = defineProps({
   status_type:{
      type: Object
   },
   project:{
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
   <Head title="Project"/>
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
               <label for="name" class="text-md font-semibold text-black-900">
                  Name:
               </label>
               <span class="text-md text-gray-700 capitalize"> 
                  {{project.name}}
               </span>
            </div>

            <div class="mb-4">
               <label for="date" class="text-md font-semibold text-black-900">
                  Date:
               </label>
               <span class="text-md text-gray-700"> 
                  {{project.date}}
               </span>
            </div>

            <div class="mb-4">
               <label for="price" class="text-md font-semibold text-black-900">
                  Price:
               </label>
               <span class="text-md text-gray-700"> 
                  &pound;{{project.price}}
               </span>
            </div>

            <div class="mb-4">
               <label for="project_reference" class="text-md font-semibold text-black-900">
                  Reference:
               </label>
               <span class="text-md text-gray-700"> 
                  {{project.project_reference}}
               </span>
            </div>

            <div class="mb-4">
               <label for="project_status" class="text-md font-semibold text-black-900">
                  Status:
               </label>
               <span class="text-md text-gray-700">
                  {{project.project_status_title}}
               </span>
            </div>  

            <div>
               <label for="customer" class="text-md font-semibold text-black-900">
                  Customer:
               </label>
               <span class="text-md text-gray-700">
                  {{customer.company}}
               </span>
            </div> 

         </div>
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>