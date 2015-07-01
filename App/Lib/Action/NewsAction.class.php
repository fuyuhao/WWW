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
        $TypeModel = D('News');
        $dataList = $TypeModel->select();
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
        $TypeModel = M('NewsProduct');
		$nid = session('nid');
        $dataList = $TypeModel->join('LEFT JOIN bt_product b ON b.pid=bt_news_product.pid')->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
		
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
		$this->display();
	}
	
	public function saveprice() {
		$pid = $_POST['myid'];
		$prate = $_POST['prate'];
		$nid = $_POST['nid'];
		$uid = $_POST['uid'];
		
		$pround = $_POST['pround'];
		
		$file = M('Price');
		$file->prate=$prate;
		$file->pid=$pid;
		$file->pround=$pround;
		$file->nid=$nid;
		$file->uid=$uid;
		$file->add(); 
		$this->returnStatus();
	}
	
	public function newsfilter() {
		$this->display();
	}
	
	public function userfilter() {
		$this->display();
	}
	
	
}
?>