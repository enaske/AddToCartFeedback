<?php declare(strict_types=1);

namespace ProductFAQ\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1707313490 extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1707313490;
    }

    public function update(Connection $connection): void
    {
        $createFAQ = <<<SQL
CREATE TABLE IF NOT EXISTS `faq` (
  `id`          BINARY(16) NOT NULL,
  `active`      TINYINT(1) NULL DEFAULT '0',
  `question`    VARCHAR(255) NOT NULL,
  `answer`      VARCHAR(255) NULL,
  `order_position` INT NOT NULL,
  `created_at`  DATETIME(3),
  `updated_at`  DATETIME(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;


        $connection->executeStatement($createFAQ);


        $productQuestionAssociation = <<<SQL
CREATE TABLE IF NOT EXISTS `product_question_association` (
  `id`          BINARY(16) NOT NULL,
  `question_id` BINARY(16) NOT NULL,
  `product_id`  BINARY(16) NOT NULL,
  `created_at`  DATETIME(3),
  `updated_at`  DATETIME(3),
  PRIMARY KEY (`id`),
  KEY `fk.product_question_association.question_id` (`question_id`),
  KEY `fk.product_question_association.product_id` (`product_id`),
  CONSTRAINT `fk.product_question_association.question_id` FOREIGN KEY (`question_id`)
    REFERENCES `faq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk.product_question_association.product_id` FOREIGN KEY (`product_id`)
    REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

        $connection->executeStatement($productQuestionAssociation);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
