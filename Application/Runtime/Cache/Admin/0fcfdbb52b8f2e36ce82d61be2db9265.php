<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 品牌管理 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/js/jquery-1.11.2.min.js"></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="/shop/ecshop/index.php/Admin/Brand/brandAdd"><?php echo ($title2); ?></a></span>
    <span class="action-span1"><a href="/shop/ecshop/index.php/Admin/Index/index">SHOP 管理中心</a> </span><span id="search_id"
                                                                                           class="action-span1"> - <?php echo ($title1); ?> </span>
    <div style="clear:both"></div>
</h1>


<div class="main-div">
    <form id="form1" method="post" action="/shop/ecshop/index.php/Admin/Brand/brandAdd" name="theForm" enctype="multipart/form-data"
          onsubmit="return validate()">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tbody>
            <tr>
                <td class="label">品牌名称</td>
                <td><input type="text" name="brand_name" maxlength="60" value=""><span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌网址</td>
                <td><input type="text" name="url" maxlength="60" size="40" value=""></td>
            </tr>
            <tr>
                <td class="label"><a href="javascript:showNotice('warn_brandlogo');" title="点击此处查看提示信息">
                    <img src="<?php echo (ADMIN_PUBLIC); ?>/images/notice.gif" width="16" height="16" border="0"
                         alt="点击此处查看提示信息"></a>品牌LOGO
                </td>
                <td><input type="file" name="logo" id="logo" size="45"> <br><span class="notice-span"
                                                                                  style="display:block"
                                                                                  id="warn_brandlogo">
        请上传图片，做为品牌的LOGO！        </span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <!--<td><textarea name="brand_desc" cols="60" rows="4"></textarea></td>-->
                <td><textarea name="brand_desc" id='brand_desc'></textarea></td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td><input type="text" name="sort_order" maxlength="40" size="15" value=""></td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td><input type="radio" name="is_show" value="1" checked="checked"> 是 <input type="radio" name="is_show"
                                                                                             value="0"> 否
                    (当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br>
                    <input type="submit" class="button" value=" 确定 ">
                    <input type="reset" class="button" value=" 重置 ">
                    <input type="hidden" name="act" value="insert">
                    <input type="hidden" name="old_brandname" value="">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="old_brandlogo" value="">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>


<div id="footer">
    版权所有 &copy; 2012-2013 传智播客 - PHP培训 -
</div>
</div>

</body>
</html>

<script>
    UE.getEditor('brand_desc', {
        "initialFrameWidth": "60%",
        "initialFrameHeight": 90,
        "maximumWords": 150
    });
</script>


<script>
    //为表单绑定ajax提交事件
    $("#form1").submit(function () {
        //使用ajax来提交
        $.ajax({
            type: "POST",                             //提交方式
            url: "/shop/ecshop/index.php/Admin/Brand/brandAdd",        //提交的地址
            data: $("#form1").serialize(),               //提交的数据：整个表单数据
            dataType: "json",                         //标记服务器返回的是json数据，此处返回的是$this->success()及$this->error()
            success: function (data) {               //ajax执行完后的回调函数
//                if (data.status == 1)  else 

                alert(data.info);
                if(data.status == 1){
                    location.href = data.url;
                }

            }

        });

        return false;//阻止表单提交
    });

</script>