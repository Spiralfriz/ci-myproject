<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public function template($template_name, $vars = array(), $admin = FALSE, $return = FALSE)
    {
        $header = (! $admin) ? 'templates/header' : 'admin/templates/header';
        $footer = (! $admin) ? 'templates/footer' : 'admin/templates/footer';

        if ($return) {
            $content  = $this->view($header, $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view($footer, $vars, $return);
            return $content;
        } else {
            $this->view($header, $vars);
            $this->view($template_name, $vars);
            $this->view($footer, $vars);
        }
    }
}