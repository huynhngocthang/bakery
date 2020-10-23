$(document).ready(function () {
//    window.onscroll = function () {
//        myFunction()
//    };
//
//    var header = document.getElementById("sticky-header");
//    var sticky = header.offsetTop;
//
//    function myFunction() {
//        if (window.pageYOffset >= sticky) {
//            header.classList.add("sticky");
//            $('.header-logo-link').css('margin', '10px 0');
//            $('.header-search-form').css('margin-top','27px');
//            $('.btn-shopping-cart').css('margin-top','31px');
//            $('.main-content').css('padding-top', '200px');
//        } else {
//            header.classList.remove("sticky");
//            $('.header-logo-link').css('margin', '20px 0');
//            $('.header-search-form').css('margin-top','37px');
//            $('.btn-shopping-cart').css('margin-top','40px');
//            $('.main-content').css('padding-top', '0px');
//        }
//    }
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.header-menu').slideUp();
            $('.hotline').fadeIn();
            $('.header-logo-link').css({'margin': '10px 0'});
            $('.header-logo-link > img').css({'width': '60px'});
            $('.header-search-form').css('margin-top','17px');
            $('.btn-shopping-cart').css('margin-top','21px');
//            $('.main-content').css('padding-top', '200px');
        }
        if($(this).scrollTop() == 0) {
            $('.header-menu').slideDown();
            $('.hotline').fadeOut();
            $('.header-logo-link').css('margin', '20px 0');
            $('.header-logo-link > img').css({'width': '80px'});
            $('.header-search-form').css('margin-top','37px');
            $('.btn-shopping-cart').css('margin-top','40px');
//            $('.main-content').css('padding-top', '0px');
        }
    });
    // GO TOP
    //Show or hide "#go-top"
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 700) {
            jQuery('#go-top').fadeIn(200);
        } else {
            jQuery('#go-top').fadeOut(200);
        }
    });
    // Animate "#go-top"
    jQuery('#go-top').click(function (event) {
        event.preventDefault();
        jQuery('html, body').animate({
            scrollTop: 0
        }, '2000', 'swing');
    });

    // $(window).load(function(event) {
    //         // Animate loader off screen
    //         $('.loader').show();

    //         $('.loader').hide();

    //     });


    $('.add-to-cart').click(function () {
        productid = $(this).data('productid');
        $.ajax({
            url: BASE_URL + 'product/addtocart',
            type: 'post',
            dataType: 'json',
            data: {'product_id': productid},
            success: function (res) {
                if (!res.error) {
                    updateCartNotiQty(res.qty);
                    $.dialog({
                        type: 'green',
                        title: '',
                        content: res.html,
                        columnClass: 'large'
                    });
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Lỗi',
                        content: res.error,
                        columnClass: 'medium'
                    });
                }
            }
        });
    });
    $('#view_bill').click(function () {
        $.ajax({
            url: BASE_URL + 'bill',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (res) {
                if (!res.error) {
                    $.dialog({
                        type: 'blue',
                        title: 'Đơn hàng đã đặt',
                        content: res.html,
                        columnClass: 'large'
                    });
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Lỗi',
                        content: res.error,
                        columnClass: 'medium'
                    });
                }
            }
        });
    });
    $('body').on('click', '#detele_bill', function() {
        var userid = $(this).data('userid');
        var pid = $(this).data('pid');
        $.ajax({
            url: BASE_URL + 'bill/delete',
            type: 'post',
            dataType: 'json',
            data: {'userid': userid ,
                    'pid':pid }
                ,
            success: function (res) {
                if (!res.error) {
                    $.dialog({

                        type: 'red',
                        title: '',
                        content: res.html,
                        columnClass: 'large'

                    });
                    if(res.check == true){
                            window.location.reload();
                        }
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Lỗi',
                        content: res.error,
                        columnClass: 'medium'
                    });
                }
            }
        });
    });
    $('body').on('click', '#btn-payment', function() {
        $(this).attr("disabled", "disabled");

     });

    $('#btn-payment1').click(function () {
        $(this).attr("disabled", "disabled");

     });
    $('#btn-contact-sendmail').click(function () {
        $(this).attr("disabled", "disabled");
        // ('asdasd');

     });
    //     var target = $(this).data('target');
    //     var rowId = $(this).data('rowid');
    //     var qty = parseInt($('.' + target).val());
    //     if (qty > 1) {
    //         $('.' + target).val(qty - 1);
    //         updateCartQty(rowId, qty - 1);
    //     }
    // });
    // $('.increase-qty').click(function () {
    //     var target = $(this).data('target');
    //     var rowId = $(this).data('rowid');
    //     var qty = parseInt($('.' + target).val());
    //     if (qty < 10) {
    //         $('.' + target).val(qty + 1);
    //         updateCartQty(rowId, qty + 1);
    //     }
    // });
    // $('.cart-index-update-giavi').click(function () {
    //     var target = $(this).data('target');
    //     var rowId = $(this).data('rowid');
    //     var giavi = ($('.' + target).val());

    //         updateCartGiavi(rowId, giavi);

    // });
    $('body').on('blur', '.cart-index-update-giavi', function() {
        ('yes');
        // var target = $(this).data('target');
        var rowId = $(this).data('rowid');
        var giavi = $(this).val();

            updateCartGiavi(rowId, giavi);

    });
    $('body').on('click', '.remove-from-cart-ajax', function() {
        // $('.remove-from-cart').click(function () {
        var rowId = $(this).data('rowid');
        ('es');
        AJAXremoveItemFromCart(rowId);
    });
    $('.remove-from-cart').click(function () {
        var rowId = $(this).data('rowid');
        ('es');
        removeItemFromCart(rowId);
    });
    $('.btn_filterpr').click(function () {
        ($('.startprice'));
    });


function updateCartNotiQty(qty) {
    if (qty > 0) {
        $('.cart-qty-notification').show().text(qty);
    } else {
        $('.cart-qty-notification').hide();
    }

}

function updateCartQty(rowId, qty) {
    $.ajax({
        url: BASE_URL + 'cart/update',
        type: 'post',
        dataType: 'json',
        data: {'rowid': rowId, 'qty': qty},
        success: function (res) {
            if (!res.error) {
                updateCartNotiQty(res.qty);
                updateCartTotal(rowId, res.total, res.subtotal);
            } else {
                (res.error);
            }
        }
    });
}
function updateCartGiavi(rowId, giavi) {
    $.ajax({
        url: BASE_URL + 'cart/addgiavi',
        type: 'post',
        dataType: 'json',
        data: {'rowid': rowId, 'giavi': giavi},
        success: function (res) {
            if (!res.error) {
                updateCartNotiQty(res.qty);
                updateCartTotal(rowId, res.total, res.subtotal);
            } else {
                (res.error);
            }
        }
    });
}

function AJAXremoveItemFromCart(rowId) {
    $.ajax({
        url: BASE_URL + 'cart/update',
        type: 'post',
        dataType: 'json',
        data: {'rowid': rowId, 'qty': 0},
        success: function (res) {
            if (!res.error) {
                updateCartNotiQty(res.qty);
                updateCartTotal(rowId, res.total, res.subtotal);
                if(res.check == true){
                     window.location.reload();
                }
            } else {
                (res.error);
            }
        }
    });

}
function removeItemFromCart(rowId) {
    $.confirm({
        title: 'Xóa khỏi giỏ hàng',
        content: 'Bạn đồng ý loại bỏ sản phẩm này khỏi đơn hàng?',
        buttons: {
            close: {
                text: 'Hủy',
                function() {}
            },
            yes: {
                text: 'Đồng ý',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: BASE_URL + 'cart/update',
                        type: 'post',
                        dataType: 'json',
                        data: {'rowid': rowId, 'qty': 0},
                        success: function (res) {
                            if (!res.error) {
                                updateCartNotiQty(res.qty);
                                updateCartTotal(rowId, res.total, res.subtotal);
                                if (res.qty > 0) {
                                    $('tr#' + rowId).fadeOut();
                                } else {
                                    window.location.reload();
                                }
                            } else {
                                (res.error);
                            }
                        }
                    });
                }
            }
        }
    });

}
function updateCartTotal(rowId, total, subtotal) {
    $('#subtotal_' + rowId).text(subtotal);
    $('#cart-index-subtotal, #cart-index-total').html(total);
}

function loadmorehome(el) {
    var page = $(el).data('page');
    $.ajax({
        url: BASE_URL + 'home/' + page,
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            $('#bind-home-products').append(res.products);
            $('.product-tile-wrapper').fadeIn('slow');
            if (!res.next) {
                $(el).hide();
            } else {
                $(el).data('page', res.next);
            }
        }
    });
}

$('.option_sort').click(function () {
    var pagination = $('#orderbyinprofile').val();
    (pagination);
    var date = GetURLParameter('date');
    if(date != ""){
        date_text = "&date="+date;
    }else{
        date_text = "";
        date = null;
    }
    var page_url = BASE_URL +"profile/search?pagination="+pagination+date_text;
    window.history.pushState('string', '', page_url);
        $.ajax({
            url: BASE_URL + 'profile/sortby',
            type: 'post',
            dataType: 'json',
            data: {'pagination':pagination,'date':date},
            success: function (res) {
                if (!res.error) {
                    $('.order_history').html(res.html);
                    window.location.reload();
                } else {
                    $('.order_history').html(res.error);
                    window.location.reload();
                }
            }
        });
    });

function GetURLParameter(sParam) {
    var sPageURL = window.location.href;
    var url = sPageURL.split('?');
    if (url[1] != null) {
        var queryURL = url[1];
        var sURLVariables = queryURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
        return "";
    } else
        return "";
}
function ShowDontUpLoadImg(){
    $.dialog({
        type: 'red',
        title: '',
        content: 'Cập nhật ảnh đại diện bị lỗi',
        columnClass: 'large'

    });
}
    

});
