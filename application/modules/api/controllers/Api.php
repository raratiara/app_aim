<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends API_Controller
{
	/* Module */
 	//private $model_name				= "api_model";

   	public function __construct()
	{
      	parent::__construct();

		//$this->load->model($this->model_name);
   	}

    public function index()
    {
        $response = [
            'message' => 'Access denied',
            "error" => 'Not allowed root access.'
            ];

		$this->render_json($response, 400);
		exit;
	}


    public function get_order_id()
    {
    	$bearer_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUSEVfQ0xBSU0iLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE3NDQwODY5MzIsIm5iZiI6MTc0NDA4Njk0MiwiZXhwIjoxNzQ0MDkwNTMyLCJkYXRhIjp7ImlkIjoiMSIsIm5hbWUiOiJEd2kgIiwiZW1haWwiOiJrdXN3YXJub0BnbWFpbC5jb20ifX0.lFA2RNrPCquAs4a-4Kg3z8dNv8t4HGPdxSGslN-4Jqs';			


    	$headers = getallheaders();
    	if (substr($headers['Authorization'], 0, 7) !== 'Bearer ') {
		    echo json_encode(["error" => "Bearer keyword is missing"]);
		    exit;
		}else{
			$token = trim(substr($headers['Authorization'], 7));

			if($token != $bearer_token){
				echo json_encode(["error" => "Token not valid"]);
		    	exit;
			}

		}



    	$jsonData = file_get_contents('php://input');
    	$data = json_decode($jsonData, true);
    	$_REQUEST = $data;

    	$id = $_REQUEST['id'];
    	

		if($id != ''){
			//$cek_data = $this->api->cek_job_order($id);	
			$cek_data = $this->db->query("select * from job_order where floating_crane_id = '".$id."' and is_active = 1 ")->result();

			if($cek_data[0]->id != '')
			{
				
				$data = [
					'id'	=> $cek_data[0]->id
				];

				$response = [
					'status' 	=> 200,
					'message' 	=> 'Success',
					'data' 		=> $data
				];
	
			} else {
				$response = [
					'status' 	=> 401,
					'message' 	=> 'Failed',
					'error' 	=> 'Order ID not found'
				];
			}
			
		} else {
			$response = [
				'status' 	=> 400, // Bad Request
				'message' 	=>'Failed',
				'error' 	=> 'Require not satisfied'
			];
		}
		
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_header('Access-Control-Allow-Methods: POST');
		$this->output->set_header('Access-Control-Max-Age: 3600');
		$this->output->set_header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
		$this->render_json($response, $response['status']);
    }


    public function send_data_cycle_time()
    {
    	$bearer_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUSEVfQ0xBSU0iLCJhdWQiOiJUSEVfQVVESUVOQ0UiLCJpYXQiOjE3NDQwODY5MzIsIm5iZiI6MTc0NDA4Njk0MiwiZXhwIjoxNzQ0MDkwNTMyLCJkYXRhIjp7ImlkIjoiMSIsIm5hbWUiOiJEd2kgIiwiZW1haWwiOiJrdXN3YXJub0BnbWFpbC5jb20ifX0.lFA2RNrPCquAs4a-4Kg3z8dNv8t4HGPdxSGslN-4Jqs';

    	$headers = getallheaders();
    	if (substr($headers['Authorization'], 0, 7) !== 'Bearer ') {
		    echo json_encode(["error" => "Bearer keyword is missing"]);
		    exit;
		}else{
			$token = trim(substr($headers['Authorization'], 7));

			if($token != $bearer_token){
				echo json_encode(["error" => "Token not valid"]);
		    	exit;
			}

		}




    	$jsonData = file_get_contents('php://input');
    	$data = json_decode($jsonData, true);
    	$_REQUEST = $data;



		if(!empty($_REQUEST)){
			$id 			= $_REQUEST['id'];
			$type_activity 	= $_REQUEST['type_activity'];
			$datetime_start = $_REQUEST['datetime_start'];
			$datetime_end 	= $_REQUEST['datetime_end'];
			$cycle_time 	= $_REQUEST['cycle_time'];
			$degree_1 		= $_REQUEST['degree_1'];
			$degree_2 		= $_REQUEST['degree_2'];
			$datetime_send 	= $_REQUEST['datetime_send'];
				
			$cek_data = $this->db->query("select * from job_order where id = '".$id."' and is_active = 1 ")->result();

			if($cek_data[0]->id != '')
			{
				$cek_sla = $this->db->query("select * from sla where activity_id = '".$type_activity."' ")->result();
				$sla = 0;
				if(!empty($cek_sla[0]->sla)){
					$sla = $cek_sla[0]->sla;
				}
				$achieve_sla=1;
				if($cycle_time > $sla){
					$achieve_sla=0;
				}

				$data = [
					'job_order_id' 		=> $id,
					'activity_id' 		=> $type_activity,
					'datetime_start' 	=> $datetime_start,
					'datetime_end'		=> $datetime_end,
					'total_time' 		=> $cycle_time,
					'degree'			=> $degree_1,
					'degree_2'			=> $degree_2,
					'achieve_sla'		=> $achieve_sla,
					'created_at' 		=> $datetime_send
				];

				$rs = $this->db->insert("job_order_detail", $data);
				

				if($rs){
					$cek_order_summary = $this->db->query("select * from job_order_summary where job_order_id = '".$id."' and activity_id = '".$type_activity."' ")->result();
					$totaltime = $this->db->query("select sum(total_time) as total FROM job_order_detail where job_order_id = '".$id."' and activity_id = '".$type_activity."' ")->result();

					if(!empty($cek_order_summary[0]->id)){
						//update
						$data2 = [
							'total_date_time' 	=> $totaltime[0]->total
						];
						$this->db->update("job_order_summary", $data2, "id = '".$cek_order_summary[0]->id."'");
					}else{
						//insert
						$data2 = [
							'job_order_id' 		=> $id,
							'activity_id' 		=> $type_activity,
							'total_date_time' 	=> $totaltime[0]->total
						];
						$this->db->insert("job_order_summary", $data2);
					}

					$response = [
						'status' 	=> 200,
						'message' 	=> 'Success'
					];
				}else{
					$response = [
						'status' 	=> 401,
						'message' 	=> 'Failed',
						'error' 	=> 'Error submit'
					];
				}
	
			} else {
				$response = [
					'status' 	=> 401,
					'message' 	=> 'Failed',
					'error' 	=> 'Order ID not found'
				];
			}
			
		} else {
			$response = [
				'status' 	=> 400, // Bad Request
				'message' 	=>'Failed',
				'error' 	=> 'Require not satisfied'
			];
		}
		
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_header('Access-Control-Allow-Methods: POST');
		$this->output->set_header('Access-Control-Max-Age: 3600');
		$this->output->set_header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
		$this->render_json($response, $response['status']);
    }

    public function tes_insert()
    {
    	$data = [
					'job_order_id' 		=> '1',
					'activity_id' 		=> '6'/*,
					'datetime_start' 	=> $datetime_start,
					'datetime_end'		=> $datetime_end,
					'total_time' 		=> $cycle_time,
					'degree'			=> $degree_1,
					'degree_2'			=> $degree_2,
					'achieve_sla'		=> $achieve_sla,
					'created_at' 		=> $datetime_send*/
				];

		$rs = $this->db->insert("job_order_detail", $data);

		echo $this->db->insert("job_order_detail", $data); die();

    }

    public function tes_insert_json(){
    	$jsonData = file_get_contents('php://input');
    	$data = json_decode($jsonData, true);
    	$_REQUEST = $data;

    	$id 			= $_REQUEST['id'];
		$type_activity 	= $_REQUEST['type_activity'];

    	$data = [
					'job_order_id' 		=> $id,
					'activity_id' 		=> $type_activity
					
				];

		$rs = $this->db->insert("job_order_detail", $data);

		if($rs){
			$response = [
						'status' 	=> 200,
						'message' 	=> 'Success'
					];
		}else{
			$response = [
						'status' 	=> 401,
						'message' 	=> 'Failed',
						'error' 	=> 'Error submit'
					];
		}


		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_header('Access-Control-Allow-Methods: POST');
		$this->output->set_header('Access-Control-Max-Age: 3600');
		$this->output->set_header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
		$this->render_json($response, $response['status']);


    }


}
