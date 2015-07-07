<?php
class RegisterAction extends Action {

    public function doreg() {
		$this->display();
	}
	
	public function reguser() { 	
	import('@.ORG.Net.UploadFile');
	$upload = new UploadFile();// 实例化上传类
	$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
	
	$account = $_POST['account'];
    $password = $_POST['password'];
	$this->assign('account',$account);
	$this->assign('password',$password);
	
	if(!$upload->upload()) {
	$this->error($upload->getErrorMsg());
	}else{ 
	$info =  $upload->getUploadFileInfo();
	}
	
	$file = M("User");
	if (!$file->create()) {
        $this->returnStatus(false, $file->getError());
    } else {
		$file->account=$account;
		$file->uname=$account;
		$file->password=pwdHash($password);
		$file->mail=$account;
		$file->ustatus=2;
		$file->imgfile1 = $info[0]["savename"];
		$file->imgfile2 = $info[1]["savename"];
		$file->imgfile3 = $info[2]["savename"];
		$file->imgfile4 = $info[3]["savename"];
		$file->add(); 
	}
		$this->display();
	}
}
?>