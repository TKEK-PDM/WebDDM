<?php
defined('BASEPATH') or exit();

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Download_log extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Download_log/index'));
        $todayval = date('Ymd');
        $data = [];
        $this->layout->view('log/download_log', array(
            'todayval' => $todayval,
            'data' => $data
        ));
    }

    public function search()
    {
        $USER_TYPE = $this->input->post('user_type');
        $DWG_NO = $this->input->post('DRAWING_NO');
        $USER_ID = $this->input->post('USER_ID');
        $USER_NAME = $this->input->post('USER_NAME');
        $DATE = $this->input->post('date');
        $FROM = $this->input->post('fromcal');
        $TO = $this->input->post('tocal');
        $todayval = date('Ymd');
        
        $response = $this->rest->get('Download_logs/index', array(
            'USER_TYPE' => $USER_TYPE,
            'DWG_NO' => $DWG_NO,
            'USER_ID' => $USER_ID,
            'USER_NAME' => $USER_NAME,
            'DATE' => $DATE,
            'FROM' => $FROM,
            'TO' => $TO
        ));
        
        if ($response->status === TRUE) {
            $data = $response->data;
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['DWG_NO'] = $response->DWG_NO;
            $request['USER_ID'] = $response->USER_ID;
            $request['USER_NAME'] = $response->USER_NAME;
            $request['DATE'] = $response->DATE;
            $request['FROM'] = $response->FROM;
            $request['TO'] = $response->TO;
            $keep = TRUE;
        } else {
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['DWG_NO'] = $response->DWG_NO;
            $request['USER_ID'] = $response->USER_ID;
            $request['USER_NAME'] = $response->USER_NAME;
            $request['DATE'] = $response->DATE;
            $request['FROM'] = $response->FROM;
            $request['TO'] = $response->TO;
        }
        
        $this->layout->view('log/download_log', array(
            'data' => is_array($data) ? $data : [],
            'info' => $request,
            'keep' => $keep,
            'todayval' => $todayval
        ));
        
        if ($this->input->get_post('query') == 'export') {
            
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setTitle("export")
                ->setDescription("none");
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Object Id')
                ->setCellValue('B1', 'Class')
                ->setCellValue('C1', 'Dwg No')
                ->setCellValue('D1', 'Revision')
                ->setCellValue('E1', 'User Type')
                ->setCellValue('F1', 'User Id')
                ->setCellValue('G1', 'Sup Code')
                ->setCellValue('H1', 'User Name')
                ->setCellValue('I1', 'Down Date')
                ->setCellValue('J1', 'Down Time');
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle('Download Log');
            
            $i = 2;
            $column = 'A';
            foreach ($data as $key => $val) {
                $num = $i - 1;
                $worksheet->setCellValue($column++ . $i ,$val->OBJECT_ID);
                $worksheet->setCellValue($column++ . $i ,$val->CLASS_ID);
                $worksheet->setCellValue($column++ . $i ,$val->TDM_ID);
                $worksheet->setCellValue($column++ . $i ,$val->REVISION);
                $worksheet->setCellValue($column++ . $i ,$val->USER_TYPE);
                $worksheet->setCellValue($column++ . $i ,$val->USER_ID);
                $worksheet->setCellValue($column++ . $i ,$val->SUP_CODE);
                $worksheet->setCellValue($column++ . $i ,$val->USER_NAME);
                $worksheet->setCellValue($column++ . $i ,$val->DOWN_D);
                $worksheet->setCellValue($column . $i, $val->DOWN_T);
                $column = 'A';
                $i ++;
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Download Log_' . date('Ymd') . '_' . date('His') . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $objWriter->save('php://output');
            exit();
        }
    }
}
