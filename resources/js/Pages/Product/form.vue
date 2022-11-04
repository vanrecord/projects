<template>
    <span>
        <span @click="CreateProduct">
            <slot />
        </span>

        <DialogModal :show="IsShowPopUp" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel for="name" value="Name Product"/>
                    <TextInput
                        ref="InputName"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Name product"
                        @keyup.enter="savePopUp"
                        required
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mt-4">
                <InputLabel for="qty" value="Quantity" />
                    <TextInput
                        ref="InputQty"
                        v-model="form.qty"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Qty"
                        @keyup.enter="savePopUp"
                    />
                    <InputError :message="form.errors.qty" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="savePopUp"
                >
                    {{ button }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>
<script setup>
import { ref, reactive, nextTick } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from "@inertiajs/inertia-vue3";

const IsShowPopUp = ref(false);
const InputName = ref(false);
const InputQty  = ref(false);

const props = defineProps({
    product:{
        type:Object,
        default: () => ({}),
    },
    title: {
        type: String,
        default: 'Create Product',
    },
    button: {
        type: String,
        default: 'Save',
    }
});

const form = useForm({
    name:props.product.name?props.product.name:'',
    qty:props.product.qty?props.product.qty:'',
    processing: false,
    error:''
});


const CreateProduct = () => {
    IsShowPopUp.value = true;
};

const savePopUp = () => {
    form.processing = true;

    axios.post(route('product.store'), {
        id:props.product.id?props.product.id:'',
        name: form.name,
        qty: form.qty
    }).then(() => {
        form.processing = false;
        closeModal();
        form.reset();
        Inertia.visit(route('product.index'), {
          only: ['products'],
          preserveState: true,
        });
    }).catch(error => {
        if(typeof(error.response.data.errors.name) !== "undefined"){
            form.errors.name = error.response.data.errors.name[0];
            InputName.value.focus();
        }
        if(typeof(error.response.data.errors.qty) !== "undefined"){
            form.errors.qty = error.response.data.errors.qty[0];
            InputQty.value.focus();
        }
        form.processing = false;
        
    });
};

const closeModal = () => {
    IsShowPopUp.value = false;
    form.reset();
};
</script>
