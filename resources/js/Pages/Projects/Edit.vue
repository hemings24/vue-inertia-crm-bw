<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateProjectForm from './Partials/AddUpdateProjectForm.vue'

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
   },
   action:{
      type: String
   }
});
</script>

<template>
   <Head title="Edit Project"/>

   <AuthenticatedLayout>
      <AddUpdateProjectForm
         :project="project"
         :status_items="status_items"
         :customers="customers"
         :action="action"
      />
   </AuthenticatedLayout>
</template>