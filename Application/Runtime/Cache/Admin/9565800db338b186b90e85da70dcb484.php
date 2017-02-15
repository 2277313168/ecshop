<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 品牌管理 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
    <span class="action-span"><a href="/shop/ecshop/index.php/Admin/Brand/brandAdd"><?php echo ($title2); ?></a></span>
    <span class="action-span1"><a href="/shop/ecshop/index.php/Admin/Index/index">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - <?php echo ($title1); ?> </span>
    <div style="clear:both"></div>
</h1>

<!--头部结束，以下是尾部=============================================================-->


<!--搜索的表单一般以get方式提交-->
<div class="form-div">
  <form action="/shop/ecshop/index.php/Admin/Brand/brandIndex" name="searchForm">
    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
     <input type="text" name="searchName" size="15">
    <input type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
        <?php if(is_array($brandList)): $i = 0; $__LIST__ = $brandList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>

			<td class="first-cell"><span style="float:right"><a href=<?php echo ($vo["brand_logo"]); ?> target="_brank"><img src="/shop/ecshop<?php echo ($vo["logo"]); ?>" width="20" height="20" border="0" alt="品牌LOGO"></a></span>
			<span onclick="javascript:listTable.edit(this, 'edit_brand_name', 1)" title="点击修改内容" style=""><?php echo ($vo["brand_name"]); ?></span>
			</td>
			<td><a href="<?php echo ($vo["url"]); ?>" target="_brank"><?php echo ($vo["url"]); ?></a></td>
			<td align="left" ><?php echo ($vo["brand_desc"]); ?></td>
			<td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 1)"><?php echo ($vo["sort_order"]); ?></span></td>
			<td align="center"><img onclick="listTable.toggle(this, 'toggle_show', 1)"
                <?php if($vo["is_show"] == 1): ?>src="<?php echo (ADMIN_PUBLIC); ?>/images/yes.gif"
                    <?php else: ?>src="<?php echo (ADMIN_PUBLIC); ?>/images/no.gif"<?php endif; ?>       ></td>
			<td align="center">
				<a href="/shop/ecshop/index.php/Admin/Brand/brandEdit/id/<?php echo ($vo["brand_id"]); ?>" title="编辑">编辑 </a> |
				<a href="/shop/ecshop/index.php/Admin/Brand/brandDelete/id/<?php echo ($vo["brand_id"]); ?>/p/<?php echo I('get.p',1) ?>" onclick="listTable.remove(1, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>

    <tr>
<!--<?php var_dump(I('get.p')) ?>-->
		<td align="right" nowrap="true" colspan="6">
            <div id="turn-page">
			<?php echo ($page); ?>
      </div>
      </td>
    </tr>
  </tbody></table>

<!-- end brand list -->
</div>
</form>



<div id="footer">
    版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>

</body>
</html>