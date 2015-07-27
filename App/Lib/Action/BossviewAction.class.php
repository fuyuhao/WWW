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
class BossviewAction extends BaseAction {

    public function index() {
        $this->display();
    }

	public function getfilterData() {
        $TypeModel = D('News');
		$current  = "";  
        $dataList = $TypeModel->where($current)->order('nid desc')->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function sumprice(){
		$nid = $_GET['nid'];
		session('nid',$nid);
		$this->display();
	}
	
	public function allprice(){
		$this->display();
	}
	
	public function getsumPrice() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
				
		$nid = session('nid');

		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('Price');
		$myprice="bt_price.nid=".$nid;
        $dataList = $TypeModel->join('LEFT JOIN bt_user b ON b.uid=bt_price.uid')->where($myprice)->field(array('sum(bt_price.sumrate)'=>'sumrate','b.uname'=>'uname','b.uid'=>'uid'))->group('uid')->order('sumrate asc')->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function getallPrice() {
		//$nid = session('nid');
        //$TypeModel = M('NewsProduct');
        //$dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid')->where('bt_news_product.nid = %d', $nid)->select();
		
		$sort = isset($_POST['sort']) ? strval($_POST['sort']).',sumrate' : 'pid,sumrate';    
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';    
		

		
		$nid = session('nid');
		$memberInfo = session('member');
		$uid=$memberInfo['uid'];
        $TypeModel = M('NewsProduct');
		$myprice="bt_news_product.nid=".$nid;
        $dataList = $TypeModel->join('LEFT JOIN bt_price a ON a.nid=bt_news_product.nid and a.pid=bt_news_product.pid')->join('LEFT JOIN bt_user b ON b.uid=a.uid')->where($myprice)->field(array('bt_news_product.pid'=>'pid','bt_news_product.pname'=>'pname','bt_news_product.punit'=>'punit','bt_news_product.npcount'=>'npcount','bt_news_product.npdetail'=>'npdetail','a.prate'=>'prate','a.sumrate'=>'sumrate','b.uname'=>'uname','a.priceid'=>'priceid'))->order($sort." ".$order)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }

}

?>
