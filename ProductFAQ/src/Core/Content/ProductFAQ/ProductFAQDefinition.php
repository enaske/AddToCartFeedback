<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductFAQ;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;


class ProductFAQDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'faq';
    }

    public function getCollectionClass(): string
    {
        return ProductFAQCollection::class;
    }

    public function getEntityClass(): string
    {
        return ProductFAQEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection(
            [
                (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
                new BoolField('active','active'),
                (new StringField('question', 'question'))->addFlags(new Required()),
                new StringField('answer', 'answer'),
                new IntField('order_position', 'orderPosition'),
                (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new Required()),
                new ManyToOneAssociationField('products_all', 'product_id', ProductDefinition::class, 'id', false),
            ]
        );
    }
}