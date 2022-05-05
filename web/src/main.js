import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import {createI18n} from 'vue-i18n/index'

import i18n from './i18n/zh_CN'
import './registerServiceWorker'
import store from './store'

createApp(App).use(store)
    .use(router)
    .use(createI18n({
        locale: 'zh_CN',
        fallbackLocale: 'en_US',
        messages: {zh_CN: i18n}
    }))
    .mount('#app')