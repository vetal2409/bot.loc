<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class Uploader
 * @package components
 */
class Uploader
{
    private $fromQueue;
    private $toSuccessQueue;
    private $toErrorQueue;

    /**
     * Uploader constructor.
     * @param IQueue $fromQueue
     * @param IQueue $toSuccessQueue
     * @param IQueue $toErrorQueue
     */
    public function __construct(IQueue $fromQueue, IQueue $toSuccessQueue, IQueue $toErrorQueue)
    {
        $this->fromQueue = $fromQueue;
        $this->toSuccessQueue = $toSuccessQueue;
        $this->toErrorQueue = $toErrorQueue;
    }

    /**
     * @param int $limit
     * @param ICloudUploader $cloudUploader
     * @return int
     */
    public function run(ICloudUploader $cloudUploader, $limit = 0)
    {
        $count = 0;
        $itemsNumber = 0;

        while (($limit === 0 || $limit !== $itemsNumber) && $this->fromQueue->getCount() > 0) {
            $itemsNumber++;
            $queueItem = $this->fromQueue->getItem();

            if ($cloudUploader->upload($queueItem)) {
                $this->toSuccessQueue->addItem($queueItem);
                $count++;
            } else {
                $this->toErrorQueue->addItem($queueItem);
            }
        }
        return $count;
    }
}
