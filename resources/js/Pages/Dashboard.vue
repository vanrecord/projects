<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableList from '../Pages/TableList.vue';
export default{
    components:{
        AppLayout,
        TableList
    }
}
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
        </template>
        <TableList/>
    </AppLayout>
</template>
