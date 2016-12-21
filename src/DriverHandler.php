<?php

namespace Finwo\Mapper;

use Finwo\Mapper\Driver\DriverInterface;

class DriverHandler
{
    /**
     * @var array<DriverInterface>
     */
    protected $drivers = array();

    /**
     * @param string          $name
     * @param DriverInterface $driver
     *
     * @return $this
     * @throws \Error
     */
    public function registerDriver($name = '', DriverInterface $driver)
    {
        if (!is_string($name)) {
            throw new \Error("Name is not a string");
        }

        if (isset($this->drivers[$name])) {
            throw new \Error(sprintf("Driver by the name of '%s' already registered.",$name));
        }

        $this->drivers[$name] = $driver;

        return $this;
    }

    /**
     * @param string $input
     * @param string $encoding
     *
     * @return string
     * @throws \Error
     */
    public function deserialize($input = '', $encoding = null)
    {
        // We may not need to deserialize
        if (is_array($input)|is_object($input)) {
            return $input;
        }

        // We might need to detect which encoding to use
        if (is_null($encoding)) {
            foreach ($this->drivers as $name => $driver) {
                if($driver->decodeSupport($input)) {
                    $encoding = $name;
                    break;
                }
            }
        }

        // Decode the data
        if (isset($drivers[$encoding])) {
            return $drivers[$encoding]->decode($input);
        }

        // Or notify we've failed
        throw new \Error("No driver capable of handling data is registered");
    }

    /**
     * @param mixed $data
     * @param null  $encoding
     *
     * @return string
     * @throws \Error
     */
    public function serialize($data, $encoding = null)
    {

        // We might need to detect which encoding to use
        if (is_null($encoding)) {
            foreach ($this->drivers as $name => $driver) {
                if($driver->encodeSupport($data)) {
                    $encoding = $name;
                    break;
                }
            }
        }

        // Decode the data
        if (isset($drivers[$encoding])) {
            return $drivers[$encoding]->encode($data);
        }

        // Or notify we've failed
        throw new \Error("No driver capable of handling data is registered");
    }

}
