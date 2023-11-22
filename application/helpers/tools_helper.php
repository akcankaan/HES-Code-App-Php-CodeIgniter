<?php

function convertToSEO($text){

    $turkce  = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "=", "(", ")", "[", "]", "{", "}");
    $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

    return strtolower(str_replace($turkce, $convert, $text));

}

function get_active_user() {
    
    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user)
        return $user;
    else
        return false;
}

function isAdmin(){

    $t = &get_instance();
    $user = $t->session->userdata("user");
    return true;
    if($user->user_role=="admin")
        return true;
    else
        return false;

}


function get_user_roles(){

    $t = &get_instance();
    return $t->session->userdata("user_roles");

}

function setUserRoles(){

    $t = &get_instance();

    $t->load->model("user_role_model");

    $user_roles = $t->user_role_model->get_all(
        array(
            "isActive" => 1
        )
    );
    $roles = [];
    foreach($user_roles as $role){
        $roles[$role->id] = $role->permissions;
    }
    $t->session->set_userdata("user_roles", $roles);
}

function getControllerList(){
    $t = &get_instance();

    $controllers = array();
    $t->load->helper("file");

    $files = get_dir_file_info(APPPATH."controllers", FALSE);

    foreach(array_keys($files) as $file){
        if($file !== "index.html"){
            $controllers[] = strtolower(str_replace(".php",'',$file));
        }

    }

    return $controllers;

}

function send_email($toEmail = "", $subject = "", $message = ""){
    $t = &get_instance();

    $t->load->model("emailsettings_model");

    $email_settings = $t->emailsettings_model->get(
        array(
            "isActive" => 1
        )
    );
    $config = array(
        "protocol"  => $email_settings->protocol,
        "smtp_host" => $email_settings->host,
        "smtp_port" => $email_settings->port,
        "smtp_user" => $email_settings->user,
        "smtp_pass" => $email_settings->password,
        "starttls"  => true,
        "charset"   => "utf-8",
        "mailtype"  => "html",
        "wordwrap"  => true,
        "newline"   => "\r\n"
    );
    $t->load->library("email", $config);
    $t->email->from($email_settings->from,$email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);
    return $t->email->send();

}

function province_find($id){
	$t = &get_instance();
	$t->load->model("province_model");
	$data=$t->province_model->get(array("id" => $id,));
	if($data) return $data->provinceName;
	else return "Yok";
}

function hescodes_find($id){
	$t = &get_instance();
	$t->load->model("hescodes_model");
	$data=$t->hescodes_model->get(array("id" => $id,));
	if($data) return $data->hes_code;
	else return "Yok";
}

function virusstatus_find($id){
	$t = &get_instance();
	$t->load->model("virusstatus_model");
	$data=$t->virusstatus_model->get(array("id" => $id,));
	if($data) return $data->virus_status;
	else return "Yok";
}

function user_name_find($id){
	$t = &get_instance();
	$t->load->model("user_model");
	$data=$t->user_model->get(array("id" => $id,));
	if($data) return $data->user_name;
	else return "Yok";
}

function full_name_find($id){
	$t = &get_instance();
	$t->load->model("user_model");
	$data=$t->user_model->get(array("id" => $id,));
	if($data) return $data->full_name;
	else return "Yok";
}