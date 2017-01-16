<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo (ADMIN_PUBLIC); ?>/styles/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo (ADMIN_PUBLIC); ?>/js/utils.js"></script>
	<script type="text/javascript" src="<?php echo (ADMIN_PUBLIC); ?>/js/selectzone.js"></script>
	<script type="text/javascript" src="<?php echo (ADMIN_PUBLIC); ?>/js/colorselector.js"></script>
	<script type="text/javascript" src="<?php echo (ADMIN_PUBLIC); ?>/js/calendar.php?lang="></script>
	<script type="text/javascript" src="/shop/ecshop/Public/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<h1>
	<span class="action-span"><a href="index.php?p=admin&c=goods&a=index">商品列表</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 编辑商品信息 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab">通用信息</span>
		<span class="tab-back" id="detail-tab">详细描述</span>
		<span class="tab-back" id="mix-tab">其他信息</span>
		<span class="tab-back" id="properties-tab">商品属性</span>
		<span class="tab-back" id="gallery-tab">商品相册</span>
      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="/shop/ecshop/index.php/Admin/Goods/goodsAdd" method="post" name="theForm">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
		 
		 <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center" style="display: table;">
			<tbody>
				<tr>
					<td class="label">商品名称：</td>
					<td><input type="text" name="goods_name" value="诺基亚N85" size="30"><span class="require-field">*</span></td>
				</tr>
				<tr>
					<td class="label">商品货号： </td>
					<td><input type="text" name="goods_sn" value="ECS000032" size="20" onblur="checkGoodsSn(this.value,'32')"><span id="goods_sn_notice"></span><br>
					<span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
			</tr>
			<tr>
				<td class="label">商品分类：</td>
				<td>
					<select name="cat_id" onchange="hideCatDiv()">
						<option value="0">请选择...</option>
						<?php if(is_array($catList)): $i = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>">
								<?php echo (str_repeat("&nbsp;&nbsp;",$vo["level"])); ?>
								<?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
                 </td>
			</tr>
			<tr>
				<td class="label">商品品牌：</td>
				<td>
					<select name="brand_id" onchange="hideBrandDiv()">
						<option value="0">请选择...</option>
						<?php if(is_array($brandList)): $i = 0; $__LIST__ = $brandList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["brand_id"]); ?>"><?php echo ($vo["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>
            <tr>
				<td class="label">选择供货商：</td>
				<td>
					<select name="suppliers_id" id="suppliers_id">
						<option value="0">不指定供货商属于本店商品</option>
						<option value="1">北京供货商</option>
						<option value="2">上海供货商</option>      
					</select>
				</td>
			</tr>
            <tr>
				<td class="label">本店售价：</td>
				<td><input type="text" name="shop_price" value="3010.00" size="20" onblur="priceSetted()">
				<input type="button" value="按市场价计算" onclick="marketPriceSetted()">
				<span class="require-field">*</span></td>
			</tr>
			<tr>
            <td class="label">会员价格：</td>
            <td><input type="text" name="user_price" value="3010.00" size="20" onblur="priceSetted()"></td>
          </tr>

          <tr>
            <td class="label">市场售价：</td>
            <td><input type="text" name="market_price" value="3612.00" size="20">
              <input type="button" value="取整数" onclick="integral_market_price()">
            </td>
          </tr>
    
          <tr>
            <td class="label"><label for="is_promote"><input type="checkbox" id="is_promote" name="is_promote" value="1" checked="checked" onclick="handlePromote(this.checked);"> 促销价：</label></td>
            <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="2750.00" size="20"></td>
          </tr>
          <tr id="promote_4">
              <link href="<?php echo (ADMIN_PUBLIC); ?>/datepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />

              <script type="text/javascript" language="javascript" src="<?php echo (ADMIN_PUBLIC); ?>/datepicker/jquery-1.7.2.min.js"></script>
              <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
              <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/datepicker/datepicker_zh-cn.js"></script>




            <td class="label" id="promote_5">促销日期：</td>
            <td id="promote_6">
              <input name="promote_start_time" type="text" id="promote_start_date" size="12" value="" > --
                <!--<input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('promote_start_date', '%Y-%m-%d', false, false, 'selbtn1');" value="选择" class="button"> - -->
                <input name="promote_end_time" type="text" id="promote_end_date" size="12" value="" >
                <!--<input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('promote_end_date', '%Y-%m-%d', false, false, 'selbtn2');" value="选择" class="button">-->
            </td>
          </tr>
          <tr>
            <td class="label">上传商品图片：</td>
            <td>
              <input type="file" name="goods_img" size="35">
                              <a href="goods.php?act=show_image&amp;img_url=<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/200905/goods_img/32_G_1242110760868.jpg" target="_blank"><img src="<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/yes.gif" border="0"></a>
                            <br><input type="text" size="40" value="商品图片外部URL" style="color:#aaa;" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" name="goods_img_url">
            </td>
          </tr>
          <tr id="auto_thumb_1">
            <td class="label"> 上传商品缩略图：</td>
            <td id="auto_thumb_3">
              <input type="file" name="goods_thumb" size="35" disabled="">
                              <a href="goods.php?act=show_image&amp;img_url=<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/200905/thumb_img/32_thumb_G_1242110760196.jpg" target="_blank"><img src="<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/yes.gif" border="0"></a>
                            <br><input type="text" size="40" value="商品缩略图外部URL" style="color:#aaa;" onfocus="if (this.value == '商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url" disabled="">
                            <br><label for="auto_thumb"><input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)">自动生成商品缩略图</label>            </td>
          </tr>
        </tbody></table>

          <!-- 详细描述 -->
          <table width="90%" id="detail-table" style="display: none;">
              <tbody><tr>
                  <td>
                      <input type="hidden" id="goods_desc" name="goods_desc" value="" style="display:none">
                      <input type="hidden" id="goods_desc___Config" value="" style="display:none">
                      <!--<iframe id="goods_desc___Frame" src="<?php echo (ADMIN_PUBLIC); ?>/fckeditor/editor/fckeditor.html?InstanceName=goods_desc&amp;Toolbar=Normal" width="100%" height="320" frameborder="0" scrolling="no" style="margin: 0px; padding: 0px; border: 0px; background-color: transparent; background-image: none; width: 100%; height: 320px;">-->

                      <!--</iframe>-->

                      <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/ueditor.config.js"></script>
                      <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/ueditor.all.min.js"> </script>
                      <script type="text/javascript" charset="utf-8" src="<?php echo (ADMIN_PUBLIC); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
                      <script id="editor" type="text/plain"  name="goods_desc" style="width:800px;height:200px;"></script>
                      <script type="text/javascript">
                      //实例化编辑器
                      //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                      var ue = UE.getEditor('editor');

                      </script>

                      <!--<input type="hidden" name="goods_id" value="<?php echo ($goodsinfo['goods_id']); ?>">-->

                  </td>
              </tr>
              </tbody></table>


        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display: none;" align="center">
                    <tbody><tr>
            <td class="label">商品重量：</td>
            <td><input type="text" name="goods_weight" value="" size="20"> <select name="weight_unit"><option value="1">千克</option><option value="0.001" selected="">克</option></select></td>
          </tr>
                              <tr>
            <td class="label"><a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息"><img src="<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>
<!--            <td><input type="text" name="goods_number" value="4" size="20" readonly="readonly" /><br />-->
            <td><input type="text" name="goods_number" value="4" size="20"><br>
            <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
          </tr>
          <tr>
            <td class="label">库存警告数量：</td>
            <td><input type="text" name="warn_number" value="1" size="20"></td>
          </tr>
                    <tr>
            <td class="label">加入推荐：</td>
            <td><input type="checkbox" name="is_best" value="1" checked="checked">精品 <input type="checkbox" name="is_new" value="1" checked="checked">新品 <input type="checkbox" name="is_hot" value="1" checked="checked">热销</td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2">上架：</td>
            <td id="alone_sale_3"><input type="checkbox" name="is_onsale" value="1" checked="checked"> 打勾表示允许销售，否则不允许销售。</td>
          </tr>
          <tr>
            <td class="label">能作为普通商品销售：</td>
            <td><input type="checkbox" name="is_alone_sale" value="1" checked="checked"> 打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。</td>
          </tr>
          <tr>
            <td class="label">是否为免运费商品</td>
            <td><input type="checkbox" name="is_shipping" value="1"> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。</td>
          </tr>
          <tr>
            <td class="label">商品关键词：</td>
            <td><input type="text" name="keywords" value="2008年10月 GSM,850,900,1800,1900 黑色" size="40"> 用空格分隔</td>
          </tr>
          <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="goods_brief" cols="40" rows="3"></textarea></td>
          </tr>
          <tr>
            <td class="label">
            <a href="javascript:showNotice('noticeSellerNote');" title="点击此处查看提示信息"><img src="<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商家备注： </td>
            <td><textarea name="seller_note" cols="40" rows="3"></textarea><br>
            <span class="notice-span" style="display:block" id="noticeSellerNote">仅供商家自己看的信息</span></td>
          </tr>
        </tbody></table>

        <!-- 商品属性 -->
         <table width="90%" id="properties-table" style="display: none;" align="center">
			<tbody>
				<tr>
					<td class="label">商品类型：</td>
					<td>
						<select name="type_id" onchange="getAttrList(32)" id="sw_type">
							<option value="0">请选择商品类型</option>
							<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>" ><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select><br>
						<span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
					</td>
				</tr>


				<tr>
				<td id="tbody-goodsAttr" colspan="2" style="padding:0">
					<!--<table width="100%" id="attrTable">-->
						<!--<tbody>-->
							<!--<tr>-->
								<!--<td class="label">上市日期</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="172">-->
										<!--<select name="attr_value_list[]">-->
											<!--<option value="">请选择...</option>-->

											<!--<option value="2008年06月">2008年06月</option>-->
											<!--<option value="2008年07月">2008年07月</option>-->
											<!--<option value="2008年08月">2008年08月</option>-->
											<!--<option value="2008年09月">2008年09月</option>-->
											<!--<option value="2008年10月" selected="selected">2008年10月</option>-->
											<!--<option value="2008年11月">2008年11月</option>-->
											<!--<option value="2008年12月">2008年12月</option>-->
											<!--<option value="2007年01月">2007年01月</option>-->
											<!--<option value="2007年02月">2007年02月</option>-->


										<!--</select>  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">存储卡格式</td>-->
								<!--<td>	-->
									<!--<input type="hidden" name="attr_id_list[]" value="180">-->
									<!--<input name="attr_value_list[]" type="text" value="MicroSD" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->

							<!--<tr>-->
								<!--<td class="label">K-JAVA</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="183">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->

							<!--<tr>-->
								<!--<td class="label">屏幕颜色</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="186">-->
										<!--<select name="attr_value_list[]">-->
											<!--<option value="">请选择...</option>-->
											<!--<option value="1600万">1600万</option>-->
											<!--<option value="262144万">262144万</option>-->
										<!--</select>  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">屏幕材质</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="187">-->
										<!--<select name="attr_value_list[]">-->
											<!--<option value="">请选择...</option>-->
											<!--<option value="TFT">TFT</option>-->
										<!--</select>  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">屏幕分辨率</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="188">-->
									<!--<select name="attr_value_list[]">-->
										<!--<option value="">请选择...</option>-->
										<!--<option value="320×240 像素">320×240 像素</option>-->
										<!--<option value="240×400 像素">240×400 像素</option>-->
										<!--<option value="240×320 像素">240×320 像素</option>-->
										<!--<option value="176x220 像素">176x220 像素</option>-->
									<!--</select>  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">屏幕大小</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="189">-->
									<!--<input name="attr_value_list[]" type="text" value="2.6英寸" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">中文输入法</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="190">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">情景模式</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="191">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">网络链接</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="192">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->


							<!--<tr>-->
								<!--<td class="label">像素</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="199">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->


							<!--<tr>-->
								<!--<td class="label">CPU频率</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="205">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">收音机</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="206">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">耳机接口</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="207">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">闪光灯</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="208">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">浏览器</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="209">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->

							<!--<tr>-->
								<!--<td class="label"><a href="javascript:;" onclick="addSpec(this)">[+]</a>配件</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="210">-->
									<!--<select name="attr_value_list[]">-->
										<!--<option value="">请选择...</option>-->
										<!--<option value="线控耳机">线控耳机</option>-->
										<!--<option value="蓝牙耳机" selected="selected">蓝牙耳机</option>-->
										<!--<option value="数据线">数据线</option>-->
									<!--</select> -->
									<!--属性价格 <input type="text" name="attr_price_list[]" value="100" size="5" maxlength="10">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label"><a href="javascript:;" onclick="removeSpec(this)">[-]</a>配件</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="210">-->
									<!--<select name="attr_value_list[]">-->
										<!--<option value="">请选择...</option>-->
										<!--<option value="线控耳机">线控耳机</option>-->
										<!--<option value="蓝牙耳机">蓝牙耳机</option>-->
										<!--<option value="数据线" selected="selected">数据线</option>-->
									<!--</select> -->
									<!--属性价格 <input type="text" name="attr_price_list[]" value="12" size="5" maxlength="10">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label"><a href="javascript:;" onclick="removeSpec(this)">[-]</a>配件</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="210">-->
										<!--<select name="attr_value_list[]">-->
											<!--<option value="">请选择...</option>-->
											<!--<option value="线控耳机" selected="selected">线控耳机</option>-->
											<!--<option value="蓝牙耳机">蓝牙耳机</option>-->
											<!--<option value="数据线">数据线</option>-->
										<!--</select> -->
										<!--属性价格 <input type="text" name="attr_price_list[]" value="50" size="5" maxlength="10">-->
									<!--</td>-->
								<!--</tr>-->

							<!--<tr>-->
								<!--<td class="label">理论通话时间</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="174">-->
									<!--<input name="attr_value_list[]" type="text" value="6.9 小时" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">理论待机时间</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="175">-->
									<!--<input name="attr_value_list[]" type="text" value="363 小时" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">铃声</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="176">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">铃声格式</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="177">-->
									<!--<input name="attr_value_list[]" type="text" value="" size="40">  -->
									<!--<input type="hidden" name="attr_price_list[]" value="0">-->
								<!--</td>-->
							<!--</tr>-->
							<!--<tr>-->
								<!--<td class="label">外观样式</td>-->
								<!--<td>-->
									<!--<input type="hidden" name="attr_id_list[]" value="178">-->
										<!--<select name="attr_value_list[]">-->
											<!--<option value="">请选择...</option>-->
											<!--<option value="翻盖">翻盖</option>-->
											<!--<option value="滑盖">滑盖</option>-->
											<!--<option value="直板">直板</option>-->
											<!--<option value="折叠">折叠</option>-->
										<!--</select>  -->
										<!--<input type="hidden" name="attr_price_list[]" value="0">-->
									<!--</td>-->
								<!--</tr>-->

							<!--</tbody>-->
						<!--</table>-->
					</td>
			 </tr>
        </tbody>
	</table>


        
        <!-- 商品相册 -->
        <table width="90%" id="gallery-table" style="display: none;" align="center">
          <tbody><tr>
            <td>
				<div id="gallery_41" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                <a href="javascript:;" onclick="if (confirm('您确实要删除该图片吗？')) dropImg('41')">[-]</a><br>
                <a href="goods.php?act=show_image&amp;img_url=<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/200905/goods_img/32_P_1242110760641.jpg" target="_blank">
                <img src="../<?php echo (ADMIN_PUBLIC); ?>//<?php echo (ADMIN_PUBLIC); ?>//images/200905/thumb_img/32_thumb_P_1242110760997.jpg" width="100" height="100" border="0">
                </a><br>
                <input type="text" value="" size="15" name="old_img_desc[41]">
              </div>
                          </td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td>
              <a href="javascript:;" onclick="addImg(this)">[+]</a>
              图片描述 <input type="text" name="img_desc[]" size="20">
              上传文件 <input type="file" name="goods_img[]">
              <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]">
            </td>
          </tr>
        </tbody></table>

        <div class="button-div">
          <input type="hidden" name="goods_id" value="32">
                    <input type="submit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
        </div>
        <input type="hidden" name="act" value="update">
      </form>
    </div>
</div>


<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - 
</div>
<script type="text/javascript" src="<?php echo (ADMIN_PUBLIC); ?>/js/tab.js"></script>
<script type="text/javascript">
	function addImg(obj){
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  	}

    function removeImg(obj){
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');
      tbl.deleteRow(row);
  	}

   	function dropImg(imgId){
    	Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  	}

  	function dropImgResponse(result){
      if (result.error == 0){
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  	}

</script>



<script type="text/javascript">
	$('#sw_type').change(function () {
		var type_id = this.value;
		$.ajax({
			type:"GET",
			url:'/shop/ecshop/index.php/Admin/Attribute/getAttrs',
			data: 'type_id='+type_id,//记得带等于号
			dataType : 'html',
			success:function (msg) {
               // alert(msg);
				$('#tbody-goodsAttr').html(msg);
			}
		})

	})

</script>


<script >$("#promote_end_date").datepicker({ dateFormat: "yy-mm-dd" })</script>
<script >$("#promote_start_date").datepicker({ dateFormat: "yy-mm-dd" })</script>



</body>
</html>