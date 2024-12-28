<script setup>
import {watch} from 'vue'
import {Head,Link,router,useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import InputField from '@/Components/InputField.vue'
import SelectInput from '@/Components/SelectInput.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({ 
   status_items:{
      type: [Object,Array]
   },
   searchType: String,
   status_types:{
      type: Array
   },
   permissions:{
      type: Object
   },
   paginate_perpage: Number,
   paginate_options:{
      type: Array
   },
   searchTitle: String,
   searchPriority: Number
});

const form = useForm({
   search_type: props.searchType,
   paginate_perpage: props.paginate_perpage,
   search_title: props.searchTitle,
   search_priority: props.searchPriority
});

const search=(type_name) =>{
   router.get(route('status_items.index'),{
      search_type: type_name,
      paginate_perpage: form.paginate_perpage,
      search_title: form.search_title,
      search_priority: form.search_priority
   });
};

watch(()=>form.paginate_perpage,(newValue)=>{
   router.get(route('status_items.index'),{
      search_type: form.search_type,
      paginate_perpage: form.paginate_perpage,
      search_title: form.search_title,
      search_priority: form.search_priority
   });
});

const destroy=(id) =>{
   if(confirm('WARNING ! \nClicking OK will delete this Status Item and all associated Customers, Projects, and/or other records ! \n\nAre you sure ?')){
      router.delete(route('status_items.destroy',id));
   }
};
</script>

<template>
   <Head title="Status Items"/>

   <AuthenticatedLayout>

      <div class="flex flex-col space-y-4 mb-10">
         <h1 class="text-3xl text-gray-700">Status</h1>
         <div class="flex flex-row">
            <div v-for="status_type in status_types" :key="status_type.type">
               <SecondaryButton v-if="permissions.status_items_view" type="button"
                  id="search_type"
                  @click="search(status_type.type)"
                  :disabled="form.processing"
                  :class="((status_type.type==form.search_type) || (status_type.type=='all' && form.search_type==null)) && 'active-statusitem'"
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

      <div class="mb-4">
         <Link v-if="permissions.status_items_admin" :href="route('status_items.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
            Add New Status Item
         </Link>
      </div>

      <div v-if="Object.keys(status_items.data).length">
         <form @submit.prevent="search(form.search_type)">
            <div class="max-h-[59vh] overflow-x-auto">
               <table class="min-w-full divide-y divide-gray-200 border">
                  <thead class="sticky top-0">
                     <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left"></th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_title"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Title"
                           />
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_priority"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Priority"
                           />
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left"></th>
                        <th class="px-6 py-3 bg-gray-50 text-left"></th>
                        <th class="px-6 pt-3 bg-gray-50 text-left text-nowrap">
                           <button type="submit" :disabled="form.processing" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-sm font-semibold uppercase tracking-widest disabled:opacity-25">
                              Search
                           </button>
                           <NavLink
                              :href="route('status_items.index')"
                              :active="route().current('status_items.index')"
                              class="ml-5 text-md"
                           >
                              Reset
                           </NavLink>
                        </th>
                     </tr>
                     <tr>
                        <th class="px-6 pr-24 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Type
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Title
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Priority
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Table Ref
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              URL
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-nowrap">
                           <div class="text-md leading-4 font-medium text-gray-500 tracking-wider">
                              Show
                              <SelectInput
                                 id="paginate_perpage"
                                 v-model="form.paginate_perpage"
                                 :options="paginate_options"
                                 option-value="id"
                                 option-label="title"
                                 :default-option="{id:'',title:''}"
                                 :disabled="form.processing"
                                 class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              />
                              entries
                           </div>
                        </th>
                     </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                     <tr v-for="(status_item,index) in status_items.data" :key="index" class="transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-6 pr-24 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 capitalize">
                           {{status_item.type}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 capitalize">
                           {{status_item.title}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{status_item.priority}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{status_item.table_ref}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{status_item.url}}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 text-nowrap">
                           <Link v-if="permissions.status_items_view" :href="route('status_items.show',status_item.id)" class="mr-1 inline-block rounded-md bg-green-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              <span class="px-2">View</span>
                           </Link>
                           <Link v-if="permissions.status_items_edit" :href="route('status_items.edit',status_item.id)" class="mr-1 inline-block rounded-md bg-blue-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              <span class="px-2.5">Edit</span>
                           </Link>
                           <button v-if="permissions.status_items_admin" @click="destroy(status_item.id)" type="button" class="rounded-md bg-red-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              Delete
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </form>

         <div class="flex justify-center mt-4 -mb-12">
            <Pagination :links="status_items.links"/>
         </div>
      </div>
      
      <div v-else class="flex flex-col gap-y-5 justify-center text-center">
         <p>There are no records</p>
         <div>
            <NavLink
               :href="route('status_items.index')"
               :active="route().current('status_items.index')">
               Reset Filters
            </NavLink>
         </div>
      </div>
   
   </AuthenticatedLayout>
</template>