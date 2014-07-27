<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-26 
 */

namespace Test\Net\Bazzline\Component\TimeLimitManager;

use Net\Bazzline\Component\TimeLimitManager\TimeLimitManager;
use PHPUnit_Framework_TestCase;

/**
 * Class TimeLimitManagerTest
 * @package Test\Net\Bazzline\Component\TimeLimitManager
 */
class TimeLimitManagerTest extends PHPUnit_Framework_TestCase
{
    public function testLimitSetter()
    {
        $limitInSeconds = 3600;
        $limitInMinutes = 15;
        $limitInHours = 2;

        $manager = $this->getNewManager();

        $expectedLimitInSeconds = (time() + $limitInSeconds);
        $manager->setLimitInSeconds($limitInSeconds);
        $this->assertEquals($expectedLimitInSeconds, $manager->getLimitInSeconds(), 'in seconds');

        $expectedLimitInSeconds = (time() + ($limitInMinutes * 60));
        $manager->setLimitInMinutes($limitInMinutes);
        $this->assertEquals($expectedLimitInSeconds, $manager->getLimitInSeconds(), 'in minutes');

        $expectedLimitInSeconds = (time() + ($limitInHours * 3600));
        $manager->setLimitInHours($limitInHours);
        $this->assertEquals($expectedLimitInSeconds, $manager->getLimitInSeconds(), 'in hours');
    }

    /**
     * @return TimeLimitManager
     */
    private function getNewManager()
    {
        return new TimeLimitManager();
    }
}