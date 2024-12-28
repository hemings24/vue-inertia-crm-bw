<script setup>
import {Link,router} from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const props = defineProps({
   customer:{
      type: Object
   },
   navStatusItem: Number,
   status_types:{
      type: Array
   },
   permissions:{
      type: Object
   }
});

const navigate=(status_item_id,status_item_type) =>{
   router.get(route('customers.show',props.customer.id),{
      nav_status_item: status_item_id,
      nav_status_type: status_item_type
   });
};
</script>

<template>
   <div class="flex flex-col space-y-4 mb-10">
      <h1 class="text-3xl text-gray-700">Customer</h1>
      <div class="flex flex-row">
         <div v-for="status_type in status_types" :key="status_type.id">
            <SecondaryButton v-if="permissions.customers_view" type="button"
               id="nav_status_type"
               @click="navigate(status_type.id,status_type.type)"
               :class="((status_type.id==props.navStatusItem) || (status_type.id==1 && props.navStatusItem==null)) && 'active-statusitem'"
               class="text-gray-500 hover:!bg-gray-200 hover:text-gray-700 focus:!bg-blue-500 focus:text-white focus:!ring-0 focus:ring-blue-500 focus:ring-offset-0 rounded-none border-none"
            >
               <span class="text-sm font-medium capitalize">
                  {{status_type.type}}
               </span>
            </SecondaryButton>
         </div>
         <hr>
      </div>
   </div>

   <slot/>
   
   <div class="mt-10 space-x-2">
      <Link :href="route('customers.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
         Back
      </Link>
   </div>

</template>