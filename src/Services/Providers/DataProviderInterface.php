<?php

namespace App\Services\Providers;

interface DataProviderInterface
{
    public function readFileData(string $path): \Generator;
}