<?php

class CsvHandler
{
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function parseCsv() {
        $data = [];
        if (($handle = fopen($this->filePath, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }
}
?>
