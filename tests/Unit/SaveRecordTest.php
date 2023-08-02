<?php

namespace App\Tests\Unit;

use App\Enum\DatabaseTypesEnum;
use App\Factories\DatabaseClientFactory;
use PHPUnit\Framework\TestCase;

class SaveRecordTest extends TestCase
{
    public function testEmptyArgument(): void
    {

    }

    public function testAllClients(): void
    {
        $testRecord = ['id' => 11111111, 'cdate' => '4/21/2023', 'eventName' => 'Something Error'];
        $redisClient = DatabaseClientFactory::create(DatabaseTypesEnum::REDIS);
        $mysqlClient = DatabaseClientFactory::create(DatabaseTypesEnum::MYSQL);
        $postgresClient = DatabaseClientFactory::create(DatabaseTypesEnum::POSTGRES);

        $redisClient->store($testRecord);
        $mysqlClient->store($testRecord);
        $postgresClient->store($testRecord);
    }
}
