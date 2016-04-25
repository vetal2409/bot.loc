<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class PheanstalkQueueFactory
 * @package components
 */
class PheanstalkQueueFactory implements IQueueFactory
{
    /**
     * @param $name
     * @return IQueue|PheanstalkQueue
     */
    public function make($name)
    {
        return new PheanstalkQueue($name);
    }
}
