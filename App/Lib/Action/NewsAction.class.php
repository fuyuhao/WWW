<?php
class NewsAction extends BaseAction {

    public function postnews() {
		$this->display();
	}
	
	public function addproduct() {
		$this->display();
	}
	
	public function comboData1() {
		$did = $_GET['pid'];
        $TypeModel = D('Product');
        $list = $TypeModel->where('pid = %d', $did)->select();
        $this->ajaxReturn($list);
    }
	
	public function comboData2() {
        $TypeModel = D('Product');
        $list = $TypeModel->select();
        $this->ajaxReturn($list);
    }
	
	public function getData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
        $TypeModel = D('NewsProduct');
		$nid = session('nid');
        $dataList = $TypeModel->join('bt_product ON bt_product.pid=bt_news_product.pid')->where('nid = %d', $nid)->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function doSave() {
			//$nid = session('nid');
		//dump($nid);
	$file = M('NewsProduct');
	$pid = $_POST['bt_product_combobox'];
	$punit = $_POST['bt_unit_combobox'];
	$pcount = $_POST['pcount'];
	$pdetail = $_POST['pdetail'];
	$nid = session('nid');
	
	$TypeModel = D('Product');
	$condition['pid'] = $pid;
	$pname=$TypeModel->where($condition)->getField('pname');
	$file->pname=$pname;
	$file->pid=$pid;
	$file->punit=$punit;
	$file->npcount=$pcount;
	$file->npdetail=$pdetail;
	$file->nid=$nid;
	$file->add();
	$this->returnStatus();
	}
	
	public function donpdel() {
		$npid = $_GET['npid'];
		//dump($npid);
		$Model = D("NewsProduct");
        $Model->where('npid = %d', $npid)->delete();
		$this->returnStatus();
    }
	
	public function save() {
	$file = M('News');
	$mydetail = $_POST['mydetail'];
	$newscontent = $_POST['newscontent'];
	$newsstart = $_POST['newsstart'];
	$newsend = $_POST['newsend'];
	$content=strip_tags($newscontent);
	$file->ntitle=$mydetail;
	$file->ntext=$content;
	$file->nstart=$newsstart;
	$file->nend=$newsend;
	$file->nround="1";
	$file->htext=$newscontent;
	$lastInsId=$file->add(); 
	
	session('nid',$lastInsId);
	}
	
	public function index() {
		$this->display();
	}
	
	public function newsgetData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = D('News');
		//$current  = "unix_timestamp(nstart) < unix_timestamp(NOW()) and unix_timestamp(nend) > unix_timestamp(NOW()) and nid NOT IN (select nid from bt_news_filter where uid=".$uid.")";
		//开始之前就可以看到
		$current  = "unix_timestamp(nend) > unix_timestamp(NOW())";
        $dataList = $TypeModel->where($current)->order("nid desc")->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function getdetail() {
		$nid = $_GET['nid'];
		$TypeModel = D('News');
		$condition['nid'] = $nid;
		$this->data=$TypeModel->where($condition)->select();
		$this->display();
	}
	
	public function addprice() {
		$nid = $_GET['nid'];
		session('nid',$nid);
		
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
		$TypeModel = D('News');
		$current  = "unix_timestamp(nstart) < unix_timestamp(NOW()) and unix_timestamp(nend) > unix_timestamp(NOW()) and nid=".$nid;
		$data = $TypeModel->where($current)->select();
		if (empty($data)) {
			$this->redirect("/news/infail/");
		}
		
		$TypeModel2 = D('NewsFilter');
		$current2  = "nid=".$nid." and uid=".$uid;
		//dump($current2);
		$data2 = $TypeModel2->where($current2)->select();
		if (empty($data2)) {
		}else{
			$this->redirect("/news/infail/");
		}
	
	$this->display();
		
		
	}
	
	public function getPriceData() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('NewsProduct');
		$myprice="bt_news_product.nid=".$nid;
        $dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid and a.uid='.$uid)->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.fapiao'=>'fapiao','a.zhangqi'=>'zhangqi','a.sumrate'=>'sumrate'))->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
		
	public function dialogprice() {
		$pid = $_GET['pid'];
		$this->myid=$pid;
		$nid = session('nid');
		$this->nid=$nid;
		$TypeModel = D('News');
		$condition['nid'] = $nid;
		$nround=$TypeModel->where($condition)->getField('nround');
		$this->pround=$nround;
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
		$this->uid=$uid;
		
		$TypeModel = D('NewsProduct');
		$condition= "pid=".$pid." and nid=".$nid;  
		$npcount=$TypeModel->where($condition)->getField('npcount');
		$this->npcount=$npcount;
		//dump($condition);

		$this->display();
	}
	
	public function saveprice() {
		$pid = $_POST['myid'];
		$prate = $_POST['prate'];
		$nid = $_POST['nid'];
		$uid = $_POST['uid'];
		$npcount = $_POST['npcount'];
		$pround = $_POST['pround'];
		$fapiao = $_POST['fapiao'];
		$zhangqi = $_POST['zhangqi'];
		$sumrate=number_format($prate*$npcount, 2, '.', '');
		//dump($npcount);
		$file = M('Price');
		
		$myprice="pid=".$pid." and uid=".$uid." and pround=".$pround." and nid=".$nid;
		$data = $file->where($myprice)->find();
        if (empty($data)) {
        $file->prate=$prate;
		$file->pid=$pid;
		$file->pround=$pround;
		$file->nid=$nid;
		$file->uid=$uid;
		$file->sumrate=$sumrate;
		$file->fapiao=$fapiao;
		$file->zhangqi=$zhangqi;
		$file->add(); 
		$this->returnStatus();
		}else{
		$file->where($myprice)->setField('prate',$prate);
		$file->where($myprice)->setField('sumrate',$sumrate);
		$file->where($myprice)->setField('fapiao',$fapiao);
		$file->where($myprice)->setField('zhangqi',$zhangqi);
		$this->returnStatus();	
        }
	}
	
	public function getfilterData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
        $TypeModel = D('News');
		$current  = "unix_timestamp(nend) < unix_timestamp(NOW()) or unix_timestamp(nstart) > unix_timestamp(NOW())";  
        $dataList = $TypeModel->where($current)->order('nid desc')->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function newsfilter() {
		$this->display();
	}
	
	public function userfilter() {
		$nid = $_GET['nid'];
		session('nid',$nid);
		$this->display();
	}
	
	public function addfilter() {
		$uid = $_GET['uid'];
		$nid = session('nid');
		$file = M('NewsFilter');
		$file->uid=$uid;
		$file->nid=$nid;
		$file->add(); 
		$this->returnStatus();
	}
	
	public function getuserData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$nid = session('nid');
        $TypeModel = D('UserView');
		$mygys="ustatus>0 and uid not in(select uid from bt_news_filter where nid=".$nid.")";
        $dataList = $TypeModel->where($mygys)->order('ustatus desc')->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function comboData3() {
		$nid = session('nid');
        $TypeModel = D('NewsFilter');
        $list = $TypeModel->join('bt_user a ON a.uid=bt_news_filter.uid')->field(array('a.uid'=>'uid','a.uname'=>'uname'))->where("nid=".$nid)->select();
        $this->ajaxReturn($list);
    }
	
	public function saveuser() {
		$uid = $_POST['bt_product_combobox'];
		$nid = session('nid');
		$myuser="uid=".$uid." and nid=".$nid;
		$TypeModel = M('NewsFilter');
        $data=$TypeModel->where($myuser)->delete();
		//dump($TypeModel->getLastSql());
		$this->returnStatus();
	}
	
	public function newswin() {
		$priceid = $_GET['priceid'];
		$file = M('Price');
		$mywin="priceid=".$priceid;
		$pid = $file->where($mywin)->getField('pid');
		$uid = $file->where($mywin)->getField('uid');
		
		$nid = session('nid');
		
		$file = M('NewsWin');
		$mywin="nid=".$nid." and pid=".$pid;
		$data = $file->where($mywin)->find();
		if (empty($data)) {
		$file->uid=$uid;
		$file->nid=$nid;
		$file->pid=$pid;
		$file->add(); 
		$this->returnStatus();
		}else{
		$this->returnStatus(FALSE, '该竞标已有中标！不能重复添加');
		}
		
	}
	
	public function delwin() {
		$nid = session('nid');
		$file = M('NewsWin');
		$mywin="nid=".$nid;
		$data = $file->where($mywin)->delete();
		$this->returnStatus();
	}
	
	public function delnews() {
		$nid = session('nid');
		//dump($nid);
		$file = M('News');
		$mywin="nid=".$nid;
		$file->where($mywin)->delete();
		$this->returnStatus();
	}
	
	public function newsresult() {
		$this->display();
	}
	
	public function wingetData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
		$TypeModel = M('News');
		if ($memberInfo['ustatus'] == 0) {
		$dataList = $TypeModel->join('bt_news_win ON bt_news.nid=bt_news_win.nid')->field(array('bt_news.nid'=>'nid','bt_news.ntitle'=>'ntitle','bt_news.ntext'=>'ntext','bt_news.nstart'=>'nstart','bt_news.nend'=>'nend','bt_news.nround'=>'nround'))->order('nid desc')->group("bt_news.nid")->limit($offset.','.$rows)->select();
		} else {
		$dataList = $TypeModel->join('bt_news_win ON bt_news.nid=bt_news_win.nid')->where('bt_news_win.uid = %d', $uid)->field(array('bt_news.nid'=>'nid','bt_news.ntitle'=>'ntitle','bt_news.ntext'=>'ntext','bt_news.nstart'=>'nstart','bt_news.nend'=>'nend','bt_news.nround'=>'nround'))->order('nid desc')->group("bt_news.nid")->limit($offset.','.$rows)->select();
		}
		//$dataList = $TypeModel->join('bt_news ON bt_news.nid=bt_news_win.nid')->where('bt_news_win.uid = %d', $uid)->select();
        $this->returnGridData($dataList, $TypeModel->count());
	}
	
	public function winresult(){
		$nid = $_GET['nid'];
		session('nid',$nid);
		$this->display();
	}
	
	public function windata(){
		//$nid = session('nid');
		//$TypeModel = M('NewsWin');
		//$condition="nid=".$nid;
		//$uid=$TypeModel->where($condition)->getField('uid');
		//dump($uid);
		//$TypeModel = M('NewsProduct');
		//$myprice="bt_news_product.nid=".$nid;
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid and a.uid='.$uid)->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.sumrate'=>'sumrate'))->select();
		//$this->returnGridData($dataList, $TypeModel->count());
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
		$TypeModel = M('NewsWin');
		$myprice="bt_news_win.nid=".$nid;
		if ($memberInfo['ustatus'] == 0) {
		//$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid')->join('LEFT JOIN bt_user b ON b.uid=a.uid')->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.sumrate'=>'sumrate','b.uname'=>'uname','a.priceid'=>'priceid'))->order('uname desc')->select();
		$dataList = $TypeModel->join('LEFT JOIN bt_user a ON a.uid=bt_news_win.uid')->join('LEFT JOIN bt_news_product b ON b.pid=bt_news_win.pid and b.nid=bt_news_win.nid')->join('LEFT JOIN bt_price c ON c.pid=bt_news_win.pid and c.nid=bt_news_win.nid and c.uid=bt_news_win.uid')->where($myprice)->field(array('a.uname'=>'uname','b.pname'=>'pname','b.punit'=>'punit','b.npcount'=>'npcount','b.npdetail'=>'npdetail','c.prate'=>'prate','c.fapiao'=>'fapiao','c.zhangqi'=>'zhangqi','c.sumrate'=>'sumrate'))->order('uname desc')->limit($offset.','.$rows)->select();
		$this->returnGridData($dataList, $TypeModel->count());
		} else {
		$myprice="bt_news_win.nid=".$nid." and bt_news_win.uid=".$uid;
		$dataList = $TypeModel->join('LEFT JOIN bt_user a ON a.uid=bt_news_win.uid')->join('LEFT JOIN bt_news_product b ON b.pid=bt_news_win.pid and b.nid=bt_news_win.nid')->join('LEFT JOIN bt_price c ON c.pid=bt_news_win.pid and c.nid=bt_news_win.nid and c.uid=bt_news_win.uid')->where($myprice)->field(array('a.uname'=>'uname','b.pname'=>'pname','b.punit'=>'punit','b.npcount'=>'npcount','b.npdetail'=>'npdetail','c.prate'=>'prate','c.fapiao'=>'fapiao','c.zhangqi'=>'zhangqi','c.sumrate'=>'sumrate'))->order('uname desc')->limit($offset.','.$rows)->select();
		$this->returnGridData($dataList, $TypeModel->count());
		}
	}
	
	
	public function exportExcel($expTitle,$expCellName,$expTableData){
		//ob_clean();
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        //vendor("Classes.PHPExcel");
		vendor('Classes.PHPExcel.IOFactory');
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
    }
	
	public function myexport(){
		
		//$xlsData=$_POST['parameters'];
		
		$xlsName  = "竞价信息";
        $xlsCell  = array(
            array('pname','产品名称'),
            array('punit','产品单位'),
			array('npcount','产品数量'),
			array('npdetail','备注信息'),
			array('prate','产品单价'),
			array('sumrate','产品金额')
        );
		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('NewsProduct');
		$myprice="bt_news_product.nid=".$nid;
        $xlsData = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid and a.uid='.$uid)->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.fapiao'=>'fapiao','a.zhangqi'=>'zhangqi','a.sumrate'=>'sumrate'))->select();
		
        //$xlsModel = M('User');
        //$xlsData  = $xlsModel->Field('uid,uname,account')->select();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
	}
	
	public function allprice(){
		$this->display();
	}
	
	public function getallPrice() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
		
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'pid,sumrate';    
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
		$offset = ($page - 1 ) * $rows;
		

		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('NewsProduct');
		$myprice="bt_news_product.nid=".$nid;
        $dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid')->join('LEFT JOIN bt_user b ON b.uid=a.uid')->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.fapiao'=>'fapiao','a.zhangqi'=>'zhangqi','a.sumrate'=>'sumrate','b.uname'=>'uname','a.priceid'=>'priceid'))->order($sort." ".$order)->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function sumprice(){
		$this->display();
	}
	
	public function getsumPrice() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('Price');
		$myprice="bt_price.nid=".$nid;
        $dataList = $TypeModel->join('LEFT JOIN bt_user b ON b.uid=bt_price.uid')->where($myprice)->field(array('sum(bt_price.sumrate)'=>'sumrate','bt_price.fapiao'=>'fapiao','bt_price.zhangqi'=>'zhangqi','b.uname'=>'uname','b.uid'=>'uid'))->group('uid')->order('sumrate asc')->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function newssumwin() {
		$uid = $_GET['uid'];
		$nid = session('nid');
		$file = M('Price');
		$mywin="uid=".$uid." and nid=".$nid;
		$myprice = $file->where($mywin)->select();
		//dump($mypirce);
		$file2 = M('NewsWin');
		$mywin="nid=".$nid;
		$data = $file2->where($mywin)->find();
		//dump($mywin);
		if (empty($data)) {
		//$file->uid=$uid;
		//$file->nid=$nid;
		//$file->pid=$pid;
		//$file->add(); 
		//$this->returnStatus();
		//dump($myprice);
		foreach($myprice as $price){
			//dump($price);
			//$element->name = 'qqyumidi';
			//dump($price);
			$file2->uid=$uid;
			$file2->nid=$nid;
			$file2->pid=$price["pid"];
			$file2->add(); 
			
		}
		$this->returnStatus();
		}else{
		$this->returnStatus(FALSE, '该竞标已有中标！不能重复添加');
		}
		

	}
	
	public function infail() {
		$this->display();
	}
	

	
	
}
?>