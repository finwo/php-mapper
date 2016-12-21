<?php

namespace Finwo\Mapper\Driver;

class UrlEncoded extends AbstractDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function encodeSupport($testData)
    {
        // TODO: implement proper testing
        try {
            $this->encode($testData);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function decodeSupport($testData)
    {
        // TODO: implement proper testing
        try {
            $this->decode($testData);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function encode($raw)
    {
        return http_build_query($raw);
    }

    /**
     * {@inheritdoc}
     */
    public function decode($testData)
    {
        return parse_str($testData);
    }
}
