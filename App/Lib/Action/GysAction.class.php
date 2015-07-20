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
        $TypeModel = D('UserView');
		$mygys="ustatus>0";
        $dataList = $TypeModel->where($mygys)->order('ustatus desc')->select();
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
