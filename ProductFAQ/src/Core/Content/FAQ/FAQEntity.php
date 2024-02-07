<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\FAQ;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;


class FAQEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected string $faqId;

    /**
     * @var string
     */
    protected string $productId;

    /**
     * @var FAQEntity|null
     */
    protected ?FAQEntity $faq;

    /**
     * @var ProductEntity|null
     */
    protected ?ProductEntity $product;


    public function getFaqId(): string
    {
        return $this->faqId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getFaq(): ?FAQEntity
    {
        return $this->faq;
    }

    public function setFaq(?FAQEntity $faq): void
    {
        $this->faq = $faq;
    }

    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    public function setProduct(?ProductEntity $product): void
    {
        $this->product = $product;
    }

}