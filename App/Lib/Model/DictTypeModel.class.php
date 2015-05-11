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
class DictTypeModel extends Model{
    public $_validate = array(
        array('dtkey', '', '此标识已经存在', self::EXISTS_VALIDATE, 'unique', self::MODEL_BOTH)
    );
}

?>
