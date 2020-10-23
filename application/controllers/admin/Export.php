<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->page_title = 'xuất excel';
		$this->load->model('admin/order_model');
		include APPPATH . 'third_party/PHPexcel/PHPExcel.php';
	}

	public function exportExcel() {
		if ($this->input->post('month') != null) {
			$month = $this->input->post('month');
		} else {
			$month = date('m');
		}
		if ($this->input->post('year') != null) {
			$year = $this->input->post('year');
		} else {
			$year = date('Y');
		}
		$data = $this->order_model->getTotalPaymenByAllUser()['orders'];
		$payment = $this->order_model->getTotalPaymenByAllUser()['payment'];
		// var_dump($data);
		// var_dump($payment->totalPrice);
		// exit();
		//Khởi tạo đối tượng
		$excel = new PHPExcel();
		//Chọn trang cần ghi (là số từ 0->n)
		$excel->setActiveSheetIndex(0);
		//Tạo tiêu đề cho trang. (có thể không cần)
		$excel->getActiveSheet()->setTitle('Tháng ' . $month . ' năm ' . $year);

		//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

		//Xét in đậm cho khoảng cột
		$excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$excel->getActiveSheet()->getStyle('A2:D2')->getFont()->setBold(true);
		//Tạo tiêu đề cho từng cột
		//Vị trí có dạng như sau:
		/**
		 * |A1|B1|C1|..|n1|
		 * |A2|B2|C2|..|n1|
		 * |..|..|..|..|..|
		 * |An|Bn|Cn|..|nn|
		 */
		/** set title excel */
		$excel->getActiveSheet()->setCellValue('A1', 'Tháng ' . $month . ' năm ' . $year);

		$excel->getActiveSheet()->setCellValue('A2', 'Số thứ tự');
		$excel->getActiveSheet()->setCellValue('B2', 'Tên');
		$excel->getActiveSheet()->setCellValue('C2', 'Tổng sản phẩm');
		$excel->getActiveSheet()->setCellValue('D2', 'Tổng tiền');
		$excel->getActiveSheet()->setCellValue('C19', 'Tổng thanh toán');
		// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
		// dòng bắt đầu = 2
		$numRow = 3;
		$d = 0;
		foreach ($data as $row) {
			$d = (int) $d + 1;
			$excel->getActiveSheet()->setCellValue('A' . $numRow, $d);
			$excel->getActiveSheet()->setCellValue('B' . $numRow, $row->username);
			$excel->getActiveSheet()->setCellValue('C' . $numRow, $row->total);
			$excel->getActiveSheet()->setCellValue('D' . $numRow, $row->totalPayment);
			$numRow++;
		}
		$excel->getActiveSheet()->setCellValue('D19', $payment->totalPrice);
		// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
		// ở đây mình lưu file dưới dạng excel2007
		$filename = 'Data ' . $month . '-' . $year . '.xls';
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
	}
}