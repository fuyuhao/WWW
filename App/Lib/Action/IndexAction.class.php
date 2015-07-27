<?php

/**
 * 作者：anticode
 * /
 * 
 */

/**
 * IndexAction
 *
 * @author anticode
 */
class IndexAction extends BaseAction {

    public function index() {
        $memberInfo = session('member');
        $Menu = D('Menu');
		
		if ($memberInfo['ustatus'] == 0) {
		$mymenu="mid<>96 and mid<>95 and mid<>94 and mid<>97 and mid<>98 and mid<>99 and mid<>104  and mid<>108";
		} elseif($memberInfo['ustatus'] < 0) {
		$mymenu="mid<>96 and mid<>95 and mid<>94 and mid<>97 and mid<>98 and mid<>99 and mid<>100 and mid<>101 and mid<>103 and mid<>105 and mid<>107 and mid<>106 and mid<>104";
		}else{
		$mymenu="mid<>96 and mid<>95 and mid<>94 and mid<>97 and mid<>98 and mid<>99 and mid<>100 and mid<>101 and mid<>103 and mid<>105 and mid<>107 and mid<>108";
		}	
		$dataList = $Menu->where($mymenu)->order('seq asc')->select();
        //if ($memberInfo['uid'] == 0) {
           // $dataList = $Menu->order('seq asc')->select();
        //} else {
        //    $dataList = $Menu->getMenuDataByUid($memberInfo['uid']);
        //}
        $_allResources = session('_resources');
        foreach ($dataList as $value) {
            if (!empty($value['href']))
                $_allResources[] = $value['href'];
        }
        session('_resources', array_unique($_allResources));
        $this->assign('memberData', json_encode($memberInfo));
        $this->assign('member', $memberInfo);
        $this->assign('menuData', json_encode(BuildMenuTree($dataList)));

        import('@.ORG.Net.IpLocation'); // 导入IpLocation类
        $Ip = new IpLocation(); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation(get_client_ip()); // 获取某个IP地址所在
        $this->assign('ip', get_client_ip());
        $this->assign('area', $area);
        //读取个人配置
        $Options = D('options');
        $dataList = $Options->where(array('uid' => $memberInfo['uid']))->select();
        $options = array();
        foreach ($dataList as $value) {
            $options[$value['op_key']] = $value['op_value'];
        }
        $this->assign('options', json_encode($options));
        $this->assign('theme', isset($options['themeName']) ? $options['themeName'] : 'default');
        $this->display();
    }

}