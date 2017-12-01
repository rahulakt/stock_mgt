<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['display_override'] = array(
                                'class'    => 'check_is_loged',
                                'function' => 'check_for_isloged',
                                'filename' => 'check_is_loged.php',
                                'filepath' => 'hooks',
                                );

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */