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
  <form action="/shop/ecshop/index.php/Admin/Role/roleEdit" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
    <table width="100%" id="general-table">
      <tbody>
      <tr>
        <td class="label">角色名称:</td>
        <td><input type="text" name="role_name" maxlength="20" value="<?php echo ($role["role_name"]); ?>" size="27"> <font color="red">*</font></td>
      </tr>
      <tr>
        <td class="label">权限列表:</td>
        <td>
          <?php if(is_array($authList)): $i = 0; $__LIST__ = $authList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo (str_repeat("---",2*$vo["level"])); ?>
            <input type="checkbox" name="auths[]" value="<?php echo ($vo["auth_id"]); ?>"
            <?php if(strpos( ','.$auths['auth_id'].',' , ','.$vo['auth_id'].',') !== FALSE ): ?>checked="checked"<?php endif; ?>    /><?php echo ($vo["auth_name"]); ?>

            <br/><?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
      </tr>


      </tbody></table>
    <div class="button-div">
      <input type="submit" value=" 确定 ">
      <input type="reset" value=" 重置 ">
    </div>
    <input type="hidden" name="id" value="<?php echo ($role["role_id"]); ?>">
    <input type="hidden" name="old_cat_name" value="">
  </form>
</div>



<div id="footer">
  版权所有 &copy; 2012-2013 传智播客 - PHP培训 -
</div>

</div>

</body>
</html>