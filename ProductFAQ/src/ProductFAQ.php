<?php declare(strict_types=1);

namespace ProductFAQ;

use ProductFAQ\Command\ActivateCommand;
use ProductFAQ\Service\FAQRoleCreator;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class ProductFAQ extends Plugin
{
    private $faqRoleCreator;

    public function activate(ActivateContext $activateContext): void
    {
        parent::activate($activateContext);

        // Access the Shopware context
        $context = $activateContext->getContext();

        // Create and dispatch the activation command
        $command = new ActivateCommand($this->container->get(FAQRoleCreator::class));
        $command->run(new ArrayInput([]), new NullOutput());
    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {
        // Deactivate entities, such as a new payment method
        // Or remove previously created entities

        parent::deactivate($deactivateContext);
    }

    public function install(InstallContext $installContext): void
    {

    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        // Remove or deactivate the data created by the plugin
    }

    public function update(UpdateContext $updateContext): void
    {
        // Update necessary stuff, mostly non-database related
    }

    public function postInstall(InstallContext $installContext): void
    {
    }

    public function postUpdate(UpdateContext $updateContext): void
    {
    }
}
