<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * DictDictTypeViewModel
 *
 * @author anticode
 */
class DictDictTypeViewModel extends ViewModel {

    protected $viewFields = array(
        'Dict' => array('did','dtValue', 'dtText', 'isdefault','isdelete'),
        'DictType' => array('dtName', '_on' => 'Dict.typeid=DictType.id')
    );

}

?>
