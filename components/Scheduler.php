<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class Scheduler
 * @package components
 */
class Scheduler extends Base
{
    private $toQueue;

    /**
     * Scheduler constructor.
     * @param $config
     * @param IQueue $toQueue
     */
    public function __construct($config, IQueue $toQueue)
    {
        parent::__construct($config);
        $this->toQueue = $toQueue;
    }

    /**
     * @param null|string $imagePath
     * @return int
     */
    public function run($imagePath = null)
    {
        if ($imagePath === null) {
            $imagePath = realpath($this->config['imagePath']);
        }
        $count = 0;
        if (file_exists($imagePath)) {
            $scannedImages = scandir($imagePath);
            if (is_array($scannedImages)) {
                foreach ($scannedImages as $scannedImage) {
                    $imageName = "$imagePath/$scannedImage";
                    $imageType = @exif_imagetype($imageName);
                    if (in_array($imageType, $this->config['allowedTypes'], true)) {
                        $this->toQueue->addItem($imageName);
                        $count++;
                    }
                }
            }
        }
        return $count;
    }
}
