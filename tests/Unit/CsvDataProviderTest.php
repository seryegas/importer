<?php

namespace App\Tests\Unit;

use App\Factories\DataProviderFactory;
use App\Services\Providers\DataProviderInterface;
use PHPUnit\Framework\TestCase;

class CsvDataProviderTest extends TestCase
{
    private DataProviderInterface $provider;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->provider = DataProviderFactory::create();
    }

    public function testNotExistedPath(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->provider->readFileData('bbabadbdfd.csv')->rewind();
    }

    public function testEmptyPath(): void
    {
        $this->expectException(\ValueError::class);
        $this->provider->readFileData('')->rewind();
    }

    public function testEmptyFile(): void
    {
        $generator = $this->provider->readFileData(dirname(__DIR__) . '/Fixtures/empty.csv');
        $count = iterator_count($generator);
        $this->assertEquals(0, $count);
        $this->assertIsNotResource($generator->getReturn());
    }

    public function testFileLength(): void
    {
        $count = iterator_count($this->provider->readFileData(dirname(__DIR__) . '/Fixtures/events.csv'));
        $this->assertEquals(100, $count);
    }

    public function testHugeFile(): void
    {
        $generator = $this->provider->readFileData(dirname(__DIR__) . '/Fixtures/hugefile.csv');
        $count = iterator_count($generator);
        $this->assertEquals(1000, $count);
        $this->assertIsNotResource($generator->getReturn());
    }
}
