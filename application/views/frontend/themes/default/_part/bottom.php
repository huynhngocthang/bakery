<section id="footer">
    <div class="inner">
      <div class="contact-us clearfix">
        <div class="cover_info">
          <p class="title_contact">LIÊN HỆ CHÚNG TÔI</p>
          <p class="text_contact">BPOTech JSC.</p>
          <p class="text_contact">Tầng 9, Tòa nhà Vadein, 78 Bến Nghé, Thành Phố Huế, Việt Nam.</p>
          <p class="text_contact">Email:<a href="javscript" class="span_contact"> info@bpotech.com.vn</a></p>
          <p class="text_contact">Số điện thoại:<a href="javscript" class="span_contact">(84-234) 393 6539</a></p>

        </div>
        <div class="mail_info">
            <div class="tx_input">
              <input type="text" name="name" class="info_name" id="name_contact" placeholder="Họ và tên">
              <input type="text" name="email" class="info_name" id="email_contact" placeholder="Email">
            </div>
            <div class="tx_erae">
              <textarea name="message" rows="5" id="msg_contact" cols="8" placeholder="Tin nhắn"></textarea>
            </div>
            <p class="btn-send">
              <button class="hoverJS" type="button" id="submit_contact">Gửi</button>
            </p>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </section><!-- #footer -->
<p id="copyright">Copyright © BPOTech JSC. All rights reserved.</p>



<!-- Modal -->
<div class="modal fade" id="fileManagerModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bootstrap Modal with Dynamic Content</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var BASE_URL = '<?php echo base_url(); ?>';

</script>
<script
              src="https://code.jquery.com/jquery-2.2.4.min.js"
              integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
              crossorigin="anonymous"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('public/assets/bootstrap/js/bootstrap.min.js') ?>" crossorigin="anonymous"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- <script src="<?php echo site_url('public/assets/bootstrap/js/bootstrap-filestyle.min.js') ?>"></script> -->
<!-- Select2 -->
<script src="<?php echo site_url('public/assets/js') ?>/plugins/select2/select2.full.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo site_url('public/assets/js') ?>/plugins/iCheck/icheck.min.js"></script>
<!-- Confirmation -->
<script src="<?php echo site_url('public/assets') ?>/bootstrap/js/bootstrap-confirmation.js"></script>
<script src="<?php echo site_url('public/assets') ?>/js/jquery.blockUI.js"></script>

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>         -->
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo site_url('public/assets/fancybox') ?>/jquery.fancybox.js?v=2.1.5"></script>
<!-- AdminLTE App -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.tutorialzine.com/misc/enhance/v3.js" async></script>
<script src="<?php echo site_url('public/assets/js') ?>/jquery-migrate-1.2.1.js"></script>
<script src="<?php echo site_url('public/assets') ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo site_url('public/assets') ?>/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo site_url('public/assets') ?>/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script src="<?php echo site_url('public/assets') ?>/jquery-confirm/dist/jquery-confirm.min.js"></script>

 <button id="go-top" class="button btn btn-primary"><i class="fa fa-angle-up fa-2x"></i></button>
<script type="text/javascript">var BASE_URL = '<?php echo base_url(); ?>'</script>
<?php if (isset($jsherf)) {?>
   <script src="<?php echo base_url('public/assets/js') ?>/vanilla-zoom.js"></script>
    <script>
    vanillaZoom.init('#my-gallery');
</script>
<?php }?>




<?php if (isset($js)) {?>

  <script src="<?php echo site_url('public/assets/cropper/dist/cropper.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo site_url($js); ?>" type="text/javascript"></script>

<?php }?>


<script charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js" type="text/javascript"></script>
<script charset="UTF-8" src="<?php echo site_url(); ?>public/assets/bxslider/jquery.bxslider.js" type="text/javascript"></script>
<script charset="UTF-8" src="<?php echo site_url(); ?>public/assets/js/float-panel.js" type="text/javascript"></script>
<script charset="UTF-8" src="<?php echo site_url(); ?>public/assets/js/frontend.js" type="text/javascript"></script>
<script charset="UTF-8" src="<?php echo site_url(); ?>public/assets/js/script.js" type="text/javascript"></script>
<!-- Load Facebook SDK for JavaScript -->
  <script type="text/javascript">
    $(function() {
        $('.bxslider').bxSlider({
            captions: true,
            pager: false,
            controls: false,
            mode: 'fade',
            speed: 1000
        });
    });
    </script>
  <?php if ($this->session->flashdata('check_not_img') != null) {?>

      <script>
        $(function() {
             $.dialog({
                        type: 'blue',
                        title: 'Gửi thư liên hệ',
                        content: '<?php echo $this->session->flashdata("check_not_img") ?>',
                        columnClass: 'large'
                    });
         });
     </script>
    <?php }?>
  <?php if (isset($order) && count($order) > 0) {?>
  <script type="text/javascript">
  function totalpage(){
    var pagination = <?php echo ($this->input->get('pagination') == null) ? 10 : $this->input->get('pagination') ?>;
    var total = parseInt(<?php echo $order['total'] ?>);
    var totalpage = parseInt(pagination);
    if(total >= totalpage && (total % totalpage) == 0){
        // console.log(total/totalpage);
        return (total/totalpage);
    }else if( total >= totalpage && (total % totalpage) != 0){
        // console.log(total/totalpage);
        return (total/totalpage)+1;
    }else{
        console.log(1);
        return 1;
    }
  }
  $('#pagination-demo').twbsPagination({
        totalPages: parseInt(totalpage()) ,
        visiblePages: 4,  
        next: 'Next',
        prev: 'Prev',
        onPageClick: function (event, page) {
          console.log(page) ;
            var pagination = <?php echo ($this->input->get('pagination') == null) ? 10 : $this->input->get('pagination') ?>;
            // page ++ ;
            $.ajax({
                url: BASE_URL + 'profile/sortby',
                type: 'post',
                dataType: 'json',
                data: {'pagination':pagination,'page':page},
                success: function (res) {
                  console.log(res) ;
                    if (!res.error) {
                        $('.order_history').html(res.html);
                    } else {
                        $('.order_history').html(res.error);
                    }
                    
                }
            });
        }
    });
  </script>
    <?php }?>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  </body>
</html>
