<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\FAQ;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void               add(FAQEntity $entity)
 * @method void               set(string $key, FAQEntity $entity)
 * @method FAQEntity[]    getIterator()
 * @method FAQEntity[]    getElements()
 * @method FAQEntity|null get(string $key)
 * @method FAQEntity|null first()
 * @method FAQEntity|null last()
 */
class FAQCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return FAQEntity::class;
    }
}