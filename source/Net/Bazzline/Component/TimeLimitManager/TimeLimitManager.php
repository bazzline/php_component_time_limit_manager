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
    private $limitFromIniInSeconds;

    /**
     * @var int
     */
    private $limitInSeconds;

    /**
     * @var int
     */
    private $startTime;

    public function __construct()
    {
        $this->limitFromIniInSeconds = (int) ini_get('max_execution_time');
        $this->setLimitInSeconds($this->limitFromIniInSeconds);
        $this->startTime = time();
    }

    /**
     * @param int $seconds
     */
    public function setBufferInSeconds($seconds)
    {
        $this->bufferInSeconds = (int) $seconds;
    }

    /**
     * @param int $minutes
     */
    public function setBufferInMinutes($minutes)
    {
        $this->setBufferInSeconds((60 * $minutes));
    }

    /**
     * @param int $hours
     */
    public function setBufferInHours($hours)
    {
        $this->setBufferInMinutes((60 * $hours));
    }

    /**
     * @return int
     */
    public function getBufferInSeconds()
    {
        return $this->bufferInSeconds;
    }

    /**
     * @param $seconds
     * @throws InvalidArgumentException
     */
    public function setLimitInSeconds($seconds)
    {
        if ($this->limitFromIniInSeconds > 0) {
            if ($seconds > $this->limitFromIniInSeconds) {
                throw new InvalidArgumentException(
                    'provided limit (' . $seconds .
                    ') is above ini limit (' .
                    $this->limitFromIniInSeconds . ')',
                    1
                );
            }
        }

        $this->limitInSeconds = time() + (int) $seconds;
    }

    /**
     * @param int $minutes
     * @throws InvalidArgumentException
     */
    public function setLimitInMinutes($minutes)
    {
        $this->setLimitInSeconds((60 * $minutes));
    }

    /**
     * @param int $hours
     * @throws InvalidArgumentException
     */
    public function setLimitInHours($hours)
    {
        $this->setLimitInMinutes((60 * $hours));
    }

    /**
     * @return int
     */
    public function getLimitInSeconds()
    {
        return $this->limitInSeconds;
    }


    /**
     * @return bool
     */
    public function isLimitReached()
    {
        $currentTimeWithBuffer = time() + $this->bufferInSeconds;

        $isReached = ($currentTimeWithBuffer >= $this->limitInSeconds);

        return $isReached;
    }
} 