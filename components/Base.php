<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class Base
 * @package components
 */
abstract class Base
{
    protected $config;

    /**
     * Base constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }
}
