<?php

namespace Finwo\Mapper;

class Mapper
{
    /**
     * @param $originalData
     * @param $newType
     */
    public function map( $originalData, $newType )
    {
        // Firstly, make sure we're not dealing with strings
        if (is_string($originalData)) {
            $originalData = DriverHandler::deserialize($originalData);
        }

        // Make sure we now have an array or object
        if (!(is_array($originalData)||is_object($originalData))) {
            // Hmm, what to do now
        }

    }
}
