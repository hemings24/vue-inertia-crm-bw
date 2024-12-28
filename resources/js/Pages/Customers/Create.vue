<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateCustomerForm from './Partials/AddUpdateCustomerForm.vue'

defineProps({
   title_prefixes:{
      type: Array
   },
   counties:{
      type: Array
   },
   status_items:{
      type: Array
   },
   status_actions:{
      type: Array
   },
   action:{
      type: String
   }
});
</script>
 
<template>
   <Head title="New Customer"/>

   <AuthenticatedLayout>
      <AddUpdateCustomerForm
         :title_prefixes="title_prefixes"
         :counties="counties"
         :status_items="status_items"
         :status_actions="status_actions"
         :action="action"
      />
   </AuthenticatedLayout>
</template>