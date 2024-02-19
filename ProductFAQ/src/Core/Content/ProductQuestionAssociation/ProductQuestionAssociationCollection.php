<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductQuestionAssociation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void               add(ProductQuestionAssociationEntity $entity)
 * @method void               set(string $key, ProductQuestionAssociationEntity $entity)
 * @method ProductQuestionAssociationEntity[]    getIterator()
 * @method ProductQuestionAssociationEntity[]    getElements()
 * @method ProductQuestionAssociationEntity|null get(string $key)
 * @method ProductQuestionAssociationEntity|null first()
 * @method ProductQuestionAssociationEntity|null last()
 */
class ProductQuestionAssociationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ProductQuestionAssociationEntity::class;
    }
}