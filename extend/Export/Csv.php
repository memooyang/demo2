<?php
/*
\Export\Csv
*/
namespace Export;

class Csv extends Base
{
    public $file_ext = 'csv';
    
    public function doProcess()
    {
        $this->initDatalist();
        $this->buildFile($this->datalist);
        \Helper\Download\Csv::process($this->url);
        exit;
    }
}