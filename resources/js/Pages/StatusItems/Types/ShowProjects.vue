<script setup>
import {Head,Link} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import StatusTypesNavLayout from '../Layouts/StatusTypesNavLayout.vue'

const props = defineProps({
   status_type:{
      type: Object
   },
   projects:{
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
   <Head title="Customer Projects"/>
   <AuthenticatedLayout>

      <StatusTypesNavLayout
         :status_type="status_type"
         :permissions="permissions"
         :navStatusTypes="navStatusTypes"
         :navCurrentStatusTypeId="navCurrentStatusTypeId"
         :statusTypeHeading="statusTypeHeading"
         :webrouteName="webrouteName"
      >
         <div>
            <div class="mb-4">
               <div v-if="Object.keys(projects).length">
                  <div v-for="(project,index) in projects" :key="index">
                     <span class="mr-2 text-md font-semibold text-black-900">Name:</span>
                     <span class="mr-4 text-md text-gray-700">{{project.name}}</span>
                     <span class="mr-2 text-md font-semibold text-black-900">Date:</span>
                     <span class="text-md text-gray-700">{{project.date}}</span>
                  </div>
               </div>
               <div v-else>
                  <p>Customer has no projects</p>
               </div>
            </div>
            <Link v-if="permissions.projects_admin" :href="route('projects.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
               Add New Project
            </Link>
         </div>
      </StatusTypesNavLayout>
   </AuthenticatedLayout>
</template>