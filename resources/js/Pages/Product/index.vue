<template>
    <AppLayout title="Home">
        <template #header>
        </template>
        <div class="pt-5 pl-8 pr-5">
            <div class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-32 text-center">
               <FormProduct>
                    <PrimaryButton type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                        Add Product
                    </PrimaryButton>
                </FormProduct>
            </div>
        </div>
        <div class="pt-5 pl-5 pr-5">
            <div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="py-3 pl-2">
                            <div class="relative max-w-xs">
                                <label for="hs-table-search" class="sr-only">
                                    Search
                                </label>
                                <input
                                    type="text"
                                    v-model="search"
                                    class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                    placeholder="Search..."
                                />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none" >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-1.5 w-full inline-block align-middle">
                            <div class="overflow-hidden border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                                Qty
                                            </th>
                                            <th scope="col" class="px-6 w-52 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr v-for="(item,key) in products.data">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                               {{key+1}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                {{item.name}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                {{item.qty}}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                <div class="float-left pr-5">
                                                    <div class="pt-2 px-3 py-2 text-white bg-blue-500 rounded-lg">
                                                        <FormProduct :product="item" :title="title" >
                                                            <PrimaryButton type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                                                                Edit
                                                            </PrimaryButton>
                                                        </FormProduct>
                                                    </div>
                                                </div>
                                                <div class="float-left pr-5">
                                                    <button @click="destroy(item.id)" class="px-3 py-2 text-white bg-red-500 rounded-lg">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :data="products" />
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import FormProduct from '@/Pages/Product/form.vue';
import {Link} from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { ref,watch } from 'vue';
import { Inertia } from '@inertiajs/inertia'
import Pagination from '@/Components/Pagination.vue';
import swal from "sweetalert";
let title = "Update Product";
const form = useForm();
const props = defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
    filter: Object
});
const search = ref(props.filter);

const destroy = (id)=>{
    swal({
        title: "Are you sure?",
        text: "Are you sure that you want to delete this record?",
        icon: "warning",
        dangerMode: true,
        button: {cancel:true,confirm:true}
    }).then(willDelete=> {
        if(willDelete){
            form.delete(route('product.destroy', id));
        }
    })
}
watch(search, value=>{
    Inertia.get('/product',{search, value},{preserveState:true,replace:true}
    );
})
</script>