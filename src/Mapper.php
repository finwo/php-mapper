<?php

namespace Finwo\Mapper;

use Finwo\Mapper\Driver\JsonDriver;
use Finwo\Mapper\Driver\UrlEncoded;

class Mapper
{
    /**
     * @return DriverHandler
     */
    protected static function getDriverHandler()
    {
        static $dh = null;
        if (is_null($dh)) {
            // Build driver handler & register included drivers
            $dh = new DriverHandler();
            $dh->registerDriver('json', new JsonDriver())
                ->registerDriver('urlencoded', new UrlEncoded());
        }

        return $dh;
    }

    /**
     * @param object|array|string $objectOrString
     * @param object|array        $targetObject
     *
     * @return $this
     */
    public function map($objectOrString, $targetObject = array())
    {
        // Initialize json-mapper
        static $mapper = null;
        if (is_null($mapper)) {
            $mapper = new \JsonMapper();
        }

        // Make the data usable
        /** @var object|array $data */
        $data = $this->getDriverHandler()->deserialize($objectOrString);

        // Map into target
        if (is_array($data)) {
            $class = is_object($targetObject) ? get_class($targetObject) : is_array($targetObject) ? null : "$targetObject";
            return $mapper->mapArray($data, array(), $class);
        } else {
            $mapper->map($data, $targetObject);
        }

        // Bail before things get complicated
        return $this;
    }
}
