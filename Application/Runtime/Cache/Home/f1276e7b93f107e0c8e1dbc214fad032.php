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
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/fillin.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/common.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/jqzoom.css" type="text/css">

    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/footer.css" type="text/css">
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/header.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/index.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/cart2.js"></script>
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


<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><img src="<?php echo (HOME_PUBLIC); ?>/images/logo.png" alt="京西商城"></a></h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>
<form action="/shop/ecshop/index.php/Home/Cart/order" method="POST" name="order_form">
    <!-- 主体部分 start -->
    <div class="fillin w990 bc mt15">
        <div class="fillin_hd">
            <h2>填写并核对订单信息</h2>
        </div>

        <div class="fillin_bd">
            <!-- 收货人信息  start-->
            <div class="address">
                <h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>

                <?php foreach($addrList as $k=>$v): ?>
                <div class="address_info" >
                    <p><input type="radio"  <?php if($k==0): ?>checked="checked" <?php endif; ?>   name="addressId" value="<?php echo ($v["address_id"]); ?>"/>
                        <?php echo ($v["consignee"]); ?> <?php echo ($v["telephone"]); ?> </p>
                    <p>&nbsp; <?php echo ($v["province"]); ?> <?php echo ($v["city"]); ?> <?php echo ($v["area"]); ?> <?php echo ($v["street"]); ?> </p>
                </div>
                <?php endforeach; ?>


                <div class="address_select none">
                    <ul>

                        <?php foreach($addrList as $k=>$v): ?>
                        <li>
                            <input type="radio" name="addressId" value="<?php echo ($v["address_id"]); ?>"/><?php echo ($v["consignee"]); ?> <?php echo ($v["province"]); ?> <?php echo ($v["city"]); ?>
                            <?php echo ($v["area"]); ?> <?php echo ($v["street"]); ?> <?php echo ($v["telephone"]); ?>
                            <a href="">设为默认地址</a>
                            <a href="">编辑</a>
                            <a href="">删除</a>
                        </li>
                        <?php endforeach; ?>


                        <li><input type="radio" name="newAddress" class="new_address"/>使用新地址</li>
                    </ul>
                    <ul>
                        <li>
                            <label for=""><span>*</span>收 货 人：</label>
                            <input type="text" name="consignee" class="txt"/>
                        </li>
                        <li>
                            <label for=""><span>*</span>所在地区：</label>
                            <select name="province" id="">
                                <option value="">请选择</option>
                                <option value="陕西省">陕西省</option>
                                <option value="四川省">四川省</option>
                                <option value="湖北省">湖北省</option>
                                <option value="湖南省">湖南省</option>
                                <option value="河北省">河北省</option>
                            </select>

                            <select name="city" id="">
                                <option value="">请选择</option>
                                <option value="武汉市">武汉市</option>
                                <option value="仙桃市">仙桃市</option>
                                <option value="襄阳市">襄阳市</option>

                            </select>

                            <select name="area" id="">
                                <option value="">请选择</option>
                                <option value="雁塔区">雁塔区</option>
                                <option value="未央区">未央区</option>
                                <option value="新城区">新城区</option>
                                <option value="高新区">高新区</option>
                                <option value="长安区">长安区</option>
                            </select>
                        </li>
                        <li>
                            <label for=""><span>*</span>详细地址：</label>
                            <input type="text" name="street" class="txt address"/>
                        </li>
                        <li>
                            <label for=""><span>*</span>邮政编码：</label>
                            <input type="text" name="zipcode" class="txt"/>
                        </li>
                        <li>
                            <label for=""><span>*</span>手机号码：</label>
                            <input type="text" name="telephone" class="txt"/>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 收货人信息  end-->

            <!-- 配送方式 start -->
            <div class="delivery">
                <h3>发货方式</h3>
                <div class="delivery_select">
                    <table>
                        <thead>
                        <tr>
                            <th class="col1">送货方式</th>
                            <th class="col2">运费</th>
                            <th class="col3">运费标准</th>
                        </tr>
                        </thead>
                        <tr>

                            <td><input type="radio" checked="checked" name="shipping_id" value="1"/>顺风</td>
                            <td>￥40.00</td>
                            <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                        </tr>
                        <tr>

                            <td><input type="radio" name="shipping_id" value="1"/>圆通</td>
                            <td>￥40.00</td>
                            <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                        </tr>

                        <tr>

                            <td><input type="radio" name="shipping_id" value="3"/>韵达</td>
                            <td>￥40.00</td>
                            <td>每张订单不满499.00元,运费40.00元, 订单4...</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- 配送方式 end -->

            <!-- 支付方式  start-->
            <div class="pay">
                <h3>支付方式</h3>

                <div class="pay_select">
                    <table>
                        <!--<tr class="cur">-->
                        <tr>
                            <td class="col1"><input type="radio" checked="checked" name="pay_id" value="1"/>支付宝</td>
                            <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                        </tr>

                        <!--<tr class="cur">-->
                        <tr>
                            <td class="col1"><input type="radio"  name="pay_id" value="2"/>微信</td>
                            <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                        </tr>

                        <!--<tr class="cur">-->
                        <tr>
                            <td class="col1"><input type="radio"  name="pay_id" value="3"/>网银</td>
                            <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                        </tr>

                        <!--<tr class="cur">-->
                        <tr>
                            <td class="col1"><input type="radio"  name="pay_id" value="4"/>货到付款</td>
                            <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- 支付方式  end-->

            <!-- 发票信息 start-->
            <div class="receipt">
                <h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
                <div class="receipt_info">
                    <p>个人发票</p>
                    <p>内容：明细</p>
                </div>

                <div class="receipt_select none">
                    <form action="">
                        <ul>
                            <li>
                                <label for="">发票抬头：</label>
                                <input type="radio" name="type" checked="checked" class="personal"/>个人
                                <input type="radio" name="type" class="company"/>单位
                                <input type="text" class="txt company_input" disabled="disabled"/>
                            </li>
                            <li>
                                <label for="">发票内容：</label>
                                <input type="radio" name="content" checked="checked"/>明细
                                <input type="radio" name="content"/>办公用品
                                <input type="radio" name="content"/>体育休闲
                                <input type="radio" name="content"/>耗材
                            </li>
                        </ul>
                    </form>
                    <a href="" class="confirm_btn"><span>确认发票信息</span></a>
                </div>
            </div>
            <!-- 发票信息 end-->

            <!-- 商品清单 start -->
            <div class="goods">
                <h3>商品清单</h3>
                <table>
                    <thead>
                    <tr>
                        <th class="col1">商品</th>
                        <!--<th class="col2">规格</th>-->
                        <th class="col3">价格</th>
                        <th class="col4">数量</th>
                        <th class="col5">小计</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php	$tp = 0; foreach ($cartList as $k => $v): ?>
                    <tr goods_id="<?php echo ($v["goods_id"]); ?>" >
                        <td class="col1"><a href=""><img src="/shop/ecshop/<?php echo ($v["goods_img"]); ?>" /></a> <strong><a href=""><?php echo ($v["goods_name"]); ?></a></strong>
                        </td>
                        <!--<td class="col2"> <?php echo ($v["goods_attr_str"]); ?></td>-->
                        <td class="col3">￥<span><?php echo ($v["shop_price"]); ?></span>元</td>
                        <td class="col4">
                            <?php echo ($v["goods_num"]); ?>
                        </td>
                        <td class="col5">
                            ￥<span><?php $xj = $v['goods_num'] * $v['shop_price']; $tp+=$xj; echo $xj; ?></span>元
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- 商品清单 end -->

        </div>

        <div class="fillin_ft">
            <a onclick="$('form[name=order_form]').submit();" href="javascript:void(0);"><span>提交订单</span></a>
            <p>应付总额：<strong>￥<?php echo ($tp); ?>元</strong></p>
            <input type="hidden" name="goods_amount" value="<?php echo ($tp); ?>"/>

        </div>
    </div>
    <!-- 主体部分 end -->
</form>

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