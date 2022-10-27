<script>
import Nav from '@/Components/Share/Nav.vue';
export default{
    components:{
        Nav
    },
    props:{
        framworks:Array
    },
    data() {
        return {
            items:[
                {name:'Alfonso Bribiesca', email:'alfonso@vexilo.com', age:'31', sale:'$9,999.00'},
                {name:'Alfonso Bribiesca', email:'alfonso@vexilo.com', age:'31', sale:'$9,999.00'},
                {name:'Alfonso Bribiesca', email:'alfonso@vexilo.com', age:'31', sale:'$9,999.00'}
            ],
            pro_items:[
                {name:'Alfonso Bribiesca', qty:'10',sale:'$9,999.00',created_at:'12/02/2021'},
                {name:'Alfonso Bribiesca', qty:'10',sale:'$9,999.00',created_at:'12/02/2021'},
                {name:'Alfonso Bribiesca', qty:'10',sale:'$9,999.00',created_at:'12/02/2021'}
            ]
        }
    },
    computed: {
      rows() {
        return this.items.length
      }
    }
}
</script>

<template>
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
                            name="search"
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
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                                        Age
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase" >
                                        Sales
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="(item,key) in items">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                       {{key+1}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{item.name}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{item.email}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                        {{item.sale}}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a class="text-green-500 hover:text-green-700" href="#" >
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a class="text-red-500 hover:text-red-700" href="#" >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
  .btn {
    @apply font-bold py-2 px-4 rounded;
  }
  .btn-gray {
    @apply bg-gray-500 text-white;
  }
  .btn-blue:hover {
    @apply bg-blue-700;
  }
</style>
