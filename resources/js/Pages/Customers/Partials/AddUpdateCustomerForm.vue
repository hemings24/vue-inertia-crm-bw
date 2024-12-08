<script setup>
import {Link,useForm} from '@inertiajs/vue3'
import SelectInput from '@/Components/SelectInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({ 
   customer:{
      type: Object
      //required: true
   },
   title_prefixes:{
      type: Array
   },
   counties:{
      type: Array
   },
   status_items:{
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
      company: '',
      title_prefix: '',
      first_name: '',
      last_name: '',
      address1: '',
      address2: '',
      address3: '',
      city: '',
      postcode: '',
      county: '',
      email: '',
      phone: '',
      notes: '',
      customer_status: ''
   });
   submit=() =>{
      form.post(route('customers.store'))
   };
}
if(props.action==="update"){
   form = useForm(props.customer);
   submit=() =>{
      form.patch(route('customers.update',props.customer))
   };
}
</script>

<template>
   <form @submit.prevent="submit"> 

      <div>

         <div class="mb-4">
            <label for="company" class="block text-sm font-medium text-gray-700">
               Company
            </label>
            <input v-model="form.company" type="text" id="company" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.company"> 
               {{form.errors.company}}
            </p>
         </div>

         <div class="mb-4 form-group">
            <InputLabel for="title_prefix" value="Title"/>
            <SelectInput
               id="title_prefix"
               v-model="form.title_prefix"
               :options="title_prefixes"
               option-value="id"
               option-label="title"
               :default-option="{id:'',title:''}"
               :disabled="form.processing"
               class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            <InputError :message="form.errors.title_prefix" class="mt-2 text-sm text-red-600"/>
         </div>

         <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
               First Name
            </label>
            <input v-model="form.first_name" type="text" id="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.first_name"> 
               {{form.errors.first_name}}
            </p>
         </div>

         <div class="mb-4">
            <label for="last_name" class="block text-sm font-medium text-gray-700">
               Last Name
            </label>
            <input v-model="form.last_name" type="text" id="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.last_name"> 
               {{form.errors.last_name}}
            </p>
         </div>

         <div class="mb-4">
            <label for="address1" class="block text-sm font-medium text-gray-700">
               Address 1
            </label>
            <input v-model="form.address1" type="text" id="address1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.address1"> 
               {{form.errors.address1}}
            </p>
         </div>

         <div class="mb-4">
            <label for="address2" class="block text-sm font-medium text-gray-700">
               Address 2
            </label>
            <input v-model="form.address2" type="text" id="address2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.address2"> 
               {{form.errors.address2}}
            </p>
         </div>

         <div class="mb-4">
            <label for="address3" class="block text-sm font-medium text-gray-700">
               Address 3
            </label>
            <input v-model="form.address3" type="text" id="address3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.address3"> 
               {{form.errors.address3}}
            </p>
         </div>

         <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">
               City
            </label>
            <input v-model="form.city" type="text" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.city"> 
               {{form.errors.city}}
            </p>
         </div>

         <div class="mb-4">
            <label for="postcode" class="block text-sm font-medium text-gray-700">
               Postcode
            </label>
            <input v-model="form.postcode" type="text" id="postcode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.postcode"> 
               {{form.errors.postcode}}
            </p>
         </div>

         <div class="mb-4 form-group">
            <InputLabel for="county" value="County"/>
            <SelectInput
               id="county"
               v-model="form.county"
               :options="counties"
               option-value="id"
               option-label="title"
               :default-option="{id:'',title:''}"
               :disabled="form.processing"
               class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            <InputError :message="form.errors.county" class="mt-2 text-sm text-red-600"/>
         </div>

         <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">
               Phone
            </label>
            <input v-model="form.phone" type="text" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.phone"> 
               {{form.errors.phone}}
            </p>
         </div>

         <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">
               Email
            </label>
            <input v-model="form.email" type="text" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.email"> 
               {{form.errors.email}}
            </p>
         </div>

         <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">
               Notes
            </label>
            <textarea v-model="form.notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.notes"> 
               {{form.errors.notes}}
            </p>
         </div>

         <div class="mb-4 form-group">
            <InputLabel for="customer_status" value="Status"/>
            <SelectInput
               id="customer_status"
               v-model="form.customer_status"
               :options="status_items"
               option-value="id"
               option-label="title"
               :default-option="{id:'',title:''}"
               :disabled="form.processing"
               class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            <InputError :message="form.errors.customer_status" class="mt-2 text-sm text-red-600"/>
         </div>

      </div>

      <div class="py-4 space-x-2">
         <button type="submit" :disabled="form.processing" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm disabled:opacity-25">
            Save Customer
         </button>
         <Link :href="route('customers.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Cancel
         </Link>
      </div>

   </form>
</template>