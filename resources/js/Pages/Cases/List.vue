<script setup>
import Header from "@/Components/Header.vue";

defineProps({
  cases: Array,
  title: String
})
</script>

<template>
    <!-- Use Inertias head component to overwrite the default in Layouts/AppLayout.vue -->
    <Head :title="title" />
    <Header>{{ title }}</Header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-4 lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <table>
                        <tr>
                          <th>Name</th>
                          <th>Kategorie</th>
                          <th>Auftraggeber</th>
                        </tr>

                        <template v-for="caseEntry in cases" :key="caseEntry.id">
                          <tr>
                            <td>{{ caseEntry.name }}</td>
                            <td>{{ caseEntry.category_id }}</td>
                            <td>{{ caseEntry.customer.customername }}</td>
                          </tr>
                        </template>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>
