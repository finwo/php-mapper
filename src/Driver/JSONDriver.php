<?php

namespace Finwo\Mapper\Driver;

class JSONDriver extends AbstractDriver
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
        return json_encode($raw);
    }

    /**
     * {@inheritdoc}
     */
    public function decode($testData)
    {
        return json_decode($testData, true);
    }
}
