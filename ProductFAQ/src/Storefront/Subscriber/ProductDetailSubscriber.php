<?php declare(strict_types=1);

namespace ProductFAQ\Storefront\Subscriber;

use ProductFAQ\Core\Content\ProductFAQ\ProductFAQCollection;
use ProductFAQ\Core\Content\ProductQuestionAssociation\ProductQuestionAssociationCollection;
use ProductFAQ\Core\Content\ProductFAQ\ProductFAQEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductDetailSubscriber implements EventSubscriberInterface

{
    private $systemConfigService;
    private $productQuestionsRepository;
    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepository $productQuestionsRepository,

    ) {
        $this->systemConfigService = $systemConfigService;
        $this->productQuestionsRepository = $productQuestionsRepository;

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
        $questions = $this->fetchQuestions($event->getContext(), $productId);


        $event->getPage()->addExtension('product_questions', $questions
        );

    }


    private function fetchQuestions(Context $context, $productId): ProductQuestionAssociationCollection
    {
        $criteria = new Criteria();

        $criteria->addAssociation('product');
        $criteria->addAssociation('faq');
        $criteria->addFilter(new EqualsFilter('faq.active', 1));
        $criteria->addFilter(new EqualsFilter('product.id', $productId));
        // Fetch FAQs
        $questionCollection = $this->productQuestionsRepository->search($criteria, $context)->getEntities();

        return $questionCollection;
    }




}