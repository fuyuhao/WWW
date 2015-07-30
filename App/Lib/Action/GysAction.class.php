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
class GysAction extends BaseAction {

    public function index() {
        $this->display();
    }
	
	public function getData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
        $TypeModel = D('UserView');
		$mygys="ustatus>0";
        $dataList = $TypeModel->where($mygys)->order('ustatus desc')->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function getdetail() {
		$did = $_GET['uid'];
		$TypeModel = D('UserView');
		$condition['uid'] = $did;
		$this->data=$TypeModel->where($condition)->select();
		$this->display();
	}
	
	public function doupdate() {
		$did = $_GET['uid'];
		if ($did) {
            $Model = D("User");
			$Model->where('uid = %d', $did)->save(array('ustatus' => 1));

        }
        $this->returnStatus();
		
	}
	
	public function undocheck(){
		$did = $_GET['uid'];
		if ($did) {
            $Model = D("User");
			$Model->where('uid = %d', $did)->save(array('ustatus' => 2));
        }
		$this->success('弃审成功！','/');
	}


}

?>
