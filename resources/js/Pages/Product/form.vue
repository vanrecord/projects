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
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="mt-1 block w-full"
                        placeholder="Name product"
                        @keyup.enter="savePopUp"
                    />
                    <InputError :message="form.error" class="mt-2" />
                </div>
                <div class="mt-4">
                {{props.product}}
                <InputLabel for="qty" value="Quantity" />
                    <TextInput
                        v-model="form.qty"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Qty"
                        name="qty"
                        @keyup.enter="savePopUp"
                    />
                    <InputError :message="form.error" class="mt-2" />
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

const IsShowPopUp = ref(false);

const form = reactive({
    name:props.product.name?props.product.name:'',
    qty:props.product.qty?props.product.qty:'',
    error: '',
    processing: false,
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
        Inertia.visit(route('product.index'), {
          only: ['products'],
          preserveState: true,
        });

    }).catch(error => {
        form.processing = false;
    });
};

const closeModal = () => {
    IsShowPopUp.value = false;
};
</script>
