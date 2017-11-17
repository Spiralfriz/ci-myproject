<?php

class Role_model extends CI_Model
{
    protected $table = 'mp_role';
    
    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const USER = 3;
    const EDITOR = 4;
    const AUTHOR = 5;
    const CONTRIBUTOR = 6;
    
    public static function getRole($role)
    {
        switch($role)
        {
            case self:SUPER_ADMIN: 
                $res = 'Super Admin';
            break;
            case self:ADMIN: 
                $res ='Admin';
            break;
            case self:USER: 
                $res = 'User';
            break;
            case self:EDITOR: 
                $res = 'Edithor';
            break;
            case self:AUTHOR: 
                $res ='Author';
            break;
            case self:CONTRIBUTOR: 
                $res = 'Contributor';
            break;
            default:
                $res = 'Anonymous';
            break;
        }
        
        return $res;
    }
}