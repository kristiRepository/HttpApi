<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class MarketService
{
    use ConsumesExternalServices;

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
     * Resolve the elements to send when authorizing the request
     *
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $accessToken = $this->resolveAccessToken();

        $headers['Authorization'] = $accessToken;
    }

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

    /**
     * Resolve a valid access token to use
     *
     * @return string
     */
    public function resolveAccessToken()
    {

        return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM0NzBlZDkwNDA1NTgxZDM3OGU4NTVjMTM5YzAxNThlMjI4NTM2ZTIxY2I2NjlkMzFkNjRjYmVkM2ViNmVkZDI0OGRiMTViNjM0ZjA1Mjk1In0.eyJhdWQiOiIyIiwianRpIjoiMzQ3MGVkOTA0MDU1ODFkMzc4ZTg1NWMxMzljMDE1OGUyMjg1MzZlMjFjYjY2OWQzMWQ2NGNiZWQzZWI2ZWRkMjQ4ZGIxNWI2MzRmMDUyOTUiLCJpYXQiOjE2MDg3Mzc1NjUsIm5iZiI6MTYwODczNzU2NSwiZXhwIjoxNjQwMjczNTY1LCJzdWIiOiIxNTEyIiwic2NvcGVzIjpbInB1cmNoYXNlLXByb2R1Y3QiLCJtYW5hZ2UtcHJvZHVjdHMiLCJtYW5hZ2UtYWNjb3VudCIsInJlYWQtZ2VuZXJhbCJdfQ.NLrqvRYW3ZLj0pde-CyOxOVlywxNSEJSlRjiYP_0iSnokruPaqkdToIjtrcBpAiwgvI6us_xV_h1M0sS-ISGODGyAH8KYTQ3nbqn26eOR9SMX6HzurVXVJGYh97ycBDinNmEDtKSBmrCZlx0yEvPY09dFBYZoSgtT7qM27LoYXHq-bS8o_Ulz7hJu36F61lp8tqt93vuLM6NfJyZ-ZHA6genwtuFrW0VgVy_a7y1Ls8032CMFlej4pQQeKRICGfeqG80YmtYxP4cAF-hVRHvJTY_BZ2AkUZiN3BNJCEdbUdd4UIZuOb0csLtHGJfzcnlMNzZSXqA0aZhmnQoT1NTxUuoxnPu-lmuupKKrMsRpZ9ADQuxU_pf-a4sj8BLIq445Iank3WVfzRoWgBCIpSjQ89PuwUwmI3-50HyPma-IhLDEFWtb3jwjFQJpJOPIf2NfYSFP8Op_OlyNd9GBrk-bMwoz5b6bbzN9J4xNfhm1nr32ddulB1kzSFTFr2HR9nvqkhx-ahpHPSc1zdnYN3lt4efLiSxqtrJfkKZTqzExEi5zdD9w0n2b7MZK35c0UUsE3S42hbIH_I8Uqhk4gendi7jazzlJaQYTUWaG_IXcaJA3KFKrQuEjO58nJtDw37TLtsmGqSnhn3A1KewyBx27lVVbS-f4c6I_K_AjGh34H4
        ';
    }
}
