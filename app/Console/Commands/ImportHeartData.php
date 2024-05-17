<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HeartData;

class ImportHeartData extends Command
{
    protected $signature = 'import:heartdata';
    protected $description = 'Import heart data from CSV to database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = storage_path('app/HeartAttack.csv');
        $this->info("Reading file from: " . $filePath);
        
        if (!file_exists($filePath)) {
            $this->error("File not found!");
            return 1;
        }

        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $this->info("Processing row: " . implode(', ', $row));
            
            try {
                HeartData::create([
                    'age' => $row[0],
                    'gender' => $row[1],
                    'impulse' => $row[2],
                    'pressurehight' => $row[3],
                    'pressurelow' => $row[4],
                    'glucose' => $row[5],
                    'kcm' => $row[6],
                    'troponin' => $row[7],
                    'class' => $row[8],
                ]);
            } catch (\Exception $e) {
                $this->error("Error inserting row: " . $e->getMessage());
                fclose($file); // Menutup file sebelum mengembalikan
                return 1; // Mengembalikan kode error
            }
        }

        fclose($file);
        $this->info('Data imported successfully.');
        return 0;
    }
}
