<?php
defined('BASEPATH') or exit();

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Supplier_cg_mapping extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->set_userdata('menu_url', site_url('Supplier_cg_mapping/index'));
        $data = [];
        /*
         * $search_info = $this->rest->get("Cg_suppliers/cg_mapping");
         * if ($search_info->status === TRUE) {
         * $data = $search_info->data;
         * }
         */
        $this->layout->view('cg_mapping/supplier_cg_mapping', array(
            'count' => count($data)
        ));
    }

    public function Add()
    {
        $this->load->view('cg_mapping/supplier_cg_mapping_add');
    }

    public function save()
    {
        // var_dump($this->session->object_id);exit;
        $sup_code = $this->input->get_post('sup_code');
        $sup_name = $this->input->get_post('sup_name');
        $cg = $this->input->get_post('cg');
        $action = $this->input->get_post('action');
        $check_info = $this->rest->get("Cg_suppliers/check_exist", array(
            'sup_code' => $sup_code,
            'cg' => $cg
        ));
        
        $check_cg_info = $this->rest->get("Cg_suppliers/check_cg_exist", array(
            'cg' => $cg
        ));
        
        if (! $check_info || $check_info->status !== TRUE) {
            echo json_encode(array(
                'status' => FALSE,
                'message' => $check_info->message != '' ? '[' . $sup_code . '/ ' . $cg . '] ' . lang('message_already_exist') : $check_info->message,
                'data' => array(
                    'modal_flag' => '1',
                    'sup_code' => $sup_code,
                    'sup_name' => $sup_name,
                    'cg' => $cg
                )
            ));
            exit();
        }
        
        if (! $check_cg_info || $check_cg_info->status !== TRUE) {
            echo json_encode(array(
                'status' => FALSE,
                'message' => lang('message_cg_not_exist') . "<br>" . $cg,
                'data' => array(
                    'modal_flag' => '1',
                    'cg' => $cg
                )
            ));
            exit();
        }
        $save_mapping = $this->rest->get("Cg_suppliers/save_mapping", array(
            'sup_code' => $sup_code,
            'cg' => $cg,
            'object_id' => $this->session->object_id
        ));
        if ($save_mapping->status === TRUE) {
            echo json_encode(array(
                'status' => TRUE,
                'message' => lang('message_save_successfully'),
                'data' => array()
            ));
            exit();
        } else {
            echo json_encode(array(
                'status' => FALSE,
                'message' => lang('message_save_failed'),
                'data' => array()
            ));
            exit();
        }
    }

    public function close()
    {
        redirect('Supplier_cg_mapping/index');
    }

    public function search()
    {
        $this->session->set_userdata('menu_url', site_url('Supplier_cg_mapping/index'));
        $sup_code_page = $this->input->get_post('SUP_CODE');
        $SUP_CODE = strpos(strtoupper($sup_code_page), 'V') === 0 ? substr($sup_code_page, 1) : $sup_code_page;
        $SUP_NAME = $this->input->get_post('SUP_NAME');
        $search_info = $this->rest->get("Cg_suppliers/cg_mapping", array(
            'SUP_CODE' => $SUP_CODE,
            'SUP_NAME' => $SUP_NAME
        ));
        if ($search_info->status === TRUE) {
            $data = $search_info->data;
            $responseresult['SUP_CODE'] = $sup_code_page;
            $responseresult['SUP_NAME'] = $search_info->SUP_NAME;
            $keep = TRUE;
        } else {
            $responseresult['SUP_CODE'] = $sup_code_page;
            $responseresult['SUP_NAME'] = $search_info->SUP_NAME;
        }
        $this->layout->view('cg_mapping/supplier_cg_mapping', array(
            'data' => $data,
            'count' => count($data),
            'info' => $responseresult,
            'keep' => $keep
        ));
        if ($this->input->get_post('query') == 'export') {
           
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setTitle("export")
                ->setDescription("none");
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Sup Code')
                ->setCellValue('B1', 'Sup Name')
                ->setCellValue('C1', 'CG')
                ->setCellValue('D1', 'CG Name');
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle('Supplier-CG Mapping');
            
            $i = 2;
            $column = 'A';
            $arrResult = array();
            $arrResult = $data;
            foreach ($arrResult as $key => $val) {
                $num = $i - 1;
                $worksheet->setCellValue($column++ . $i, $val->SUP_CODE);
                $worksheet->setCellValue($column++ . $i, $val->SUP_NAME);
                $worksheet->setCellValue($column++ . $i, $val->CG);
                $worksheet->setCellValue($column . $i, $val->CG_NAME);
                $column = 'A';
                $i ++;
            }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Supplier-CG_Mapping_' . date('Ymd') . '_' . date('His') . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            
            $objWriter->save('php://output');
            exit();
        }
    }

    public function get_supplier_name()
    {
        $sup_code = $this->input->get_post('sup_code');
        $sup_info = $this->rest->get("Cg_suppliers/supplier_name", array(
            'sup_code' => $sup_code
        ));
        echo json_encode(array(
            'status' => $sup_info->status,
            'message' => $sup_info->message != '' ? $sup_code . ' ' . lang('message_sup_code_not_exist') : $sup_info->message,
            'data' => $sup_info->data
        ));
        exit();
    }

    public function delete()
    {
        $delete_items = $this->input->post('check');
        foreach ($delete_items as $value) {
            $delete_info = explode(",", $value);
            $this->rest->get("Cg_suppliers/delete_mapping", array(
                'sup_code' => $delete_info[0],
                'cg' => $delete_info[1]
            ));
        }
        redirect('Supplier_cg_mapping/search');
    }

    public function import_file()
    {
        $import_type = $this->input->post('radio_import');
        $path = $_FILES['import_file'];
        $filePath = "/tmp/" . $path["name"];
        move_uploaded_file($path["tmp_name"], $filePath);
        // Load Excel file
        $spreadsheet = IOFactory::load($filePath);
        // Get first sheet
        $worksheet = $spreadsheet->getSheet(0);
        // Get Top row
        $topRow = $worksheet->getHighestRow();
        
        $th1 = Coordinate::stringFromColumnIndex(1) . '1';
        $th3 = Coordinate::stringFromColumnIndex(3) . '1';

        if ($worksheet->getCell($th1)->getValue() === 'Sup Code' &&
            $worksheet->getCell($th3)->getValue() === 'CG'){
            
            $record_array = array();    
            $k = 0;
            for ($i = 2; $i <= $topRow; $i ++) {
                $record_array[$k]['sup_code'] = trim($worksheet->getCell(Coordinate::stringFromColumnIndex(1) . $i)->getValue());
                $record_array[$k]['sup_name'] = trim($worksheet->getCell(Coordinate::stringFromColumnIndex(2) . $i)->getValue());
                $record_array[$k]['cg'] = trim($worksheet->getCell(Coordinate::stringFromColumnIndex(3) . $i)->getValue());
                $k ++;
            }
            $check_sup = $this->rest->post("Cg_suppliers/check_sup", array(
                'record' => $record_array
            ));
            if (! $check_sup || $check_sup->status !== TRUE) {
                $this->layout->view('cg_mapping/supplier_cg_mapping', array(
                    'message' => lang('message_no_supplier_exist') . "<br>" . $check_sup->data,
                    'modal_flag' => '1'
                ));
            } else {
                if ($import_type == 'all_add') {
                    $delete_add_form = $this->rest->post("Cg_suppliers/delete_add_form", array(
                        'add_data' => $record_array,
                        'object_id' => $this->session->object_id
                    ));
                    redirect('Supplier_cg_mapping/search');
                } else {
                    $add_cg_mapping = $this->rest->post("Cg_suppliers/add_cg_mapping", array(
                        'record' => $record_array,
                        'object_id' => $this->session->object_id
                    ));
                    redirect('Supplier_cg_mapping/search');
                }
            }

        } else {
            $this->layout->view('cg_mapping/supplier_cg_mapping', array(
                'message' => lang('message_excel_format'),
                'modal_flag' => '1'
            ));
        }
    }
}