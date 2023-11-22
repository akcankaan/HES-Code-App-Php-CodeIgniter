<?php

class Userop extends CI_Controller {

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "users_v";
        $this->load->model("user_model");

    }

    public function login(){

        if(get_active_user()){
            redirect(base_url());
        }

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login(){

        
        if(get_active_user()){
            redirect(base_url());
        }

        $this->load->library("form_validation");
        // Kurallar yazilir..
        
        $this->form_validation->set_rules("user_email", "E-Posta", "required|trim|valid_email");
        $this->form_validation->set_rules("user_password", "Şifre", "required|trim|min_length[6]");
        
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz.",
                "min_length" => "<b>{field}</b> en az 6 karakterden oluşmalıdır"
            )
        );

        // Form Validation Calistirilir..
        if($this->form_validation->run() == FALSE){

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        } else {

            $user = $this->user_model->get(
                array(
                    "email"    => $this->input->post("user_email"),
                    "password" => md5($this->input->post("user_password")),
                    "isActive" => 1
                )
            );

            if($user){ 

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "$user->full_name Hogeldiniz",
                    "type"  => "success"
                );

                /***********Kullanıcı Yetkilerinin Session'a Aktarılması */
                setUserRoles();
                /*************************************** */

                $this->session->set_userdata("user",$user);
                $this->session->set_flashdata("alert", $alert);

                redirect(base_url());

            } else {
                //hata verilecek...

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Lütfen giriş bilgileriniz kontrol ediniz.",
                    "type"  => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
            }

        }

    }

    public function logout(){
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
    }
   
    public function forget_password(){
        if(get_active_user()){
            redirect(base_url());
        }
        $viewData = new stdClass();
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } 

    public function reset_password(){

        $this->load->library("form_validation");

        // Kurallar yazilir..
        
        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email");
                
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email" => "Lütfen geçerli bir <b>e-posta</b> adresi giriniz.",
            )
        );

        if($this->form_validation->run() == FALSE){
            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        } else {

            $user = $this->user_model->get(
                array(
                    "isActive" => 1,
                    "email" => $this->input->post("email")
                )
            );

            if($user){

                $this->load->helper("string");
                $temp_password = random_string();

                $send = send_email($user->email, "Şifremi Unuttum", "Hayat Eve Sığar'a geçici olarak <b>{$temp_password}</b> şifresiyle giriş yapabilirsiniz." );

                if($send){
                    echo "E-posta başarılı bir şekilde gönderilmiştir.";

                    $this->user_model->update(
                        array("id"=>$user->id),
                        array("password"=> md5($temp_password))
                    );

                    $alert = array(
                        "title" => "İşlem Başarılı",
                        "text" => "Şifreniz başarılı bir şekilde resetlendi. Lütfen E-postanızı kontrol ediniz!",
                        "type"  => "success"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                    die();
                }else{
                    //echo $this->email->print_debugger();

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "E-posta gönderilirken bir problem oluştu!!",
                        "type"  => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("sifremi-unuttum"));

                    die();
                }
                


            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Böyle bir kullanıcı bulunamadı!!!",
                    "type"  => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("sifremi-unuttum"));

            }

        }
       
    }

    public function signup(){
        $viewData = new stdClass();
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "signup";

        $this->load->model(array("Province_model"));
        $provinces=$this->Province_model->get_all(array());
        $viewData->provinces=$provinces;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save(){
        $this->load->library("form_validation");
        // Kurallar yazilir..
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("date_of_birth", "Doğum Tarihi", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("provinceID", "İl", "required|trim");
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
                    "date_of_birth"           => $this->input->post("date_of_birth"),
                    "provinceID"          => $this->input->post("provinceID"),
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
            redirect(base_url("login"));
            die();
        } else {
            $viewData = new stdClass();
            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "signup";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
}