<script setup>
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import Dropdown from '@/Components/Dropdown.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'

const props = defineProps({
   customer:{
      type: [Object,Array]
   },
   permissions:{
      type: Object
   },
   email_templates:{
      type: Array
   }
});

const form = useForm({
   subject: '',
   content: '',
   customer: props.customer.id
});

const sendEmail=() =>{
   form.post(route('emails.store',props.customer),{
      preserveScroll: true,
      onSuccess: ()=> closeModal()
   });
};

const showEmailTemplateModal = ref(false);

const openModal=(email_template_subject,email_template_content) =>{
   showEmailTemplateModal.value = true;
   form.subject = email_template_subject;
   form.content = "Hi "+props.customer.company+",\n\n"+email_template_content;
};

const closeModal=() =>{
   showEmailTemplateModal.value = false;
};
</script>

<template>

   <div class="flex items-end">
      <Dropdown>
         <template #trigger>
            <div>
               <button
                  type="button"
                  class="inline-flex items-center rounded-md border-2 border-transparent bg-blue-500 px-10 pt-2.5 pb-3 text-base leading-4 text-white transition duration-150 ease-in-out hover:text-white focus:outline-none"
               >
                  Send Email
                  <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                     <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
               </button>
            </div>
         </template>
         <template #content>
            <div v-for="email_template in email_templates" :key="email_template.id">
               <button 
                  @click="openModal(email_template.subject,email_template.content)"
                  class="flex w-full pl-3 py-1 border-none border-0 text-base hover:bg-gray-200"
               >
                  {{email_template.subject}}
               </button>
            </div>
         </template>
      </Dropdown>
      <div v-if="$page.props.flash.message" class="ml-10 rounded-md bg-blue-100 px-3 py-2 text-blue-700">
         {{$page.props.flash.message}}
      </div>
   </div>

   <Modal :show="showEmailTemplateModal" @close="closeModal">

      <div class="flex justify-end">
         <DangerButton @click="closeModal" class="inline-block rounded-md px-2 py-2 text-xs uppercase bg-yellow-500 font-semibold text-white shadow-sm">
            X
         </DangerButton>
      </div>

      <form @submit.prevent="sendEmail">
         <div class="flex flex-col mx-8 mb-2 space-y-2">
            <div class="basis-1 grow space-y-2">
               <div class="pt-4 pb-10 space-y-3 bg-white rounded-md border-none border-0">

                  <div class="mb-4">
                     <label for="company" class="block text-md font-semibold text-black-900">
                        Customer
                     </label>
                     <input v-model="props.customer.company" type="text" id="company" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>

                  <div class="mb-4">
                     <label for="email" class="block text-md font-semibold text-black-900">
                        Email
                     </label>
                     <input v-model="props.customer.email" type="text" id="email" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>

                  <div class="mb-4">
                     <label for="subject" class="block text-md font-semibold text-black-900">
                        Subject
                     </label>
                     <input v-model="form.subject" type="text" id="subject" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>

                  <div class="mb-4">
                     <label for="content" class="block text-md font-semibold text-black-900">
                        Content
                     </label>
                     <textarea v-model="form.content" id="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.content">
                        {{form.errors.content}}
                     </p>
                  </div>

               </div>
            </div>

            <div class="pb-4">
               <PrimaryButton 
                  type="submit"
                  :disabled="form.processing"
                  class="inline-block rounded-md bg-green-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm"
                  :class="{'opacity-25':form.processing}"
               >
                  Send
               </PrimaryButton>
            </div>

         </div>
      </form>

   </Modal>
</template>