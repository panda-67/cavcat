require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({
    delay: 500,

    color: '#ff0000',

    // includeCSS: true,

    showSpinner: true,
});

// ref: https://tobiasahlin.com/blog/move-from-jquery-to-vanilla-javascript/#document-ready

