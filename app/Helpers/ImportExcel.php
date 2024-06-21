<?php
namespace App\Helpers;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExcel implements ToModel, WithHeadingRow,WithChunkReading,WithBatchInserts
{
    private $collection;

   
    public function batchSize(): int
    {
        return 200;
    }
    
    public function chunkSize(): int
    {
        return 200;
    }
    public function model(array $row)
    {
        $this->collection[] = $row;
    }

    public function getCollection(){
        return $this->collection;
    }
}
