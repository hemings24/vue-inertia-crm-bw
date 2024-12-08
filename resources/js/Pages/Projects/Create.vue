<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateProjectForm from './Partials/AddUpdateProjectForm.vue'

defineProps({
   status_items:{
      type: Array
   },
   customers:{
      type: Array
   },
   action:{
      type: String
   }
});
</script>
 
<template>
   <Head title="New Project"/>

   <AuthenticatedLayout>
      <AddUpdateProjectForm
         :status_items="status_items"
         :customers="customers"
         :action="action"
      />
   </AuthenticatedLayout>
</template>