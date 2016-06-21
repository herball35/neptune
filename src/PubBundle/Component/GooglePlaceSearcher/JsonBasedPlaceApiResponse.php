<?php
namespace PubBundle\Component\GooglePlaceSearcher;

use PubBundle\TypeValidationTrait\PositiveIntegerVerifyingTrait;
use PubBundle\TypeValidationTrait\StringVerifyingTrait;

class JsonBasedPlaceApiResponse implements PlaceApiResponse
{
    use PositiveIntegerVerifyingTrait;
    use StringVerifyingTrait;

    private $successStatuses= [
        'OK',
        'ZERO_RESULTS'
    ];

    /**
     * @var int
     */
    private $httpStatusCode;

    /**
     * @var string
     */
    private $jsonBody;

    /**
     * @var string
     */
    private $errorMessage = '';

    /**
     * @var string
     */
    private $status;

    /**
     * @var \stdClass[]|array
     */
    private $results = [];

    /**
     * @param int $httpStatusCode
     * @param string $jsonBody
     */
    public function __construct($httpStatusCode, $jsonBody = '')
    {
        $this->httpStatusCode = $this->verifyPositiveInteger($httpStatusCode, 'Http status code');
        $this->jsonBody = $this->verifyString($jsonBody, 'Body');

        if ($this->httpStatusCode !== 200) {
            $responseData = $this->getResponseData($this->jsonBody);
            if (is_object($responseData)) {
                $this->setDataFromResponse($responseData);
            }

            $this->errorMessage = sprintf(
                "Http request error, with returning status %d.\n%s",
                $this->httpStatusCode,
                $this->errorMessage
            );
        } else {
            $responseData = $this->getResponseData($this->jsonBody);
            if (is_object($responseData)) {
                $this->setDataFromResponse($responseData);
            } else {
                $this->errorMessage = 'Unable to read response body.';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccess()
    {
        return (
            $this->httpStatusCode == 200
            && in_array($this->status, $this->successStatuses)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param string $json
     * @return mixed
     */
    private function getResponseData($json)
    {
        return $responseData = json_decode($json);
    }

    /**
     * @param /stdClass $responseData
     */
    private function setDataFromResponse($responseData)
    {
        if (!empty($responseData->status)) {
            $this->status = $responseData->status;
        }
        if (!empty($responseData->error_message)) {
            $this->errorMessage = $responseData->error_message;
        }
        if (!empty($responseData->results)) {
            $this->results = $responseData->results;
        }
    }
}
