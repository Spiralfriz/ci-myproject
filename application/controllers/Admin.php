<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('menu_model');
	}
	
	public function index()
	{
		$data = $this->menu_model->getAll();
		$this->load->template('admin/index', $data, TRUE);
	}
	
	public function dashboard()
	{
		$data = [];
		$this->load->template('admin/dashboard', $data, TRUE);
	}
}
