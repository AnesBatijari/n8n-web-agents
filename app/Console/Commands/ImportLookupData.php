<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Location;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class ImportLookupData extends Command
{
    protected $signature = 'import:lookups';
    protected $description = 'Import locations and languages from CSV files';

    public function handle()
    {
        $this->importLocations();
        $this->importLanguages();

        $this->info('Import finished successfully ✅');
    }

    private function importLocations()
    {
        $path = 'import/locations.csv';

        if (!file_exists(storage_path('app/' . $path))) {
            $this->error("locations.csv not found.");
            return;
        }

        $rows = array_map('str_getcsv', file(storage_path('app/' . $path)));
        $header = array_map('trim', array_shift($rows));

        $nameIndex = array_search('location_name', $header);
        $codeIndex = array_search('location_code', $header);

        foreach ($rows as $row) {
            if (!isset($row[$nameIndex], $row[$codeIndex])) continue;

            Location::updateOrCreate(
                ['location_code' => (int)$row[$codeIndex]],
                ['location_name' => trim($row[$nameIndex])]
            );
        }

        $this->info('Locations imported.');
    }

    private function importLanguages()
    {
        $path = 'import/languages.csv';

        if (!file_exists(storage_path('app/' . $path))) {
            $this->error("languages.csv not found.");
            return;
        }

        $rows = array_map('str_getcsv', file(storage_path('app/' . $path)));
        $header = array_map('trim', array_shift($rows));

        $nameIndex = array_search('language_name', $header);
        $codeIndex = array_search('language_code', $header);

        foreach ($rows as $row) {
            if (!isset($row[$nameIndex], $row[$codeIndex])) continue;

            Language::updateOrCreate(
                ['language_code' => strtolower(trim($row[$codeIndex]))],
                ['language_name' => trim($row[$nameIndex])]
            );
        }

        $this->info('Languages imported.');
    }
}
