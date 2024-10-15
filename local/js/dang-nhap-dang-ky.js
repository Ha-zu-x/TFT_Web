var User = (function() {
  // =============================
  // Private methods and propeties
  // =============================
  cart = [];
  
  // Constructor
  function Item(id,name,pass,email,tel,country,city,ward,address) {
	this.name = name 
	this.pass = pass 
	this.email = email
	this.tel = tel
	this.country = country
	this.city = city
	this.ward = ward
	this.address = address	
  }
  
  // Save cart
  function saveCart() {
    sessionStorage.setItem('User', JSON.stringify(cart));
	console.log(JSON.stringify(cart))
  }  
    // Load cart
  function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('User'));
  }
  if (sessionStorage.getItem("User") != null) {
    loadCart();
  }
  

  // =============================
  // Public methods and propeties
  // =============================
  var obj = {};
  
  // Add to cart
  obj.addItemToCart = function(name, price, count, img) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart[item].amount ++;
        saveCart();
        return;
      }
    }
    var item = new Item(name, price, count, img);
    cart.push(item);
    saveCart();
  }
  // Set count from item
  obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].amount = count;
        break;
      }
    }
  };
  // Remove item from cart
  obj.removeItemFromCart = function(name) {
      for(var item in cart) {
        if(cart[item].name === name) {
          cart[item].amount --;
          if(cart[item].amount === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  // Remove all items from cart
  obj.removeItemFromCartAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // Clear cart
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  // Count cart 
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].amount;
    }
    return totalCount;
  }

  // Total cart
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].amount;
    }
    return Number(totalCart.toFixed(1));
  }

  // List cart
  obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.amount).toFixed(1);
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  // cart : Array
  // Item : Object/Class
  // addItemToCart : Function
  // removeItemFromCart : Function
  // removeItemFromCartAll : Function
  // clearCart : Function
  // countCart : Function
  // totalCart : Function
  // listCart : Function
  // saveCart : Function
  // loadCart : Function
  return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
name_SP = $('.add-to-cart').data('name');


$('.add-to-cart').click(function(event) {
  event.preventDefault();
  name = $(this).data('name');
  price = Number($(this).data('price'));
  img = $(this).data('img');
  User.addItemToCart(name, price, 1, img);
  displayCart();
});

// Clear items
$('.clear-cart').click(function() {
  User.clearCart();
  displayCart();
});

$('#btn_order').click(function() {  
/*  */
	$("#form-cart-submit").validate({
		debug:false,
		errorClass:"text-danger",
		errorElement:"span",
		submitHandler:function(){
		$.ajax({
			url:"/PHPMailer/send-to-mail.php",
			type:"POST",
			data:$('#form-cart-submit').serialize(),
			beforeSend:function(){
				$('.show-cart').html('<div class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>');
			},
			success:function(response){
				User.clearCart();
				displayCart();
				$('#info').attr('style','display:none');
				
				$('.show-cart').html(response);
				$('#btn_order').attr('style','display:none');
							
			},
		});
		}
	});
});

function displayCart() {
  var cartArray = User.listCart();
  var output = "";
  var tt = 0;
  
  for(var i in cartArray) {
    var name_sp = cartArray[i].name;
	output += ""
	
	
+ '<div class="media">'
+ '	<div class="media-left"><img class="media-object" src="'+ cartArray[i].img + '" style="width:40px"></div>'
+ '	<div class="media-body">' + cartArray[i].name + '</div>'
+ '</div>'

+ '<div class="">'
	+ '<div class="row">'
		+ '<div class="col-xs-6">'
		
	+ '<div class="input-group">'
	+ '<a href="#" class="minus-item input-group-addon" data-name="' + cartArray[i].name + '">-</a>'
	+ '<input type="number" class="item-count form-control" data-name="' + cartArray[i].name + '" value="' + cartArray[i].amount + '" >'
	+ '<a href="#" class="plus-item input-group-addon" data-name="'+ cartArray[i].name + '">+</a>'
	+ '</div>'		

		+ '</div>'
		+ '<div class="col-xs-6 text-right">'

	+ Number(cartArray[i].total).toLocaleString('vn-VN', { style: 'currency', currency: 'VND' }) + ' <button class="delete-item " data-name="' + cartArray[i].name + '"><span class="glyphicon glyphicon-trash"></span></button>'	

		+ '</div>'
	+ '</div>'
+ '</div><br>'

	tt = tt+1 ;
	
	
  }
  
  $('.show-cart').html(output + '<hr>');
  
  var tong_cong = User.totalCart().toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });
  $('.total-cart').html(tong_cong);
  
  $('.total-count').html(User.totalCount());   
  
  $('.thong-tin-don-hang').html(JSON.stringify(cart));
  
	if (User.totalCount() != 0) {
		$('#icon-cart').attr('style','');
		$('#btn_order').attr('style','');
		$('#info').attr('style','');
	}else{
		$('#icon-cart').attr('style','display: none;')
		$('#btn_order').attr('style','display:none');
		$('#info').attr('style','display:none');
	}
  
  return JSON.stringify(cart);
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('name')
  User.removeItemFromCartAll(name);
  displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
  event.preventDefault();
  var name = $(this).data('name')
  User.removeItemFromCart(name);
  displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
  event.preventDefault();
  var name = $(this).data('name')
  User.addItemToCart(name);
  displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  User.setCountForItem(name, count);
  displayCart();
});

displayCart();

$("#opt a").click(function(){
	event.preventDefault();
	var price = Number($(this).attr('data-price'));
	$(".add-to-cart").attr('data-price',Number($(this).attr('data-price')));
	$(".add-to-cart").attr('data-name',$(this).attr('data-name'));	
	$('.price').html(price.formatMoney(0, "." , ",") + ' vnđ');
	
	$("#btn-booking").attr('onclick',"booking('" + $(this).attr('data-name') + "','" + price + "')");
//	var selector = '.nav li';

	$('#opt a').removeClass('active');
	$(this).addClass('active');
});

$("select").change(function(){	
	var valueSelected = Number($(this).val()); 
	var textSelected   = $(this).find("option:selected").text()
	
	$(".add-to-cart").attr('data-price',valueSelected);
	$(".add-to-cart").attr('data-name',name_SP + ' - ' + textSelected);
	
	$('.price').html(valueSelected.formatMoney(0, "." , ",") + 'vnđ');
	;
});
Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

function booking(ten_sp,gia_1 = 0,gia_2 = 0){
	$("#modal").modal();
/*	*/	
	$.ajax({
		type:"post",
		data:{
			'ten' : ten_sp,
			'gia_1' : gia_1,
			'gia_2' : gia_2,
			
        },
		url:"/layout/booking.php",				
		beforeSend:function(){
					$('#load_modal').html('<img class="center-block" src="/images/loading.gif" alt="loading">');
				},
		success:function(response){
					$('#load_modal').html(response);					
				},
	});	
};