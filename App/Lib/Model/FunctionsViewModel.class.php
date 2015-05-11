<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * FunctionViewModel
 *
 * @author anticode
 */
class FunctionsViewModel extends ViewModel {

    protected $viewFields = array(
        'Functions' => array('fid', 'text', 'resources', 'mid'),
        'Menu' => array('text' => 'relegation', '_on' => 'Menu.mid=Functions.mid')
    );

}

?>
