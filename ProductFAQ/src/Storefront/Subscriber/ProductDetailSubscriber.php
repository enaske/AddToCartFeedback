<?php declare(strict_types=1);

namespace ProductFAQ\Storefront\Subscriber;

use ProductFAQ\Core\Content\ProductFAQ\ProductFAQCollection;
use ProductFAQ\Core\Content\ProductFAQ\ProductFAQEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Shopware\Storefront\Pagelet\Footer\FooterPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductDetailSubscriber implements EventSubscriberInterface

{
    private $systemConfigService;
    private $productFAQRepository;

    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepository $productFAQRepository,

    ) {
        $this->productFAQRepository = $productFAQRepository;
        $this->systemConfigService = $systemConfigService;

    }
    public static function getSubscribedEvents()
    {
        return [
            ProductPageLoadedEvent::class => 'onProductPageLoaded'
        ];
    }

    public function onProductPageLoaded(ProductPageLoadedEvent  $event) : void

    {
        if(!$this->systemConfigService->get('ProductFAQ.config.showFAQ')) {
            return;
        }



        // Create fake FAQ data
        $faqsFake = new ProductFAQCollection();
        for ($i = 1; $i <= 5; $i++) {
            $faq = new ProductFAQEntity();
            $faq->setId(UUID::randomHex()); // Generating UUID manually
            $faq->setActive(true);
            $faq->setQuestion("Test");
            $faq->setAnswer("Answer $i");
            $faq->setOrderPosition($i);

            // Add more properties as needed

            $faqsFake->add($faq);
        }

        $product = $event->getPage()->getProduct();
        $productId = $product->getUniqueIdentifier();

        $faqs = $this->fetchFAQs($event->getContext(), $productId);
        $event->getPage()->addExtension('product_faq', $faqs
        );

    }

    private function fetchFAQs(Context $context, $productId) :ProductFAQCollection
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('active', 1));
        $criteria->addFilter(new EqualsFilter('product_id', $productId));
        // Fetch FAQs
        $FAQCollection = $this->productFAQRepository->search($criteria, $context)->getEntities();

        return $FAQCollection;
    }



}