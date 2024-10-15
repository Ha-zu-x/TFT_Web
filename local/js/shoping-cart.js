var crcRate = 0;
var shoppingCart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];

    // Constructor
    function Item(name, price, count, img) {
        this.name = name;
        this.price = price;
        this.amount = count;
        this.img = img;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }

    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(name, price, count, img) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].amount++;
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
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].amount = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(name) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].amount--;
                if (cart[item].amount === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        }
        //Get amount of items in cart
    obj.getItemAmount = function(name) {
            var cartAmount = 0;
            for (var item in cart) {
                if (cart[item].name === name) {
                    cartAmount = cart[item].amount;
                }
            }
            return cartAmount;
        }
        // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart 
    obj.totalCount = function() {
        var totalCount = 0;
        for (var item in cart) {
            totalCount += cart[item].amount;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += cart[item].price * cart[item].amount;
            }
            return Number(totalCart.toFixed(1));
        }
        //Convert total to usd
    obj.crcConverted = function() {
            var crcCvt = crcRate * this.totalCount().toFixed(3);
            return crcCvt
        }
        // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
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
// Initial value
var current_total_cart = shoppingCart.listCart().length;
var pre_total_cart = 0;

// Add item
name_SP = $('.add-to-cart').data('name');

function openNav() {
    var width_windows = $(window).width();
    if (width_windows > 1200) {
        document.getElementById("mySidebar").style.transform = "translateX(0px)";
        document.getElementById("main").style.marginRight = "300px"
    }
}

function closeNav() {
    document.getElementById("mySidebar").style.transform = "translateX(300px)";
    document.getElementById("main").style.marginRight = "auto";
    // Close the paypal purchase modal window   
}

// Clear items
$('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
});

function appendCartElement(startId) {
    var cartArray = shoppingCart.listCart();
    for (var i = startId; i < current_total_cart; i++) {
        var newCart = "" +
            '<div class = "cart-item" >' +
            '<div class="media" style="display: flex; align-items: center; padding-bottom: 16px">' +
            '	<div class="media-left"><img class="media-object" src="' + cartArray[i].img + '" style="width:50px"></div>' +
            '	<div class="media-body" style = "color: #054f97; font-weight: 600;">' + cartArray[i].name + '</div>' +
            '</div>'

        +'<div style="padding-bottom: 16px">' +
        '<div class="row">' +
        '<div class="col-xs-6">'

        +
        '<div class="input-group">' +
        '<a href="#" class="minus-item input-group-addon" data-name="' + cartArray[i].name + '">-</a>' +
            '<input type="number" class="item-count form-control" data-name="' + cartArray[i].name + '" value="' + cartArray[i].amount + '" >' +
            '<a href="#" class="plus-item input-group-addon" data-name="' + cartArray[i].name + '">+</a>' +
            '</div>'

        +
        '</div>' +
        '<div class="col-xs-6 text-right">'

        +
        Number(cartArray[i].total).toLocaleString('vn-VN', { style: 'currency', currency: 'VND' }) + '<button class="delete-item" style="margin-left: 5px" data-name="' + cartArray[i].name + '"><span class="glyphicon glyphicon-trash"></span></button>'

        +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>'
        $('.show-cart').append(newCart);
    }
}

function updateCartElement(cartName, cartAmount) {
    $(".show-cart .cart-item").each(function() {
        var cartItemName = $(this).find(".media-body")[0].innerText;
        if (cartItemName == cartName) {
            if (cartAmount == 0) {
                $(this).remove();
            } else {
                $(this).find(".item-count")[0].value = cartAmount;
            }
            current_total_cart = shoppingCart.listCart().length;
            pre_total_cart = current_total_cart;
        }
    });
}

function displayCart(cartName, cartAmount) {
    if (current_total_cart != pre_total_cart && current_total_cart - pre_total_cart > 0) {
        appendCartElement(pre_total_cart);
        pre_total_cart = current_total_cart;
    } else {
        updateCartElement(cartName, cartAmount);
    }
    var tong_cong = shoppingCart.totalCart().toLocaleString('vn-VN', { style: 'currency', currency: 'VND' });
    $('.total-cart').html(tong_cong);

    $('.total-count').html(shoppingCart.totalCount());
    $('.crc-rate').text(Number(crcRate).toLocaleString('vn-VN', { style: 'currency', currency: 'VND' }));
    $(".crc-converted").text((shoppingCart.totalCart() / crcRate).toFixed(2));
    if (shoppingCart.totalCount() != 0) {
        $('#btn_order').attr('style', '');
        $('#info').attr('style', '');
        $(".icon-cart .badge").css("display", 'block');
        $("#form-cart-submit .not-order").css("display", "none");
        $("#paypal-button-container").css("display", 'block');
    } else {
        $('#btn_order').attr('style', 'display:none');
        $('#info').attr('style', 'display:none');
        $(".icon-cart .badge").css("display", 'none');
        $("#form-cart-submit .not-order").css("display", 'block');
        $("#paypal-button-container").css("display", 'none');
    }

    return JSON.stringify(cart);
}

// Add item to cart by Add button
$('.add-to-cart').off().on('click', function(event) {
    console.log("Item added to cart");
    event.preventDefault();
    name = $(this).data('name');
    price = Number($(this).data('price'));
    img = $(this).data('img');
    shoppingCart.addItemToCart(name, price, 1, img);
    current_total_cart = shoppingCart.listCart().length;
    openNav();
    displayCart(name, shoppingCart.getItemAmount(name));
});

// Delete item button

$('.show-cart-pr1').off().on('click', ".cart-item .delete-item", function(event) {
    console.log("Cart item deleted");
    var name = $(this).data('name')
    shoppingCart.removeItemFromCartAll(name);
    displayCart(name, 0);
    if (shoppingCart.totalCount() == 0) {
        closeNav();
        $("#form-cart-submit .close").click();
    }
});

// +1 button 
$('.show-cart-pr2').off().on('click', ".cart-item .plus-item", function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    shoppingCart.addItemToCart(name);
    var amount = shoppingCart.getItemAmount(name);
    current_total_cart = shoppingCart.listCart().length;
    displayCart(name, amount);
});
// -1 button 
$('.show-cart-pr3').off().on('click', ".cart-item .minus-item", function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    shoppingCart.removeItemFromCart(name);
    current_total_cart = shoppingCart.listCart().length;
    var amount = shoppingCart.getItemAmount(name);
    displayCart(name, amount);
    if (shoppingCart.totalCount() == 0) {
        closeNav();
        $("#form-cart-submit .close").click();
    }
});


// Item count input
$('.show-cart').on("change", ".cart-item .item-count", function() {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart(name, count);
});

$("#opt a").click(function() {
    event.preventDefault();
    var price = Number($(this).attr('data-price'));
    $(".add-to-cart").attr('data-price', Number($(this).attr('data-price')));
    $(".add-to-cart").attr('data-name', $(this).attr('data-name'));
    $('.price').html(price.formatMoney(0, ".", ",") + ' vnđ');

    $("#btn-booking").attr('onclick', "booking('" + $(this).attr('data-name') + "','" + price + "')");
    //	var selector = '.nav li';

    $('#opt a').removeClass('active');
    $(this).addClass('active');
});

$("select").change(function() {
    var valueSelected = Number($(this).val());
    var textSelected = $(this).find("option:selected").text()

    $(".add-to-cart").attr('data-price', valueSelected);
    $(".add-to-cart").attr('data-name', name_SP + ' - ' + textSelected);

    $('.price').html(valueSelected.formatMoney(0, ".", ",") + 'vnđ');;
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

function booking(ten_sp, gia_1 = 0, gia_2 = 0) {
    $("#modal").modal();
    /*	*/
    $.ajax({
        type: "post",
        data: {
            'ten': ten_sp,
            'gia_1': gia_1,
            'gia_2': gia_2,

        },
        url: "/layout/booking.php",
        beforeSend: function() {
            $('#load_modal').html('<img class="center-block" src="/images/loading.gif" alt="loading">');
        },
        success: function(response) {
            $('#load_modal').html(response);
        },
    });
};
$('.show-cart').html('');
displayCart();
// Currency conversions
(function() {
    fetch(`https://api.exchangerate-api.com/v4/latest/USD`)
        .then(response => {
            return response.json();
        })
        .then(data => {
            crcRate = data.rates["VND"];
            displayCart();
        })
})();
$(window).load(function() {
    console.log("Total");

    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'paypal',

        },
        // Set up the transaction
        createOrder: function(data, actions) {
            console.log(shoppingCart.totalCart());
            return actions.order.create({
                "purchase_units": [{
                    "amount": {
                        "value": `${$('.crc-converted').text()}`,
                    },
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For demo purposes:
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details' + '\n\nThank you for your purchase');
                shoppingCart.clearCart();
                displayCart();
                closeNav();
                // Replace the above to show a success message within this page, e.g.
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }


    }).render('#paypal-button-container');
});