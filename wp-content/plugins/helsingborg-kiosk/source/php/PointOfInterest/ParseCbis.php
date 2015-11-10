<?php

namespace HbgKiosk\PointOfInterest;

class ParseCbis
{
    public $path;
    public $csv;
    public $data;

    public function __construct($path)
    {
        $this->path = $path;
        $this->data = $this->getData($this->path);
        var_dump($this->data);
        die();
    }

    /**
     * Parses the CSV-file into array
     * @param  string $path      The csv-file's path
     * @param  string $delimiter The delimiter to use (semicolon by default)
     * @return array             The csv data as an array
     */
    public function getData($path, $delimiter = ';')
    {
        $file = fopen($path, "r");
        $data = array();

        while (!feof($file)) {
            $data[] = fgetcsv($file, null, $delimiter);
        }

        fclose($file);

        array_walk_recursive($data, function (&$value, $key) {
            if (is_string($value)) {
                $value = utf8_encode($value);
            }
        });

        return $data;
    }

    /**
     * Gets the first row (presumably the header)
     * @return array The data in the first row
     */
    public function getHeader()
    {
        return $this->data[0];
    }
}
