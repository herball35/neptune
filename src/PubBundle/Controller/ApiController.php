<?php
namespace PubBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PubBundle\Domain\Factory\StringBasedLocationFactory;
use PubBundle\Domain\ReadRepository\NearbyPlacesReadRepository;
use PubBundle\Domain\ValueObject\Location;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Returns a location with nearest pub's list",
     *  requirements = {
     *      {
     *          "name" = "coordinates",
     *          "dataType" = "string",
     *          "requirement" = "/-?([0-9]){1,2}(\.[0-9]{0,8})?,-?([0-9]){1,3}(\.[0-9]{0,8})?/",
     *          "description" = "Latitude and longitude of location for which the list of nearest pub is given, examples: 55.123,12.234 or -80.99,-160.456 "
     *      }
     *  },
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when coordinates have wrong format"
     *  },
     *  headers={
     *      {
     *          "name"="Accept",
     *          "description"="Could be application/json or application/xml"
     *      }
     *  }
     * )
     */
    public function getPubsAction($coordinates)
    {
        /** @var StringBasedLocationFactory $converter */
        $converter = $this->container->get('location.factory.fromCoordinates');
        try {
            $location = $converter->createFromString($coordinates);
        } catch (\InvalidArgumentException $exception) {
            throw new HttpException(400, $exception->getMessage());
        }
        return $this->getPlacesForLocation($location);
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Returns Neptune’s Fountain location with a list of nearest pubs.",
     *  statusCodes = {
     *     200 = "Returned when successful"
     *  },
     *  headers={
     *      {
     *          "name"="Accept",
     *          "description"="Could be application/json or application/xml"
     *      }
     *  }
     * )
     */
    public function getNeptunePubsAction()
    {
        /** @var Location $neptuneLocation */
        $neptuneLocation = $this->container->get('neptune.location');
        return $this->getPlacesForLocation($neptuneLocation);
    }

    private function getPlacesForLocation(Location $location)
    {
        /** @var NearbyPlacesReadRepository $readRepository */
        $readRepository = $this->container->get('place.nearbyPlacesReadRepository');
        $nearbyPlaces = $readRepository->getByLocation($location);
        $view = $this->view($nearbyPlaces,200);
        return $this->handleView($view);
    }
}
