<?php if (!defined('THINK_PATH')) exit();?>﻿
<form method="post" action="/grxx/doupdata"  target="id_iframe" enctype="multipart/form-data" id="bt_upimage_from"  class="form">
    <table align="center">

        <tr>
            <td>
			<?php echo ($myid); ?>
			<div style="font-weight:900;font-size:16px;font-family:'Microsoft YaHei',微软雅黑,'MicrosoftJhengHei',华文细黑,STHeiti,MingLiu">上传图片：</div>
	<div style="margin-bottom:20px">
	    <input type="file"  name="image1"/>
	</div>
			
			</td>
           
			
        </tr>

    </table>
    <input type="hidden" name="myid" value="<?php echo ($myid); ?>">
</form>