<?php

namespace App\Traits;



trait InteractsWithMarketResponses
{
    
    /**
     * Decode correspondingly the response
     *@param [type] $response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        $decoded_response= json_decode($response);

        return $decoded_response->data ?? $decoded_response;
    }


    /**
     * Resolve when  the request failed
     *
     * @param [type] $response
     * @return stdClass
     */
    public function checkIfErrorResponse($response)
    {
        if(isset($response->error)){
            throw new \Exception("Something failed: {$response->error}");
        }
    }

}
