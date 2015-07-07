<?php
class UnittypeAction extends BaseAction {

	public function index() {
		$this->display();
	}
	
	public function getData() {
        $TypeModel = D('UnitType');
        $dataList = $TypeModel->select();
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
}
?>