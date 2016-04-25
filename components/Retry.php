<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class Retry
 * @package components
 */
class Retry
{
    private $fromQueue;
    private $toQueue;

    /**
     * Retry constructor.
     * @param IQueue $fromQueue
     * @param IQueue $toQueue
     */
    public function __construct(IQueue $fromQueue, IQueue $toQueue)
    {
        $this->fromQueue = $fromQueue;
        $this->toQueue = $toQueue;
    }

    /**
     * @param int $limit
     * @return int
     */
    public function run($limit = 0)
    {
        $count = 0;
        while (($limit === 0 || $limit !== $count) && $this->fromQueue->getCount() > 0) {
            $this->toQueue->addItem($this->fromQueue->getItem());
            $count++;
        }
        return $count;
    }
}
