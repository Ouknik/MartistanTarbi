import "./bootstrap";
import "../css/app.css";
import 'v-calendar/style.css';

import.meta.glob(["/images/**", "/fonts/**"]);
import "vue-toast-notification/dist/theme-sugar.css";
import "vue3-easy-data-table/dist/style.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import VueApexCharts from "vue3-apexcharts";
import { VueDraggableNext } from 'vuedraggable';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// use





const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
            .use(VueSweetalert2)
            .use(VueDraggableNext)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
