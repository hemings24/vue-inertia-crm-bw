<script setup>
import {Head} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatusTypesNavLayout from '../Layouts/StatusTypesNavLayout.vue'

const props = defineProps({
   status_type:{
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
   <Head title="Admin"/>
   <AuthenticatedLayout>

      <StatusTypesNavLayout
         :status_type="status_type"
         :permissions="permissions"
         :navStatusTypes="navStatusTypes"
         :navCurrentStatusTypeId="navCurrentStatusTypeId"
         :statusTypeHeading="statusTypeHeading"
         :webrouteName="webrouteName"
      >
         ADMIN
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>