<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * DictModel
 *
 * @author anticode
 */
class DictModel extends Model{
    public $_validate = array(
        array('typeid', 'require', '类型必须'),
        array('dtValue', 'require', '实际值必须'),
        array('dtText', 'require', '显示值必须')
    );
}

?>
