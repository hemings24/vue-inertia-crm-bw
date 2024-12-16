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
   <Head title="Show Customer"/>
   <AuthenticatedLayout>

      <StatusTypesNavLayout
         :customer="customer"
         :navStatusItem="navStatusItem"
         :status_types="status_types"
         :permissions="permissions"
      >
         ENQUIRIES
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>