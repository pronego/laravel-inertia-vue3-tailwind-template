<script setup>
defineProps({
    // we need an object here because we get a Pagination object
    // (@see Controller, ->paginate() and iterate over collection.data)
    collection: Object
})
</script>

<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <!-- mobile pagination -->
        <div class="flex flex-1 justify-between md:hidden">
            <Component
                :is="collection.prev_page_url ? 'Link' : 'span'"
                :href="collection.prev_page_url"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-50"
                :class="[
                    collection.prev_page_url ? 'text-gray-700' : 'text-gray-500', // link : no link
                ]">
                Zurück
            </Component>
            <Component
                :is="collection.next_page_url ? 'Link' : 'span'"
                :href="collection.next_page_url"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-50"
                :class="[
                    collection.next_page_url ? 'text-gray-700' : 'text-gray-500', // link : no link
                ]">
                Weiter
            </Component>
        </div>

        <!-- desktop pagination -->
        <div class="hidden md:flex md:flex-1 md:items-center md:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    {{ ' ' }}
                    <span class="font-medium">{{ collection.from }}</span>
                    {{ ' ' }}
                    -
                    {{ ' ' }}
                    <span class="font-medium">{{ collection.to }}</span>
                    {{ ' ' }}
                    von
                    {{ ' ' }}
                    <span class="font-medium">{{ collection.total }}</span>
                    {{ ' ' }}
                    Einträgen
                </p>
            </div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="(link, idx) in collection.links"
                    :href="link.url"
                    v-html="link.label "
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0"
                    :class="[
                        link.active
                            ? 'z-10 bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                            : link.label != '...' ? 'hover:bg-gray-100' : '', // hover: ... | non-active link
                        link.url
                            ? 'text-gray-900' // link
                            : link.label == '...' ? 'text-gray-700' : 'text-gray-500', // text-color: ... | no link
                        idx == 0 ? 'rounded-l-md' : '', // rounded left corner on first el
                        idx == (collection.links.length-1) ? 'rounded-r-md' : '' // rounded right corner on last el
                    ]"
                    :aria-current="link.active ? 'page' : ''"
                />
            </nav>
        </div>
    </div>
</template>