<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AddUpdateCustomerForm from './Partials/AddUpdateCustomerForm.vue'

const props = defineProps({
   customer:{
      type: Object
   },
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
   <Head title="Edit Customer"/>

   <AuthenticatedLayout>
      <AddUpdateCustomerForm
         :customer="customer"
         :title_prefixes="title_prefixes"
         :counties="counties"
         :status_items="status_items"
         :status_actions="status_actions"
         :action="action"
      />   
   </AuthenticatedLayout>
</template>