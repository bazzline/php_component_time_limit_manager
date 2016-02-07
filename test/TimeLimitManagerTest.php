<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-26 
 */

namespace Test\Net\Bazzline\Component\TimeLimitManager;

use Net\Bazzline\Component\TimeLimitManager\TimeLimitManager;
use PHPUnit_Framework_TestCase;
use RuntimeException;

/**
 * Class TimeLimitManagerTest
 * @package Test\Net\Bazzline\Component\TimeLimitManager
 */
class TimeLimitManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $initialLimit;

    protected function setUp()
    {
        $this->initialLimit = (int) ini_get('max_execution_time');
    }

    /**
     * @throws RuntimeException
     */
    protected function tearDown()
    {
        $wasNotSet = (ini_set('max_execution_time', $this->initialLimit) === false);

        if ($wasNotSet) {
            throw new RuntimeException(
                'could not restore ini setting max_execution_time with value ' . $this->initialLimit
            );
        }
    }

    public function testLimitSetterAndGetter()
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

    public function testBufferSetterAndGetter()
    {
        $bufferInSeconds = 3600;
        $bufferInMinutes = 15;
        $bufferInHours = 2;

        $manager = $this->getNewManager();

        $expectedBufferInSeconds = $bufferInSeconds;
        $manager->setBufferInSeconds($bufferInSeconds);
        $this->assertEquals($expectedBufferInSeconds, $manager->getBufferInSeconds(), 'in seconds');

        $expectedBufferInSeconds = ($bufferInMinutes * 60);
        $manager->setBufferInMinutes($bufferInMinutes);
        $this->assertEquals($expectedBufferInSeconds, $manager->getBufferInSeconds(), 'in minutes');

        $expectedBufferInSeconds = ($bufferInHours * 3600);
        $manager->setBufferInHours($bufferInHours);
        $this->assertEquals($expectedBufferInSeconds, $manager->getBufferInSeconds(), 'in hours');
    }

    public function testIsLimitReached()
    {
        $manager = $this->getNewManager();
        $manager->setBufferInSeconds(0);
        $manager->setLimitInSeconds(1);

        $this->assertFalse($manager->isLimitReached());

        $manager->setBufferInSeconds(1);
        $this->assertTrue($manager->isLimitReached());
    }

    /**
     * @expectedException \Net\Bazzline\Component\TimeLimitManager\InvalidArgumentException
     * @expectedExceptionMessage provided limit (1000) is above ini limit (100)
     * @expectedExceptionCode 1
     */
    public function testInvalidArgumentProvided()
    {
        if (ini_set('max_execution_time', 100) === false) {
            $this->fail('could not set ini value max_execution_time');
        } else {
            $manager = $this->getNewManager();
            $manager->setLimitInSeconds(1000);
        }
    }

    /**
     * @return TimeLimitManager
     */
    private function getNewManager()
    {
        return new TimeLimitManager();
    }
}
