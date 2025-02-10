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
https://neohsuxoops.blogspot.com/2020/09/phpspreadsheetphpexcel-xoops.html
*/
class BasePhpSpreadsheet 
{
    //instance
    public $spreadsheet = null;
    public $next_sheet_pos = 0;
    public $file_name = '';
    
    //input
    public $params = array();
    
    //attribute
    public $vars = array();
    public $datalist = array();
    public $instance = array();
    
    //output
    public $cells = array();
    
    //output
    public $result = array();
    
    public function init($params = [])
    {
        $this->params = $params;
        $this->spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        for ($i = 'A'; $i !== 'AC'; $i++){
            // echo $i.', '; //A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, AA, AB,
            $this->cells[] = $i;
        }
        // _j($this->cells);
        $this->file_name = uniqid();
    }
    
    public function save($file_name = '')
    {
        $file_name = ($file_name)?$file_name:$this->file_name;
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->spreadsheet);
        $writer->save($file_name.'.xlsx');
    }
    
    public function download($file_name = '')
    {
        $file_name = ($file_name)?$file_name:$this->file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    
    // public function build($table_header = [], $table_body = [])
    // {
    //     $sheet = $this->spreadsheet->getActiveSheet();
    //     // foreach($table_headers as $i => $text){
    //     //     $sheet->setCellValue('A1', '這是第一格');
    //     // }
    // }
    
    public function build($table_header = [], $table_body = [], $sheet_name = 'Worksheet')
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        foreach($table_header as $i => $text){
            $cell = $this->cells[$i];
            $sheet->setCellValue("{$cell}1", $text);
        }
        $total_header = count($table_header);
        $pos = 2;
        foreach($table_body as $k => $arr){
            for($i=0;$i<$total_header;$i++){
                $cell = $this->cells[$i];
                $text = $arr[$i];
                $sheet->setCellValue("{$cell}{$pos}", $text);
            }
            $pos++;
        }
    }
    
    public function focusFirstSheet()
    {
        $this->spreadsheet->setActiveSheetIndex(0);
    }
    
    public function removeDefaultSheet()
    {
        $this->removeSheet('Worksheet');
    }
    
    public function removeSheet($sheet_name = 'xxx')
    {
        $sheetIndex = $this->spreadsheet->getIndex(
            $this->spreadsheet->getSheetByName($sheet_name)
        );
        $this->spreadsheet->removeSheetByIndex($sheetIndex);
    }
}