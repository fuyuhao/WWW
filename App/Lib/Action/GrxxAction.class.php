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
class GrxxAction extends BaseAction {

    public function index() {
		$memberInfo = session('member');
		//$this->assign('member', $memberInfo);
		//$memberInfo['uid'] == 0
		$did = $memberInfo['uid'];
		$TypeModel = D('UserView');
		$condition['uid'] = $did;
		$this->data=$TypeModel->where($condition)->select();
        $this->display();
    }
	
	
	public function upimage() {
		$did = $_GET['id'];
		$this->myid=$did;
		$this->display();
	}
	
	public function doupdata() {
	import('@.ORG.Net.UploadFile');
	$upload = new UploadFile();// 实例化上传类
	$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
	
	
	if(!$upload->upload()) {
	$this->error($upload->getErrorMsg());
	}else{ 
	$info =  $upload->getUploadFileInfo();
	}
		
	$myid = $_POST['myid'];
	$memberInfo = session('member');
	$did = $memberInfo['uid'];
	$did="uid=".$did;
	//$this->myid=$did;
	//$this->display();
	
	$file = M("User");
	if($myid==1)
	{
		$file->where($did)->setField('imgfile1',$info[0]["savename"]);
	}
	$this->returnStatus();
	}
	
	public function getData() {
        $TypeModel = D('UserView');
        $dataList = $TypeModel->order('ustatus asc')->select();
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


}

?>
