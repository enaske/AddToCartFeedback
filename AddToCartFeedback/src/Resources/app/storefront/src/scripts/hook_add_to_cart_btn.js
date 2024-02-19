
import AddToCartPlugin
    from "src/plugin/add-to-cart/add-to-cart.plugin";
import DomAccess from "src/helper/dom-access.helper";
import HttpClient from "src/service/http-client.service";



export default class HookAddToCartBtn extends AddToCartPlugin {



    init(){
        console.log("Plugin loaded")
        this._cartEl = DomAccess.querySelector(document, '.header-cart')
        this._addToCartBtn = DomAccess.querySelector(document, '.btn.btn-primary.btn-buy')
        this._quantityElements = DomAccess.querySelectorAll(document, '[aria-label*="quantity" i]')
        this._svgIcons = DomAccess.querySelectorAll(document, '[aria-label*="quantity" i] > span  > svg > defs > path')
        this._addToCartDefaultTxt = window.customText.default
        super.init()
        this._addToCartFeedback = window.customText.adding
        this.PluginManager = window.PluginManager
        this._client = new HttpClient(window.accessKey, window.contextToken)





    }
    _openOffCanvasCart(instance, requestUrl, formData) {
           // if we don't want this Original Canvas, comment this out.
        window.setTimeout(() => {
        instance.openOffCanvas(requestUrl, formData, () => {
            this.$emitter.publish('openOffCanvasCart');
            });
        }, 1000)
        this. _giveFeedback()
        // uncomment this, if you remove the Canvas
       // this._client.post(requestUrl, formData, this._afterAddItemToCart.bind(this))


    }
    _afterAddItemToCart() {
        this._refreshCartValue()

    }
    _refreshCartValue() {
        const cartWidgetEl = DomAccess.querySelector(this._cartEl, '[data-cart-widget]')
        const cartWidgetInstance = this.PluginManager.getPluginInstanceFromElement(cartWidgetEl, 'CartWidget')
        cartWidgetInstance.fetch()
        console.info(cartWidgetEl)
    }

    _giveFeedback() {
        this._addToCartBtn.disabled = true;
        this._setButtonText(this._addToCartFeedback)
        this._changeStyles()
        window.setTimeout(() => {
            this._restoreOriginal()
        }, 1000)

    }
    _restoreOriginal() {
        this._addToCartBtn.disabled = false;
        this._setButtonText(this._addToCartDefaultTxt)
        this._changeStyles()
    }

    _setButtonText(text) {

        this._addToCartBtn.textContent = text;
    }
    _changeStyles() {
        console.log("Change style call")
        this._quantityElements.forEach(element => {

            element.classList.toggle('btn-outline-feedback')
        });
        this._svgIcons.forEach(element => {

            element.classList.toggle('svg-color-feedback')
        });



        this._addToCartBtn.classList.toggle('btn-font-color-feedback')

    }
}




