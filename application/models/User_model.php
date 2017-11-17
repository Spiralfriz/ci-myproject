<?php

class User_model extends CI_Model {
    
    protected $table = 'mp_user';
    
    public function getRoles($user_id)
    {
        $return = [];
        
        $res =  $this->db->select('r.name, r.id')
                        ->from($this->table.' u')
                        ->join('mp_user_role ur', 'u.id = ur.user_id')
                        ->join('mp_role r', 'r.id = ur.role_id')
                        ->where('u.id = '.$user_id)
                        ->order_by('r.id')
                        ->get()
                        ->result();
       
        foreach($res as $r)
        {
             $return[$r->id] = $r->name;        
        }  
        
        return $return;
    }
}