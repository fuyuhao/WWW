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
	$uname = $_POST['company'];
	$company = $_POST['telname'];
	$telephone = $_POST['telephone'];
	$address = $_POST['address'];
	$mail = $_POST['email'];
	//$this->assign('account',$account);
	//$this->assign('password',$password);
	
	if(!$upload->upload()) {
	$this->error($upload->getErrorMsg());
	}else{ 
	$info =  $upload->getUploadFileInfo();
	}
	
	$file = M("User");
	
	$mywin="account=".$account;
	$data = $file->where($mywin)->find();
	if (empty($data)) {

	}else{
		$this->error("用户名已存在！");
	}
	
	
	if (!$file->create()) {
        $this->returnStatus(false, $file->getError());
    } else {
		$file->account=$account;
		$file->uname=$uname;
		$file->password=pwdHash($password);
		$file->company=$company;
		$file->telephone=$telephone;
		$file->address=$address;
		$file->mail=$mail;
		
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