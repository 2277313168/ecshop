<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 属性管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="/shop/ecshop/index.php/Admin/Attribute/attrAdd">添加属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：<select name="goods_type" onchange="searchAttr(this.value)">
      <option value="0">所有商品类型</option>
      <!--<option value="1" selected="true">书</option><option value="2">音乐</option><option value="3">电影</option><option value="4">手机</option><option value="5">笔记本电脑</option><option value="6">数码相机</option><option value="7">数码摄像机</option><option value="8">化妆品</option><option value="9">精品手机</option><option value="10">我的商品</option>-->
    <?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"  <?php if($vo['type_id'] == $type_id): ?>selected = "selected"<?php endif; ?> ><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
  </select>
  </form>
</div>

<form method="post" action="attribute.php?act=batch" name="listForm">
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th><input onclick="listTable.selectAll(this, &quot;checkboxes[]&quot;)" type="checkbox">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>排序</a></th>
			<th>操作</th>
		</tr>

        <?php if(is_array($attrList)): $i = 0; $__LIST__ = $attrList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td nowrap="true" valign="top"><span><input value="1" name="checkboxes[]" type="checkbox"><?php echo ($i); ?></span></td>
			<td class="first-cell" nowrap="true" valign="top"><span onclick="listTable.edit(this, 'edit_attr_name', 1)"><?php echo ($vo["attr_name"]); ?></span></td>
			<td nowrap="true" valign="top"><span><?php echo ($vo["type_name"]); ?></span></td>
			<td nowrap="true" valign="top"><span><?php echo ($vo["attr_input_type"]); ?></span></td>
			<td valign="top"><span><?php echo ($vo["attr_value"]); ?></span></td>
			<td align="right" nowrap="true" valign="top"><span onclick="listTable.edit(this, 'edit_sort_order', 1)">0</span></td>
			<td align="center" nowrap="true" valign="top">
				<a href="/shop/ecshop/index.php/Admin/Attribute/attrEdit/id/<?php echo ($vo["attr_id"]); ?>" title="编辑"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_edit.gif" border="0" height="16" width="16"></a>
				<a href="/shop/ecshop/index.php/Admin/Attribute/attrDelete/id/<?php echo ($vo["attr_id"]); ?>" onclick="removeRow(1)" title="移除"><img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_drop.gif" border="0" height="16" width="16"></a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

      </tbody></table>

  <table cellpadding="4" cellspacing="0">
    <tbody><tr>
      <td style="background-color: rgb(255, 255, 255);"><input type="submit" id="btnSubmit" value="删除" class="button" disabled="true"></td>
      <td align="right" style="background-color: rgb(255, 255, 255);">      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        <?php echo ($page); ?>
      </div>
</td>
    </tr>
  </tbody></table>
</div>

</form>

<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>


<script type="text/javascript">
    function searchAttr(type_id) {
        window.location.href="/shop/ecshop/index.php/Admin/Attribute/attrIndex/id/"+type_id ;
    }
</script>

</body>
</html>