<script setup>
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import SelectInput from '@/Components/SelectInput.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
   customer:{
      type: [Object,Array]
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

const form = useForm(props.customer);
form.county = props.customer.county.id;

const updateContact=() =>{
   form.patch(route('customers.update',props.customer),{
      preserveScroll: true,
      onSuccess: ()=> closeModal()
   });
};

const showUpdateContactModal = ref(false);

const openModal=() =>{
   showUpdateContactModal.value = true;
};

const closeModal=() =>{
   showUpdateContactModal.value = false;
};
</script>

<template>
   <PrimaryButton v-if="permissions.customers_edit" @click="openModal" class="inline-block rounded-md bg-yellow-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
      Edit
   </PrimaryButton>

   <Modal :show="showUpdateContactModal" @close="closeModal">

      <div class="flex justify-end">
         <DangerButton @click="closeModal" class="inline-block rounded-md px-2 py-2 text-xs uppercase bg-yellow-500 font-semibold text-white shadow-sm">
            X
         </DangerButton>
      </div>
   
      <form @submit.prevent="updateContact"> 
         <div class="flex mx-8 my-4 space-x-10">
            <div class="basis-1 grow space-y-4">
               <h2 class="text-xl font-medium text-gray-700">Person One</h2>
               <div class="min-h-96 px-4 pt-4 pb-10 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
                  <div>
                     <label for="company" class="mr-2 text-md font-semibold text-black-900">
                        Company
                     </label>
                     <input v-model="form.company" type="text" id="company" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.company">
                        {{form.errors.company}}
                     </p>
                  </div>                  
                  <div class="form-group">
                     <label for="title_prefix" class="mr-2 text-md font-semibold text-black-900">
                        Title
                     </label>
                     <SelectInput
                        id="title_prefix"
                        v-model="form.title_prefix"
                        :options="title_prefixes"
                        option-value="id"
                        option-label="title"
                        :default-option="{id:'',title:''}"
                        :disabled="form.processing"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                     />
                     <InputError :message="form.errors.title_prefix" class="mt-2 text-sm text-red-600"/>
                  </div>
                  <div>
                     <label for="first_name" class="mr-2 text-md font-semibold text-black-900">
                        First Name
                     </label>
                     <input v-model="form.first_name" type="text" id="first_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.first_name">
                        {{form.errors.first_name}}
                     </p>
                  </div>  
                  <div>
                     <label for="last_name" class="mr-2 text-md font-semibold text-black-900">
                        Last Name
                     </label>
                     <input v-model="form.last_name" type="text" id="last_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.last_name">
                        {{form.errors.last_name}}
                     </p>
                  </div>  
                  <div>
                     <label for="phone" class="mr-2 text-md font-semibold text-black-900">
                        Phone
                     </label>
                     <input v-model="form.phone" type="text" id="phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.phone">
                        {{form.errors.phone}}
                     </p>
                  </div>
                  <div>
                     <label for="email" class="mr-2 text-md font-semibold text-black-900">
                        Email
                     </label>
                     <input v-model="form.email" type="text" id="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.email">
                        {{form.errors.email}}
                     </p>
                  </div>  
               </div>
            </div>
            <div class="basis-1 grow space-y-4">
               <h2 class="text-xl font-medium text-gray-700">Person Two</h2>
               <div class="min-h-96 px-4 pt-4 pb-80 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
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
               <div class="min-h-96 px-4 pt-4 pb-28 space-y-3 bg-gray-100 rounded-md border-2 border-black-100">
                  <div>
                     <label for="address1" class="mr-2 text-md font-semibold text-black-900">
                        Address
                     </label>
                     <input v-model="form.address1" type="text" id="address1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.address1">
                        {{form.errors.address1}}
                     </p>
                     <input v-model="form.address2" type="text" id="address2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.address2">
                        {{form.errors.address2}}
                     </p>
                     <input v-model="form.address3" type="text" id="address3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.address3">
                        {{form.errors.address3}}
                     </p>
                  </div>
                  <div>
                     <label for="city" class="mr-2 text-md font-semibold text-black-900">
                        City
                     </label>
                     <input v-model="form.city" type="text" id="city" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.city">
                        {{form.errors.city}}
                     </p>
                  </div>
                  <div>
                     <label for="postcode" class="mr-2 text-md font-semibold text-black-900">
                        Postcode
                     </label>
                     <input v-model="form.postcode" type="text" id="postcode" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                     <p class="mt-2 text-sm text-red-600" v-show="form.errors.postcode">
                        {{form.errors.postcode}}
                     </p>
                  </div>
                  <div class="form-group">
                     <label for="county" class="mr-2 text-md font-semibold text-black-900">
                        County
                     </label>
                     <SelectInput
                        id="county"
                        v-model="form.county"
                        :options="counties"
                        option-value="id"
                        option-label="title"
                        :default-option="{id:'',title:''}"
                        :disabled="form.processing"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                     />
                     <InputError :message="form.errors.county" class="mt-2 text-sm text-red-600"/>
                  </div>
               </div>
            </div>
         </div>

         <div class="ml-4 mb-4">
            <PrimaryButton 
               v-if="permissions.customers_edit" 
               type="submit"
               :disabled="form.processing"
               class="inline-block rounded-md bg-yellow-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm"
               :class="{'opacity-25':form.processing}"
            >
               Save
            </PrimaryButton>
         </div>

      </form>
   </Modal>
</template>