<?php

namespace App\Factories;

use App\Services\Providers\CsvDataProvider;
use App\Services\Providers\DataProviderInterface;

class DataProviderFactory
{
    public static function create(): DataProviderInterface
    {
        return new CsvDataProvider();
    }
}