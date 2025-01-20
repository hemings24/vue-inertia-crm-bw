<script setup>
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import Dropdown from '@/Components/Dropdown.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'

const props = defineProps({
   status_actions:{
      type: Array
   }
});

const form = useForm({
   title: '',
   url: '---',
   type: 'customer',
   table_ref: '---',
   priority: 0,
   page: 'modal'
});

const addStatus=() =>{
   form.post(route('status_items.store'),{
      preserveScroll: true,
      onSuccess: ()=> closeModal()
   });
};

const showAddStatusModal = ref(false);

const openModal=(status_action) =>{
   if(status_action==="add"){
      showAddStatusModal.value = true;
   }
};

const closeModal=() =>{
   showAddStatusModal.value = false;
};
</script>

<template>

   <div class="flex items-end">
      <Dropdown>
         <template #trigger>
            <div>
               <button
                  type="button"
                  class="inline-flex items-center rounded-l-none rounded-r-md border-2 border-transparent bg-blue-500 px-3 pt-2.5 pb-3 text-base leading-4 text-white transition duration-150 ease-in-out hover:text-white focus:outline-none"
               >
                  Action
                  <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                     <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
               </button>
            </div>
         </template>
         <template #content>
            <div v-for="status_action in status_actions" :key="status_action.id">
               <button @click="openModal(status_action.id)" class="flex w-full pl-3 py-1 border-none border-0 text-base hover:bg-gray-200"
               >
                  {{status_action.title}}
               </button>
            </div>
         </template>
      </Dropdown>
      <div v-if="$page.props.flash.message" class="ml-10 rounded-md bg-blue-100 px-3 py-2 text-blue-700">
         {{$page.props.flash.message}}
      </div>
   </div>

   <Modal :show="showAddStatusModal" @close="closeModal">

      <div class="flex justify-end">
         <DangerButton @click="closeModal" class="inline-block rounded-md px-2 py-2 text-xs uppercase bg-yellow-500 font-semibold text-white shadow-sm">
            X
         </DangerButton>
      </div>
   
      <form @submit.prevent="addStatus"> 
         <div class="flex flex-col mx-8 mb-2 space-y-2">
            <div class="basis-1 grow space-y-2">
               <div class="space-y-2">
                  <h2 class="text-xl font-medium text-gray-700">Add Item</h2>
                  <p class="text-base text-gray-700">
                     Fill the details in below and click the Add Item button
                  </p>
               </div>
               <div class="pt-4 pb-10 space-y-3 bg-white rounded-md border-none border-0">
                  <div>
                     <label for="title" class="block text-md font-semibold text-black-900">
                        Title
                     </label>
                     <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.title">
                        {{form.errors.title}}
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
                  Add Item
               </PrimaryButton>
            </div>

         </div>

      </form>
   </Modal>
</template>