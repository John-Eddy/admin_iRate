<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use GuzzleHttp\Client;
use App\Service\ApiDataAdapter;
use App\Service\ApiResponseChecker;
use App\Entity\Articles;
use App\Entity\Scans;




/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    private $serializer;

    public function __construct() {
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $normalizers = [$normalizer];
        $encoders = [new JsonEncoder()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @Route("/searchArticle/{barecode}", name="search_article", methods={"GET"})
     */
    public function searchArticle($barecode, ApiDataAdapter $apiDataAdapter )
    {

        $article = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findOneBy(array(
                'code' => $barecode,
                'active' => 1,
            ));


        //Si l'article recherché n'existe en base
        if ($article) {

        } else {
            $client = new Client([
                'base_uri' => 'https://world.openfoodfacts.org/api/v0/'
            ]);
            $response = $client->request('GET', 'products/'.$barecode);

            if (ApiResponseChecker::isValidOFFResponse($response)) {
                $article = $apiDataAdapter->createArticleFromOFFResponse($response);

            
            } else {
                return new JsonResponse([], Response::HTTP_NO_CONTENT);

            }
        }        

        $scan = new Scans();
        $scan->setCode($barecode);

        $article->addScan($scan);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        $article->removeScans();

        $response = new Response(
            $this->serializer->serialize($article, 'json'),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
            );
        return $response;
    }

}
