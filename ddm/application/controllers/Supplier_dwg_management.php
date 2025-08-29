<?php
defined('BASEPATH') or exit();

class Supplier_dwg_management extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', base_url('Supplier_dwg_management/index'));
        if ($_POST) {
            
            $sup_code_page = $this->input->post('sup_code');
            $sup_code = strpos(strtoupper($sup_code_page), 'V') === 0 ? substr($sup_code_page, 1) : $sup_code_page;
            $response = $this->rest->get('Dwg_management/index', array(
                'sup_code' => $sup_code
            ));
            $search_message = 0;
            if ($response->status === TRUE) {
                $result = $response->data;
                $search_message = 1;
                $keep = TRUE;
            }
            $sup_name_rsp = $this->rest->get("Drawings/sup_name", array(
                'sup_code' => $sup_code
            ));
            if ($sup_name_rsp->status === TRUE) {
                $sup_name = $sup_name_rsp->data;
            }
        }
        $query_action = $this->input->post('query');
        if ("export" == $query_action) {
            // export excel
           
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setTitle("export")
                ->setDescription("none");
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Dwg No')
                ->setCellValue('B1', 'Revision')
                ->setCellValue('C1', 'Dwg Name(EN)')
                ->setCellValue('D1', 'Dwg Name(KO)')
                ->setCellValue('E1', 'Assign User')
                ->setCellValue('F1', 'Assign Date')
                ->setCellValue('G1', 'Assign Date')
                ->setCellValue('H1', 'Down Date')
                ->setCellValue('I1', 'Down Time')
                ->setCellValue('J1', 'Down Count');
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle('CG Library');
            
            $i = 2;
            $column = 'A';
            $arrResult = array();
            $arrResult = $result;
            foreach ($arrResult as $key => $val) {
                $worksheet->setCellValue($column++ . $i, $val->DWG_NO);
                $worksheet->setCellValue($column++ . $i, $val->REVISION);
                $worksheet->setCellValue($column++ . $i, $val->TDM_DESCRIPTION);
                $worksheet->setCellValue($column++ . $i, $val->CN_LOCAL_DESCRIPTION);
                $worksheet->setCellValue($column++ . $i, $val->CRT_USER);
                $worksheet->setCellValue($column++ . $i, $val->CRT_DATE);
                $worksheet->setCellValue($column++ . $i, $val->CRT_TIME);
                $worksheet->setCellValue($column++ . $i, $val->DOWN_D);
                $worksheet->setCellValue($column++ . $i, $val->DOWN_T);
                $worksheet->setCellValue($column . $i, $val->DOWN_COUNT);
                $column = 'A';
                $i ++;
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Supplier_Dwg_' . date('Ymd') . '_' . date('His') . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $objWriter->save('php://output');
            exit();
        }
        
        $this->layout->view('supplier_dwg_management/index', array(
            'data' => is_array($result) ? $result : [],
            'sup_code' => $sup_code_page,
            'sup_name' => $sup_name,
            'search_message' => $search_message,
            'keep' => $keep
        ));
    }

    public function delete_dwg_supplier()
    {
        $sup_code = $this->input->post('sup_code');
        $dwg_no_str = $this->input->post('dwg_no_str');
        
        $response = $this->rest->get('Dwg_management/delete_dwg_sup', array(
            'sup_code' => $sup_code,
            'dwg_no_str' => $dwg_no_str
        ));
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        echo $result->delete_count;
        exit();
    }

    public function copy_display()
    {
        $sup_code_from = $this->input->post('sup_code_from');
        $sup_name_from = $this->input->post('sup_name_from');
        
        echo $this->load->view('supplier_dwg_management/copy', array(
            'sup_code_from' => $sup_code_from,
            'sup_name_from' => $sup_name_from
        ), true);
        exit();
    }

    public function get_all_suppliers()
    {
        $from_to = $this->input->post('from_to');
        $response = $this->rest->get('Dwg_management/select_suppliers');
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        echo $this->load->view('supplier_dwg_management/suppliers', array(
            'data' => $result,
            'from_to' => $from_to
        ), true);
        exit();
    }

    public function copy_insert()
    {
        $sup_code_from = $this->input->post('sup_code_from');
        $sup_code_to = $this->input->post('sup_code_to');
        $uid = $this->session->uid;
        $response = $this->rest->get('Dwg_management/copy_dwg_supplier', array(
            'sup_code_from' => $sup_code_from,
            'sup_code_to' => $sup_code_to,
            'uid' => $uid
        ));
        if ($response->status === TRUE) {
            $result = $response->data;
        }
        echo $result->copy_count;
        exit();
    }
}