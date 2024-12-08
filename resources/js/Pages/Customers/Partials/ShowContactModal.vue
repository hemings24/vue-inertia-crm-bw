<script setup>
import {ref} from 'vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import UpdateContactFormModal from './UpdateContactFormModal.vue'

const props = defineProps({ 
   customer:{
      type: Object
   },
   permissions:{
      type: Object
   },
   title_prefixes:{
      type: Array
   },
   counties:{
      type: Array
   }
});

const showContactModal = ref(false);

const openModal=() =>{
   showContactModal.value = true;
};

const closeModal=() =>{
   showContactModal.value = false;
};
</script>

<template>
   <PrimaryButton v-if="permissions.customers_view" @click="openModal" class="inline-block rounded-md bg-yellow-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
      View
   </PrimaryButton>

   <Modal :show="showContactModal" @close="closeModal">

      <div class="flex justify-end">
         <DangerButton @click="closeModal" class="inline-block rounded-md px-2 py-2 text-xs uppercase bg-yellow-500 font-semibold text-white shadow-sm">
            X
         </DangerButton>
      </div>

      <div class="flex mx-8 my-4 space-x-10">
         <div class="basis-1 grow space-y-4">
            <h2 class="text-xl font-medium text-slate-800">Person One</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p><span class="mr-2 font-bold">Company:</span>{{customer.company}}</p>
               <p><span class="mr-2 font-bold">Title:</span>{{customer.title_prefix}}</p>
               <p><span class="mr-2 font-bold">First Name:</span>{{customer.first_name}}</p>
               <p><span class="mr-2 font-bold">Last Name:</span>{{customer.last_name}}</p>
               <p><span class="mr-2 font-bold">Phone:</span>{{customer.phone}}</p>
               <p><span class="mr-2 font-bold">Email:</span>{{customer.email}}</p>
            </div>
         </div>
         <div class="basis-1 grow space-y-4">
            <h2 class="text-xl font-medium text-slate-800">Person Two</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p><span class="mr-2 font-bold">Title:</span></p>
               <p><span class="mr-2 font-bold">First Name:</span></p>
               <p><span class="mr-2 font-bold">Last Name:</span></p>
               <p><span class="mr-2 font-bold">Phone:</span></p>
               <p><span class="mr-2 font-bold">Email:</span></p>
            </div>
         </div>
         <div class="basis-1 grow space-y-4">
            <h2 class="text-xl font-medium text-slate-800">Addresses</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p><span class="mr-2 font-bold">Address:</span>{{customer.address1}}</p>
               <p>{{customer.address2}}</p>
               <p>{{customer.address3}}</p>
               <p><span class="mr-2 font-bold">City:</span>{{customer.city}}</p>
               <p><span class="mr-2 font-bold">Postcode:</span>{{customer.postcode}}</p>
               <p><span class="mr-2 font-bold">County:</span>{{customer.county.title}}</p>
            </div>
         </div>
      </div>

      <div class="ml-4 mb-4">
         <UpdateContactFormModal
            :customer="customer"
            :permissions="permissions"
            :title_prefixes="title_prefixes"
            :counties="counties"
         />
      </div>

   </Modal>
</template>