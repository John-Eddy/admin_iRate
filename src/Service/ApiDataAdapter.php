<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\Brands;


class ApiDataAdapter
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * 
     */
    function createArticleFromOFFResponse($response) : Articles { 

        $responseBody = json_decode($response->getBody(), true);

        $article = new Articles();
        $article->setCode($responseBody['code'])
            ->setDesignation($responseBody['product']["product_name"])
            ->setBrand($responseBody['product']["brands"])
            ->setImageUrl($responseBody['product']["image_front_url"])
            ->setActive(1);
            
        return $article;
    }
    

}
?>