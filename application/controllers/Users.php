<?php

class Users extends VS_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "users_v";

        $this->load->model("user_model");

        $this->load->model("user_role_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        $user = get_active_user();

        if(isAdmin()){

            $where = array();

        }else{

            $where = array(
                "id" => $user->id
            );

        }

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->user_model->get_all(
            $where
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        if(!isAllowedWriteModule()){
            redirect(base_url("users"));
        }

        $viewData = new stdClass();

        $this->load->model("user_role_model");

        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->model(array("Province_model"));
        $provinces=$this->Province_model->get_all(array());
        $viewData->provinces=$provinces;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("date_of_birth", "Doğum Tarihi", "required|trim");
        $this->form_validation->set_rules("provinceID", "İl", "required|trim");
        $this->form_validation->set_rules("user_role_id", "Kullanıcı Rolü", "required|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|matches[password]");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz.",
                "is_unique" => "<b>{field}</b> alanı daha önceden kullanılmış",
                "matches" => "Şifreler aynı değil",
            )
        );

        // Form Validation Calistirilir..
        // TRUE - FALSE
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->user_model->add(
                array(
                    "user_name"     => $this->input->post("user_name"),
                    "full_name"     => $this->input->post("full_name"),
                    "date_of_birth"     => $this->input->post("date_of_birth"),
                    "provinceID"          => $this->input->post("provinceID"),
                    "user_role_id"          => $this->input->post("user_role_id"),
                    "email"         => $this->input->post("email"),
                    "password"      => md5($this->input->post("password")),
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                )
            );

            // TODO Alert sistemi eklenecek...
            if($insert){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde eklendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("users"));
            die();

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

        // Başarılı ise
            // Kayit işlemi baslar
        // Başarısız ise
            // Hata ekranda gösterilir...

    }

    public function update_form($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("users"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );

        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->model(array("Province_model"));
        $provinces=$this->Province_model->get_all(array());
        $viewData->provinces=$provinces;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function password_form($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("users"));
        }

        $viewData = new stdClass();
        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        $this->load->library("form_validation");

        $oldUser = $this->user_model->get(
            array(
                "id" => $id
            )
        );

         // Kurallar yazilir..
        if($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        }

        if($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[users.email]");
        }
        
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");

        $this->form_validation->set_rules("user_role_id", "Kullanıcı Rolü", "required|trim");

        $this->form_validation->set_rules("date_of_birth", "Doğum Tarihi", "required|trim");

        $this->form_validation->set_rules("provinceID", "İl", "required|trim");
        
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz.",
                "is_unique" => "<b>{field}</b> alanı daha önceden kullanılmış",
            )
        );
        
       $validate = $this->form_validation->run();



        if($validate){

            $update = $this->user_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "user_name"         => $this->input->post("user_name"),
                    "full_name"   => $this->input->post("full_name"),
                    "email"           => $this->input->post("email"),
                    "date_of_birth"           => $this->input->post("date_of_birth"),
                    "provinceID"          => $this->input->post("provinceID"),
                    "user_role_id"           => $this->input->post("user_role_id"),
                )
            );

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );


            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));

        } else {

            $viewData = new stdClass();

            /** Tablodan Verilerin Getirilmesi.. */
            $item = $this->user_model->get(
                array(
                    "id"    => $id,
                )
            );

            $viewData->user_roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

        // Başarılı ise
        // Kayit işlemi baslar
        // Başarısız ise
        // Hata ekranda gösterilir...

    }  
    
    public function update_password($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        $this->load->library("form_validation");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır",
                "matches"     => "Şifreler birbirlerini tutmuyor"
            )
        );
        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();
        if($validate){
            // Upload Süreci...
            $update = $this->user_model->update(
                array("id" => $id),
                array(
                    "password" => md5($this->input->post("password")),
                )
            );
            // TODO Alert sistemi eklenecek...
            if($update){
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Şifreniz başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Şifre Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }
            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
        } else {
            $viewData = new stdClass();
            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = true;
            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->user_model->get(
                array(
                    "id"    => $id,
                )
            );
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    
    public function delete($id){

        if(!isAllowedDeleteModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        $delete = $this->user_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if($delete){

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde silindi",
                "type"  => "success"
            );

        } else {

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("users"));


    }

    public function isActiveSetter($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->user_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function permissions_form($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("users"));
        }
       
        $viewData = new stdClass();
        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_model->get(
            array(
                "id"    => $id,
            )
        );
                
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "permissions";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_permissions($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url($this->router->fetch_class()));
        }

        $permissions = json_encode($this->input->post("permissions"));

        // Update Süreci...
        $update = $this->user_model->update(
            array("id" => $id),
            array(
                "permissions" => $permissions
            )
        );
        // TODO Alert sistemi eklenecek...
        if($update){
            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Yetki tanımı başarılı bir şekilde güncellendi",
                "type"  => "success"
            );
        } else {
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Yetki tanımı güncelleme sırasında bir problem oluştu",
                "type"  => "error"
            );
        }
        // İşlemin Sonucunu Session'a yazma işlemi...
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("users/permissions_form/$id"));

    }

}
