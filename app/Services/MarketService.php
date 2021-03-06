<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketService
{
    use ConsumesExternalServices,AuthorizesMarketRequests,InteractsWithMarketResponses;

    /**
     * The URL to send requests
     * 
     * @var string
     */
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

   /**
     * Obtains the list of products from the API
     *
     * @return stdClass
     */
    public function getProducts(){
 
        return $this->makeRequest('GET','products');
    }

     /**
     * Obtains a product from the API
     *
     * @return stdClass
     */
    public function getProduct($id){
 
        return $this->makeRequest('GET',"products/{$id}");
    }


  /**
     * Obtains the list of categories from the API
     *
     * @return stdClass
     */
    public function getCategories(){
 
        return $this->makeRequest('GET','categories');
    }


   /**
     * Obtains the products of a category from the API
     *
     * @return stdClass
     */
    public function getCategoryProducts($id){
 
        return $this->makeRequest('GET',"categories/{$id}/products");
    }

    /**
     * Retrieve the user information from the API
     *
     * @return strClass
     */
    public function getUserInformation()
    {
        return $this->makeRequest('GET','users/me');
    }
   
}
