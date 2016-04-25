<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Interface IQueue
 * @package components
 */
interface IQueue
{
    /**
     * @param $item
     * @return mixed
     */
    public function addItem($item);

    /**
     * @return mixed
     */
    public function getItem();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getCount();
}
