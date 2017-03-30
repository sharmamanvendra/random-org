<?php

namespace Odan\Test;

use Odan\Random\RandomOrgClient;
use PHPUnit\Framework\TestCase;

/**
 * Base36Test
 *
 * @coversDefaultClass \Odan\Random\RandomOrgClient
 */
class Base36Test extends TestCase
{

    protected $apiKey = 'cedfd156-3c49-4aaa-9e5e-0cf9a5a81b1e';

    /**
     * Test.
     *
     * @covers ::generateIntegers
     * @covers ::encodeJson
     * @covers ::decodeJson
     * @covers ::setTimelimit
     * @covers ::call
     * @covers ::generateDecimalFractions
     * @covers ::generateGaussians
     * @covers ::generateStrings
     * @covers ::generateUUIDs
     * @covers ::generateBlobs
     * @covers ::getUsage
     * @covers ::setUrl
     * @covers ::post
     * @covers ::encodeUtf8
     */
    public function testAll()
    {
        $random = new RandomOrgClient();
        $random->setApiKey($this->apiKey);

        // Generate 5 true random integers between 1-100
        $integers = $random->generateIntegers(5, 1, 100);
        $this->assertCount(5, $integers);

        // dice
        $integers = $random->generateIntegers(6, 1, 6, false);
        $this->assertCount(6, $integers);

        // binary data
        $integers = $random->generateIntegers(10, 1, 255, true, 2);
        $this->assertCount(10, $integers);

        $decimalNumbers = $random->generateDecimalFractions(1, 2);
        $this->assertCount(1, $decimalNumbers);

        $gaussians = $random->generateGaussians(1, 0, 1, 10);
        $this->assertCount(1, $gaussians);

        $randomStrings = $random->generateStrings(1, 12);
        $this->assertCount(1, $randomStrings);

        $uuids = $random->generateUUIDs(3);
        $this->assertCount(3, $uuids);

        $blobs = $random->generateBlobs(1, 256);
        $this->assertCount(1, $blobs);

        $hexBlobs = $random->generateBlobs(1, 128, 'hex');
        $this->assertCount(1, $hexBlobs);

        $usage = $random->getUsage();
        $this->assertEquals('running', $usage['status']);
    }
}
