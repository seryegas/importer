<?php

namespace App\Services\Providers;

class CsvDataProvider implements DataProviderInterface
{
    public function readFileData(string $path): \Generator
    {
        try {
            $file = fopen($path, 'rb');
        } catch (\Exception) {
            throw new \RuntimeException();
        }

        while (!feof($file)) {
            $data = fgetcsv($file);

            if ($data && $this->isRowsDataExist($data)) {
                yield $data;
            }
        }

        fclose($file);
    }

    private function isRowsDataExist(array $row): bool
    {
        return implode('', $row) !== '';
    }
}