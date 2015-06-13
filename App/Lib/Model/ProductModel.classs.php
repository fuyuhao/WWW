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
class ProductModel extends Model{
    public $_validate = array(
        array('pname', 'require', '产品名称必须'),
        array('punit', 'require', '产品类型必须')
    );
}

?>