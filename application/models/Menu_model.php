<?php

class Menu_model extends CI_Model
{
    protected $table = 'mp_menu';

    /**
     * Get menu and items for user connect
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

    /**
     * Insert menu with items and permissions(user role) by item
     * @param $data
     *
     */
    public function insertWithChild($post)
    {
         echo '<pre>'.print_r($post, true).'</pre>';die;
        $menu = [];
        $menuItem = [];
        $menuItemId = [];
        $menuPermission = [];

        // Insert menu
        $menu['name'] = $post['name'];
        $this->db->insert($this->table, $menu);
        $menu_id = $this->db->insert_id();

        // Insert menu items
        if(isset($post['menu_item']))
        {
            // TODO update for link item
            foreach ($post['menu_item'] as $k => $item)
            {
                $menuItem = [
                    'label' => $item['name'],
                    'sort' => $k,
                    'menu_id' => $menu_id
                ];
                $this->db->insert('mp_menu_item', $menuItem);
                $menuItemId[] = $this->db->insert_id();
            }
        }

        // Insert permission by menu_item
        if(isset($post['menu_permission']))
        {
            foreach ($post['menu_permission'] as $k => $permissions)
            {
                foreach ($permissions as $role_id)
                {
                    $menuPermission = [
                        'role_id' => $role_id,
                        'access' => (int) 1,
                        'menu_item_id' => (isset($menuItemId[$k]) ? (int) $menuItemId[$k] : null)

                    ];

                    $this->db->insert('mp_permission', $menuPermission);
                }
            }
        }
    }
}