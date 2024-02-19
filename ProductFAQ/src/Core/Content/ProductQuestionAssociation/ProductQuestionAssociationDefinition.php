<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductQuestionAssociation;

use ProductFAQ\Core\Content\ProductFAQ\ProductFAQCollection;
use ProductFAQ\Core\Content\ProductFAQ\ProductFAQDefinition;
use ProductFAQ\Core\Content\ProductFAQ\ProductFAQEntity;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductQuestionAssociationDefinition extends EntityDefinition
{

    public function getCollectionClass(): string
    {
        return ProductQuestionAssociationCollection::class;
    }

    public function getEntityClass(): string
    {
        return ProductQuestionAssociationEntity::class;
    }
    public function getEntityName(): string
    {
        return 'product_question_association';
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            (new FkField('question_id', 'questionId', ProductFAQDefinition::class))->addFlags(new Required()),
            (new ManyToOneAssociationField('faq', 'question_id', ProductFAQDefinition::class, 'id'))->addFlags(new CascadeDelete()),
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new Required()),
            (new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id', false))->addFlags(new CascadeDelete()),
            // Additional fields if needed
        ]);
    }
}