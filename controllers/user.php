<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

   /**
   * Contructor function
   */
   function __construct() {
      parent::__construct();
      $this->load->model('usermodel');                 
      $this->load->helper('url');
      //$this->output->enable_profiler(TRUE);
   }

   /**
   * Default class action
   */
   function index() {
      // Request the list from database. This is done by creating an instance of
      $data['user_list'] = $this->usermodel->find();

      $config['base_url'] = site_url('user/');   

      //Generates the overview
      $this->load->view('/user/usergrid', $data);
   }

   /**
   * Prompts user for input and adds a new user entry
   */
   function add() {

      // Check if the user is submitting or not
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
         // User is submitting data
         $data = $this->_get_form_values();

         // Store the values from the form onto the db
         $this->usermodel->add($data['user']);
		 
         //Display overview
         $this->index();
         return true;
      } else {
         // We have to show the user the input form
         $data = $this->_clear_form();
         $data['action'] = 'add';
         $this->load->view('/user/userdetails', $data);
      }
   }
   
   /**
   * Skeleton for testing the add() function  
   */
   function addtest() {
    	/*
        $this->load->library('unit_test');
        $this->load->helper('testdata');
    	
        $_POST['user']['userid'] = generate_testdata();
     	$_POST['user']['username'] = generate_testdata();
     	$_POST['user']['password'] = generate_testdata();
        $_POST["Submit"] = true;
        echo $this->unit->run( $this->add(), 1, 'Add user' );
        */
   }

   /**
   * Prompts user for input and changes an  user entry
   */
   function modify() {

      //Check if the user is submitting or not
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
         // User is submitting data
         $data['action'] = 'modify';
         $data = $this->_get_form_values();

         //Modify  
         $this->usermodel->modify($data['user']['userid'], $data['user']);

         $this->index();
         return true;
      } else {
         // We have to show the user the input form

         $idField = $this->uri->segment(3);

         $data = $this->_clear_form();
         $data['user'] = $this->usermodel->retrieve_by_pkey($idField);
         $data['action'] = 'modify';

         $this->load->model('usermodel');
         $data['user_list'] = $this->usermodel->findAll(0, $this->limit_per_page);  // Send the retrievelist msg

         $this->load->view('/user/userdetails', $data);

      }
   }
   /**
   * Skeleton for testing the modify() function  
   */
   function modifytest() {
     	/*
     	$this->load->library('unit_test');
     	$this->load->helper('testdata');
     	
     	$_POST['user']['userid'] = generate_testdata();
     	$_POST['user']['username'] = generate_testdata();
     	$_POST['user']['password'] = generate_testdata();
     	$_POST["Submit"] = true;
     	echo $this->unit->run( $this->modify(), 1, 'Modify user' );
     	*/
   }
 
  /**
   * Delete an user entry
   */
    function delete() {
      $idField = $this->uri->segment(3);
      $the_results = $this->usermodel->delete_by_pkey($idField);
      $this->index();
   }

   function _clear_form() {
      // Set default values for the form here if you wish.
      $data['user']['userid'] = '';
      $data['user']['username'] = '';
      $data['user']['password'] = '';
      return $data;
   }

   function _get_form_values() {
      $data['user'] = $this->input->post('user');
      return $data;
   }
}
?>