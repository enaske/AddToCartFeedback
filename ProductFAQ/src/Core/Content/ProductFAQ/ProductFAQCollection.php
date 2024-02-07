<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductFAQ;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void               add(ProductFAQEntity $entity)
 * @method void               set(string $key, ProductFAQEntity $entity)
 * @method ProductFAQEntity[]    getIterator()
 * @method ProductFAQEntity[]    getElements()
 * @method ProductFAQEntity|null get(string $key)
 * @method ProductFAQEntity|null first()
 * @method ProductFAQEntity|null last()
 */
class ProductFAQCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ProductFAQEntity::class;
    }
}