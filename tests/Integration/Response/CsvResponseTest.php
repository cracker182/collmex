<?php
declare(strict_types=1);

namespace MarcusJaschen\Collmex\Tests\Integration\Response;

use MarcusJaschen\Collmex\Csv\SimpleParser;
use MarcusJaschen\Collmex\Response\CsvResponse;
use MarcusJaschen\Collmex\Response\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test case.
 *
 * @covers \MarcusJaschen\Collmex\Response\CsvResponse
 */
class CsvResponseTest extends TestCase
{
    /**
     * @var SimpleParser
     */
    private $parser = null;

    protected function setUp(): void
    {
        $this->parser = new SimpleParser();
    }

    /**
     * @test
     */
    public function implementsResponseInterface(): void
    {
        $subject = new CsvResponse($this->parser, '');

        self::assertInstanceOf(ResponseInterface::class, $subject);
    }

    /**
     * @test
     */
    public function getResponseRawReturnsUnprocessedResponseBody(): void
    {
        $responseBody = '"Kaiserschmarrn";Pfannkuchen' . "\n" . 'Tee;Kaffee';
        $subject = new CsvResponse($this->parser, $responseBody);

        $result = $subject->getResponseRaw();

        self::assertSame($responseBody, $result);
    }
}
