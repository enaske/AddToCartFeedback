import template from './faq-bundle-list.html.twig'


const { Component} = Shopware;
const { Criteria    } = Shopware.Data;




console.log("Loaded Listing")
Component.register('faq-bundle-list', {
    template,

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            repository: null,
            bundles: null
        }

    },
    metaInfo() {
        return {
            title: this.$createTitle()
        }

    },
    computed: {
        columns() {
            return this.getColumns();
        }
    },
    created() {
        this.createdComponent();
        console.log("List created")
    },
    methods: {

        createdComponent() {
            this.repository = this.repositoryFactory.create("faq");
            const criteria = new Criteria();
            criteria.addAssociation('products_all');
            this.repository.search(criteria, Shopware.Context.api).then((result) => {
               this.bundles = result;
               console.dir(this.bundles)

            })
        },
        search() {
            const criteria = new Criteria();
            criteria.addAssociation('products_all');
            this.repository.search(criteria, Shopware.Context.api).then((result) => {
                this.bundles = result;
            })
        },
        onSave(promise, product) {
            console.log(product)
            console.log('saving')

            return promise.then(() => {
                    console.log('saved')})
        },
        getColumns() {
            return [{
                property: 'question',
                label: this.$tc('faq-bundle.columns.question'),
                inlineEdit: 'string',
                allowResize: true
            },
                {
                    property: 'active',
                    label: this.$tc('faq-bundle.columns.active'),
                    inlineEdit: 'boolean',
                    allowResize: true
                },
                {
                    property: 'answer',
                    label: this.$tc('faq-bundle.columns.answer'),
                    inlineEdit: 'string',
                    allowResize: true
                },
                {
                    property: 'productId.productNumber',
                    label: this.$tc('faq-bundle.columns.product'),
                    allowResize: true
                }]
        }

    }
})
