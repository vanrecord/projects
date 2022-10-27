<template>
	<div>
		<nav>
            <ul>
                <li><Link href='/user'>User</Link></li>
                <li><Link href='/product'>Products</Link></li>
                <li><Link href='/setting'>Setting</Link></li>
            </ul>
        </nav>
	</div>
</template>
<script>
	import { Link } from '@inertiajs/inertia-vue3';
	export default{
		components:{
			Link
		}
	}
</script>