<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    protected $user_logged = null;
    
    public function __construct()
    {
       	parent::__construct();
        $this->_checkAuth();
        
        // tests
       	$this->user_logged['id'] = 1;
       	$this->user_logged['roles'] = ['SUPER_ADMIN', 'USER', 'EDITOR'];
    }
    
    private function _checkAuth()
    {
        //$this->user_logged = $this->session->all_userdata();
        //echo '<pre>'.print_r($this->user_logged).'</pre>';die;
    }
    
    protected function _profiler()
    {
        $this->output->enable_profiler(TRUE);
    }
    
    protected function _debug($data, $mode = 0)
    {
        if($mode != 0)
        {
            var_dump($data);die;
        }
        
        echo '<pre>'.print_r($data, true).'</pre>';die;
    }
}