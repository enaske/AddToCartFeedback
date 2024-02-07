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
        a: {component: 'b'}
    },

    navigation: [{
        label: 'faq-bundle.general.mainMenuItemGeneral',
        color: '#ff3d58',
        path: 'faq.bundle.index',
        icon: 'default-shopping-paper-bag-product',
        position: 100
    }]
});