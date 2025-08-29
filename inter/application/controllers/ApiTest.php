<?php
    defined('BASEPATH') or exit('No direct script access allowed');


    class ApiTest extends CI_Controller {

        public function __construct() {
            parent::__construct();
            // 필요한 라이브러리, 헬퍼 로드 가능
            $this->load->helper('url');
            $this->load->helper('form');
        }

        // GET 요청 테스트
        public function index() {
            $data = [
                'status' => 'success',
                'message' => 'GET 요청 테스트 성공',
                'time' => date('Y-m-d H:i:s')
            ];
            // JSON 형태로 응답
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
        }

        // POST 요청 테스트
        public function post_test() {
            // POST 데이터 받기
            $postData = $this->input->post();

            $response = [
                'status' => 'success',
                'received_data' => $postData,
                'message' => 'POST 요청 테스트 성공',
                'time' => date('Y-m-d H:i:s')
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }
?>