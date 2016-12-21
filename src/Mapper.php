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
     * @param object|string $objectOrString
     * @param object        $targetObject
     *
     * @return $this
     */
    public function map($objectOrString, $targetObject)
    {
        // Initialize json-mapper
        static $mapper = null;
        if (is_null($mapper)) {
            $mapper = new \JsonMapper();
        }

        // Make the data usable
        $data = $this->getDriverHandler()->deserialize($objectOrString);

        // Map & bail
        $mapper->map($data, $targetObject);
        return $this;
    }
}
