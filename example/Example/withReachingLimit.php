<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-07-26 
 */

require_once __DIR__ . '/../../vendor/autoload.php';

echo 'starting example' . PHP_EOL;

$startTime = time();

$manager = new Net\Bazzline\Component\TimeLimitManager\TimeLimitManager();
$manager->setBufferInSeconds(1);
$manager->setLimitInSeconds(9);

$scriptRunTimeInSeconds = 9;

for ($iterator = 0; $iterator < $scriptRunTimeInSeconds; ++$iterator) {
    if ($manager->isLimitReached()) {
        echo 'error - runtime of ' . $manager->getLimitInSeconds() . ' seconds limit reached' . PHP_EOL;
        exit(1);
    }

    $iteratorIsEven = (($iterator % 2) === 0);

    if ($iteratorIsEven) {
        echo 'Tick ' . PHP_EOL;
    } else {
        echo 'Tack ' . PHP_EOL;
    }

    sleep(1);
}

$runTimeInSeconds = (time() - $startTime);

echo 'finished example in ' . $runTimeInSeconds . ' seconds' . PHP_EOL;