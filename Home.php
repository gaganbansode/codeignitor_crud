<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
function __construct() {
        parent::__construct();
        
         $this->load->model('Dbs');
        
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
			
		$data['slider'] = $this->Dbs->fetch('slider',array('status'=>'1'));
		// echo "<pre>";print_r($data); exit();
		$data['services'] = $this->Dbs->fetch('services',array('status'=>'1'));
		$data['brand'] = $this->Dbs->fetch('brand',array('status'=>'1'));

	
		$this->load->view('index',$data);
	}
	public function about()
	{
		$data['about_us'] = $this->Dbs->fetch_all('about_us');
		
		$this->load->view('about',$data);
		
	}
		public function career()
	{
		$data['job_post'] = $this->Dbs->fetch('job_post',array('status'=>'1'));
		$this->load->view('career',$data);
	}
		public function contact_us()
	{
		$this->load->view('contact-us');
	}
		public function oxiinc_group_project()
	{
		$data['projects'] = $this->Dbs->fetch('projects',array('status'=>'1'));
		$this->load->view('oxiinc-group-projects',$data);
	}
		public function management()
	{
		$this->load->view('management');
	}
		public function product()
	{
		$this->load->view('products');
	}
		public function technologies()
	{
		$this->load->view('technologies');
	}
	public function Contact_us_msg()
	{
		 $this->session->set_flashdata('msg','We got your massage ');
		$this->Dbs->add('contact_us',$_POST);
		
	}
	public function apply_now()
	{
		 // $this->session->set_flashdata('msg','We got your massage ');
			$postData = $_POST;
        
     
        if(!empty($_FILES['photo'])){
        	$exploded = explode('.',$_FILES['photo']['name']);
          $ext = $exploded[count($exploded) - 1]; 
            $uploaddir = 'uploads/';
            $oxiinc=rand().".".$ext;
            $uploadfile = $uploaddir . $oxiinc;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
             
              $postData['photo'] = $oxiinc;
            }
        }
		$this->session->set_flashdata('msg','We got your resume');
		$this->Dbs->add('apply_post',$postData);
		redirect('Career');
		
	}
	public function country($value='')
	{
		$data['country'] = $this->Dbs->fetch_all('countries');
		$this->load->view('country_view',$data);
	}
	function fetch_state($value='')
	{
		$data['projects'] = $this->Dbs->fetch('states',array('country_id'=>$_POST['country_id']));
		echo json_encode($data['projects']);
	}
	function add_data($value='')
	{
		                  $form_data['first_name']='gagan';
		                  $form_data['last_name']='bansode';
                          $api_url = base_url('home/insert_data');
                          $client = curl_init($api_url);
                          curl_setopt($client, CURLOPT_POST, true);
                          curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
                          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                          $response_add = curl_exec($client);
                          // echo ;
                          print_r(json_decode($response_add));
	}
	function insert_data($value='')
	{
		echo json_encode($_REQUEST) ;
	}
}
