<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductFAQ;

use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;


class ProductFAQEntity extends Entity
{

    use EntityIdTrait;
    /**
     * @var boolean
     */
    protected bool $active;
    /**
     * @var string
     */
    protected string $question;
    /**
     * @var string|null
     */
    protected string|null $answer;
    /**
     * @var int
     */
    protected int $orderPosition;
    /**
     * @var ProductCollection
     */
   protected ProductCollection $products;


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

    public function getProducts(): ProductCollection
    {
        return $this->products;
    }

    public function setProducts(ProductCollection $products): void
    {
        $this->products = $products;
    }

}