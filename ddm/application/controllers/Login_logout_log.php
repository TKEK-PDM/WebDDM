<?php
defined('BASEPATH') or exit();

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Login_logout_log extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Login_logout_log/index'));
        $todayval = date('Ymd');
        $data = [];
        $this->layout->view('log/login_logout_log', array(
            'todayval' => $todayval,
            'data' => $data
        ));
    }

    public function search()
    {
        $USER_TYPE = $this->input->post('user_type');
        $USER_ID = $this->input->post('USER_ID');
        $USER_NAME = $this->input->post('USER_NAME');
        $DATE = $this->input->post('date');
        $FROM = $this->input->post('fromcal');
        $TO = $this->input->post('tocal');
        $todayval = date('Ymd');
        
        $response = $this->rest->get('Login_logout_logs/index/', array(
            'USER_TYPE' => $USER_TYPE,
            'USER_ID' => $USER_ID,
            'USER_NAME' => $USER_NAME,
            'DATE' => $DATE,
            'FROM' => $FROM,
            'TO' => $TO
        ));
        
        if ($response->status === TRUE) {
            $data = $response->data;
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['USER_ID'] = $response->USER_ID;
            $request['USER_NAME'] = $response->USER_NAME;
            $request['DATE'] = $response->DATE;
            $request['FROM'] = $response->FROM;
            $request['TO'] = $response->TO;
            $keep = TRUE;
        } else {
            $request['USER_TYPE'] = $response->USER_TYPE;
            $request['USER_ID'] = $response->USER_ID;
            $request['USER_NAME'] = $response->USER_NAME;
            $request['DATE'] = $response->DATE;
            $request['FROM'] = $response->FROM;
            $request['TO'] = $response->TO;
        }
        $this->layout->view('log/login_logout_log', array(
            'data' => $data,
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
                ->setCellValue('A1', 'Seq')
                ->setCellValue('B1', 'User Type')
                ->setCellValue('C1', 'User ID')
                ->setCellValue('D1', 'Sup Code')
                ->setCellValue('E1', 'User Name')
                ->setCellValue('F1', 'Action Type')
                ->setCellValue('G1', 'Action Date')
                ->setCellValue('H1', 'Action Time');
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle('Login-Logout Log');
            
            $i = 2;
            $column = 'A';
            foreach ($data as $key => $val) {
                $num = $i - 1;
                $worksheet->setCellValue($column++ . $i, $val->SEQ);
                $worksheet->setCellValue($column++ . $i, $val->USER_TYPE);
                $worksheet->setCellValue($column++ . $i, $val->USER_ID);
                $worksheet->setCellValue($column++ . $i, $val->SUP_CODE);
                $worksheet->setCellValue($column++ . $i, $val->USER_NAME);
                $worksheet->setCellValue($column++ . $i, $val->ACTION_TYPE);
                $worksheet->setCellValue($column++ . $i, $val->ACTION_DATE);
                $worksheet->setCellValue($column . $i, $val->ACTION_TIME);
                $column = 'A';
                $i ++;
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Login-Logout Log_' . date('Ymd') . '_' . date('His') . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $objWriter->save('php://output');
            exit();
        }
    }
}
