import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import UserEdit from '../assets/components/UserEdit.vue';

const app = createApp({
    components: {
        'user-edit': UserEdit
    }
});

app
    .use(ElementPlus)
    .mount('#app')