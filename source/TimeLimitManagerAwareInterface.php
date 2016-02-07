<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-26 
 */

namespace Net\Bazzline\Component\TimeLimitManager;

/**
 * Interface TimeLimitManagerAwareInterface
 * @package Net\Bazzline\Component\TimeLimitManager
 */
interface TimeLimitManagerAwareInterface
{
    /**
     * @return TimeLimitManager $manager
     */
    public function getTimeLimitManager();

    /**
     * @param TimeLimitManager $manager
     */
    public function setTimeLimitManager(TimeLimitManager $manager);
} 