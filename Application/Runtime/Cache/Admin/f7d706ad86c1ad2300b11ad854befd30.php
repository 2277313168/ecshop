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
<span class="action-span"><a href="index.php?p=admin&c=category&a=index">商品分类</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加分类 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="/shop/ecshop/index.php/Admin/Category/catEdit" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">分类名称:</td>
				<td><input type="text" name="cat_name" maxlength="20" value="<?php echo ($cat["cat_name"]); ?>" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">上级分类:</td>
				<td>
					<select name="parent_id">
						<?php if(is_array($catList)): $i = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>" <?php if($vo['cat_id'] == $cat['parent_id']): ?>selected="selected"<?php endif; ?> >
								<?php echo (str_repeat("&nbsp;&nbsp;&nbsp;",$vo["level"])); ?>
								<?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>

			<tr id="measure_unit">
				<td class="label">数量单位:</td>
				<td><input type="text" name="unit" value="<?php echo ($cat["unit"]); ?>" size="12"></td>
			</tr>
			<tr>
				<td class="label">排序:</td>
				<td><input type="text" name="sort_order" value="<?php echo ($cat["sort_order"]); ?>" size="15"></td>
			</tr>

			<tr>
				<td class="label">是否显示:</td>
				<td><input type="radio" name="is_show" value="1"  <?php if($cat["is_show"] == 1): ?>checked="true"<?php endif; ?> > 是
					<input type="radio" name="is_show" value="0" <?php if($cat["is_show"] == 0): ?>checked="true"<?php endif; ?> > 否  </td>
			</tr>
			<!--<tr>-->
				<!--<td class="label">是否显示在导航栏:</td>-->
				<!--<td><input type="radio" name="show_in_nav" value="1"> 是  <input type="radio" name="show_in_nav" value="0" checked="true"> 否    </td>-->
			<!--</tr>-->
			<!--<tr>-->
				<!--<td class="label">设置为首页推荐:</td>-->
				<!--<td>-->
					<!--<input type="checkbox" name="cat_recommend[]" value="1"> 精品          -->
					<!--<input type="checkbox" name="cat_recommend[]" value="2"> 最新          -->
					<!--<input type="checkbox" name="cat_recommend[]" value="3"> 热门       -->
				<!--</td>-->
			<!--</tr>-->
      <tr>
        <td class="label">分类描述:</td>
        <td>
          <textarea name="cat_desc" rows="6" cols="48"><?php echo ($cat["cat_desc"]); ?></textarea>
        </td>
      </tr>
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
    <input type="hidden" name="act" value="insert">
    <input type="hidden" name="old_cat_name" value="">
    <input type="hidden" name="id" value="<?php echo ($cat["cat_id"]); ?>">
  </form>
</div>



<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - 
</div>

</div>

</body>
</html>