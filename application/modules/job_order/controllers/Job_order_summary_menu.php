<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_order_summary_menu extends MY_Controller
{
	/* Module */
 	const  LABELMODULE				= "job_order_summary_menu"; // identify menu
 	const  LABELMASTER				= "Menu Job Order Summary";
 	const  LABELFOLDER				= "job_order"; // module folder
 	const  LABELPATH				= "job_order_summary_menu"; // controller file (lowercase)
 	const  LABELNAVSEG1				= "job_order"; // adjusted 1st sub parent segment
 	const  LABELSUBPARENTSEG1		= "Job Order Summary"; // 
 	const  LABELNAVSEG2				= ""; // adjusted 2nd sub parent segment
 	const  LABELSUBPARENTSEG2		= ""; // 
	
	/* View */
	public $icon 					= 'fa-database';
	public $tabel_header 			= ["ID","Floating Crane","Mother Vessel", "Job Order","Activity", "Total DateTime","Datetime Start","Datetime End"];
	

	/* Export */
	public $colnames 				= ["ID","Floating Crane","Mother Vessel", "Job Order","Activity", "Total DateTime","Datetime Start","Datetime End"];
	public $colfields 				= ["id","floating_crane_name","mother_vessel_name", "order_name", "activity_name", "total_date_time","datetime_start","datetime_end"];

	/* Form Field Asset */
	public function form_field_asset()
	{
		$field = []; 
		
		
		$field['txttotaldatetime'] 	= $this->self_model->return_build_txt('','total_datetime','total_datetime','','','');
		
		$msjob	= $this->db->query("select * from job_order")->result(); 
		$field['seljoborder'] 	= $this->self_model->return_build_select2me($msjob,'','','','job_order','job_order','','','id','order_name',' ','','','',3,'-');
		$msactivity				= $this->db->query("select * from activity")->result(); 
		$field['selactivity'] 	= $this->self_model->return_build_select2me($msactivity,'','','','activity','activity','','','id','activity_name',' ','','','',3,'-');
		

		
		return $field;
	}

	//========================== Considering Already Fixed =======================//
 	/* Construct */
	public function __construct() {
        parent::__construct();
		# akses level
		$akses = $this->self_model->user_akses($this->module_name);
		define('_USER_ACCESS_LEVEL_VIEW',$akses["view"]);
		define('_USER_ACCESS_LEVEL_ADD',$akses["add"]);
		define('_USER_ACCESS_LEVEL_UPDATE',$akses["edit"]);
		define('_USER_ACCESS_LEVEL_DELETE',$akses["del"]);
		define('_USER_ACCESS_LEVEL_DETAIL',$akses["detail"]);
		define('_USER_ACCESS_LEVEL_IMPORT',$akses["import"]);
		define('_USER_ACCESS_LEVEL_EKSPORT',$akses["eksport"]);
    }

	/* Module */
 	public $folder_name				= self::LABELFOLDER."/".self::LABELPATH; // module path
 	public $module_name				= self::LABELMODULE;
 	public $model_name				= self::LABELPATH."_model";

	/* Navigation */
 	public $parent_menu				= self::LABELFOLDER;
 	public $subparent_menu			= self::LABELNAVSEG1;
 	public $subparentitem_menu		= self::LABELNAVSEG2;
 	public $sub_menu 				= self::LABELMODULE;

	/* Label */
 	public $label_parent_modul		= self::LABELFOLDER;
 	public $label_subparent_modul	= self::LABELSUBPARENTSEG1;
 	public $label_subparentitem_modul	= self::LABELSUBPARENTSEG2;
 	public $label_modul				= self::LABELMASTER;
 	public $label_list_data			= "Daftar Data ".self::LABELMASTER;
 	public $label_add_data			= "Tambah Data ".self::LABELMASTER;
 	public $label_update_data		= "Edit Data ".self::LABELMASTER;
 	public $label_sukses_disimpan 	= "Data berhasil disimpan";
 	public $label_gagal_disimpan 	= "Data gagal disimpan";
 	public $label_delete_data		= "Hapus Data ".self::LABELMASTER;
 	public $label_sukses_dihapus 	= "Data berhasil dihapus";
 	public $label_gagal_dihapus 	= "Data gagal dihapus";
 	public $label_detail_data		= "Datail Data ".self::LABELMASTER;
 	public $label_import_data		= "Import Data ".self::LABELMASTER;
 	public $label_sukses_diimport 	= "Data berhasil diimport";
 	public $label_gagal_diimport 	= "Import data di baris : ";
 	public $label_export_data		= "Export";
 	public $label_gagal_eksekusi 	= "Eksekusi gagal karena ketiadaan data";

	//============================== Additional Method ==============================//
}
