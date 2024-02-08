<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductFAQ;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ProductFAQEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var bool
     */
    protected bool $active;

    /**
     * @var string
     */
    protected string $question;

    /**
     * @var ?string
     */
    protected ?string $answer = null;

    /**
     * @var int
     */
    protected int $orderPosition;

    /**
     * @var ProductEntity|null
     */
    protected ?ProductEntity $productId;

    public function getOrderPosition(): int
    {
        return $this->orderPosition;
    }

    public function setOrderPosition(int $orderPosition): void
    {
        $this->orderPosition = $orderPosition;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): void
    {
        $this->answer = $answer;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
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
