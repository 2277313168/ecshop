<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>SHOP 管理中心 - 添加分类 </title>
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/js/jquery-1.11.2.min.js"></script>
</head>
<body>

<h1>
  <span class="action-span"><a href="/shop/ecshop/index.php/Admin/Category/catIndex">权限列表</a></span>
  <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id"
                                                                                     class="action-span1"> - 添加分类 </span>
  <div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="/shop/ecshop/index.php/Admin/Admin/adminAdd" method="post" name="theForm" enctype="multipart/form-data"
        onsubmit="return validate()">
    <table width="100%" id="general-table">
      <tbody>
      <tr>
        <td class="label">管理员名称:</td>
        <td><input type="text" name="admin_name" maxlength="20" value="" size="27"> <font color="red">*</font>
        </td>
      </tr>

      <tr>
        <td  class="label">密码：</td>
        <td><input type="text" name="psw" value=""/> </td>
      </tr>

      <tr>
        <td class="label">确认密码：</td>
        <td><input type="text" name="repsw" value=""/> </td>
      </tr>


      <tr>
        <td class="label">角色列表:</td>
        <td>
          <?php if(is_array($roleList)): $i = 0; $__LIST__ = $roleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input  type="checkbox"  name="roleIds[]"  value="<?php echo ($vo["role_id"]); ?>"/><?php echo ($vo["role_name"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
      </tr>


      <tr>
        <td class="label">是否启用：</td>
        <td>
        <input type="radio" name="is_use" value="1" checked="checked"/>启用
        <input type="radio" name="is_use" value="0"/>禁用
        </td>
      </tr>


      </tbody>
    </table>
    <div class="button-div">
      <input type="submit" value=" 确定 ">
      <input type="reset" value=" 重置 ">
    </div>
    <input type="hidden" name="act" value="insert">
    <input type="hidden" name="old_cat_name" value="">
  </form>
</div>




</div>


</body>
</html>




<script>
  //    $(":checkbox").click(function () {
  //        var level = $(this).attr('level');
  //        var prevs = $(this).prevAll(":checkbox");
  //        var nexts = $(this).nextAll(":checkbox");
  //
  //        if ($(this).attr("checked")) {   //已选中，取消选中
  //          $(this).removeAttr('checked');
  //            $(nexts).each(function (k, v) {
  //                if ($(v).attr('level') > level) {
  //                    $(v).removeAttr('checked');
  //                } else {
  //                    return false;
  //                }
  //            })
  //
  //
  //        }
  //        else { //未选中。   好奇怪，同行注释必须与代码空一格以上
  //            $(this).attr('checked','checked');
  //            var level_tmp = level;
  //            $(prevs).each(function (k, v) {
  //
  //                if ($(v).attr('level') < level_tmp) {
  //                    $(v).attr("checked", "checked");
  //                    level_tmp--;
  //                }
  //            });
  //
  //
  //            $(nexts).each(function (k, v) {
  //
  //                if ($(v).attr('level') > level) {
  //                    $(v).attr('checked', 'checked');
  //                } else {
  //                    return false;
  //                }
  //            });
  //
  //
  //        }
  //
  //
  //    });


</script>