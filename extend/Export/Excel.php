<?php
/*
\Export\Excel
*/
namespace Export;

/*
@test
https://demo2.app/AdminApi/Users/ExportExcel
*/
class Excel extends BasePhpSpreadsheet
{
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
}