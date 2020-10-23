/***************************************************************************
*
* SCRIPT JS
*
***************************************************************************/

$(document).ready(function(){



    var setheight = $( window ).height();
    setheight = setheight - 264 - 39 -50;
    var padding_height_top = (setheight - 211 + 59)/2;
    $(".main-content").css("height", setheight);
    $(".main-content").css("padding-top", padding_height_top);

    if($( "#checkhasclass" ).hasClass("main-content")) {


    };
    if($('body').height() > $( window ).height()){
      $("#go-top").css("display", "block");

    }
      // if( < 5000  ){

      // }
    // Hover Button for All Pages
    $('.hoverJS').hover(function(){
        $(this).stop().fadeTo(100,0.8);
    },function(){
        $(this).stop().fadeTo(100,1);
    });


    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

  var count = 0;
  $('.btn_toggle').click(function(){
    count += 1;
    if(count % 2 != 0 ){
      $('.navbar-nav').addClass("add_class");
      $('.body_noscroll').addClass("no_scroll");

    } else{
      $('.body_noscroll').removeClass("no_scroll");
        $('.navbar-nav').removeClass("add_class");
    }

  });
  $('body').on('click', '.icon_edit_giavi', function() {
    $('.wrap-giavi').toggle("show");
    $('.giavi').toggle("show");
  });



  $('.iCheck-helper').click(function(){
    if($('.minimal:checked').length > 0) {
      $('#bulk-delete').show();
    }else{
      $('#bulk-delete').hide();
    }
  });
  $('.sup_menu').click(function(){
    $('.dropdown-menu').toggle("show");
  });

  $('.dish-list').click(function(){
    $('.dropdown-menu').hide();
  });
  $('#content').click(function(){
    $('.dropdown-menu').hide();
  });

    $('.btnFilterDate').click(function () {

        var date = new Date($('#datepicker').val());
        if(date != 'Invalid Date'){
            day = date.getDate();
          month = date.getMonth() + 1;
          year = date.getFullYear();
          $.ajax({
                type: "POST",
                url: BASE_URL + "order/getorderbymonth",
                dataType: 'json',
                data: {'month': month,'year':year},
                success: function (res) {
                     jQuery('html, body').animate({
                                scrollTop: 0
                            }, '2000', 'swing');
                    // empty(.a21);
                    if (res != null) {
                        // $('.loader').hide();
                        $('.total-price').html(res.totalprice);
                        $('.list-order').html(res.html);
                    } else
                        $('.list-order').html('không có sản phẩm');
                }
            });
        }


    });
    $('#submit_contact').click(function () {
    var name = $('#name_contact').val();
    var email = $('#email_contact').val();
    var msg = $('#msg_contact').val();
      $('.loader').css('display','block');
     
    if (validateEmail(email) && name.length > 0 && msg.length > 0) {
       $("input[type=text]").val("");
       $("input[type=email]").val("");
       $("input[type=text], textarea").val("");
      $.ajax({
            url: BASE_URL + 'contact',
            type: 'post',
            dataType: 'json',
            data: {'name':name,'email':email,'msg':msg},
            success: function (res) {
                if (!res.error) {
                  $('.loader').css('display','none');
                    $.dialog({
                        type: 'blue',
                        title: 'Gửi thư liên hệ',
                        content: res.msg,
                        columnClass: 'large'
                    });


                } else {
                  $('.loader').hide();
                    $.dialog({
                        type: 'red',
                        title: 'Lỗi',
                        content: res.error,
                        columnClass: 'medium'
                    });
                }
            }
        });
    }else if(!validateEmail(email) && name.length == 0 && msg.length == 0){
      $('.loader').css('display','none');
      $.dialog({
          type: 'red',
          title: 'Gửi thư liên hệ',
          content: 'Gửi thư bị lỗi, vui lòng thêm nội dung vào thư mực để liên hệ',
          columnClass: 'large'
      });
    }else if(!validateEmail(email)){
      $('.loader').css('display','none');
      $.dialog({
          type: 'red',
          title: 'Gửi thư liên hệ',
          content: 'Gửi thư bị lỗi, email không hợp lệ',
          columnClass: 'large'
      });
    }else if(name.length == 0 || msg.length == 0){
     $('.loader').css('display','none');

       $.dialog({
          type: 'red',
          title: 'Gửi thư liên hệ',
          content: 'Gửi thư bị lỗi, Vui lòng không để trống các phần còn lại trong liên hệ',
          columnClass: 'large'
      });
    }else{
     $('.loader').css('display','none');

      $.dialog({
          type: 'red',
          title: 'Gửi thư liên hệ',
          content: 'Gửi thư bị lỗi, Vui lòng không để trống các phần còn lại trong liên hệ',
          columnClass: 'large'
      });
    }

    });

    $('#btn-search-user').click(function(){
        var keyword = $('#content-input').val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "user/searchuser",
            dataType: 'json',
            data: {'keyword': keyword},
            success: function (res) {
                 jQuery('html, body').animate({
                            scrollTop: 0
                        }, '2000', 'swing');
                // empty(.a21);
                if (res != null) {
                    // $('.loader').hide();

                    $('.list-user').html(res.html);
                } else
                    $('.list-user').html('tìm kiếm xảy ra lỗi, xin bạn thực hiện lại');
            }
        });
    });
    // $('.haha').on('click', '.product1', function() {
    // $('#btn-search-product').click(function(){
    //     var keyword = $('#content-input').val();
    //         var page_url = BASE_URL+"admin/order/searchproduct/"+keyword;
    //         window.history.pushState('string', '', page_url);
    //     $.ajax({
    //         type: "POST",
    //         url: BASE_URL + "product/searchproduct",
    //         dataType: 'json',
    //         data: {'keyword': keyword},
    //         success: function (res) {
    //              jQuery('html, body').animate({
    //                         scrollTop: 0
    //                     }, '2000', 'swing');
    //             // empty(.a21);
    //             if (res != null) {
    //                 // $('.loader').hide();

    //                 $('.list-product').html(res.html);
    //                 $('.box-footer').html("<?php echo custom_pagination(site_url('/admin/product/searchproduct/)', $data['total']); ?>");
    //             } else
    //                 $('.list-product').html('tìm kiếm xảy ra lỗi, xin bạn thực hiện lại');
    //         }
    //     });
    // });

    // $('#btn-search-order').click(function(){
    //     var keyword = $('#content-input').val();
    //         console.log('ád');
    //     $.ajax({
    //         type: "POST",
    //         url: BASE_URL + "order/searchorder",
    //         dataType: 'json',
    //         data: {'keyword': keyword},
    //         success: function (res) {
    //              jQuery('html, body').animate({
    //                         scrollTop: 0
    //                     }, '2000', 'swing');
    //             // empty(.a21);
    //             if (res != null) {
    //                 // $('.loader').hide();

    //                 $('.list-detail-order').html(res.html);
    //             } else
    //                 $('.list-detail-order').html('tìm kiếm xảy ra lỗi, xin bạn thực hiện lại');
    //         }
    //     });
    // });
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    function isempty(st){
        var temp=st.replace(" ","");
        if (temp.length<=0){
            return true;
        }else{
            return false;
        }
    }
    function checkPassword(password)
      {
        // at least one number, one lowercase and one uppercase letter
        // at least six characters
        var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        return re.test(String(password).toLowerCase());
      }
    $('#fullname').blur(function () {
         var fullname = $(this).val();
         if(fullname != null && !isempty(fullname) && fullname != ""){
            $('#note-fullname').html('<i class="fa fa-check" style="color:green;"></i>');
         }else{
            $('#note-fullname').html('Không được để trống');
         }
    })
    $('#phone').blur(function () {
         var phone = $(this).val();
         if(phone != null && !isempty(phone) && phone != ""){
            if ( phone.match(/\d/) ) {
                $('#note-phone').html('<i class="fa fa-check" style="color:green;"></i>');
            }else{
                $('#note-phone').html('vui lòng nhập số');
            }
         }else{
            $('#note-phone').html('Không được để trống');
         }
    })
    $('#address').blur(function () {
         var address = $(this).val();
         if(address != null && !isempty(address) && address != ""){
            $('#note-address').html('<i class="fa fa-check" style="color:green;"></i>');
         }else{
            $('#note-address').html('Không được để trống');
         }
    })
    $('#email').blur(function () {
         var email = $(this).val();
         if(email != null && !isempty(email) && email != "" && validateEmail(email)){
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "user/checkemail",
                    dataType: 'json',
                    data: {'email': email},
                    success: function (res) {
                         // jQuery('html, body').animate({
                         //            scrollTop: 0
                         //        }, '2000', 'swing');
                        // empty(.a21);
                        if (res!=null) {
                            // $('.loader').hide();
                            if(res.check == true)
                                $('#note-email').html('<i class="fa fa-check" style="color:green;"></i>');
                            else
                                 $('#note-email').html('email đã tồn tại');
                        } else
                            $('#note-email').html('kiểm tra bị lỗi vui lòng nhập lại');
                    }
                });
         }else{
            $('#note-email').html('Vui lòng nhập email');
         }
    })
   $('#password').blur(function () {
        password = $(this).val();

        if(password != null && !isempty(password) && password != ""){
            //validate letter
            if ( password.length < 8 ) {
                $('#note-password').html('Mật khẩu chưa đủ 8 ký tự');
            }else
            if ( !password.match(/[A-z]/) || !password.match(/[A-Z]/) ) {
                $('#note-password').html('Mật khẩu bảo yếu');
                $('#note-password').css('color','orange');
            }
            //validate capital letter
            // if ( password.match(/[A-Z]/) ) {
            //     $('#note-email').html('Mật khẩu chưa đủ 8 ký tự');
            // }

            //validate number
            else if ( !password.match(/\d/) ) {
                $('#note-password').html('Mật khẩu bảo đủ mạnh');
                $('#note-password').css('color','green');
            }else{
                $('#note-password').html('Mật khẩu bảo mạnh');
                $('#note-password').css('color','blue');
            }
        }
        else
            $('#note-password').html('Mật khẩu không được trống');
    });
    $('#re-pass').blur(function () {
        repass = $(this).val();
        pwd = $('#password').val();


        if(repass != null && !isempty(repass) && repass != ""){
            if(repass === pwd){
               $('#note-re-password').html('<i class="fa fa-check" style="color:green;"></i>');
           }
        }
        else
            $('#note-re-password').html('Nhập lại mật khẩu không đúng');
    });

    $('#price').keyup(function(){
        var $this = $( this );
        var input = $this.val();

        2
        var input = input.replace(/[\D\s\._\-]+/g, "");

        // 3
        input = input ? parseInt( input, 10 ) : 0;

        // 4
        $this.val( function() {
            return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
        } );
    });

   // $('#jqChart').jqChart({
   //      title: "Biểu Đồ Số Lượng Sản Phẩm Bán Ra Theo Năm",
   //      legend: {
   //          itemsCursor: 'pointer'
   //      },
   //      animation: { duration: 1 },
   //      series: [
   //          {
   //              type: 'column',
   //              title: 'Series 1',
   //              data: [['A', 300], ['B', 35], ['C', 68], ['D', 30],
   //                     ['E', 27], ['F', 85], ['D', 43], ['H', 29]]
   //          },
   //          {
   //              type: 'column',
   //              title: 'Series 2',
   //              data: [['A', 69], ['B', 57], ['C', 86], ['D', 23],
   //                     ['E', 70], ['F', 60], ['D', 88], ['H', 22]]
   //          }
   //      ]
   //  });

});
