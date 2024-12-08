<script setup>
import {Link,useForm} from '@inertiajs/vue3'
import SelectInput from '@/Components/SelectInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
   project:{
      type: Object
   },
   status_items:{
      type: Array
   },
   customers:{
      type: Array
   },
   action:{
      type: String
   }
});

let form = null;
let submit=() =>{null};

if(props.action==="add"){
   form = useForm({
      name: '',
      date: '',
      price: '',
      project_reference: '',
      project_status: '',
      customer: ''
   });
   submit=() =>{
      form.post(route('projects.store'))
   };
}
if(props.action==="update"){
   form = useForm(props.project);
   submit=() =>{
      form.patch(route('projects.update',props.project))
   };
}
</script>

<template>
   <form @submit.prevent="submit"> 
      <div>

         <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">
               Name
            </label>
            <input v-model="form.name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.name"> 
               {{form.errors.name}}
            </p>
         </div>

         <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">
               Date
            </label>
            <input v-model="form.date" type="text" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.date"> 
               {{form.errors.date}}
            </p>
         </div>

         <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">
               Price &pound;
            </label>
            <input v-model="form.price" type="text" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.price"> 
               {{form.errors.price}}
            </p>
         </div>

         <div class="mb-4">
            <label for="project_reference" class="block text-sm font-medium text-gray-700">
               Reference
            </label>
            <input v-model="form.project_reference" type="text" id="project_reference" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.project_reference"> 
               {{form.errors.project_reference}}
            </p>
         </div>

         <div class="mb-4 form-group">
            <InputLabel for="project_status" value="Status"/>
            <SelectInput
               id="project_status"
               v-model="form.project_status"
               :options="status_items"
               option-value="id"
               option-label="title"
               :default-option="{id:'',title:''}"
               :disabled="form.processing"
               class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            <InputError :message="form.errors.project_status" class="mt-2 text-sm text-red-600"/>
         </div>

         <div class="mb-4 form-group">
            <InputLabel for="customer" value="Customer"/>
            <SelectInput
               id="customer"
               v-model="form.customer"
               :options="customers"
               option-value="id"
               option-label="company"
               :default-option="{id:'',company:''}"
               :disabled="form.processing"
               class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            <InputError :message="form.errors.customer" class="mt-2 text-sm text-red-600"/>
         </div>

      </div>

      <div class="py-4 space-x-2">
         <button type="submit" :disabled="form.processing" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm disabled:opacity-25">
            Save Project
         </button>
         <Link :href="route('projects.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Cancel
         </Link>
      </div>
         
   </form> 
</template>