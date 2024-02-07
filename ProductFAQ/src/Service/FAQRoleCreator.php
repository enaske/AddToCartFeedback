<?php declare(strict_types=1);

namespace ProductFAQ\Service;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Rule\Container\ContainerInterface;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\System\SystemConfig\SystemConfigService;


class FAQRoleCreator
{
    private $roleRepository;
    private $integrationRepository;
    private $systemConfig;

    public function __construct(EntityRepository $roleRepository, EntityRepository $integrationRepository,  SystemConfigService $systemConfig)
    {
        $this->roleRepository = $roleRepository;
        $this->integrationRepository = $integrationRepository;
        $this->systemConfig = $systemConfig;
    }

    public function createIntegration(Context $context): void
    {
        // Use dependency injection to get necessary services
        $integrationRepository = $this->integrationRepository;

        $faqRoleId = $this->getFAQRoleId($context);
        $randomBytes = random_bytes(16);
        $accessKey = 'SWIA' . bin2hex($randomBytes);
        $secretAccessKey = bin2hex(random_bytes(32));
        sleep(5);


        // Define the data for the new integration
        $integrationData = [
            'label' => 'FAQ Integration',
            'accessKey' => $accessKey,
            'secretAccessKey' => $secretAccessKey,
            'writeAccess' => true,
            'admin' => false,
            'enabled' => true
        ];
        // Fetch the integration definition
        //$integrationDefinition = $integrationRepository->getDefinition();
        $this->systemConfig->set('ProductFAQ.config.apiKEY', $accessKey);
        $this->systemConfig->set('ProductFAQ.config.apiSECRET', $secretAccessKey);

        // Add the ACL role association to the integration data
        $integrationData['aclRoles'] = [
            ['id' => $faqRoleId],
        ];


        // Insert the new integration without the user context
        $integrationRepository->create([$integrationData], Context::createDefaultContext());
    }


    private function getFAQRoleId(Context $context): string
    {
        // Fetch the FAQ role by name
        $faqRole = $this->roleRepository->search(
            new Criteria(),
            $context
        )->getEntities()->filterByProperty('name', 'faq')->first();

        // If the FAQ role exists, return its ID; otherwise, create the role
        if ($faqRole) {
            return $faqRole->getId();
        } else {
            // Define data for the new FAQ role
            $faqRoleData = [
                'name' => 'faq',
                'privileges' => ['faq:create'], // Adjust this based on your actual privileges
            ];

            // Insert the new FAQ role without the user context
            $this->roleRepository->create([$faqRoleData], Context::createDefaultContext());

            // Fetch and return the ID of the newly created role with the original context
            $faqRole = $this->roleRepository->search(
                new Criteria(),
                $context
            )->getEntities()->filterByProperty('name', 'faq')->first();

            return $faqRole->getId();
        }
    }
}
