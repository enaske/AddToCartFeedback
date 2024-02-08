import template from './faq-bundle-detail.html.twig'


const { Component, Mixin} = Shopware;


Component.register('faq-bundle-detail', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification')
    ],
    metaInfo() {
        return {
            title: this.$createTitle()
        }
    },
    data() {
        return {
            bundle: null,
            isLoading: false,
            processSuccess: false,
            repository: null
        }
    },

    computed: {
        options() {
            return [
                {value: 'absolute', name: this.$tc('faq-absoluteText')},
                {value: 'percentage', name: this.$tc('faq-percentage')}
            ]
        }
    },

    created() {
        this.createdComponent();
        console.log('created Details Page')
    },

    methods: {
        createdComponent() {
            this.repository = this.repositoryFactory.create('faq');
            this.getBundle();
        },
        getBundle() {
            this.repository.get(this.$route.params.id, Shopware.Context.api).then((entity) =>{
                console.log(entity)
                this.bundle = entity;
            })
        },
        onClickSave() {
            this.isLoading = true;
            this.repository.save(this.bundle, Shopware.Context.api).then(() => {
                this.getBundle();
                this.isLoading = false;
                this.processSuccess = true;
            }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('FAQ-ERROR'),
                    message: exception
                })
            })
        },
        saveFinish() {
            this.processSuccess = false;
        }
    }
})