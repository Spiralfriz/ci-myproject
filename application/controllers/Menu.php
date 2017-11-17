<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
        $this->load->model('user_model');
        $this->load->model('role_model');
	}
	
    public function index()
    {
		$roles = $this->user_model->getRoles($this->user_logged['id']);
	    //	$this->_debug($roles);
		
        // liste, nombre de menu / tableau / actions (add, edit, delete)
        $data['is_super_admin'] = false;
		if(array_key_exists(Role_model::SUPER_ADMIN, $roles)) {
			$data['menu'] = $this->menu_model->getAll();
			$data['is_super_admin'] = (bool) Role_model::SUPER_ADMIN;
		} else {
			$data['menu'] = $this->menu_model->getAll($this->user_logged['id']);
		}
		//$this->_debug($data, 1);
		$this->load->template('admin/menu/list', $data, TRUE); 
    }
    
    public function add()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]|is_unique[mp_menu.name]');

        if (! $this->form_validation->run())
        {
            $data['roles'] = Role_model::getRoles();
            //$this->_debug($data);
            return $this->load->template('admin/menu/add', $data, TRUE);
        }

        $this->menu_model->insertWithChild($this->input->post());

        //$this->_debug($_POST);
        die('form is valide !');
    }
    
    public function edit()
    {
        
    }
    
    public function delete()
    {
        
    }
}