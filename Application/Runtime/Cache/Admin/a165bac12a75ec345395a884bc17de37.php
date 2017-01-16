<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SHOP 管理中心 - 添加分类 </title>
	<meta name="robots" content="noindex, nofollow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
	<span class="action-span"><a href="/shop/ecshop/index.php/Admin/Category/catIndex">权限列表</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加分类 </span>
	<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
	<form action="/shop/ecshop/index.php/Admin/Auth/authEdit" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
		<input type="hidden" name="id" value="<?php echo ($auth['auth_id']); ?>">
		<table width="100%" id="general-table">
			<tbody>

			<tr>
				<td class="label">权限名称:</td>
				<td><input type="text" name="auth_name" maxlength="20" value="<?php echo ($auth["auth_name"]); ?>" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">上级分类:</td>
				<td>
					<select name="auth_pid">
						<option value="0">顶级分类</option>
						<?php if(is_array($authList)): $i = 0; $__LIST__ = $authList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["auth_id"]); ?>" <?php if($vo['auth_id'] == $auth['auth_pid'] ): ?>selected="selected"<?php endif; ?>  >
								<?php echo (str_repeat("&nbsp;&nbsp;" ,$vo["level"])); ?>
								<?php echo ($vo["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>

			<tr >
				<td class="label">模块名称:</td>
				<td><input type="text" name="module_name" value="<?php echo ($auth["module_name"]); ?>" size="12"></td>
			</tr>
			<tr >
				<td class="label">控制器名称:</td>
				<td><input type="text" name="controller_name" value="<?php echo ($auth['controller_name']); ?>" size="12"></td>
			</tr>

			<tr >
				<td class="label">方法名称:</td>
				<td><input type="text" name="action_name" value="<?php echo ($auth['action_name']); ?>" size="12"></td>
			</tr>

			</tbody></table>
		<div class="button-div">
			<input type="submit" value=" 确定 ">
			<input type="reset" value=" 重置 ">
		</div>
		<input type="hidden" name="act" value="insert">
		<input type="hidden" name="old_cat_name" value="">
	</form>
</div>



<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 -
</div>

</div>

</body>
</html>