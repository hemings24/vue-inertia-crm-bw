<script setup>
import {Head,Link,router,useForm} from '@inertiajs/vue3'
import NavLink from '@/Components/NavLink.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputField from '@/Components/InputField.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({ 
   customers:{
      //required: true
      type: [Object,Array]
   },
   permissions:{
      type: Object
   },
   searchGlobal: String,
   searchCompany: String,
   searchName: String,
   searchAddress: String,
   searchNotes: String,
   searchStatus: String
});

const form = useForm({
   search_global: props.searchGlobal,
   search_company: props.searchCompany,
   search_name: props.searchName,
   search_address: props.searchAddress,
   search_notes: props.searchNotes,
   search_status: props.searchStatus
});

const search =() =>{
   router.get(route('customers.index'),{
      search_global: form.search_global,
      search_company: form.search_company,
      search_name: form.search_name,
      search_address: form.search_address,
      search_notes: form.search_notes,
      search_status: form.search_status
   });
};

const destroy =(id) =>{
   if(confirm('Are you sure?')){
      router.delete(route('customers.destroy',id))
   }
};
</script>
 
<template>
   <Head title="Customers"/>
   
   <AuthenticatedLayout>
      <div class="flex justify-between items-center mb-4">
         <Link v-if="permissions.customers_manage" :href="route('customers.create')" class="inline-block rounded-md bg-blue-500 px-4 py-3 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
            Add New Customer
         </Link>

         <div class="flex gap-10">
            <form @submit.prevent="search">
               <InputField
                  v-model="form.search_global"
                  type="search"
                  label=""
                  icon="magnifying-glass"
                  placeholder="Search All..."
                  class="w-80"
               />
            </form>
            <NavLink
               :href="route('customers.index')"
               :active="route().current('customers.index')">
               Reset Filters
            </NavLink>
         </div>

      </div>
      <div v-if="Object.keys(customers.data).length">
         <table class="min-w-full divide-y divide-gray-200 border">
            <thead>
               <tr>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <form @submit.prevent="search">
                        <InputField
                           v-model="form.search_company"
                           type="search"
                           label=""
                           icon="magnifying-glass"
                           placeholder="Company"
                        />
                     </form>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <form @submit.prevent="search">
                        <InputField
                           v-model="form.search_name"
                           type="search"
                           label=""
                           icon="magnifying-glass"
                           placeholder="Name"
                        />
                     </form>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <form @submit.prevent="search">
                        <InputField
                           v-model="form.search_address"
                           type="search"
                           label=""
                           icon="magnifying-glass"
                           placeholder="Address"
                        />
                     </form>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left"></th>
                  <th class="px-6 py-3 bg-gray-50 text-left"></th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <form @submit.prevent="search">
                        <InputField
                           v-model="form.search_notes"
                           type="search"
                           label=""
                           icon="magnifying-glass"
                           placeholder="Notes"
                        />
                     </form>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <form @submit.prevent="search">
                        <InputField
                           v-model="form.search_status"
                           type="search"
                           label=""
                           icon="magnifying-glass"
                           placeholder="Status"
                        />
                     </form>
                  </th>
                  <th class="bg-gray-50 px-6 py-3 text-left"></th>
               </tr>
               <tr>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm  leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Company
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Address
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Phone
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Email
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Notes
                     </span>
                  </th>
                  <th class="px-6 py-3 bg-gray-50 text-left">
                     <span class="text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Status
                     </span>
                  </th>
                  <th class="bg-gray-50 px-6 py-3 text-left"></th>
               </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
               <!--tr v-for="customer in customers.data"-->
               <!--tr v-for="customer in customers.data" :key="customer.id"-->
               <tr v-for="(customer,index) in customers.data" :key="index">
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.company}}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.title_prefix}}
                     {{customer.first_name}}
                     {{customer.last_name}}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     <p>{{customer.address1}}</p>
                     <p>{{customer.address2}}</p>
                     <p>{{customer.address3}}</p>
                     <p>{{customer.city}}</p>
                     <p>{{customer.postcode}}</p>
                     <p>{{customer.county.title}}</p>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.phone}}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.email}}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.notes}}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                     {{customer.status_item.title}}
                  </td>
                  <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                     <Link v-if="permissions.customers_manage" :href="route('customers.edit',customer.id)" class="mr-2 inline-block rounded-md bg-blue-500 px-3 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                        <span class="px-2.5">Edit</span>
                     </Link>
                     <button v-if="permissions.customers_manage" @click="destroy(customer.id)" type="button" class="rounded-md bg-red-600 px-3 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm">
                        Delete
                     </button>
                  </td>
               </tr>
            </tbody>
         </table>
         <div class="flex justify-center mt-10">
            <Pagination :links="customers.links"/>
         </div>
      </div>
      <div v-else class="flex justify-center">
         There are no records.
      </div>
   </AuthenticatedLayout>
</template>