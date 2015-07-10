<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * UserViewModel
 *
 * @author anticode
 */
class UserViewModel extends ViewModel {

    protected $viewFields = array(
        'User' => array('uid','uname', 'account', 'mail','ustatus','imgfile1','imgfile2','imgfile3','imgfile4','company','telephone','address')
    );

}

?>
