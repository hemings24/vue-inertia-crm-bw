<script setup>
import {ref} from 'vue'
import {Link,useForm} from '@inertiajs/vue3'
import SelectInput from '@/Components/SelectInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
   status_item:{
      type: Object
   },
   status_types:{
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
      title: '',
      url: '',
      type: '',
      table_ref: '',
      priority: 0,
      page: 'main',
      typeInputValue: '',
      typeSelectValue: ''
   });
   submit=() =>{
      form.post(route('status_items.store'))
   };
}
if(props.action==="update"){
   form = useForm(props.status_item);
   submit=() =>{
      form.patch(route('status_items.update',props.status_item))
   };
}

const showTypeInputField = ref(false);

const showInputField=() =>{
   showTypeInputField.value = true;
   form.typeSelectValue = form.type;
   form.type = form.typeInputValue;
};

const showSelectField=() =>{
   showTypeInputField.value = false;
   form.typeInputValue = form.type;
   form.type = form.typeSelectValue;
};
</script>

<template>
   <div>

      <form @submit.prevent="submit"> 
         <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">
               Title
            </label>
            <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.title"> 
               {{form.errors.title}}
            </p>
         </div>
      </form>

      <div class="mb-4 form-group">
         <InputLabel for="type" value="Type"/>
         <div class="flex flex-row items-end">

            <form @submit.prevent="submit">
               <div v-if="showTypeInputField && props.action==='add'">
                  <input v-model="form.type" type="text" id="type" class="min-w-36 max-w-36 mt-1 block rounded-l-md rounded-r-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
               </div>
               <div v-else>
                  <SelectInput
                     id="type"
                     v-model="form.type"
                     :options="status_types"
                     option-value="type"
                     option-label="type"
                     :default-option="{id:'',title:''}"
                     :disabled="form.processing"
                     class="min-w-36 max-w-36 mt-1 block capitalize rounded-l-md rounded-r-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  />
               </div>
            </form>

            <div v-if="props.action==='add'">
               <div v-if="showTypeInputField">
                  <button type="button" @click="showSelectField()" class="w-24 pt-2.5 pb-3 leading-4 rounded-l-none rounded-r-md border-2 border-transparent bg-blue-500 text-base text-center text-white transition duration-150 ease-in-out hover:text-white focus:outline-none">
                     Close
                  </button>
               </div>
               <div v-else>
                  <button type="button" @click="showInputField()" class="w-24 pt-2.5 pb-3 leading-4 rounded-l-none rounded-r-md border-2 border-transparent bg-blue-500 text-base text-center text-white transition duration-150 ease-in-out hover:text-white focus:outline-none">
                     Add New
                  </button>
               </div>
            </div>

         </div>
         <InputError :message="form.errors.type" class="mt-2 text-sm text-red-600"/>
      </div>

      <form @submit.prevent="submit"> 
         <div class="mb-4">
            <label for="table_ref" class="block text-sm font-medium text-gray-700">
               Table Ref
            </label>
            <input v-model="form.table_ref" type="text" id="table_ref" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.table_ref"> 
               {{form.errors.table_ref}}
            </p>
         </div>
         <div class="mb-4">
            <label for="url" class="block text-sm font-medium text-gray-700">
               URL
            </label>
            <input v-model="form.url" type="text" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p class="mt-2 text-sm text-red-600" v-show="form.errors.url"> 
               {{form.errors.url}}
            </p>
         </div>
      </form>
   </div>

   <div class="py-4 space-x-2">
      <form @submit.prevent="submit"> 
         <button type="submit" :disabled="form.processing" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm disabled:opacity-25">
            Save Status Item
         </button>
         <Link :href="route('status_items.index')" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-xs font-semibold uppercase tracking-widest shadow-sm">
            Cancel
         </Link>
      </form>
   </div>
         
</template>