<?php
namespace PubBundle\Component\GooglePlaceSearcher;

use Psr\Log\LoggerInterface;
use PubBundle\TypeValidationTrait\NonEmptyStringVerifyingTrait;
use Zend\Http\Client;

class ZendHttpBasedPlaceApiClient implements PlaceApiClient
{
    use NonEmptyStringVerifyingTrait;

    private $supportedLanguageCode = [
        'pl' => 'pl'
    ];

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $languageCode;

    /**
     * @var string
     */
    private $responseFormat = 'json';

    /**
     * @var LoggerInterface
     */
    private $logger;


    /**
     * @param string $apiUrl
     * @param string $apiKey
     * @param string $languageCode
     * @param LoggerInterface $logger
     */
    public function __construct(
        $apiUrl,
        $apiKey,
        $languageCode,
        LoggerInterface $logger
    ) {
        //TODO supported for more languages and response formats
        $this->apiUrl = $this->verifyNonEmptyString($apiUrl, 'Api URL');
        $this->apiKey = $this->verifyNonEmptyString($apiKey, 'Api key');
        $this->languageCode = $this->verifyNonEmptyString($languageCode, 'Language');
        if (!array_key_exists($this->languageCode, $this->supportedLanguageCode)) {
            throw new \InvalidArgumentException(sprintf(
                'Language "%s" is not supported now.',
                $this->languageCode
            ));
        }
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function makeRequest(SearchMethod $method, SearchParameters $parameters)
    {
        try {
            $uri = sprintf(
                '%s/%s/%s',
                $this->apiUrl,
                $method->getName(),
                $this->responseFormat
            );


            $client = new Client();
            $client->setUri($uri);
            $client->setParameterGet($this->parametersToArray($parameters));
            $response = $client->send();
            return new JsonBasedPlaceApiResponse(
                $response->getStatusCode(),
                $response->getBody()
            );
        } catch (\Exception $exception) {
            $this->logger->error((string) $exception);
            return new JsonBasedPlaceApiResponse(
                500,
                json_encode(['error_message' => (string) $exception])
            );
        }
    }


    /**
     * @param SearchParameters $parameters
     * @return array
     */
    private function parametersToArray(SearchParameters $parameters)
    {
        $parametersArray = [];
        $parametersArray['key'] = $this->apiKey;
        $parametersArray['language'] = $this->languageCode;
        foreach ($parameters->getAllParameters() as $parameter) {
            $parametersArray[$parameter->getName()] = $parameter->valueToString();
        }

        return $parametersArray;
    }
}
