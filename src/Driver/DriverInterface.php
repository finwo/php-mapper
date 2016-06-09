<?php

namespace Finwo\Mapper\Driver;

interface DriverInterface
{
    /**
     * encodeSupport()
     * Checks if the given data is compatible with encoding technique
     * 
     * @param mixed $testData
     *
     * @return boolean
     */
    public function encodeSupport( $testData );

    /**
     * decodeSupport()
     * Checks if the given encoded data is of our type
     *
     * @param string $testData
     *
     * @return boolean
     */
    public function decodeSupport( $testData );

    /**
     * encode()
     * Returns encoded version of the raw data
     *
     * @return string
     */
    public function encode( $raw );

    /**
     * decode()
     * Returns data decoded to assoc array based upon the encoded data
     *
     * @return array
     */
    public function decode( $encoded );
}
