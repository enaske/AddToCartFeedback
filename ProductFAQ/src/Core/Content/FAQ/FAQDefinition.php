<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\FAQ;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;

use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;


class FAQDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'faq_product';
    }

    public function getCollectionClass(): string
    {
        return FAQCollection::class;
    }

    public function getEntityClass(): string
    {
        return FAQEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('faq_id', 'faqId'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new Required()),
        ]);
    }
}