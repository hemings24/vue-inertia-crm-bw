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
   projects:{
      type: [Object,Array]
   },
   searchProjectStatus: Number,
   project_statuses:{
      type: Array
   },
   permissions:{
      type: Object
   },
   paginate: Number,
   paginate_options:{
      type: Array
   },
   searchGlobal: String,
   searchName: String,
   searchDate: String,
   searchStatusItems: String,
   searchCustomer: String,
   customers:{
      type: Array
   }
});

const form = useForm({
   search_project_status: props.searchProjectStatus,
   paginate: props.paginate,
   search_global: props.searchGlobal,
   search_name: props.searchName,
   search_date: props.searchDate,
   search_status_items: props.searchStatusItems,
   search_customer: props.searchCustomer
});

const search=(project_status_id) =>{
   router.get(route('projects.index'),{
      search_project_status: project_status_id,
      paginate: form.paginate,
      search_global: form.search_global,
      search_name: form.search_name,
      search_date: form.search_date,
      search_status_items: form.search_status_items,
      search_customer: form.search_customer
   });
};

watch(()=>form.paginate,(newValue)=>{
   router.get(route('projects.index'),{
      search_project_status: form.search_project_status,
      paginate: form.paginate,
      search_global: form.search_global,
      search_name: form.search_name,
      search_date: form.search_date,
      search_status_items: form.search_status_items,
      search_customer: form.search_customer
   });
});

const destroy=(id) =>{
   if(confirm('Are you sure?')){
      router.delete(route('projects.destroy',id));
   }
};
</script>
 
<template>
   <Head title="Projects"/>

   <AuthenticatedLayout>

      <div class="flex flex-col space-y-4 mb-10">
         <h1 class="text-3xl text-gray-700">Projects</h1>
         <div>
            <span v-for="project_status in project_statuses" :key="project_status.id">
               <SecondaryButton v-if="permissions.projects_view" type="button"
                  id="search_project_status"
                  @click="search(project_status.id)"
                  :disabled="form.processing"
                  :class="((project_status.id==form.search_project_status) || (project_status.id==0 && form.search_project_status==null)) && 'active-statusitem'"
                  class="text-gray-500 hover:!bg-gray-200 hover:text-gray-700 focus:!bg-blue-500 focus:text-white focus:!ring-0 focus:ring-blue-500 focus:ring-offset-0 rounded-none border-none"
               >
                  <span class="text-sm font-medium capitalize">
                     {{project_status.title}}
                  </span>   
               </SecondaryButton>
            </span>
            <hr>
         </div>
      </div>

      <div class="mb-4">
         <Link v-if="permissions.projects_admin" :href="route('projects.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
            Add New Project
         </Link>
      </div>

      <div v-if="Object.keys(projects.data).length">
         <form @submit.prevent="search(form.search_project_status)">
            <div class="max-h-[59vh] overflow-x-auto">
               <table class="min-w-full divide-y divide-gray-200 border">
                  <thead class="sticky top-0">
                     <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_name"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Name"
                           />
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_date"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Date"
                           />
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left"></th>
                        <th class="px-6 py-3 bg-gray-50 text-left"></th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_status"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Status"
                           />
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <InputField
                              v-model="form.search_customer"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Customer"
                           />
                        </th>
                        <th class="px-6 pt-3 bg-gray-50 text-left text-nowrap">
                           <button type="submit" :disabled="form.processing" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-sm font-semibold uppercase tracking-widest disabled:opacity-25">
                              Search
                           </button>
                           <NavLink
                              :href="route('projects.index')"
                              :active="route().current('projects.index')"
                              class="ml-5 text-md"
                           >
                              Reset
                           </NavLink>
                        </th>
                     </tr>
                     <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Name
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Date
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Price
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Reference
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Status
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                           <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                              Customer
                           </span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-nowrap">
                           <div class="text-md leading-4 font-medium text-gray-500 tracking-wider">
                              Show
                              <SelectInput
                                 id="paginate"
                                 v-model="form.paginate"
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
                     <tr v-for="(project,index) in projects.data" :key="index" class="transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{project.name}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{project.date}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           &pound;{{project.price}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{project.project_reference}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           {{project.status_item.title}}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                           <p>{{project.customer.company}}</p>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 text-nowrap">
                           <Link v-if="permissions.projects_view" :href="route('projects.show',project.id)" class="mr-1 inline-block rounded-md bg-green-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              <span class="px-2">View</span>
                           </Link>
                           <Link v-if="permissions.projects_edit" :href="route('projects.edit',project.id)" class="mr-1 inline-block rounded-md bg-blue-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              <span class="px-2.5">Edit</span>
                           </Link>
                           <button v-if="permissions.projects_admin" @click="destroy(project.id)" type="button" class="rounded-md bg-red-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                              Delete
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </form>

         <div class="flex justify-center mt-4 -mb-12">
            <Pagination :links="projects.links"/>
         </div>
      </div>
      
      <div v-else class="flex flex-col gap-y-5 justify-center text-center">
         <p>There are no records</p>
         <div>
            <NavLink
               :href="route('projects.index')"
               :active="route().current('projects.index')">
               Reset Filters
            </NavLink>
         </div>
      </div>
   
   </AuthenticatedLayout>
</template>