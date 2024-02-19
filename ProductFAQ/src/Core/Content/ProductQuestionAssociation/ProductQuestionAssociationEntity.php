<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductQuestionAssociation;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ProductQuestionAssociationEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected string $questionId;

    /**
     * @var ProductEntity|null
     */
    protected ?ProductEntity $productId;
    public function getQuestionId(): string
    {
        return $this->questionId;
    }

    public function setQuestionId(string $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function getProductId(): ?ProductEntity
    {
        return $this->productId;
    }

    public function setProductId(?ProductEntity $productId): void
    {
        $this->productId = $productId;
    }
}