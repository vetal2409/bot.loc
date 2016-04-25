<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Interface ICloudUploader
 * @package components
 */
interface ICloudUploader
{
    /**
     * @param $path
     * @return bool
     */
    public function upload($path);
}
