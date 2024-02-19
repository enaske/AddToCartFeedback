<?php declare(strict_types=1);

namespace ProductFAQ\Command;

use ProductFAQ\Service\FAQRoleCreator;
use Shopware\Core\Framework\Context;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ActivateCommand extends Command
{
private $faqRoleCreator;

public function __construct(FAQRoleCreator $faqRoleCreator)
{
parent::__construct();

$this->faqRoleCreator = $faqRoleCreator;
}

protected function configure()
{
$this->setName('product_faq:activate');

}

protected function execute(InputInterface $input, OutputInterface $output)
{
$context = Context::createDefaultContext();

// Create the integration and associate it with the FAQ role
$this->faqRoleCreator->createIntegration($context);

return Command::SUCCESS;
}
}
