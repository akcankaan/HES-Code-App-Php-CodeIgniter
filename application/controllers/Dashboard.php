<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $viewFolder = "";
    //public $user;

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "dashboard_v";

        //$this->user = get_active_user();
        

        if(!get_active_user()){
            redirect(base_url("login"));
        }else{
            $this->load->model("user_model");
            $this->load->model("hescodes_model");
        }
    }
    
    public function index(){
	    $viewData = new stdClass();

        $items = $this->hescodes_model->get_all(array());

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->model(array("Province_model"));
        $provinces=$this->Province_model->get_all(array());
        $viewData->provinces=$provinces;

        $this->load->model(array("hescodes_model"));
        $hes_codes=$this->hescodes_model->get_all(array());
        $viewData->hes_codes=$hes_codes;
        
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

    public function generate_hes_code($id) {
        // HES kodunu oluşturun
        $hes_code = substr(mt_rand(), 0, 20);
        
        // HES kodunu veritabanına kaydedin
        $this->load->model("hescodes_model");

        $insert = $this->hescodes_model->add( 
            array(
                'user_id' => $id,
                'hes_code' => $hes_code
            )
        );

        if($insert){
            $last_id = $this->db->insert_id();
             // Kullanıcının HES kodunu güncelleyin
            $this->db->where('id', $id);
            $this->db->update('users', array('hes_code' => $last_id));

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Hes Kodu başarılı bir şekilde oluşturuldu",
                "type"  => "success"
            );
            
        } else {
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Hes Kodu oluşturma sırasında bir problem oluştu",
                "type"  => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("dashboard"));

    }
    
    
    
    
}
