<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateStatusItemForm from './Partials/AddUpdateStatusItemForm.vue'

defineProps({
   status_types:{
      type: Array
   },
   action:{
      type: String
   }
});
</script>
 
<template>
   <Head title="New Status Item"/>

   <AuthenticatedLayout>
      <AddUpdateStatusItemForm
         :status_types="status_types"
         :action="action"
      />
   </AuthenticatedLayout>
</template>