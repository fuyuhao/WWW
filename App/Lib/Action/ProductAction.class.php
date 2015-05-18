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
        $TypeModel = D('UserView');
        $dataList = $TypeModel->order('uid asc,ustatus asc')->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function doupdate() {
		$did = $_GET['uid'];
		if ($did) {
            $Model = D("User");
			$Model->where('uid = %d', $did)->save(array('ustatus' => 1));

        }
        $this->returnStatus();
		
	}


}

?>
