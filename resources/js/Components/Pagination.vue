<script setup>
import { Link }  from '@inertiajs/inertia-vue3';

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div v-if="data.links.length > 3" class="flex pl-5 mt-4 space-x-0">
        <Link
            v-for="(link, k) in data.links"
            :key="k"
            class="px-4 py-3 text-sm leading-4 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
            :class="{'bg-indigo-400 text-white': link.active}"
            :href="link.url"
            v-html="link.label"
        />
    </div>
</template>