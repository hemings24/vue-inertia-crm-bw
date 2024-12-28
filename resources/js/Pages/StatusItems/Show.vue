<script setup>
import {Head,Link} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
   status_item:{
      type: Object
   }
});
</script>

<template>
   <Head title="Show Status Item"/>

   <AuthenticatedLayout>
      <div>

         <div class="mb-4">
            <label for="name" class="text-md font-semibold text-black-900">
               Title:
            </label>
            <span class="text-md text-gray-700"> 
               {{status_item.title}}
            </span>
         </div>

         <div class="mb-4">
            <label for="type" class="text-md font-semibold text-black-900">
               Type:
            </label>
            <span class="text-md text-gray-700 capitalize"> 
               {{status_item.type}}
            </span>
         </div>

         <div class="mb-4">
            <label for="priority" class="text-md font-semibold text-black-900">
               Priority:
            </label>
            <span class="text-md text-gray-700"> 
               {{status_item.priority}}
            </span>
         </div>

         <div class="mb-4">
            <label for="table_ref" class="text-md font-semibold text-black-900">
               Table Ref:
            </label>
            <span class="text-md text-gray-700"> 
               {{status_item.table_ref}}
            </span>
         </div>

         <div class="mb-4">
            <label for="url" class="text-md font-semibold text-black-900">
               URL:
            </label>
            <span class="text-md text-gray-700"> 
               {{status_item.url}}
            </span>
         </div>

      </div>

      <div class="py-4 space-x-2">
         <Link :href="route('status_items.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Back
         </Link>
      </div>

   </AuthenticatedLayout>
</template>