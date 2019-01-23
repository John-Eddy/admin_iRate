<?php

namespace App\Service;

use App\Entity\Articles;

abstract class ApiResponseChecker
{

    /**
     * 
     */
    static function isValidOFFResponse($response) : bool { 
        if ($response->getStatusCode()!= 200 ) {
            return false;
        }
        $responseBody = json_decode($response->getBody(), true);

        if ( isset($responseBody["status"]) && $responseBody["status"] == 1) {
            return true;
        } else {
            return false;
        }
    }
    

}
?>