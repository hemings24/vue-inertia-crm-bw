<script setup>
import {ref} from 'vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import SendEmailTemplatesModal from './SendEmailTemplatesModal.vue'

const props = defineProps({ 
   customer:{
      type: Object
   },
   permissions:{
      type: Object
   },
   email_templates:{
      type: Array
   }
});

const showLatestCommsModal = ref(false);

const openModal=() =>{
   showLatestCommsModal.value = true;
};

const closeModal=() =>{
   showLatestCommsModal.value = false;
};
</script>

<template>
   <PrimaryButton v-if="permissions.customers_view" @click="openModal" class="inline-block rounded-md bg-yellow-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
      View
   </PrimaryButton>

   <Modal :show="showLatestCommsModal" @close="closeModal">

      <div class="flex justify-end">
         <DangerButton @click="closeModal" class="inline-block rounded-md px-2 py-2 text-xs uppercase bg-yellow-500 font-semibold text-white shadow-sm">
            X
         </DangerButton>
      </div>

      <div class="flex flex-col mx-8 mb-8 space-y-8">
         <div class="space-y-4">
            <h2 class="text-xl font-medium text-gray-700">Comms Actions</h2>
            <div class="py-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               <SendEmailTemplatesModal
                  :customer="customer"
                  :permissions="permissions"
                  :email_templates="email_templates"
               />
            </div>
         </div>
         <div class="space-y-4">
            <h2 class="text-xl font-medium text-gray-700">Previous Comms</h2>
            <div class="py-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               ----------
            </div>
         </div>
         <div class="space-y-4">
            <h2 class="text-xl font-medium text-gray-700">Previous System Emails</h2>
            <div class="py-4 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
               ----------
            </div>
         </div>
      </div>

   </Modal>
</template>