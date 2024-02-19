<?php declare(strict_types=1);

namespace ProductFAQ\Core\Content\ProductQuestionAssociation;

use ProductFAQ\Core\Content\ProductFAQ\ProductFAQDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductQuestionAssociationDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'product_question_association';
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            (new ManyToOneAssociationField('question', 'question_id', ProductFAQDefinition::class))->addFlags(new Required()),
            (new ManyToOneAssociationField('product', 'product_id', 'product'))->addFlags(new Required()),

            // Additional fields if needed
        ]);
    }
}