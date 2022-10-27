<div>
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="p-12 border-b border-gray-200 shadow">
                    <table class="divide-y divide-gray-300" id="dataTable">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    ID
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Product Name
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Qty
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Sale
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Created_at
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Edit
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-500">
                            <tr class="whitespace-nowrap" v-for="(pro,key) in pro_items">
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    1
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{pro.name}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{pro.qty}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{pro.sale}}
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{pro.created_at}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#"
                                        class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Edit</a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#"
                                        class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>