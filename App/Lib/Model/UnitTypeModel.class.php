<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * DictTypeModel
 *
 * @author anticode
 */
class UnitTypeModel extends Model{
    public $_validate = array(
        array('unitname', '', '此单位已经存在', self::EXISTS_VALIDATE, 'unique', self::MODEL_BOTH)
    );
}

?>