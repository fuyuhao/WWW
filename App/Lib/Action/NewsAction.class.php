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
        $TypeModel = D('NewsProduct');
		$nid = session('nid');
        $dataList = $TypeModel->join('bt_product ON bt_product.pid=bt_news_product.pid')->where('nid = %d', $nid)->select();
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
	
	public function save() {
	$file = M('News');
	$mydetail = $_POST['mydetail'];
	$newscontent = $_POST['newscontent'];
	$newsstart = $_POST['newsstart'];
	$newsend = $_POST['newsend'];
	$file->ntitle=$mydetail;
	$file->ntext=$newscontent;
	$file->nstart=$newsstart;
	$file->nend=$newsend;
	$file->nround="1";
	$lastInsId=$file->add(); 
	
	session('nid',$lastInsId);
	}
	
	public function index() {
		$this->display();
	}
	
	public function newsgetData() {
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = D('News');
		$current  = "unix_timestamp(nstart) < unix_timestamp(NOW()) and unix_timestamp(nend) > unix_timestamp(NOW()) and nid NOT IN (select nid from bt_news_filter where uid=".$uid.")";
        $dataList = $TypeModel->where($current)->select();
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
		$this->display();
	}
	
	public function getPriceData() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
				
		$nid = session('nid');
        $TypeModel = M('NewsProduct');
        $dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid')->where('bt_news_product.nid = %d', $nid)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.sumrate'=>'sumrate'))->select();
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
		//dump($npcount);
		$file = M('Price');
		$file->prate=$prate;
		$file->pid=$pid;
		$file->pround=$pround;
		$file->nid=$nid;
		$file->uid=$uid;
		$file->sumrate=number_format($prate*$npcount, 2, '.', '');;
		$file->add(); 
		$this->returnStatus();
	}
	
	public function getfilterData() {
        $TypeModel = D('News');
		$current  = "unix_timestamp(nend) < unix_timestamp(NOW()) or unix_timestamp(nstart) > unix_timestamp(NOW())";  
        $dataList = $TypeModel->where($current)->select();
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
	
	public function newswin() {
		$uid = $_GET['uid'];
		$nid = session('nid');
		$file = M('NewsWin');
		$file->uid=$uid;
		$file->nid=$nid;
		$file->add(); 
		$this->returnStatus();
	}
	
	public function newsresult() {
		$this->display();
	}
	
	public function wingetData() {
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
		$TypeModel = M('NewsWin');
		$dataList = $TypeModel->join('bt_news ON bt_news.nid=bt_news_win.nid')->where('bt_news_win.uid = %d', $uid)->select();
        $this->returnGridData($dataList, $TypeModel->count());
	}
	
	
	
}
?>