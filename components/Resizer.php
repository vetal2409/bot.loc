<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

use Intervention\Image\Constraint;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

/**
 * Class Resizer
 * @package components
 */
class Resizer extends Base
{
    private $fromQueue;
    private $toQueue;

    /**
     * Resizer constructor.
     * @param $config
     * @param IQueue $fromQueue
     * @param IQueue $toQueue
     */
    public function __construct($config, IQueue $fromQueue, IQueue $toQueue)
    {
        parent::__construct($config);
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
        $itemsNumber = 0;
        $manager = new ImageManager(array('driver' => 'imagick'));
        $savePath = realpath($this->config['imagePath']);
        while (($limit === 0 || $limit !== $itemsNumber) && $this->fromQueue->getCount() > 0) {
            $itemsNumber++;
            $queueItem = $this->fromQueue->getItem();
            if (!file_exists($queueItem)) {
                continue;
            }
            $image = $manager->make($queueItem);
            $saveName = $savePath . '/' . $image->filename . '.jpg';
            $width = $widthNew = $this->config['width'];
            $height = $heightNew = $this->config['height'];

            if ($image->getWidth() > $image->getHeight()) {
                $heightNew = null;
            } else {
                $widthNew = null;
            }

            $imageNew = $image
                ->resize($widthNew, $heightNew, function ($constraint) {
                    /**
                     * @var Constraint $constraint
                     */
                    $constraint->aspectRatio();
                })
                ->resizeCanvas($width, $height, 'top-left', false, '#ffffff')
                ->save($saveName);
            if ($imageNew instanceof Image) {
                $this->toQueue->addItem($imageNew->basePath());
                unlink($queueItem);
                $count++;
            }
        }
        return $count;
    }
}
