<?php
class UnittypeAction extends BaseAction {

	public function index() {
		$this->display();
	}
	
	public function getData() {
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	$offset = ($page - 1 ) * $rows;
		
        $TypeModel = D('UnitType');
        $dataList = $TypeModel->limit($offset.','.$rows)->select();
        $this->returnGridData($dataList, $TypeModel->count());
    }
	
	public function doSave() {
        $Model = D("UnitType");
        if (!$Model->create()) {
            $this->returnStatus(false, $Model->getError());
        } else {

                $Model->add();

            if ($Model->getError()) {
                $this->returnStatus(false, $Model->getError());
            }
            $this->returnStatus();
        }
    }
	
	    public function dodelete() {
        $id = $_GET['id'];
		$Model = D("UnitType");
		$Model->where("id=".$id)->delete();


        $this->returnStatus();
    }
}
?>