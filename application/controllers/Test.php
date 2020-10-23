<?php 

/**
* @author       Asim Zeeshan
* @web         http://www.asim.pk/
* @date     13th May, 2009
* @copyright    No Copyrights, but please link back in any way
*/
 
class Test extends My_Controller {
 
function __construct()
{
	parent::__construct();
	$this->load->model('admin/users_model');
	$this->load->model('admin/order_model');
}
 
function index()
{			
			$now = date('Y:m:d');
			$data['data'] = $this->order_model->getOrderByDay($now, 0, 30);

			$email = 'hodacquyenpx@gmail.com';
			$name = 'Hồ Đắc Quyền';
			$message = $this->load->view('email_template/order_notification', $data, TRUE);
			//        die($message);

			$mail_name = 'BPO Tech Huế';
			$mail_from = 'no-reply@bpotech.comm.vn';
			$mail_to = 'tmntester001@gmail.com';
			$mail_cc = $email;
			$mail_sub = $name . 'thân gửi.';
			$mail_msg = $message;
			$this->users_model->sendmail($mail_name, $mail_from, $mail_to, $mail_cc, null, $mail_sub, $mail_msg);
			echo "gửi mail thành công\n";
}
 
function test() {
echo "testing from test \n";
}
} 
?>