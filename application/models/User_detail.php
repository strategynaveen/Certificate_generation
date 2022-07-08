<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class User_detail extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     // Your own constructor code
    //     $this->load->database();
    //     $this->load->library('session');
    //     // $this->load->library('stripe');
    //     /*cache control*/
    //     $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    //     $this->output->set_header('Pragma: no-cache');

    //     // CHECK CUSTOM SESSION DATA
    //     //$this->session_data();
    // }

    public function demo(){
        echo "nk";
    }

    //  // CHECK CUSTOM SESSION DATA
    //  public function session_data()
    //  {
    //      // SESSION DATA FOR CART
    //      if (!$this->session->userdata('cart_items')) {
    //          $this->session->set_userdata('cart_items', array());
    //      }
 
    //      // SESSION DATA FOR FRONTEND LANGUAGE
    //      if (!$this->session->userdata('language')) {
    //          $this->session->set_userdata('language', get_settings('language'));
    //      }
    //  }



}

?>