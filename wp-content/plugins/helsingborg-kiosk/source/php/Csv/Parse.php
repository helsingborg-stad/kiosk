<?php

namespace hbgKiosk\Csv;

class Parse
{
    public $path;
    public $csv;
    public $data;

    public function __construct($path)
    {
        $this->path = $path;
        $this->getCsv($this->path);
        die();
    }

    public function getCsv($path)
    {
        $this->csv = file_get_contents($path);
        $this->csv = preg_replace('/(\r\n|\n|\r|\f)/U', ";9 ", $this->csv);
        $this->data = str_getcsv($this->csv);
    }
}
