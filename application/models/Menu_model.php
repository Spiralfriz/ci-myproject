<?php

class Menu_model extends CI_Model
{
    protected $table = 'mp_menu';

    /**
     * Récupère le nemu et les items de l'utilisateur connecté
     * @return 
    **/
    public function getAll($user_id = null)
    {
        $cond = ($user_id == null) ? ' u.active = 1' :  ' u.active = 1 AND u.id = '.$user_id;
        
        return $this->db->select('*')
                        ->from($this->table.' m')
                        ->join('mp_menu_item mi', 'mi.menu_id = m.id')
                        ->join('mp_permission p', 'p.menu_item_id = mi.id')
                        ->join('mp_role r', 'r.id = p.role_id ')
                        ->join('mp_user_role ur', 'ur.role_id = r.id')
                        ->join('mp_user u', 'u.id = ur.user_id')
                        ->where($cond)
                        ->order_by('mi.id', 'asc')
                        ->get()
                        ->result();
    }
}