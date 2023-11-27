<script setup>
import Header from "@/Components/Header.vue"
import Pagination from "@/Components/Pagination.vue"
import {ref, watch} from "vue"
import {router} from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import LinkButton from "@/Components/LinkButton.vue"

let props = defineProps({
    users: Object, // we need an object here because we get a Pagination object (@see Controller, ->paginate() and iterate over users.data)
    title: String,
    filters: Object, // to determine type here, check Vue dev tools and look for returned props
    can: Object // used to fetch authorizations
})

let search = ref(props.filters.search) // access the v-model="search", init with value received from server
// Usage: watch(<element to watch>, <callback function>)
watch(search,
    // Use debounce to send the request x milliseconds after typing
    debounce(value => {
        // Equivalent to click on a link (clears field) -> set preserveState
        router.get('/users', { search: value }, {
            preserveState: true, // keep typed value in input field, otherwise focus is lost and the value is cleared after making the request
            replace: true // do not create history records on every request sent
        })
    }, 300)
)

</script>

<template>
    <!-- Use Inertias head component to overwrite the default in Layouts/AppLayout.vue -->
    <Head :title="title" />
    <Header>{{ $t('Users') }}</Header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end mb-2">
                <LinkButton v-if="can.createUser" :href="route('users.create')" class="mr-4 md:ml-0">{{ $t('New User') }}</LinkButton>
                <input v-model="search" type="text" :placeholder="$t('Search')" class="border px-2 rounded-lg "/>
            </div>

            <div class="bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-gray-200 dark:border-gray-700 sm:rounded-t-lg">
                <div class="shadow overflow-hidden border-gray-200 sm:rounded-t-lg">
                    <table class="min-w-full divide-y dividy-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t('Name') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t('Status') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $t('Last Login') }}</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">{{ $t('Edit') }}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dividy-gray-200">
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ user.firstname }} {{ user.lastname }}</div>
                                        <div class="text-sm text-gray-500">{{ user.email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                      :class="{
                                        'bg-green-100 text-green-800': user.active,
                                        'bg-red-100 text-red-800' : !user.active
                                        }">
                                    {{ user.active ? $t('Active') : $t('Inactive') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Admin
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link v-if="user.can.edit" :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-90">{{ $t('Edit') }}</Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <Pagination :collection="users"/>
        </div>
    </div>
</template>