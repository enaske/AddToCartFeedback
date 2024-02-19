<?php declare(strict_types=1);

namespace ProductFAQ\Core\Api;

use Symfony\Component\HttpFoundation\Request;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


#[Route(defaults: ['_routeScope' => ['api']])]
class ProductFAQApiController extends AbstractController
{
private $faqRepository;

public function __construct(EntityRepository $faqRepository)
{
$this->faqRepository = $faqRepository;
}

/**
* @Route("/api/v{version}/_action/faq/new", name="api.action.product_faq.create", methods={"POST"})
 *
*/
public function createFAQ(Request $request,Context $context): JsonResponse
{
$data = json_decode($request->getContent(), true);

$questionId = Uuid::randomHex();

    $newFAQ = [
        'id' => $questionId,
        'active' => false,
        'question' => $data['question'],
        'orderPosition' => 1,
        'productQuestionAssociations' => [
            [
                'id' => Uuid::randomHex(),
                'questionId' => $questionId,
                'productId' => $data['product_id']
            ]
        ]
    ];



$this->faqRepository->upsert([$newFAQ], $context);

return new JsonResponse(['success' => true]);
}
}