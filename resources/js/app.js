import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m' // use laravel routes in JS
import { i18nVue } from 'laravel-vue-i18n'
import AppLayout from "@/Layouts/AppLayout.vue"

createInertiaApp({
    // Prepend app name in the title (title is set in the components with <Head :title="..." />
    title: (title) => `MyApp - ${title}`,

    //resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: async (name) => {
        let page = (await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))).default

        // Apply default layout if not disabled (@see Pages/Auth/Login.vue)
        if (page.layout === undefined) {
            page.layout = AppLayout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)

            // Make Laravel translations available in JS: @see https://github.com/xiCO2k/laravel-vue-i18n
            .use(i18nVue, {
                resolve: async lang => {
                    const langs = import.meta.glob('../../lang/*.json');
                    return await langs[`../../lang/${lang}.json`]();
                }
            })

            // make <Link> and <Head> globally available
            .component('Link', Link)
            .component('Head', Head)
            .mount(el);
    },

    // Show progress bar on page load, alternatively:
    // import {InertiaProgress} from '@inertiajs/progress'
    // InertiaProgress.init()
    progress: {
        color: '#4B5563',
        // showSpinner: true // default=false
    },
});
