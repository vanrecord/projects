<template>
	<AppLayout title="Dashboard">
        <template #header>
        </template>
	    <div class="py-12">
	        <div class="font-bold text-center">
	        	Create Shop
	        </div>
	         <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
						<form  @submit.prevent="submit">    
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
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
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
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.phone_number"
                                    class="text-sm text-red-600"
                                >
                                	{{ form.errors.phone_number }}
                                </div>
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
                                    placeholder=""
                                />
                                <div
                                    v-if="form.errors.address"
                                    class="text-sm text-red-600"
                                >
                                {{ form.errors.address }}
                                </div>
                            </div>
                            <div class="mb-6">
                            	<label for="Title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" >UnActive</label>
                                <input type="checkbox" v-model="form.unactive" name="unactive" :value="true">
                            </div>
                            <button
                                type="submit"
                                class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                            >
                                Submit
                            </button>
				    	</form>
				    </div>
				</div>
		    </div>
		</div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from '@inertiajs/inertia-vue3';
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    shop: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    id: props.shop.id?props.shop.id:'',
    name: props.shop.name?props.shop.name:'',
    address: props.shop.address?props.shop.address:'',
    phone_number: props.shop.phone_number?props.shop.phone_number:'',
    unactive: props.shop.unactive?true:false
});
const submit = () => {
	form.post(route("shop.store"));
};
</script>