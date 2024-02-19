<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductQuestionAssociation;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ProductQuestionAssociationEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $questionId;

    /**
     * @var string
     */
    protected $productId;
    public function getQuestionId(): string
    {
        return $this->questionId;
    }

    public function setQuestionId(string $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }
}