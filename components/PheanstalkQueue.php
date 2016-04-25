<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

use Pheanstalk\Pheanstalk;

/**
 * Class PheanstalkQueue
 * @package components
 */
class PheanstalkQueue implements IQueue
{
    private $name;
    private $provider;

    /**
     * PheanstalkQueue constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->provider = new Pheanstalk('127.0.0.1');
    }

    /**
     * @param $item
     * @return string
     */
    public function addItem($item)
    {
        $this->provider
            ->useTube($this->name)
            ->put($item);
    }

    /**
     * @return string
     */
    public function getItem()
    {
        $job = $this->provider
            ->watch($this->name)
            ->ignore('default')
            ->reserve(0);
        $this->provider->delete($job);
        return $job->getData();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->provider->watch($this->name)->statsTube($this->name)->current_jobs_ready;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
