<template>
	<div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex">
		<!-- <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink> -->
		<NavLink :href="route('shop.index')" :active="route().current('shop.index')">
            Shop
        </NavLink>
        <NavLink :href="route('product.index')" :active="route().current('product.index')">
            Product
        </NavLink>
        <NavLink :href="route('setting')" :active="route().current('setting')">
            Setting
        </NavLink>
	</div>
</template>
<script>
import NavLink from '@/Components/NavLink.vue';
export default{
	components:{
		NavLink
	}
}
</script>