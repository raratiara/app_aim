<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_order_detail_menu_model extends MY_Model
{
	/* Module */
 	protected $folder_name				= "job_order/job_order_detail_menu";
 	protected $table_name 				= _PREFIX_TABLE."job_order_detail";
 	protected $primary_key 				= "id";

	function __construct()
	{
		parent::__construct();
	}

	// fix
	public function get_list_data()
	{ 
		$aColumns = [
			NULL,
			NULL,
			'dt.id',
			'dt.floating_crane_name',
			'dt.mother_vessel_name',
			'dt.order_name',
			'dt.activity_name',
			'dt.datetime_start',
			'dt.datetime_end',
			'dt.degree',
			'dt.degree_2',
			'dt.total_time'
		];
		
		

		$sIndexColumn = $this->primary_key;
		$sTable = '(select a.*, b.order_name, c.activity_name, d.name as floating_crane_name, e.name as mother_vessel_name
					from job_order_detail a
					left join job_order b on b.id = a.job_order_id
					left join activity c on c.id = a.activity_id
					left join floating_crane d on d.id = b.floating_crane_id
					left join mother_vessel e on e.id = b.mother_vessel_id )dt';
		

		/* Paging */
		$sLimit = "";
		if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
			$sLimit = "LIMIT ".($_GET['iDisplayStart']).", ".
			($_GET['iDisplayLength']);
		}

		/* Ordering */
		$sOrder = "";
		if(isset($_GET['iSortCol_0'])) {
			$sOrder = "ORDER BY  ";
			for ($i=0 ; $i<intval($_GET['iSortingCols']) ; $i++){
				if($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true"){
					$srcCol = $aColumns[ intval($_GET['iSortCol_'.$i])];
					$findme   = ' as ';
					$pos = strpos($srcCol, $findme);
					if ($pos !== false) {
						$pieces = explode($findme, trim($srcCol));
						$sOrder .= trim($pieces[0])."
						".($_GET['sSortDir_'.$i]) .", ";
					} else {
						$sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i])]."
						".($_GET['sSortDir_'.$i]) .", ";
					}
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if($sOrder == "ORDER BY"){
				$sOrder = "";
			}
		}

		/* Filtering */
		$sWhere = " WHERE 1 = 1 ";
		if(isset($_GET['sSearch']) && $_GET['sSearch'] != ""){
			$sWhere .= "AND (";
			foreach ($aColumns as $c) {
				if($c !== NULL){
					$srcCol = $c;
					$findme   = ' as ';
					$pos = strpos($srcCol, $findme);
					if ($pos !== false) {
						$pieces = explode($findme, trim($srcCol));
						$sWhere .= trim($pieces[0])." LIKE '%".($_GET['sSearch'])."%' OR ";
					} else {
						$sWhere .= $c." LIKE '%".($_GET['sSearch'])."%' OR ";
					}
				}
			}

			$sWhere = substr_replace( $sWhere, "", -3);
			$sWhere .= ')';
		}

		/* Individual column filtering */
		for($i=0 ; $i<count($aColumns) ; $i++) {
			if(isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && isset($_GET['sSearch_'.$i]) && $_GET['sSearch_'.$i] != ''){
				if($sWhere == ""){
					$sWhere = "WHERE ";
				} else {
					$sWhere .= " AND ";
				}
				$srcString = $_GET['sSearch_'.$i];
				$findme   = '|';
				$pos = strpos($srcString, $findme);
				if ($pos !== false) {
					$srcKey = "";
					$pieces = explode($findme, trim($srcString));
					foreach ($pieces as $value) {
						if(!empty($srcKey)){
							$srcKey .= ",";
						}
						$srcKey .= "'".$value."'";
					}
					
					$srcCol = $aColumns[$i];
					$findme   = ' as ';
					$pos = strpos($srcCol, $findme);
					if ($pos !== false) {
						$pieces = explode($findme, trim($srcCol));
						$sWhere .= trim($pieces[0])." IN (".$srcKey.") ";
					} else {
						$sWhere .= $aColumns[$i]." IN (".$srcKey.") ";
					}
				} else {
					$srcCol = $aColumns[$i];
					$findme   = ' as ';
					$pos = strpos($srcCol, $findme);
					if ($pos !== false) {
						$pieces = explode($findme, trim($srcCol));
						$sWhere .= trim($pieces[0])." LIKE '%".($srcString)."%' ";
					} else {
						$sWhere .= $aColumns[$i]." LIKE '%".($srcString)."%' ";
					}
				}
			}
		}

		/* Get data to display */
		$filtered_cols = array_filter($aColumns, [$this, 'is_not_null']); // Filtering NULL value
		$sQuery = "
		SELECT  SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $filtered_cols))."
		FROM $sTable
		$sWhere
		$sOrder
		$sLimit
		";
		# echo $sQuery;exit;
		$rResult = $this->db->query($sQuery)->result();

		/* Data set length after filtering */
		$sQuery = "
			SELECT FOUND_ROWS() AS filter_total
		";
		$aResultFilterTotal = $this->db->query($sQuery)->row();
		$iFilteredTotal = $aResultFilterTotal->filter_total;

		/* Total data set length */
		$sQuery = "
			SELECT COUNT(".$sIndexColumn.") AS total
			FROM $sTable
		";
		$aResultTotal = $this->db->query($sQuery)->row();
		$iTotal = $aResultTotal->total;

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		foreach($rResult as $row)
		{
			$detail = "";
			if (_USER_ACCESS_LEVEL_DETAIL == "1")  {
				$detail = '<a class="btn btn-xs btn-success detail-btn" href="javascript:void(0);" onclick="detail('."'".$row->id."'".')" role="button"><i class="fa fa-search-plus"></i></a>';
			}
			$edit = "";
			if (_USER_ACCESS_LEVEL_UPDATE == "1")  {
				$edit = '<a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="edit('."'".$row->id."'".')" role="button"><i class="fa fa-pencil"></i></a>';
			}
			$delete_bulk = "";
			$delete = "";
			if (_USER_ACCESS_LEVEL_DELETE == "1")  {
				$delete_bulk = '<input name="ids[]" type="checkbox" class="data-check" value="'.$row->id.'">';
				$delete = '<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="deleting('."'".$row->id."'".')" role="button"><i class="fa fa-trash"></i></a>';
			}

			array_push($output["aaData"],array(
				$delete_bulk,
				'<div class="action-buttons">
					'.$detail.'
					'.$edit.'
					'.$delete.'
				</div>',
				$row->id,
				$row->floating_crane_name,
				$row->mother_vessel_name,
				$row->order_name,
				$row->activity_name,
				$row->datetime_start,
				$row->datetime_end,
				$row->total_time,
				$row->degree,
				$row->degree_2

			));
		}

		echo json_encode($output);
	}

	// filltering null value from array
	public function is_not_null($val){
		return !is_null($val);
	}		

	public function delete($id= "") {
		if (isset($id) && $id <> "") {
			//$this->db->trans_off(); // Disable transaction
			$this->db->trans_start(); // set "True" for query will be rolled back
			$this->db->where([$this->primary_key => $id])->delete($this->table_name);
			$this->db->trans_complete();

			return $rs = $this->db->trans_status();
		} else return null;
	}  

	// delete multi items action
	public function bulk($id= "") {
		if (is_array($id) && count($id)) {
			$err = '';
			foreach ($id as $pid) {
				//$this->db->trans_off(); // Disable transaction
				$this->db->trans_start(); // set "True" for query will be rolled back
				$this->db->where([$this->primary_key => $pid])->delete($this->table_name);
				$this->db->trans_complete();
				$deleted = $this->db->trans_status();
                if ($deleted == false) {
					if(!empty($err)) $err .= ", ";
                    $err .= $pid;
                }
			}
			
			$data = array();
			if(empty($err)){
				$data['status'] = TRUE;
			} else {
				$data['status'] = FALSE;
				$data['err'] = '<br/>ID : '.$err;
			}
			
			return $data;
		} else return null;
	}  

	

	public function add_data($post) { 
		
		$datetime_start = date_create($post['date_time_start']); 
		$datetime_end = date_create($post['date_time_end']); 

		$f_datetime_start = date_format($datetime_start,"Y-m-d H:i:s");
		$f_datetime_end = date_format($datetime_end,"Y-m-d H:i:s");


		/*$timestamp1 = strtotime($f_datetime_start); 
		$timestamp2 = strtotime($f_datetime_end);
  		$diff = abs($timestamp2 - $timestamp1)/(60); //menit*/


  		//GET DURATION CYCLE TIME
		$start = new DateTime($f_datetime_start);
		$end = new DateTime($f_datetime_end); 
		$interval = $start->diff($end);
		// Convert the total duration to hours:minutes:seconds
		$totalHours = ($interval->days * 24) + $interval->h;
		$minutes = $interval->i;
		$seconds = $interval->s;
		// Format as H:i:s (e.g., 50:30:45)
		$duration = sprintf("%02d:%02d:%02d", $totalHours, $minutes, $seconds);
		$diff = $duration;
		//END GET DURATION CYCLE TIME


		
  		$sla = trim($post['sla']);
  		if($diff > $sla){
  			$achieve_sla = 0;
  		}else{
  			$achieve_sla = 1;
  		}

  		$cek_data = $this->db->query("select * from job_order where id = '".$post['job_order']."' and is_active = 1 ")->result();
  		if($cek_data[0]->id != '')
		{
			$data = [
				'job_order_id' 		=> trim($post['job_order']),
				'activity_id' 		=> trim($post['activity']),
				'datetime_start' 	=> $f_datetime_start,
				'datetime_end' 		=> $f_datetime_end,
				'total_time' 		=> $diff,
				'degree' 			=> trim($post['degree']),
				'degree_2' 			=> trim($post['degree_2']),
				'achieve_sla' 		=> $achieve_sla
			];

			$rs = $this->db->insert($this->table_name, $data);

			if($rs){
				$data_order = [
					'datetime_start'	=> $f_datetime_start,
					'datetime_end' 		=> $f_datetime_end,
					'date_time_total' 	=> $diff
				];
				$this->db->update("job_order", $data_order, "id = '".$post['job_order']."'");

				$cek_order_summary = $this->db->query("select * from job_order_summary where job_order_id = '".$post['job_order']."' and activity_id = '".$post['activity']."' ")->result();
				/*$totaltime = $this->db->query("select sum(total_time) as total FROM job_order_detail where job_order_id = '".$post['job_order']."' and activity_id = '".$post['activity']."' ")->result();*/

				// CONVERT each duration to seconds and sum
				$totaltime = $this->db->query("select * from job_order_detail where job_order_id = '".$post['job_order']."' and activity_id = '".$post['activity']."' ")->result();
				foreach ($totaltime as $duration) {
				    list($hours, $minutes, $seconds) = explode(":", $duration->total_time);
				    $totalSeconds += ($hours * 3600) + ($minutes * 60) + $seconds;
				}
				// Convert total seconds back to H:i:s
				$hours = floor($totalSeconds / 3600);
				$minutes = floor(($totalSeconds % 3600) / 60);
				$seconds = $totalSeconds % 60;
				// Format result
				$totalDuration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
				// END CONVERT each duration to seconds and sum

				if(!empty($cek_order_summary[0]->id)){
					//update
					$data2 = [
						'total_date_time' 	=> $totalDuration, //$totaltime[0]->total
						'datetime_end' 		=> $f_datetime_end
					];
					$this->db->update("job_order_summary", $data2, "id = '".$cek_order_summary[0]->id."'");
				}else{
					//insert
					$data2 = [
						'job_order_id' 		=> $post['job_order'],
						'activity_id' 		=> $post['activity'],
						'total_date_time' 	=> $totalDuration, //$totaltime[0]->total
						'datetime_start' 	=> $f_datetime_start,
						'datetime_end' 		=> $f_datetime_end
					];
					$this->db->insert("job_order_summary", $data2);
				}
			}
		}
		else return null;

		

		return $rs;
	}  

	public function edit_data($post) { 

		$datetime_start = date_create($post['date_time_start']); 
		$datetime_end = date_create($post['date_time_end']); 

		$f_datetime_start = date_format($datetime_start,"Y-m-d H:i:s");
		$f_datetime_end = date_format($datetime_end,"Y-m-d H:i:s");


		$timestamp1 = strtotime($f_datetime_start); 
		$timestamp2 = strtotime($f_datetime_end);

  		$diff = abs($timestamp2 - $timestamp1)/(60); //menit
			

  		$sla = trim($post['sla']);
  		if($diff > $sla){
  			$achieve_sla = 0;
  		}else{
  			$achieve_sla = 1;
  		}


		if(!empty($post['id'])){

			$data = [
				'job_order_id' 		=> trim($post['job_order']),
				'activity_id' 		=> trim($post['activity']),
				'datetime_start' 	=> $f_datetime_start,
				'datetime_end' 		=> $f_datetime_end,
				'total_time' 		=> $diff,
				'degree' 			=> trim($post['degree']),
				'degree_2' 			=> trim($post['degree_2']),
				'achieve_sla' 		=> $achieve_sla
			];

			return  $rs = $this->db->update($this->table_name, $data, [$this->primary_key => trim($post['id'])]);
		} else return null;
	}  

	public function getRowData($id) { 
		$mTable = '(select a.*, b.order_name, c.activity_name, d.sla from job_order_detail a
					left join job_order b on b.id = a.job_order_id
					left join activity c on c.id = a.activity_id
                    left join sla d on d.activity_id = a.activity_id  
			)dt';

		$rs = $this->db->where([$this->primary_key => $id])->get($mTable)->row();
		
		/*if(!empty($rs->provinsi_id)){
			$ri = $this->db->select('name as parent_title')->where([$this->primary_key => $rs->provinsi_id])->get($this->table_name)->row();
			$rs = (object) array_merge((array) $rs, (array) $ri);
		} else {
			$rs = (object) array_merge((array) $rs, ['parent_title'=>'-']);
		}*/
		
		return $rs;
	} 

	public function import_data($list_data)
	{
		$i = 0;

		foreach ($list_data as $k => $v) {
			$i += 1;

			$data = [
				'job_order_id'		=> $v["B"],
				'activity_id' 		=> $v["C"],
				'datetime_start' 	=> $v["D"],
				'datetime_end' 		=> $v["E"],
				'total_time' 		=> $v["F"],
				'degree' 			=> $v["G"],
				'degree_2' 			=> $v["H"]
				
			];

			$rs = $this->db->insert($this->table_name, $data);
			if (!$rs) $error .=",baris ". $v["A"];
		}

		return $error;
	}

	public function eksport_data()
	{
		$sql = "select a.*, b.order_name, c.activity_name, d.name as floating_crane_name, e.name as mother_vessel_name
					from job_order_detail a
					left join job_order b on b.id = a.job_order_id
					left join activity c on c.id = a.activity_id
					left join floating_crane d on d.id = b.floating_crane_id
					left join mother_vessel e on e.id = b.mother_vessel_id
				order by a.id desc
		";

		$res = $this->db->query($sql);
		$rs = $res->result_array();
		return $rs;
	}

}
