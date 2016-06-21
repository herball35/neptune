<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Component\GooglePlaceSearcher\NearbyPlacesSearcher;
use PubBundle\Component\GooglePlaceSearcher\NearbySearchParametersProvider;
use PubBundle\Domain\Entity\NearbyPlaces;
use PubBundle\Domain\Factory\LocationRelationFactory;
use PubBundle\Domain\ValueObject\Location;

class GoogleNearbyPlacesReadRepository implements NearbyPlacesReadRepository
{
    /**
     * @var NearbySearchParametersProvider
     */
    private $parametersProvider;

    /**
     * @var NearbyPlacesSearcher
     */
    private $googleSearcher;
    /**
     * @var GoogleResultToPlaceMapper
     */
    private $mapper;
    /**
     * @var LocationRelationFactory
     */
    private $locationRelationFactory;

    /**
     * @param NearbyPlacesSearcher $googleSearcher
     * @param NearbySearchParametersProvider $parametersProvider
     * @param GoogleResultToPlaceMapper $mapper
     * @param LocationRelationFactory $locationRelationFactory
     */
    public function __construct(
        NearbyPlacesSearcher $googleSearcher,
        NearbySearchParametersProvider $parametersProvider,
        GoogleResultToPlaceMapper $mapper,
        LocationRelationFactory $locationRelationFactory
    ) {
        $this->googleSearcher = $googleSearcher;
        $this->parametersProvider = $parametersProvider;
        $this->mapper = $mapper;
        $this->locationRelationFactory = $locationRelationFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getByLocation(Location $location)
    {
        $searchResponse = $this->googleSearcher->search(
            $this->parametersProvider->getParametersForLocation($location)
        );

        if (!$searchResponse->isSuccess()) {
            throw new \RuntimeException(sprintf(
                "Error during reading data from google api with message:\n%s",
                $searchResponse->getErrorMessage()
            ));
        }
        $results = $searchResponse->getResults();

        $relatedPlaces = [];
        foreach ($results as $result) {
            $relatedPlaces[] = $this->mapper->map($result);
        }

        $relations = [];
        foreach ($relatedPlaces as $relatedPlace) {
            $relations[] = $this->locationRelationFactory->createLocationRelation($location, $relatedPlace);
        }

        return new NearbyPlaces($location, $relations);
    }
}
