<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

use Dropbox\Client;
use Dropbox\WriteMode;
use Exception;

/**
 * Class DropBoxUploader
 * @package components
 */
class DropBoxUploader implements ICloudUploader
{
    /**
     * @param $path
     * @return bool
     */
    public function upload($path)
    {
        $file = fopen($path, 'rb');
        try {
            $accessToken = 'ZyjO_yCXjJAAAAAAAAAAJxZVs02vjdzos89aZkfcS9RYfQi0Ea4Z-DjZ9YJ-cWsR';
            $dbxClient = new Client($accessToken, 'PHP-Example/1.0');
            $pathExploded = explode('/', $path);
            $name = end($pathExploded);
            $result = $dbxClient->uploadFile("/$name", WriteMode::add(), $file);
            return is_array($result);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        } finally {
            fclose($file);
        }
        return false;
    }
}
