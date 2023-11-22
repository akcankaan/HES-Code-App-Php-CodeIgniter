<?php

class Virusstatus extends VS_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "virus_status_v";

        $this->load->model("hescodes_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->hescodes_model->get_all(
            array()
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->model(array("virusstatus_model"));
        $virus_status=$this->virusstatus_model->get_all(array());
        $viewData->virus_status=$virus_status;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function isVirusStatus($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url($this->router->fetch_class()));
        }

            $update = $this->hescodes_model->update(
                array(
                    "id"   => $id
                ),
                array(
                    "isVirusStatus" => $this->input->post("isVirusStatus"),
                )
            );
            if($update){
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }
            //İşlemin sonucunu SESSİON' a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("virusstatus"));
    }


}
