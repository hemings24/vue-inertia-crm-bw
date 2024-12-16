<script setup>
import {watch} from 'vue'
import {Head,Link,router,useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import InputField from '@/Components/InputField.vue'
import SelectInput from '@/Components/SelectInput.vue'
import Pagination from '@/Components/Pagination.vue'
import ShowContactModal from './Partials/ShowContactModal.vue'

const props = defineProps({
   customers:{
      type: [Object,Array]
   },
   projects:{
      type: [Object,Array]
   },
   searchCustomerStatus: Number,
   customer_statuses:{
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
   searchCompany: String,
   searchName: String,
   searchAddress: String,
   searchNotes: String,
   searchStatusItems: String,
   title_prefixes:{
      type: Array
   },
   counties:{
      type: Array
   }
});

const form = useForm({
   search_customer_status: props.searchCustomerStatus,
   paginate: props.paginate,
   search_global: props.searchGlobal,
   search_company: props.searchCompany,
   search_name: props.searchName,
   search_address: props.searchAddress,
   search_notes: props.searchNotes,
   search_status_items: props.searchStatusItems
});

const search=(customer_status_id) =>{
   router.get(route('customers.index'),{
      search_customer_status: customer_status_id,
      paginate: form.paginate,
      search_global: form.search_global,
      search_company: form.search_company,
      search_name: form.search_name,
      search_address: form.search_address,
      search_notes: form.search_notes,
      search_status_items: form.search_status_items
   });
};

watch(()=>form.paginate,(newValue)=>{
   router.get(route('customers.index'),{
      search_customer_status: form.search_customer_status,
      paginate: form.paginate,
      search_global: form.search_global,
      search_company: form.search_company,
      search_name: form.search_name,
      search_address: form.search_address,
      search_notes: form.search_notes,
      search_status_items: form.search_status_items
   });
});

const destroy=(id) =>{
   if(confirm('Are you sure?')){
      router.delete(route('customers.destroy',id));
   }
};
</script>
 
<template>
   <Head title="Customers"/>

   <AuthenticatedLayout>

      <div class="flex flex-col space-y-4 mb-10">
         <h1 class="text-3xl text-gray-700">Customers</h1>
         <div>
            <span v-for="customer_status in customer_statuses" :key="customer_status.id">
               <SecondaryButton v-if="permissions.customers_view" type="button"
                  id="search_customer_status"
                  @click="search(customer_status.id)"
                  :disabled="form.processing"
                  :class="((customer_status.id==form.search_customer_status) || (customer_status.id==0 && form.search_customer_status==null)) && 'active-statusitem'"
                  class="text-gray-500 hover:!bg-gray-200 hover:text-gray-700 focus:!bg-blue-500 focus:text-white focus:!ring-0 focus:ring-blue-500 focus:ring-offset-0 rounded-none border-none"
               >
                  <span class="text-sm font-medium capitalize">
                     {{customer_status.title}}
                  </span>
               </SecondaryButton>
            </span>
            <hr>
         </div>
      </div>

      <div class="mb-4">
         <Link v-if="permissions.customers_admin" :href="route('customers.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
            Add New Customer
         </Link>
      </div>

      <div v-if="Object.keys(customers.data).length">
         <div class="max-h-[59vh] overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border">
               <thead class="sticky top-0">
                  <tr>
                     <th class="px-6 py-3 bg-gray-50 text-left"></th>
                     <th class="px-6 py-3 bg-gray-50 text-left">
                        <form @submit.prevent="search(form.search_customer_status)">
                           <InputField
                              v-model="form.search_company"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Company"
                           />
                        </form>
                     </th>
                     <th class="px-6 py-3 bg-gray-50 text-left"></th>
                     <th class="max-w-sm px-6 py-3 bg-gray-50 text-left">
                        <form @submit.prevent="search(form.search_customer_status)">
                           <InputField
                              v-model="form.search_notes"
                              type="search"
                              label=""
                              icon="magnifying-glass"
                              placeholder="Notes"
                           />
                        </form>
                     </th>
                     <th class="px-6 py-3 bg-gray-50 text-left"></th>
                     <th class="px-6 pt-3 bg-gray-50 text-left text-nowrap">
                        <form @submit.prevent="search(form.search_customer_status)">
                           <button type="submit" :disabled="form.processing" class="inline-block rounded-md border border-gray-300 px-4 py-3 text-sm font-semibold uppercase tracking-widest disabled:opacity-25">
                              Search
                           </button>
                           <NavLink
                              :href="route('customers.index')"
                              :active="route().current('customers.index')"
                              class="ml-5 text-md"
                           >
                              Reset
                           </NavLink>
                        </form>
                     </th>
                  </tr>
                  <tr>
                     <th class="px-6 py-3 bg-gray-50 text-left"></th>
                     <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                           Company
                        </span>
                     </th>
                     <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                           Contact Details
                        </span>
                     </th>
                     <th class="max-w-sm px-6 py-3 bg-gray-50 text-left">
                        <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                           Notes
                        </span>
                     </th>
                     <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                           Status
                        </span>
                     </th>
                     <th class="px-6 py-3 bg-gray-50 text-left text-nowrap">
                        <div class="text-md leading-4 font-medium text-gray-500 tracking-wider">
                           <form @submit.prevent="search(form.search_customer_status)">
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
                           </form>
                        </div>
                     </th>
                  </tr>
               </thead>
               <tbody v-for="(customer,index) in customers.data" :key="index" class="bg-white divide-y divide-gray-200 divide-solid">
                  <!--tr v-for="customer in customers.data" :key="customer.id"-->
                  <tr class="transition duration-300 ease-in-out hover:bg-gray-100">
                     <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <button @click="customer.isHidden = !customer.isHidden">
                           <span v-if="customer.isHidden">[+]</span>
                           <span v-else>[x]</span>
                        </button>
                     </td>
                     <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{customer.company}}
                     </td>
                     <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <ShowContactModal
                           :customer="customer"
                           :permissions="permissions"
                           :title_prefixes="title_prefixes"
                           :counties="counties"
                        />  
                     </td>
                     <td class="max-w-sm px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{customer.notes}}
                     </td>
                     <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{customer.status_item.title}}
                     </td>
                     <td class="px-6 py-4 text-sm leading-5 text-gray-900 text-nowrap">
                        <Link v-if="permissions.customers_view" :href="route('customers.show',customer.id)" class="mr-1 inline-block rounded-md bg-green-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                           <span class="px-2">View</span>
                        </Link>
                        <Link v-if="permissions.customers_edit" :href="route('customers.edit',customer.id)" class="mr-1 inline-block rounded-md bg-blue-500 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                           <span class="px-2.5">Edit</span>
                        </Link>
                        <button v-if="permissions.customers_admin" @click="destroy(customer.id)" type="button" class="rounded-md bg-red-600 px-2 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                           Delete
                        </button>
                     </td>
                  </tr>
                  <tr v-if="!customer.isHidden">
                     <td colspan="6" class="px-6 py-4 whitespace-no-wrap leading-5">
                        <div class="flex mx-0 my-4 space-x-10">
                           <div class="basis-1 grow space-y-4">
                              <div class="px-0 pt-0 space-y-4 bg-white-100 rounded-md border-0 border-black-100">
                                 <div class="pb-6">
                                    <div class="pb-4">
                                       <p class="mb-8">
                                          <span class="mr-2 text-md font-semibold text-black-900">Company:</span>
                                          <span class="text-md text-gray-700">{{customer.company}}</span>
                                       </p>
                                       <p class="pb-2">
                                          <span class="mr-2 text-md font-semibold text-black-900">Address:</span>
                                          <span class="mr-1 text-md text-gray-700">{{customer.address1}},</span>
                                          <span class="text-md text-gray-700">{{customer.address2}}</span>
                                          <span class="text-md text-gray-700">{{customer.address3}}</span>
                                          <span class="mr-1 text-md text-gray-700">{{customer.city}}</span>
                                          <span class="mr-1 text-md text-gray-700">{{customer.postcode}},</span>
                                          <span class="text-md text-gray-700">{{customer.county.title}}</span>
                                       </p>
                                       <p>
                                          <span class="mr-2 text-md font-semibold text-black-900">Contact:</span>
                                          <span class="mr-1 text-md text-gray-700">{{customer.title_prefix}}</span>
                                          <span class="mr-1 text-md text-gray-700">{{customer.first_name}}</span>
                                          <span class="text-md text-gray-700">{{customer.last_name}}</span>
                                       </p>
                                       <p>
                                          <span class="text-md text-gray-700">{{customer.email}}</span>
                                       </p>
                                       <p>
                                          <span class="text-md text-gray-700">{{customer.phone}}</span>
                                       </p>
                                    </div>
                                    <div>
                                       <ShowContactModal
                                          :customer="customer"
                                          :permissions="permissions"
                                          :title_prefixes="title_prefixes"
                                          :counties="counties"
                                       />  
                                    </div>
                                 </div>

                                 <div>
                                    <p class="mb-1 text-xl font-medium text-gray-700">Projects</p>
                                    <div class="pb-4">
                                       <div v-if="Object.keys(projects).length">
                                          <div v-for="(project,index) in projects" :key="index">
                                             <span v-if="project.customer===customer.id">
                                                <span class="mr-2 text-md font-semibold text-black-900">Name:</span>
                                                <span class="mr-4 text-md text-gray-700">{{project.name}}</span>
                                                <span class="mr-2 text-md font-semibold text-black-900">Date:</span>
                                                <span class="text-md text-gray-700">{{project.date}}</span>
                                             </span>
                                          </div>
                                       </div>
                                       <div v-else>
                                          <p>Customer has no projects</p>
                                       </div>
                                    </div>
                                    <Link v-if="permissions.projects_admin" :href="route('projects.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                                       Add New Project
                                    </Link>
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="basis-1 grow space-y-4">
                              <div class="px-0 pb-32 space-y-8 bg-white-100 rounded-md border-2 border-black-100">
                                 <p class="mb-1 text-xl font-medium text-gray-700">Latest Diary</p>
                              </div>
                              <div class="px-0 pb-32 space-y-8 bg-white-100 rounded-md border-2 border-black-100">
                                 <p class="mb-1 text-xl font-medium text-gray-700">Latest Comms</p>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="flex justify-center mt-4 -mb-12">
            <Pagination :links="customers.links"/>
         </div>
      </div>
      
      <div v-else class="flex flex-col gap-y-5 justify-center text-center">
         <p>There are no records</p>
         <div>
            <NavLink
               :href="route('customers.index')"
               :active="route().current('customers.index')">
               Reset Filters
            </NavLink>
         </div>
      </div>
   
   </AuthenticatedLayout>
</template>