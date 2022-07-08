<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // CHECK CUSTOM SESSION DATA
        $this->session_data();
        $enc_code = "";
    }

    public function index()
    {
        $this->home();
    }

    public function verification_code()
    {
        if (!$this->session->userdata('register_email')) {
            redirect(site_url('home/sign_up'), 'refresh');
        }
        $page_data['page_name'] = "verification_code";
        $page_data['page_title'] = site_phrase('verification_code');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function home()
    {
        $page_data['page_name'] = "home";
        $page_data['page_title'] = site_phrase('home');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function shopping_cart()
    {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $page_data['page_name'] = "shopping_cart";
        $page_data['page_title'] = site_phrase('shopping_cart');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    // starting strategy code
    //My Function.... this function is create the customized template function for fabric
    public function new_certificate()
    {
        $this->load->helper('url');
        // if the session is destroy redirect to home page the home() directly calling home page
        if(!$this->session->userdata("user_id")){
            $this->home();
        }
        else{
                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);
                $user_email = $retrieve_data['email'];   
                // loading images   
                $bgimg = $this->crud_model->backgroundimg();
                $logoimg = $this->crud_model->logoimg();   
                $user_bgimg = $this->crud_model->user_bgimg_select($userid,$user_email);
                $user_limg = $this->crud_model->user_limg_select($userid,$user_email);
               //$this->load->vars($bgimg);
                $page_data['user_logo'] = $user_limg;
                $page_data['user_mail'] = $user_email;
                $page_data['user_bgimg'] = $user_bgimg;
                $page_data['loadimg'] = $bgimg;
                $page_data['logo_img'] = $logoimg;
                $page_data['page_name'] = "user_login";
                $page_data['page_title'] = site_phrase('user login');
                $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        }
    }
// navigation link passing
    // generate certificate
    public function gcertificate(){
        if (!$this->session->userdata("user_id")) {
            $this->home();
        }
        else{

            $page_data['page_name'] = "gcertificate";
            $page_data['page_title'] = site_phrase('user login');
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        }
    }
    // mycertificate
    public function my_certificate(){
        if (!$this->session->userdata("user_id")) {
            $this->home();
        }
        else{

            $page_data['page_name'] = "mycertificate";
            $page_data['page_title'] = site_phrase('user login');
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        }
    }

    // identity navigation
    public function identity_certificate(){
        if (!$this->session->userdata("user_id")) {
            $this->home();
        }
        else{
            $page_data['page_name'] = "user_identity";
            $page_data['page_title'] = site_phrase('user login');
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        }
    }
    // uplooad student data function
    public function upload_data(){
        if(!$this->session->userdata("user_id")){
            $this->home();
        }
        else{
            $page_data['page_name'] = "upload_data";
            $page_data['page_title'] = site_url('uploading data');
            $this->load->view('frontend/'.get_frontend_settings('theme').'/index',$page_data);
        }
    }
    /*
     encryption decryption public key and private key  
     then generate user directory  function 
     then create the qr code function
     all in one function
    */
    public function enc_dec_generate(){
        $this->load->helper('security');
        if (!empty($_POST)) {
            if (!$this->session->userdata("user_id")) {
                echo "session destroy";
                $this->home();
            }
            else{
                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);

                //print_r($retrieve_data);
                $re_email = $retrieve_data['email'];
                $data = "hi guys";
                // this line function getting system username
                // $suser = get_current_user();

                $keypair = array(  
                    "digest_alg" => "sha512",  
                    "private_key_bits" => 2048,  
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,  
                );  
                
                $res=openssl_pkey_new($keypair);  
                // Get private key  
                openssl_pkey_export($res, $privkey );  
                // Get public key  
                $pubkey=openssl_pkey_get_details($res);  
                $pubkey=$pubkey["key"]; 

                //print_r($data);
                $tmp_dir = "working_directory/";
                $fileName = "public";
                $fileName1 = "private";
                $hemail = do_hash($re_email);
                file_put_contents($tmp_dir.$hemail."/"."keyfiles/".$fileName.".key",$pubkey);
                file_put_contents($tmp_dir.$hemail."/"."keyfiles/".$fileName1.".key",$privkey);
                $sname = $_POST["sname"];
                $cdate = $_POST['date'];
                $dname = $_POST["dname"];
                $clgname = $_POST["clgname"];
                $sign_name = $_POST['sign_name'];

                $text_enc = $sname.$cdate.$dname.$clgname.$sign_name;
                //echo "completed";
                openssl_public_encrypt($text_enc,$cipher,$pubkey);

                $enc_cipher = base64_encode($cipher);
                // $this->enc_code = $enc_cipher;
                $this->session->set_userdata('encode_data', $enc_cipher);
                echo "qr code generator!!";


            }
        }else{
            echo "no data found";
        }
       
    }
    // download json function
    public function downloadjson(){
        $this->load->helper('security');
        //echo "ok";
       // print_r($_POST);
        /*
        temporary hidding its working code on strategy
        */
        if(!empty($_POST['data'])){
            if (!$this->session->userdata("user_id")) {
                echo "sry session destroyed";
                $this->login();
            }else{
               // echo "ok";
                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);

                //print_r($retrieve_data);
                $re_email = $retrieve_data['email'];
                $re_fname = $retrieve_data['first_name'];
                $re_lname = $retrieve_data['last_name'];
                $data = base64_decode($_POST['data']);
                //$suser = get_current_user();
                //print_r($data);
                $tmp_dir = "working_directory/";
                $fileName = $re_fname.$re_lname;
                $hemail = do_hash($re_email);
                $filecheck = $tmp_dir.$hemail."/"."certificate/".$fileName.".json";
                if (file_exists($filecheck)) {
                    $sysdate = date('h:i:s-d');
                    $fileName = $fileName.$sysdate;
                    echo $fileName;
                    //file_put_contents($tmp_dir.$hemail."/"."certificate/".$fileName1.".json",$data);
                }
                
                    //$fileName = $re_fname.$re_lname;
                file_put_contents($tmp_dir.$hemail."/"."certificate/".$fileName.".json",$data);
                
               
              echo "completed";
            } 
        }
        else {
            echo "No Data Sent";
        }
        

    }
    // download json function end strategy code
    // enc_dec checking code strategy
    /*
        if you check the ecnryption decryption public and private key  checing encrypt 
        and decrypt value just enable now!!
    
    
    public function enc_dec(){
        if (!empty($_POST["text"])) {
            if (!$this->session->userdata("user_id")) {
                echo "session destroyed";
                $this->login();
            }
            else{
                $text = $_POST["text"];
                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);
                $re_email = $retrieve_data['email'];
                $suser = get_current_user();
                $tmp_dir = "/home"."/".$suser."/Documents/working_directory/";
                $hemail = do_hash($re_email);
                $public = file_get_contents($tmp_dir.$hemail."/"."certificate/public.key");
                //print_r($public);
                $private = file_get_contents($tmp_dir.$hemail."/"."certificate/private.key");
                //print_r($private);
                openssl_public_encrypt($text,$cipher,$public);
                // echo $text ."\t\t".base64_encode($cipher);
                openssl_private_decrypt($cipher,$plaintext,$private);
                // echo "<br>";
                // echo $plaintext;

            }

        }
    }
    
   
    public function qrcode(){
         //$this->session->userdata("encode_data");
        //$myPhpVar = "demo";
       include 'assets/phpqrcode/qrlib.php';
        $qrcode = $this->session->userdata("encode_data");
       QRcode::png($qrcode);
    }
        */
    public function qrview(){
        if (!$this->session->userdata("user_id")) {
         echo "sry session destroyed";   
        }
        else{
        //$myPhpVar = $_COOKIE['myJavascriptVar'];
        $this->load->view("frontend/default/qrcode");
        }
    }

    // enc_dec checking code strategy end

    // user detail encode function
    /*
    public function user_detail_encode(){
        if (!empty($_POST)) {
            if (!$this->session->userdata("user_id")) {
                $this->login();
            }
            else{
                $sname = $_POST["sname"];
                $cdate = $_POST['date'];
                $dname = $_POST["dname"];
                $clgname = $_POST["clgname"];
                $sign_name = $_POST['sign_name'];

                $text_enc = $sname.$cdate.$dname.$clgname.$sign_name;
                // first get the email id
                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);
                $re_email = $retrieve_data['email'];

                // next get the public key file
                $suser = get_current_user();
                $tmp_dir = "/home"."/".$suser."/Documents/working_directory/";
                $hemail = do_hash($re_email);
                $public = file_get_contents($tmp_dir.$hemail."/"."certificate/public.key");
                //print_r($public);
                openssl_public_encrypt($text_enc,$cipher,$public);

                $enc_cipher = base64_encode($cipher);
                // $this->enc_code = $enc_cipher;
                $this->session->set_userdata('encode_data', $enc_cipher);
                echo $enc_cipher;

            }
        }
    }
    */
    // user detail encode function end
    // download pdf function strategy code
    /*
    public function downloadpdf(){
        if (!empty($_POST['data'])) {
            
        
            if (!$this->session->userdata("user_id")) {
                $this->login();
            }
            else{

                $userid =  $this->session->userdata('user_id');
                $rolid =  $this->session->userdata("role_id");
                $retrieve_pdf_data = $this->crud_model->download_pdf_data($userid,$rolid);

                $pemail = $retrieve_pdf_data['email'];
                $pfname = $retrieve_pdf_data['first_name'];
                $plname = $retrieve_pdf_data['last_name'];
                $data = base64_decode($_POST['data']);
                $filenamepdf = $pfname.$plname;
                $hemail1 = do_hash($pemail);
                file_put_contents("useraccount/".$hemail1."/".$filenamepdf."pdf",$data);
                echo "completed pdf";

            }

        }
        else{
            echo "no value found";
        }
    }
    */
    // download pdf function strategycode
    public function isLoggedIn()
    {
        if ($this->session->userdata('user_login') == 1){
            echo true;
        }
        else{
            if(isset($_GET['url_history']) && !empty($_GET['url_history'])){
                $this->session->set_userdata('url_history', base64_decode($_GET['url_history']));
            }
            echo false;
        }
    }
    //  user add background image
    public function user_addbgimg(){
      //echo "ok";
      $userid =  $this->session->userdata('user_id');
      $rolid =  $this->session->userdata("role_id");
      $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);
      $re_email = $retrieve_data['email'];
      $hemail = do_hash($re_email);
        // echo $hemail;
        // echo "<br>";
        $config['allowed_types'] = 'jpg|png';
        $config['upload_path'] = './working_directory/'.$hemail.'/backgroundimg'.'/';
        $this->load->library('upload',$config);
        if ($this->upload->do_upload('ubgimg')) {
          //print_r($this->upload->data());
          
          $data['imgname'] =  $this->upload->data('file_name');  
          $data['imgtype'] = 'b';
          $data['userid']  = $userid;
          $data['email'] = $re_email;
          
          $res = $this->crud_model->user_background_img($data);
         if ($res == true) {
            //  echo "insertion successfully";
            $this->new_certificate();
         }
         else{
             print_r($data);
             echo "insertion failed";
         }
        }
        else{
          print_r($this->upload->data());
        }

    }
    // user add background image end
    
    // user add logo
    public function ulogo(){
        $userid =  $this->session->userdata('user_id');
        $rolid =  $this->session->userdata("role_id");
        $retrieve_data = $this->crud_model->download_json_detail($userid,$rolid);
        $re_email = $retrieve_data['email'];
        $hemail = do_hash($re_email);


        $config['allowed_types'] = 'jpg|png|jpeg';
         $config['upload_path'] = './working_directory/'.$hemail.'/logo'.'/';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('ulimg')){
            $data['imgname'] =  $this->upload->data('file_name');  
            $data['imgtype'] = 'l';
            $data['userid']  = $userid;
            $data['email'] = $re_email;

            $result = $this->crud_model->user_logo_add($data);
            if ($result == true) {
               // echo "insertion successfully";
               $this->new_certificate();
            }
            else{
                echo "insertion failed";
            }
        }
        else{
            print_r($this->upload->data());
        }
    }
    // strategy code end
    //Search box ....
    public function search($search_string = "")
    {
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $search_string = $_GET['query'];
            $page_data['courses'] = $this->crud_model->get_courses_by_search_string($search_string)->result_array();
        } else {
            $this->session->set_flashdata('error_message', site_phrase('no_search_value_found'));
            redirect(site_url(), 'refresh');
        }

        if (!$this->session->userdata('layout')) {
            $this->session->set_userdata('layout', 'list');
        }
        $page_data['layout']     = $this->session->userdata('layout');
        $page_data['page_name'] = 'courses_page';
        $page_data['search_string'] = $search_string;
        $page_data['page_title'] = site_phrase('search_results');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    //Footer Section Starts....

    public function about_us()
    {
        $page_data['page_name'] = 'about_us';
        $page_data['page_title'] = site_phrase('about_us');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function terms_and_condition()
    {
        $page_data['page_name'] = 'terms_and_condition';
        $page_data['page_title'] = site_phrase('terms_and_condition');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function refund_policy()
    {
        $page_data['page_name'] = 'refund_policy';
        $page_data['page_title'] = site_phrase('refund_policy');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function privacy_policy()
    {
        $page_data['page_name'] = 'privacy_policy';
        $page_data['page_title'] = site_phrase('privacy_policy');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    public function cookie_policy()
    {
        $page_data['page_name'] = 'cookie_policy';
        $page_data['page_title'] = site_phrase('cookie_policy');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    
    //Footer Section Ends.....
    // Version 1.1
    public function dashboard($param1 = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        if ($param1 == "") {
            $page_data['type'] = 'active';
        } else {
            $page_data['type'] = $param1;
        }

        $page_data['page_name']  = 'instructor_dashboard';
        $page_data['page_title'] = site_phrase('instructor_dashboard');
        $page_data['user_id']    = $this->session->userdata('user_id');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    /**/

    // Version 1.4 codes
    public function login()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'login';
        $page_data['page_title'] = site_phrase('login');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function sign_up()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'sign_up';
        $page_data['page_title'] = site_phrase('sign_up');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function forgot_password()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'forgot_password';
        $page_data['page_title'] = site_phrase('forgot_password');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    
    
    /***  COURSE COMPARE ENDS */

    public function page_not_found()
    {
        $page_data['page_name'] = '404';
        $page_data['page_title'] = site_phrase('404_page_not_found');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }
    
    // CHECK CUSTOM SESSION DATA
    public function session_data()
    {
        // SESSION DATA FOR CART
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        // SESSION DATA FOR FRONTEND LANGUAGE
        if (!$this->session->userdata('language')) {
            $this->session->set_userdata('language', get_settings('language'));
        }
        // session handling in strategynaveen
        // if(empty($this->session->userdata("user_id"))){
        //     $page_data['page_name'] = 'login';
        //     $page_data['page_title'] = site_phrase('login');
        //     $this->session->sess_destroy();
        //     $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        // }
        // strategy works end 
    }
    
    // SETTING FRONTEND LANGUAGE
    public function site_language()
    {
        $selected_language = $this->input->post('language');
        $this->session->set_userdata('language', $selected_language);
        echo true;
    }
}
