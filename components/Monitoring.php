<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */
namespace components;

/**
 * Class Monitoring
 * @package components
 */
class Monitoring extends Base
{
    public function run()
    {
        echo $this->printHeader();
        $factory = new PheanstalkQueueFactory();
        foreach ($this->config['queues'] as $queueName) {
            $queue = $factory->make($queueName);
            echo $this->printQueueInfo($queue);

        }
        echo $this->printFooter();
    }

    /**
     * @return string
     */
    public function printHeader()
    {
        $result = "********************\n";
        $result .= "Images Processor Bot\n";
        $result .= "\tQueue\t\tCount\n";
        return $result;
    }

    /**
     * @return string
     */
    public function printFooter()
    {
        return "********************\n";
    }

    /**
     * @param IQueue $queue
     * @return mixed
     */
    public function printQueueInfo(IQueue $queue)
    {
        return "\t" . $queue->getName() . "\t\t" . $queue->getCount() . "\n";
    }
}
