<?php
defined('BASEPATH') or exit();

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cg_library extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('cg_library/index'));
        $response = $this->rest->get('Librarys/index');
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        $this->layout->view('library/cg_library', array(
            'data' => $result,
            'count' => count($result)
        ));
        
        if ($this->input->get_post('query') == 'export') {
            
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setTitle("export")
                ->setDescription("none");
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Block')
                ->setCellValue('C1', 'Box')
                ->setCellValue('D1', 'CG')
                ->setCellValue('E1', 'Conponent Group Naming')
                ->setCellValue('F1', 'Pur.')
                ->setCellValue('G1', 'Pur Code')
                ->setCellValue('H1', 'SP')
                ->setCellValue('I1', 'MM');
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle('CG Library');
            
            $i = 2;
            $column = 'A';
            $arrResult = array();
            $arrResult = $result;
            foreach ($arrResult as $key => $val) {
                $num = $i - 1;
                $worksheet->setCellValue($column++ . $i, $num);
                $worksheet->setCellValue($column++ . $i, $val->BLOCK_CODE);
                $worksheet->setCellValue($column++ . $i, $val->BOX_NO);
                $worksheet->setCellValue($column++ . $i, $val->CG);
                $worksheet->setCellValue($column++ . $i, $val->CG_NAME);
                $worksheet->setCellValue($column++ . $i, $val->PUR);
                $worksheet->setCellValue($column++ . $i, $val->PUR_CODE);
                $worksheet->setCellValue($column++ . $i, $val->SP);
                $worksheet->setCellValue($column . $i, $val->MM);
                
                $column = 'A';
                $i ++;
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="CG_Library_' . date('Ymd') . '_' . date('His') . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $objWriter->save('php://output');
            exit();
        }
    }
}