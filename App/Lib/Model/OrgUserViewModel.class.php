<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * OrgUserViewModel
 *
 * @author anticode
 */
class OrgUserViewModel extends ViewModel {

    protected $viewFields = array(
        'User' => array('uname', 'account', 'mail'),
        'UserOrg' => array('id', '_on' => 'User.uid=UserOrg.uid')
    );

}

?>
