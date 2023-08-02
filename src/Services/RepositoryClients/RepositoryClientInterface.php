<?php

namespace App\Services\RepositoryClients;

interface RepositoryClientInterface
{
    public function store(array $object): void;
}