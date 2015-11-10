<?php

namespace HbgKiosk\PointOfInterest;

class ParseCbis
{
    public $path;
    public $csv;
    public $header;
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

        // Save the header information
        $this->header = $this->getHeader($data, true);
        unset($data[0]);

        $modifiedKeys = array();

        // Set keys and utf8-encode
        foreach ($data as $rowKey => $rowData) {
            if (is_array($rowData)) {
                foreach ($rowData as $key => $value) {
                    $key = lcfirst($this->header[$key]);

                    if (is_string($value)) {
                        $value = utf8_encode($value);
                    }

                    $modifiedKeys[$rowKey][$key] = $value;
                }
            }
        }

        $modifiedKeys = json_decode(json_encode($modifiedKeys));
        return $modifiedKeys;
    }

    /**
     * Gets the first row (presumably the header)
     * @param array   $data     The csv data
     * @return array The data in the first row
     */
    public function getHeader($data)
    {
        return $data[0];
    }
}
