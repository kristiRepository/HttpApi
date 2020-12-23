<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{

    /**
     * Sends a request to any service
     *
     * @return stdClass|string
     */
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if(method_exists($this,'resolveAuthorization')){
            $this->resolveAuthorization($queryParams,$formParams,$headers);
        }
        

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            'form_params' => $formParams,
            'headers' => $headers
        ]);

        $response=$response->getBody()->getContents();

        if(method_exists($this,'decodeResponse')){
            $this->decodeResponce($response);
        }

        if(method_exists($this,'checkIfErrorResponse')){
            $this->checkIfErrorResponse($response);
        }

        return $response;
    }
}
