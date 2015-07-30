<?php

/**
 * 作者：anticode
 * 
 * 
 */

/**
 * DictAction
 *
 * @author anticode
 */
class ProductAction extends BaseAction {

    public function index() {
        $this->display();
    }
	
	public function getData() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
	
    $TypeModel = D('ProductView');
    $dataList = $TypeModel->order('pid asc')->limit($offset.','.$rows)->select();
    $this->returnGridData($dataList, $TypeModel->count());
    }
	
	//删除
	public function doupdate() {
		$did = $_GET['uid'];
		$Model = D("Product");
        $Model->where('pid = %d', $did)->delete();
		
		if ($Model->getError()) {
                $this->returnStatus(false, $Model->getError());
        }
		
        $this->returnStatus();
	}
	
	public function comboData() {
        $TypeModel = D('UnitType');
        $list = $TypeModel->select();
        $this->ajaxReturn($list);
    }

	public function doSave() {
        $Model = D("product");
        if (!$Model->create()) {
            $this->returnStatus(false, $Model->getError());
        } else {

                $Model->add();

            if ($Model->getError()) {
                $this->returnStatus(false, $Model->getError());
            }
            $this->returnStatus();
        }
    }
	
	public function doDelete() {

    }
	

}

?>
