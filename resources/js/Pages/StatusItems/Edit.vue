<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateStatusItemForm from './Partials/AddUpdateStatusItemForm.vue'

const props = defineProps({
   status_item:{
      type: Object
   },
   status_types:{
      type: Array
   },
   action:{
      type: String
   }
});
</script>

<template>
   <Head title="Edit Status Item"/>

   <AuthenticatedLayout>
      <AddUpdateStatusItemForm
         :status_item="status_item"
         :status_types="status_types"
         :action="action"
      />
   </AuthenticatedLayout>
</template>