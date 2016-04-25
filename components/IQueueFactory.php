<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Interface IQueueFactory
 * @package components
 */
interface IQueueFactory
{
    /**
     * @param $name
     * @return IQueue
     */
    public function make($name);
}
