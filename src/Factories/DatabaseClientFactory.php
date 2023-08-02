<?php

namespace App\Factories;

use App\Enum\DatabaseTypesEnum;
use App\Services\RepositoryClients\MySqlClient;
use App\Services\RepositoryClients\PostgresClient;
use App\Services\RepositoryClients\RedisClient;
use App\Services\RepositoryClients\RepositoryClientInterface;

class DatabaseClientFactory
{
    public static function create(string $database): RepositoryClientInterface
    {
        return match ($database) {
            DatabaseTypesEnum::POSTGRES => new PostgresClient(),
            DatabaseTypesEnum::MYSQL => new MySqlClient(),
            DatabaseTypesEnum::REDIS => new RedisClient(),
            default => null,
        };
    }
}