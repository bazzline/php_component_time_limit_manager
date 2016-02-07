<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-26 
 */

namespace Net\Bazzline\Component\TimeLimitManager;

/**
 * Interface TimeLimitManagerDependentInterface
 * @package Net\Bazzline\Component\TimeLimitManager
 */
interface TimeLimitManagerDependentInterface
{
    public function injectTimeLimitManager(TimeLimitManager $manager);
} 