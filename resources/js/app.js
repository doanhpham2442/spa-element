import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import UserEdit from '../assets/components/UserEdit.vue';
import UserParent from '../assets/components/UserParent.vue';
import * as ElementPlusIconsVue from '@element-plus/icons-vue'

const app = createApp({
    components: {
        'user-edit': UserEdit,
        'user-parent': UserParent
    }
});

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
  app.component(key, component)
}

app
    .use(ElementPlus)
    .mount('#app')