<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * RoleUserViewModel
 *
 * @author anticode
 */
class RoleUserViewModel extends ViewModel {

    protected $viewFields = array(
        'User' => array('uname', 'account', 'mail'),
        'RoleUser' => array('uid', '_on' => 'User.uid=RoleUser.uid')
    );

}

?>
