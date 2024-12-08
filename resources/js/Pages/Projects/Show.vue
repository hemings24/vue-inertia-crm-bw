<script setup>
import {Head,Link} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
   project:{
      type: Object
      //required: true
   },
   status_items:{
      type: Array
   },
   customers:{
      type: Array
   }
});
</script>

<template>
   <Head title="Show Project"/>

   <AuthenticatedLayout>
      <div>

         <div class="mb-4">
            <label for="name" class="text-lg font-medium text-black-900">
               Name:
            </label>
            <span class="text-lg text-gray-700"> 
               {{project.name}}
            </span>
         </div>

         <div class="mb-4">
            <label for="date" class="text-lg font-medium text-black-900">
               Date:
            </label>
            <span class="text-lg text-gray-700"> 
               {{project.date}}
            </span>
         </div>

         <div class="mb-4">
            <label for="price" class="text-lg font-medium text-black-900">
               Price:
            </label>
            <span class="text-lg text-gray-700"> 
               &pound;{{project.price}}
            </span>
         </div>

         <div class="mb-4">
            <label for="project_reference" class="text-lg font-medium text-black-900">
               Reference:
            </label>
            <span class="text-lg text-gray-700"> 
               {{project.project_reference}}
            </span>
         </div>

         <div class="mb-4">
            <label for="project_status" class="text-lg font-medium text-black-900">
               Status:
            </label>
            <span v-for="status_item in status_items" :key="status_item.id" class="text-lg text-gray-700">
               <span v-if="status_item.id===project.project_status">
                  {{status_item.title}}
               </span>
            </span>
         </div>  

         <div class="mb-4">
            <label for="customer" class="text-lg font-medium text-black-900">
               Customer:
            </label>
            <span v-for="customer in customers" :key="customer.id" class="text-lg text-gray-700">
               <span v-if="customer.id===project.customer">
                  {{customer.company}}
               </span>
            </span>
         </div> 

      </div>

      <div class="py-4 space-x-2">
         <Link :href="route('projects.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Back
         </Link>
      </div>

   </AuthenticatedLayout>
</template>