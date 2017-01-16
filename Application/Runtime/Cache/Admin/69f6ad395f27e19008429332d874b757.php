<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SHOP 管理中心 - 管理员列表 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/shop/ecshop/Public/js/jquery-1.11.2.min.js"></script>
</head>
<body>

<h1>
	<span class="action-span"><a href="/shop/ecshop/index.php/Admin/Admin/adminAdd">添加管理员</a></span>
	<span class="action-span1"><a href="index.php?p=admin&c=index&a=index">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 管理员列表 </span>
	<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
	<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
			<tr>
				<th width="20%">管理员名称</th>
				<th width="40%">角色名称</th>
				<th width="5%">是否启用</th>
				<th width="10%">添加时间</th>
				<th width="15%">操作</th>
			</tr>
			<?php if(is_array($adminList)): $i = 0; $__LIST__ = $adminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" class="0" id="0_1">
					<td><?php echo ($vo["admin_name"]); ?></td>
					<td><?php echo ($vo["role_name"]); ?></td>
					<td class="is_use" adminId = <?php echo ($vo['admin_id']); ?>>
						<?php if($vo["is_use"] == 1): ?>启用
						<?php else: ?>禁用<?php endif; ?>
					</td>
					<td><?php echo ($vo["add_time"]); ?></td>
					<td>
						<a href="/shop/ecshop/index.php/Admin/Admin/adminEdit/id/<?php echo ($vo["admin_id"]); ?>">编辑</a>

						<?php if($vo['admin_id'] > 1): ?>|<a href="/shop/ecshop/index.php/Admin/Admin/adminDelete/id/<?php echo ($vo["admin_id"]); ?>" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">移除</a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--  start 这些代码是显示使用，没有格式化 开发时可删除-->

			</tbody>
		</table>
	</div>
</form>

</table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>
<script type="text/javascript">

	$(".is_use").click(function () {
		var id = $(this).attr('adminId');
		var _this=$(this);

		$.ajax({
			type : "GET",
			url : '/shop/ecshop/index.php/Admin/Admin/ajaxIsUse' ,
			data :'id= '+id, //之前id与=之间空了一格导致一直出错
			dataType : 'html',
			success:function(data){
				if(data == 0){
					_this.html("启用");
				}else if(data == 1){
					_this.html("禁用");
				}else{
					alert("超级管理员不能被禁用");
				}


			}
		})


	})




















	/**
	 * 折叠分类列表
	 */
	var imgPlus = new Image();
	imgPlus.src = "<?php echo (ADMIN_PUBLIC); ?>/images/menu_plus.gif";

	function rowClicked(obj)
	{
		// 当前图像
		img = obj;
		// 取得上二级tr>td>img对象
		obj = obj.parentNode.parentNode;
		// 整个分类列表表格
		var tbl = document.getElementById("list-table");
		// 当前分类级别
		var lvl = parseInt(obj.className);
		// 是否找到元素
		var fnd = false;
		var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : 'table-row' ;
		// 遍历所有的分类
		for (i = 0; i < tbl.rows.length; i++)
		{
			var row = tbl.rows[i];
			if (row == obj)
			{
				// 找到当前行
				fnd = true;
				//document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
			}
			else
			{
				if (fnd == true)
				{
					var cur = parseInt(row.className);
					var icon = 'icon_' + row.id;
					if (cur > lvl)
					{
						row.style.display = sub_display;
						if (sub_display != 'none')
						{
							var iconimg = document.getElementById(icon);
							iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
						}
					}
					else
					{
						fnd = false;
						break;
					}
				}
			}
		}

		for (i = 0; i < obj.cells[0].childNodes.length; i++)
		{
			var imgObj = obj.cells[0].childNodes[i];
			if (imgObj.tagName == "IMG" && imgObj.src != '<?php echo (ADMIN_PUBLIC); ?>/images/menu_arrow.gif')
			{
				imgObj.src = (imgObj.src == imgPlus.src) ? '<?php echo (ADMIN_PUBLIC); ?>/images/menu_minus.gif' : imgPlus.src;
			}
		}
	}
</script>
</body>
</html>