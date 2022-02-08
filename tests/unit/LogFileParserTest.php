<?php

use App\Modules\LogFileParser;

class LogFileParserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testAddressTotalVisitsCounting()
    {
        $filename = __DIR__.'/../../webserver.log';

        $userData = $this->construct(LogFileParser::class, ['filename' => $filename]);

        $this->assertEquals($userData->getTotalVisits()['/contact'], 89);
    }

    public function testUniqueVisitsArrayOutput()
    {
        $filename = __DIR__.'/../../webserver.log';

        $userData = $this->construct(LogFileParser::class, ['filename' => $filename]);

        $this->assertIsArray($userData->getUniqueVisits());
    }


}
