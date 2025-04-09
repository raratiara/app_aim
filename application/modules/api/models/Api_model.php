<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends MY_Model
{
	/* Module */
 	protected $folder_name	= "api/api";
    protected $table 		= "job_order";

	function __construct()
	{
		parent::__construct();
	}
 
    public function register($data)
    {
		$query = $this->db->insert($this->table, $data);

        return $query;
    }

    public function cek_job_order($id)
    {
        $table = "job_order";

        $query = $this->db->where('floating_crane_id', $id)
                ->get($table)
                ->num_rows();
 
        if($query >  0){
            $hasil = $this->db->where('floating_crane_id', $id)
                    ->limit(1)
                    ->get($table)
                    ->row_array();
        } else {
            $hasil = array(); 
        }

        return $hasil;
    }

}
