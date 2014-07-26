<?php
/**
 * @author: sleibelt
 * @since: 7/23/14
 */

namespace Net\Bazzline\Component\TimeLimitManager;

/**
 * Class TimeLimitManager
 * @package Net\Bazzline\Component\TimeLimitManager
 */
class TimeLimitManager
{
    /**
     * @var int
     */
    private $bufferInSeconds;

    /**
     * @var int
     */
    private $maximumFromIniInSeconds;

    /**
     * @var int
     */
    private $maximumInSeconds;

    /**
     * @var int
     */
    private $startTime;

    public function __construct()
    {
        $this->maximumFromIniInSeconds = (int) ini_get('max_execution_time');
        $this->setMaximumInSeconds($this->maximumFromIniInSeconds);
        $this->startTime = time();
    }

    /**
     * @param int $bufferInSeconds
     */
    public function setBufferInSeconds($bufferInSeconds)
    {
        $this->bufferInSeconds = (int) $bufferInSeconds;
    }

    /**
     * @return int
     */
    public function getBufferInSeconds()
    {
        return $this->bufferInSeconds;
    }

    /**
     * @param $maximumInSeconds
     * @throws InvalidArgumentException
     */
    public function setMaximumInSeconds($maximumInSeconds)
    {
        if ($maximumInSeconds > $this->maximumFromIniInSeconds) {
            throw new InvalidArgumentException(
                'provided maximum (' . $maximumInSeconds .
                ') is above ini maximum (' .
                $this->maximumFromIniInSeconds . ')'
            );
        }
        $this->maximumInSeconds = time() + (int) $maximumInSeconds;
    }

    /**
     * @return int
     */
    public function getMaximumInSeconds()
    {
        return $this->maximumInSeconds;
    }


    /**
     * @return bool
     */
    public function isLimitReached()
    {
        $currentTimeWithBuffer = time() + $this->bufferInSeconds;

        $isReached = ($currentTimeWithBuffer >= $this->maximumInSeconds);

        return $isReached;
    }
} 