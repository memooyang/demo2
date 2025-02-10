<?php
/*
\Export\Excel
*/
namespace Export;

/*
@test
https://demo2.app/AdminApi/Users/ExportExcel
@doc
https://phpspreadsheet.readthedocs.io/en/latest/topics/worksheets/
*/
class ExcelQa extends BasePhpSpreadsheet
{
    public function build($table_header = [], $table_body = [], $sheet_name = 'Worksheet')
    {
        //-----
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($this->spreadsheet, $sheet_name);
        $this->spreadsheet->addSheet($myWorkSheet, $this->next_sheet_pos);
        $this->spreadsheet->setActiveSheetIndex($this->next_sheet_pos);
        // $sheet = $this->spreadsheet->getActiveSheet();
        $sheet = $this->spreadsheet->getSheetByName($sheet_name);
        // $sheet->setTitle($sheet_name);
        
        //-----
        foreach($table_header as $i => $text){
            $cell = $this->cells[$i];
            $sheet->setCellValue("{$cell}1", $text);
        }
        
        //-----
        foreach($table_body as $i => $text){
            $cell = $this->cells[$i];
            $sheet->setCellValue("{$cell}2", $text);
        }
        
        $this->next_sheet_pos++;
    }
    
    public function buildWithTop($table_header_top = '', $table_header = [], $table_body = [], $sheet_name = 'Worksheet')
    {
        //-----
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($this->spreadsheet, $sheet_name);
        $this->spreadsheet->addSheet($myWorkSheet, $this->next_sheet_pos);
        $this->spreadsheet->setActiveSheetIndex($this->next_sheet_pos);
        $sheet = $this->spreadsheet->getSheetByName($sheet_name);
        
        //-----
        $cell = $this->cells[0];
        $sheet->setCellValue("{$cell}1", $table_header_top);
        
        //-----
        foreach($table_header as $i => $text){
            $cell = $this->cells[$i];
            $sheet->setCellValue("{$cell}2", $text);
        }
        
        //-----
        foreach($table_body as $i => $text){
            $cell = $this->cells[$i];
            $sheet->setCellValue("{$cell}3", $text);
        }
        
        $this->next_sheet_pos++;
    }
}