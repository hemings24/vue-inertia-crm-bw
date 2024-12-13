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
            <h2 class="text-xl font-medium text-gray-700">Person One</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Company:</span>
                  <span class="text-md text-gray-700">{{customer.company}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Title:</span>
                  <span class="text-md text-gray-700">{{customer.title_prefix}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">First Name:</span>
                  <span class="text-md text-gray-700">{{customer.first_name}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Last Name:</span>
                  <span class="text-md text-gray-700">{{customer.last_name}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Phone:</span>
                  <span class="text-md text-gray-700">{{customer.phone}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Email:</span>
                  <span class="text-md text-gray-700">{{customer.email}}</span>
               </p>
            </div>
         </div>
         <div class="basis-1 grow space-y-4">
            <h2 class="text-xl font-medium text-gray-700">Person Two</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Title:</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">First Name:</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Last Name:</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Phone:</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Email:</span>
               </p>
            </div>
         </div>
         <div class="basis-1 grow space-y-4">
            <h2 class="text-xl font-medium text-gray-700">Addresses</h2>
            <div class="min-h-72 px-4 pt-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Address:</span>
                  <span class="text-md text-gray-700">{{customer.address1}}</span>
               </p>
               <p>
                  <span class="text-md text-gray-700">{{customer.address2}}</span>
               </p>
               <p>
                  <span class="text-md text-gray-700">{{customer.address3}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">City:</span>
                  <span class="text-md text-gray-700">{{customer.city}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">Postcode:</span>
                  <span class="text-md text-gray-700">{{customer.postcode}}</span>
               </p>
               <p>
                  <span class="mr-2 text-md font-semibold text-black-900">County:</span>
                  <span class="text-md text-gray-700">{{customer.county.title}}</span>
               </p>
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