<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>购物车</title>
    <meta name="keywords" content="<?php echo ($page_keywords); ?>"/>
    <meta name="description" content="<?php echo ($page_description); ?>"/>
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/header.css" type="text/css">


    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/index.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/cart.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/common.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/jqzoom.css" type="text/css">

    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/footer.css" type="text/css">
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/header.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/index.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/cart1.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/jqzoom-core.js"></script>


</head>
<body>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($page_title); ?></title>
    <meta name="keywords" content="<?php echo ($page_keywords); ?>" />
    <meta name="description" content="<?php echo ($page_description); ?>" />
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/header.css" type="text/css">
    <?php foreach ($page_css as $k => $v): ?>
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/<?php echo ($v); ?>.css" type="text/css">
    <?php endforeach; ?>
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/footer.css" type="text/css">
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/header.js"></script>
    <?php foreach ($page_js as $k => $v): ?>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/<?php echo ($v); ?>.js"></script>
    <?php endforeach; ?>
</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li id="logInfo"></li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->
<div style="clear:both;"></div>


<script >
    $.ajax({
        type : 'GET',
        url: "/shop/ecshop/index.php/Home/Register/logInfoAjax",
        dataType: 'json',  //指定服务器返回json
        success: function (data) {
            var html;
            if(data.ok == 1){
                //html = "您好<?php echo session('user_name') ?>，欢迎来到京西！[<a href='/shop/ecshop/index.php/Home/Register/logout'>退出</a>]";
                html = data.userName+"您好，欢迎来到京西！[<a href='/shop/ecshop/index.php/Home/Register/logout'>退出</a>]";

            }else{
                html = '您好，欢迎来到京西！[<a href="/shop/ecshop/index.php/Home/Register/login">登录</a>] [<a href="/shop/ecshop/index.php/Home/Register/register">免费注册</a>]' ;
            }

            $('#logInfo').html(html);
        }

    });
</script>

<div style="clear:both;"></div>


<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
		<div class="logo w1210">
			<h1 class="fl"><a href="/shop/ecshop/index.php/Home/Index/index"><img src="<?php echo (HOME_PUBLIC); ?>/images/logo.png" alt="京西商城"></a></h1>
			<!-- 头部搜索 start -->
			<div class="search fl">
				<div class="search_form">
					<div class="form_left fl"></div>
					<form action="" name="serarch" method="get" class="fl">
						<input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
					</form>
					<div class="form_right fl"></div>
				</div>
				
				<div style="clear:both;"></div>

				<div class="hot_search">
					<strong>热门搜索:</strong>
					<a href="">D-Link无线路由</a>
					<a href="">休闲男鞋</a>
					<a href="">TCL空调</a>
					<a href="">耐克篮球鞋</a>
				</div>
			</div>
			<!-- 头部搜索 end -->

			<!-- 用户中心 start-->
			<div class="user fl">
				<dl>
					<dt>
						<em></em>
						<a href="">用户中心</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							您好，请<a href="">登录</a>
						</div>
						<div class="uclist mt10">
							<ul class="list1 fl">
								<li><a href="">用户信息></a></li>
								<li><a href="">我的订单></a></li>
								<li><a href="">收货地址></a></li>
								<li><a href="">我的收藏></a></li>
							</ul>

							<ul class="fl">
								<li><a href="">我的留言></a></li>
								<li><a href="">我的红包></a></li>
								<li><a href="">我的评论></a></li>
								<li><a href="">资金管理></a></li>
							</ul>

						</div>
						<div style="clear:both;"></div>
						<div class="viewlist mt10">
							<h3>最近浏览的商品：</h3>
							<ul id="history">
								<!--<li><a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/view_list1.jpg" alt="" /></a></li>-->
								<!--<li><a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/view_list2.jpg" alt="" /></a></li>-->
								<!--<li><a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/view_list3.jpg" alt="" /></a></li>-->
							</ul>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 用户中心 end-->

			<!-- 购物车 start -->
			<div class="cart fl">
				<dl>
					<dt>
						<a href="/shop/ecshop/index.php/Home/Cart/index">去购物车结算</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							<!--购物车中还没有商品，赶紧选购吧！-->
						</div>
					</dd>
				</dl>
			</div>
			<!-- 购物车 end -->
		</div>
		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>

		<!-- 导航条部分 start -->
		<div class="nav w1210 bc mt10">
			<!--  商品分类部分 start-->
			<div class="category fl <?php if($fold) echo 'cat1' ?>"> <!-- 非首页，需要添加cat1类折叠 -->
				<div class="cat_hd <?php if($fold) echo 'cat_hd' ?> ">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
					<h2>全部商品分类</h2>
					<em></em>
				</div>
				
				<div class="cat_bd <?php if($fold) echo 'none'; ?>">

					<?php foreach($catTree as $k=>$v ): ?>
					<?php if($k <8): ?>
					<div class="cat ">
						<h3><a href=""><?php echo ($v['cat_name']); ?></a> <b></b></h3>
						<div class="cat_detail">
							<?php foreach($v['child'] as $k1=>$v1): ?>
							<dl class="dl_1st">
								<dt><a href=""><?php echo ($v1['cat_name']); ?></a></dt>
								<dd>
									<?php foreach($v1['child'] as $k2=>$v2 ): ?>
									<a href=""><?php echo ($v2['cat_name']); ?></a>
									<?php endforeach; ?>
								</dd>
							</dl>
							<?php endforeach; ?>

						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>



				</div>

			</div>
			<!--  商品分类部分 end--> 

			<div class="navitems fl">
				<ul class="fl">
					<li class="current"><a href="/shop/ecshop/index.php/Home/Index/index">首页</a></li>
					<li><a href="">电脑频道</a></li>
					<li><a href="">家用电器</a></li>
					<li><a href="">品牌大全</a></li>
					<li><a href="">团购</a></li>
					<li><a href="">积分商城</a></li>
					<li><a href="">夺宝奇兵</a></li>
				</ul>
				<div class="right_corner fl"></div>
			</div>
		</div>
		<!-- 导航条部分 end -->
	</div>
	<!-- 头部 end-->
	
	<div style="clear:both;"></div>


<script >

	$.ajax({
		type : 'GET',
		url : "/shop/ecshop/index.php/Home/Index/ajaxHistory",
		dataType : 'json',
		success : function (data) {
			var html = '';
			$(data).each(function (k,v) {

				html += '<li><a href="/shop/ecshop/index.php/Home/Index/goods/id/'+v.goods_id+'"><img src="/shop/ecshop'+v.goods_img+'" alt="" /></a></li>';

			})


			$('#history').html(html);


		}
	})


</script>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="/shop/ecshop/index.php/Home/Index/index"><img src="<?php echo (HOME_PUBLIC); ?>/images/logo.png"
                                                             alt="京西商城"></a></h2>
        <div class="flow fr">
            <ul>
                <li class="cur">1.我的购物车</li>
                <li>2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->
<div style="clear:both;"></div>
<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <h2><span>我的购物车</span></h2>


    <table>
        <thead>
        <tr>
            <!--<td></td>-->
            <th class="col1">商品名称</th>
            <!--<th class="col2">商品信息</th>-->
            <th class="col3">单价</th>
            <th class="col4">数量</th>
            <th class="col5">小计</th>
            <th class="col6">操作</th>
        </tr>
        </thead>

        <tbody>
        <?php
 $tp = 0; foreach ($cartList as $k => $v): ?>

        <tr id="updateInfo" goods_id="<?php echo ($v["goods_id"]); ?>" goods_attr_id="<?php echo ($v["goods_attr_id"]); ?>">
            <!--<td><input type="checkbox" name="checkBox[]" value="<?php echo ($v["goods_id"]); ?>"> </td>-->
            <td class="col1"><a href=""><img src="/shop/ecshop/<?php echo ($v["goods_img"]); ?>"/></a> <strong><a
                    href=""><?php echo ($v["goods_name"]); ?></a></strong></td>
            <!--<td class="col2"> <?php echo ($v["goods_attr_str"]); ?> </td>-->
            <td class="col3">￥<span><?php echo ($v["shop_price"]); ?></span>元</td>
            <td class="col4">

                <a href="javascript:;" class="reduce_num"></a>
                <input id="inputNum" type="text" name="amount" value="<?php echo ($v["goods_num"]); ?>" class="amount"/>
                <a href="javascript:;" class="add_num"></a>

               (库存：<?php echo ($v["goods_kucun"]); ?>件)
            </td>
            <td class="col5">￥<span><?php $xj = $v['goods_num'] * $v['shop_price']; $tp+=$xj; echo $xj; ?></span>元
            </td>
            <td class="col6"><a href="javascript:void(0);">删除</a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo ($tp); ?></span>元</strong></td>
        </tr>
        </tfoot>
    </table>

        <div class="cart_btn w990 bc mt10">
            <a href="/shop/ecshop/index.php/Home/Index/index" class="continue">继续购物</a>
            <a href="/shop/ecshop/index.php/Home/Cart/order" onclick="isLack();" class="checkout">结 算</a>

        </div>

</div>
<!-- 主体部分 end -->


<div style="clear:both;"></div>

	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->
<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/xin.png" alt="" /></a>
        <a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/police.jpg" alt="" /></a>
        <a href=""><img src="<?php echo (HOME_PUBLIC); ?>/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>


<script>
    function isLack() {
//        alert(1);
    }


    function ajaxUpdateCart(goodsId, goodsNum) {
        //不能向下面那样写，不然每次只能执行一个商品的修改
//	var goodsId = $('#updateInfo').attr('goods_id') ;
//	var goodsNum = $('#inputNum').val();
        $.ajax({
            type: 'GET',
            url: "/shop/ecshop/index.php/Home/Cart/ajaxUpdate/id/" + goodsId + "/num/" + goodsNum,
            dataType: 'json',
            success: function (data) {

            }
        })

    }

    //$.ajax({
    //	type: 'GET',
    //	url : "/shop/ecshop/index.php/Home/Cart/ajaxKucun/"+goodsId+"/num/"+goodsNum ,
    //	dataType : "json",
    //	success : function (data) {
    //
    //	}
    //})

</script>