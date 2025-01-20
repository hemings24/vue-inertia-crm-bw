<script setup>
import {Link,router} from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

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

const navigate=(nav_status_type_id,nav_status_type_name) =>{
   router.get(route(props.webrouteName+'.show',props.status_type.id),{
      nav_current_status_type_id : nav_status_type_id,
      nav_current_status_type_name : nav_status_type_name
   });
};
</script>

<template>
   <div class="flex flex-col space-y-4 mb-10">
      <h1 class="text-3xl text-gray-700">{{props.statusTypeHeading}}</h1>
      <div class="flex flex-row">
         <div v-for="navStatusType in navStatusTypes" :key="navStatusType.id">
            <SecondaryButton v-if="permissions.status_items_view" type="button"
               id="nav_status_type"
               @click="navigate(navStatusType.id,navStatusType.type)"
               :class="((navStatusType.id==props.navCurrentStatusTypeId) || (navStatusType.id==1 && props.navCurrentStatusTypeId==null)) && 'active-statusitem'"
               class="text-gray-500 hover:!bg-gray-200 hover:text-gray-700 focus:!bg-blue-500 focus:text-white focus:!ring-0 focus:ring-blue-500 focus:ring-offset-0 rounded-none border-none"
            >
               <span class="text-sm font-medium capitalize">
                  {{navStatusType.type}}
               </span>
            </SecondaryButton>
         </div>
         <hr>
      </div>
   </div>

   <slot/>
   
   <div class="mt-10 space-x-2">
      <Link :href="route(props.webrouteName+'.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
         Back
      </Link>
   </div>

</template>