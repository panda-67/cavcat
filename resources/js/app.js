require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { InertiaProgress } from '@inertiajs/progress';
import CKEditor from '@ckeditor/ckeditor5-vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use( CKEditor )
            .mixin({ methods: { route } })
            .mount(el);
    },
});

// Vue.component('Inertia', Inertia)

InertiaProgress.init({
    delay: 500,

    color: '#ff0000',

    // includeCSS: true,

    showSpinner: true,
});
