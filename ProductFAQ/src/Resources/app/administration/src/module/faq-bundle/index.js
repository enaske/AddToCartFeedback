import './page/faq-bundle-list'
import './page/faq-bundle-detail'

import deDE from './snippet/en-GB.json'
import enGB from './snippet/de-DE.json'

console.log('index.js loaded')




Shopware.Module.register('faq-bundle', {
    type: 'plugin',
    name: 'bundle',
    title: 'faq-bundle.general.mainMenuItemGeneral',
    description: 'faq-bundle.general.descriptionTextModule',
    color: '#ff3d58',
    icon: 'default-shopping-paper-bag-product',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        index: {
            component: 'faq-bundle-list',
            path: 'index'
        },
        detail: {
            component: 'faq-bundle-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'faq.bundle.index'
            }
        }
    },
    navigation: [{
        id: 'faq-bundle-main',
        label: 'faq-bundle.general.mainMenuItemGeneral',
        color: '#A092F0',
        path: 'faq.bundle.index',
        icon: 'regular-shopping-bag',
        parent: 'sw-catalogue',
        position: 30
    }],
});