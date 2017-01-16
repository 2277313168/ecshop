<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 权限列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="/shop/ecshop/index.php/Admin/Auth/authAdd">添加权限</a></span>
<span class="action-span1"><a href="index.php?p=admin&c=index&a=index">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限列表 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>权限名称</th>
					<th>模块名称</th>
					<th>控制器名称</th>
					<th>方法名称</th>
					<th>上级权限id</th>
					<th>操作</th>
				</tr>
                <?php if(is_array($authList)): $i = 0; $__LIST__ = $authList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" class="0" id="0_1">

					<td width="10%" align="left">
						<?php echo str_repeat("&nbsp;",4*$vo['level']) ?>
						<!--<?php echo (str_repeat("&nbsp;&nbsp;&nbsp;",$vo["level"])); ?>-->
						<?php echo ($vo["auth_name"]); ?></td>
					<td width="10%"><?php echo ($vo["module_name"]); ?></td>
					<td width="10%"><?php echo ($vo["controller_name"]); ?></td>
					<td width="10%"><?php echo ($vo["action_name"]); ?></td>
					<td width="10%"><?php echo ($vo["auth_pid"]); ?></td>

					<td width="24%" align="center">
						<!--<a href="category.php?act=move&amp;cat_id=1">转移商品</a> |-->
						<a href="/shop/ecshop/index.php/Admin/Auth/authEdit/id/<?php echo ($vo["auth_id"]); ?>">编辑</a> |
						<a href="/shop/ecshop/index.php/Admin/Auth/authDelete/id/<?php echo ($vo["auth_id"]); ?>" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">移除</a>
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
 <script>
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