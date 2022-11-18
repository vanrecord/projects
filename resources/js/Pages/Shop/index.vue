<template>
	<AppLayout title="Home">
        <template #header>
        </template>
        <div class="pt-5 pl-8 pr-5">
	    	<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
			  <Link :href="route('shop.create')">Add Shop</Link>
			</button>
        </div>
        <div class="pt-5 pl-5 pr-5">
            <div>
                <div class="flex flex-col">
                    <div class="">
                        <Table :meta="shops" :sort-by="sortBy" :header="header">
                            <template #head>
                                <tr>
                                   <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        UnActive
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        Action
                                    </th>
                                </tr>
                              </template>

                              <template #body>
                                <tr v-for="(shop,key) in shops.data" :key="key">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                       {{key+1}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{shop.name}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{shop.address}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{shop.phone_number}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{shop.unactive?"Yes":"No"}}
                                    </td>
                                    <td class="text-sm text-gray-800 whitespace-nowrap">
                                        <div class="float-left">
                                            <button @click="showDetail(shop)" class="px-3 py-0 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="float-left ">
                                            <Link :href="route('shop.edit',shop.id)" class=" rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </Link>
                                        </div>
                                        <div class="float-left">
                                            <button @click="destroy(shop.id)" class="px-3 py-0  rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
        <DialogModal :show="open" @close="closeModal">
             <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mb-6">
                    <label
                        for="Name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Name</label>
                    <input
                        type="text"
                        v-model="form.name"
                        name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        disabled="disabled"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="Phone Number"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Phone Number</label>
                    <input
                        type="text"
                        v-model="form.phone_number"
                        name="phone_number"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        disabled
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="Address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Address</label>
                    <input
                        type="text"
                        v-model="form.address"
                        name="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        disabled
                    />
                </div>
                <div class="mb-6">
                    <label for="Title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" >UnActive</label>
                    <input type="checkbox" v-model="form.unactive" name="unactive" :value="true" disabled>
                </div>
            </template>
            <template #footer>
                <SecondaryButton @click="closeModal">
                   Cancel
                </SecondaryButton>
            </template>
        </DialogModal>

    </AppLayout>
</template>
<script setup>
import TableList from '@/Pages/TableList.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref,watch } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '@/Components/Pagination.vue';
import DialogModal from '@/Components/DialogModal.vue';
import swal from 'sweetalert';
import {Table} from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { setTranslations } from "@protonemedia/inertiajs-tables-laravel-query-builder";

setTranslations({
  next: "Next",
  no_results_found: "No results found",
  of: "of",
  per_page: "per page",
  previous: "Previous",
  results: "results",
  to: "to"
});

const props= defineProps({
	shops:{
		type:Object,
		default: ()=>({})
	},
    filter:Object,
    item:Object,
    index:String
})

let title = 'Detail';
// const count = ref(0)
const open = ref(false);
const search = ref(props.filter);
const form = useForm();
const destroy = (id)=> {
    swal({
      title: "Are you sure?",
      text: "Are you sure that you want to delete this record?",
      icon: "warning",
      dangerMode: true,
      buttons: {cancel:true, confirm:true}
    })
    .then(willDelete => {
      if (willDelete) {
        form.delete(route('shop.destroy', id));
        // swal("Deleted!", "Your imaginary file has been deleted!", "success");
      }
    });
}
const showDetail = (item) =>{
    form.name = item.name;
    form.address = item.address;
    form.phone_number = item.phone_number;
    form.unactive = item.unactive;
    open.value = true;
}
watch(search , value=>{
    Inertia.get('/shop',{search,value},{preserveState:true,replace:true});
})
const closeModal = ()=>{
    open.value = false;
}


</script>