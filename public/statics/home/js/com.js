$(function(){
	// 初始化弹出框
	$('.alert_shop').delay(1500).slideUp(300);
	// 取购物车数量
	cartnum();
	// 修改数量时更新产品总价及所有总价
	$('.change_cart').on('change',function(event) {
		var that = $(this);
    	var gid = that.attr('data-gid');
    	var fid = that.attr('data-fid');
		var num = that.val();
		var price = that.attr('data-price');
    	var new_prices = parseFloat(price) * parseInt(num);
    	// 更新购物车
		$.post(host+'shop/changecart',{gid:gid,num:num,price:price,fid:fid},function(d){
			if (d != 0) {
				cartnum();
		    	// 更新end
		    	$('.total_price_' + gid + '_' + fid).html(new_prices.toFixed(2));
		    	that.val(d);
		    	total_prices();
			}
			else
			{
				alert('修改数量失败，请稍后再试！');
			}
		});
		return;
	});
	/*打开添加购物车*/
	$('.alert_addcart').on('click',function(){
		$('#myModal').modal('show');
	});
	// 移除购物车
	$(".remove_cart").on('click',function(){
		var that = $(this);
    	var gid = that.attr('data-gid');
    	var fid = that.attr('data-fid');
		$.post(host+'shop/removecart',{id:gid,fid:fid},function(d){
			if (d == 1) {
    			that.parent('td').parent('tr').remove();
    			// 重新取购物车数量，计算总价
				cartnum();
    			total_prices();
			}
			else
			{
				alert('删除失败，请稍后再试！');
			}
		});
	});
	// 确认功能
	$(".confirm").click(function(){
		if (!confirm("确实要进行此操作吗?")){
			return false;
		}else{
			return true;
		}
	});
	// 购物车数量变化
	$('.cart_dec').click(function(event) {
		var num = parseInt($('.cart_num').text());
		if (num > 1) {
			$('.cart_num').text(num - 1);
			$('.cartnum').val(num - 1);
		}
	});
	$('.cart_inc').click(function(event) {
		var num = parseInt($('.cart_num').text());
		$('.cart_num').text(num + 1);
		$('.cartnum').val(num + 1);
	});
	// 购物车页面
	$('.cart_dec_cart').on('click',function(event) {
		var gid = $(this).attr('data-gid');
		var num = parseInt($('.cart_num_cart_' + gid).text());
		if (num > 1) {
			$('.cart_num_cart_' + gid).text(num - 1);
			$('.cart_num_' + gid).val(num - 1);
		}
		// 计算总价
		$('.cart_num_' + gid).trigger('change');
		return;
	});
	$('.cart_inc_cart').on('click',function(event) {
		var gid = $(this).attr('data-gid');
		var num = parseInt($('.cart_num_cart_' + gid).text());
		$('.cart_num_cart_' + gid).text(num + 1);
		$('.cart_num_' + gid).val(num + 1);
		// 计算总价
		$('.cart_num_' + gid).trigger('change');
		return;
	});
	// 添加到购物车
	$('.addcart').click(function(event) {
		var gid = $('input[name="gid"]').val();
		var num = $('input[name="num"]').val();
		var fid = $('input[name="fid"]').val();
		var gp = $('input[name="gp"]').val();
		var token = $('input[name="_token"]').val();
		$.post(host+'shop/addcart',{gid:gid,fid:fid,num:num,gp:gp,_token:token},function(d){
			if (d == 1) {
    			// 重新取购物车数量，计算总价
				cartnum();
				$('#myModal').modal('hide');
				/*alert('添加成功！');*/
				$('.alert_good').slideToggle().delay(1500).slideToggle();
			}
			else
			{
				alert('添加失败，请稍后再试！');
			}
		});
	});
	
})
// 更新总价
function total_prices()
{
	var total_price = 0;
	$('.one_total_price').each(function(index, el) {
		var v = $(el).text();
		total_price = total_price + parseFloat(v);
	});
	$('.total_prices').html('￥' + total_price.toFixed(2));
}
// 取购物车数量
function cartnum()
{
	$.get(host + 'shop/cartnums',function(data){
		$('.good_alert_num').html(data);
	});
}