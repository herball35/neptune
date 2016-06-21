<?php
namespace PubBundle\Domain\ReadRepository;

use PubBundle\Component\Location\LocationToPlaceIdsReadRepository;
use PubBundle\Domain\Entity\NearbyPlaces;
use PubBundle\Domain\Factory\LocationRelationFactory;
use PubBundle\Domain\ValueObject\Location;

class TestNearbyPlacesReadRepository implements NearbyPlacesReadRepository
{
    /**
     * @var PlaceReadRepository
     */
    private $placeReadRepository;
    /**
     * @var LocationToPlaceIdsReadRepository
     */
    private $locationToPlaceIdsReadRepository;
    /**
     * @var LocationRelationFactory
     */
    private $locationRelationFactory;

    public function __construct(
        PlaceReadRepository $placeReadRepository,
        LocationToPlaceIdsReadRepository $locationToPlaceIdsReadRepository,
        LocationRelationFactory $locationRelationFactory
    ) {
        $this->placeReadRepository = $placeReadRepository;
        $this->locationToPlaceIdsReadRepository = $locationToPlaceIdsReadRepository;
        $this->locationRelationFactory = $locationRelationFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getByLocation(Location $location)
    {
        $relatedPlacesIds = $this->locationToPlaceIdsReadRepository->getByLocation($location)->getPlaceIds();
        $relatedPlaces = $this->placeReadRepository->getForIds($relatedPlacesIds);
        $relations = [];
        foreach ($relatedPlaces as $relatedPlace) {
            $relations[] = $this->locationRelationFactory->createLocationRelation($location, $relatedPlace);
        }

        return new NearbyPlaces($location, $relations);
    }
}
