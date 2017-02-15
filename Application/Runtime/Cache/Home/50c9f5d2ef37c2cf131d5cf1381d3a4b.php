<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo ($page_title); ?></title>
	<meta name="keywords" content="<?php echo ($page_keywords); ?>" />
	<meta name="description" content="<?php echo ($page_description); ?>" />
	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/base.css" type="text/css">
	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/global.css" type="text/css">
	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/header.css" type="text/css">


	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/index.css" type="text/css">
	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/login.css" type="text/css">

	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="<?php echo (HOME_PUBLIC); ?>/style/footer.css" type="text/css">
	<script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/header.js"></script>

	<script type="text/javascript" src="<?php echo (HOME_PUBLIC); ?>/js/login.js"></script>

</head>
<body>


<!-- 顶部导航 start -->
<div class="topnav">
	<div class="topnav_bd w1210 bc">
		<div class="topnav_left">

		</div>
		<div class="topnav_right fr">
			<ul>
				<li>您好，欢迎来到京西！[<a href="/shop/ecshop/index.php/Home/Register/login">登录</a>] [<a href="/shop/ecshop/index.php/Home/Register/register">免费注册</a>] </li>
				<li class="line">|</li>
				<li>我的订单</li>
				<li class="line">|</li>
				<li>客户服务</li>

			</ul>
		</div>
	</div>
</div>
<!-- 顶部导航 end -->

<!-- 登录主体部分start -->
	<div class="login w990 bc mt10">
		<div class="login_hd">
			<h2>用户登录</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">Email：</label>
							<input type="text" class="txt" name="email" />
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
						</li>
						<li>
							<label for="">验证码：</label>
							<input class="txt" type="text"  name="chkcode" /><br />
						</li>
						<li>
							<label for="">&nbsp;</label>
							<img onclick="this.src='/shop/ecshop/index.php/Home/Register/checkCode/'+ Math.random();" style="cursor:pointer;" src="/shop/ecshop/index.php/Home/Register/checkCode" width="180" height="60" alt="" />
							<span>看不清？<a onclick="$(this).parent().prev('img').trigger('click');" href="javascript:void(0);">换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				<div class="coagent mt15">
					<dl>
						<dt>使用合作网站登录商城：</dt>
						<dd class="qq"><a href=""><span></span>QQ</a></dd>
						<dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
						<dd class="yi"><a href=""><span></span>网易</a></dd>
						<dd class="renren"><a href=""><span></span>人人</a></dd>
						<dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
						<dd class=""><a href=""><span></span>百度</a></dd>
						<dd class="douban"><a href=""><span></span>豆瓣</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="guide fl">
				<h3>还不是商城用户</h3>
				<p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

				<a href="/shop/ecshop/index.php/Home/Register/register" class="reg_btn">免费注册 >></a>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->