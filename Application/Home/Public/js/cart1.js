/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/

$(function(){
	
	//减少
	$(".reduce_num").click(function(){
		var amount = $(this).parent().find(".amount");
		if (parseInt($(amount).val()) <= 1){
			alert("商品数量最少为1");
		} else{
			$(amount).val(parseInt($(amount).val()) - 1);
			//以下几行记住哇！！！
			var tr = $(this).parent().parent();
			var goodsId = tr.attr('goods_id') ;
			var goodsNum = $(amount).val();
			ajaxUpdateCart(goodsId, goodsNum);
			//========================
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
	});

	//增加
	$(".add_num").click(function(){
		var amount = $(this).parent().find(".amount");
		$(amount).val(parseInt($(amount).val()) + 1);
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));

		//以下几行记住哇！！！
		var tr = $(this).parent().parent();
		var goodsId = tr.attr('goods_id') ;
		var goodsNum = $(amount).val();
		ajaxUpdateCart(goodsId, goodsNum);
		//========================
	});

	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(this).val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(this).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));

		//以下几行记住哇！！！
		var tr = $(this).parent().parent();
		var goodsId = tr.attr('goods_id') ;
		var goodsNum = $(this).val();
		ajaxUpdateCart(goodsId, goodsNum);
		//========================

	});



	//删除
	$(".col6 a").click(function () {
		if(confirm("您确定删除该商品吗？")){
			var tr = $(this).parent().parent();
			var goodsId = tr.attr('goods_id');
			//修改总金额
			var money = tr.find(".col5").find("span").html() ;
			var total = $("#total").html();
			var newTotal = parseFloat(total) - parseFloat(money);
			$("#total").html(newTotal);
			//删除本行
			tr.remove();

			ajaxUpdateCart(goodsId,0);
		}
		return false; //防止页面跳转
	});

	// delete
	// $(".col6 a").click(function(){
	// 	if(confirm("are you sure?"))
	// 	{
	// 		// 先获取所在的TR
	// 		var tr = $(this).parent().parent();
	// 		var gid = tr.attr("goods_id");
	// 		var gaid = tr.attr("goods_attr_id");
	// 		// 执行AJAX更新到服务器
	// 		ajaxUpdateCart(goodsId,0);
	// 		tr.remove();
	// 		var newTp = parseFloat($("#total").html()) - parseFloat(tr.find(".col5").find("span").html());
	// 		$("#total").html(newTp.toFixed(2));
	// 	}
	// 	return false;
	// });

});