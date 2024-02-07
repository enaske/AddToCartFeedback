<?php declare(strict_types=1);

namespace ProductFAQ\Storefront\Subscriber;

use Sandboxer\Core\Content\ShopFinder\ShopFinderCollection;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductDetailSubscriber implements EventSubscriberInterface

{
    private $systemConfigService;
    private $productFAQRepository;
    private $requestStack;
    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepository $productFAQRepository,
        RequestStack $requestStack
    ) {
        $this->productFAQRepository = $productFAQRepository;
        $this->systemConfigService = $systemConfigService;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents()
    {
        return [
            ProductPageLoadedEvent::class => 'onProductPageLoaded'
        ];
    }

    public function onProductPageLoaded(ProductPageLoadedEvent $event) : void

    {
        if(!$this->systemConfigService->get('ProductFAQ.config.showFAQ')) {
            return;
        }

        $faqs = $this->fetchFAQs($event->getContext());

        $event->getPagelet()->addExtension('product_faq', $faqs
        );
    }

    private function fetchFAQs(Context $context) :ShopFinderCollection
    {
        $productId = $this->getCurrentProductId();


        $criteria = new Criteria();
        $criteria->addAssociation('products');
        $criteria->addFilter(new EqualsFilter('active', 1));
        $criteria->addFilter(new EqualsFilter('products.id', $productId));



        // Fetch FAQs
        $FAQCollection = $this->productFAQRepository->search($criteria, $context)->getEntities();

        return $FAQCollection;
    }

    private function getCurrentProductId(): ?string
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        if ($currentRequest === null) {
            return null;
        }

        // Assuming the product ID is part of the route parameters
        $productId = $currentRequest->attributes->get('productId');

        return $productId;
    }

}