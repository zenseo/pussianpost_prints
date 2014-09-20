<?php
define('FPDF_FONTPATH',DIR_SYSTEM.'ufpdf/font/');
define('FPDF_LIBPATH',DIR_SYSTEM.'ufpdf/');

class ControllerModuleRuspostForm extends Controller {
	private $error = array(); 

	public function pdfopis() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.opis.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes ($value);
		}
		$this->load->model('sale/order');
		$products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
		
		$doc = new PDF_Opis('P','mm','A4');
		$doc->Open();

		$doc->PrintFirstPage('Post sticker blank');
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address'], $vals_array['addr_index']);
		
		$total = 0;
		$total_num = 0;
		foreach ($products as $product) {
			$total += $product['total'];
			$total_num += $product['quantity'];
		}
		$doc->PrintProducts($products);
		
		$doc->PrintNumSum($total, $total_num);
		$doc->Output();
  	}
  	
	public function pdfsticker() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.sticker.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes ($value);
		}
		
		$doc = new PDF_Blank('L','mm','A4');
		$doc->Open();

		$doc->PrintFirstPage('Post sticker blank');
		$doc->PrintAddrIndex($vals_array['addr_index']);
		$doc->PrintSenderIndex($vals_array['sender_index']);
		$doc->PrintStrSum($vals_array['addr_sum']);
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address']);

		$doc->PrintSenderName($vals_array['sender_name']);
		$doc->PrintSenderAddress($vals_array['sender_address']);
		$doc->Output();
  	}
	
	public function pdfform() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.blank.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes ($value);
		}
		$vals_array['sender_RS'] = '';
		$vals_array['sender_bank'] = '';
		$vals_array['sender_bank_city'] = '';
		$vals_array['sender_bank_address'] = '';
		$vals_array['sender_bank_kor'] = '';
		$vals_array['sender_bank_bik'] = '';
		$vals_array['sender_bank_inn'] = '';

		$doc = new PDF_Blank('L','mm','A4');
		$doc->Open();

		$doc->PrintFirstPage('Post payment blank');
		$doc->PrintAddrIndex($vals_array['addr_index']); // индекс получателя
		$doc->PrintSenderIndex($vals_array['sender_index']); // индекс отправителя
		$doc->PrintNumSum($vals_array['addr_sum']);
		$doc->PrintStrSum($vals_array['addr_sum']);
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address'],$vals_array['addr_index']);

		if ($vals_array['sender_jurfiz']){
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			//$doc->PrintSenderBank($vals_array['sender_rs'],$vals_array['sender_bank'],$vals_array['sender_bank_city'],$vals_array['sender_bank_address'],$vals_array['sender_korr'],$vals_array['sender_bik'],$vals_array['sender_inn']);
		}
		else {
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			$doc->PrindDocument($vals_array['sender_document_doc'], $vals_array['sender_document_ser'],
				$vals_array['sender_document_nomer'], $vals_array['sender_document_vydan'],
				$vals_array['sender_document_vydanday'], $vals_array['sender_document_vydanyear']);
		}
		$doc->PrintSenderBank('',$vals_array['sender_address'],'','','','','');

		$doc->PrintSecondPage();
		$doc->PrintNumSum2nd($vals_array['addr_sum']);
		$doc->PrintAddrName2nd($vals_array['addr_name']);
		// выводим адрес отправителя, для адресата -  $vals_array['addr_address'] и $vals_array['addr_index']
		$doc->PrintAddrAddress2nd($vals_array['addr_address'],$vals_array['addr_index']);
		//Выводим документ в браузер
		$doc->Output();
		set_error_handler('error_handler');
	}

	public function f112ep() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.f112ep.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes($value);
		}
		$doc = new PDF_F112ep('L','mm','A4');
		$doc->Open();

		$doc->PrintFirstPage('Post payment blank');
		$doc->PrintAddrIndex($vals_array['addr_index']); // индекс получателя
		$doc->PrintSenderIndex($vals_array['sender_index']); // индекс отправителя
		$doc->PrintAddrPhone($vals_array['addr_phone']);
		$doc->PrintSenderPhone($vals_array['sender_phone']);
		$doc->PrintNumSum($vals_array['addr_sum']);
		$doc->PrintStrSum($vals_array['addr_sum']);
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address'],$vals_array['addr_index']);

		if ($vals_array['sender_jurfiz']){
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			$doc->PrintSenderBank($vals_array['sender_inn'], $vals_array['sender_bank'], $vals_array['sender_korr'], $vals_array['sender_rs'], $vals_array['sender_bik']);
		}
		else {
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			$doc->PrindDocument($vals_array['sender_document_doc'], $vals_array['sender_document_ser'],
				$vals_array['sender_document_nomer'], $vals_array['sender_document_vydan'],
				$vals_array['sender_document_vydanday'], $vals_array['sender_document_vydanyear']);
		}

		$doc->PrintSecondPage();
		$doc->PrintNumSum2nd($vals_array['addr_sum']);
		$doc->PrintAddrName2nd($vals_array['addr_name']);
        // выводим адрес отправителя, для адресата -  $vals_array['addr_address'] и $vals_array['addr_index']
		$doc->PrintAddrAddress2nd($vals_array['addr_address'],$vals_array['addr_index']);
		//Выводим документ в браузер
		$doc->Output();
		set_error_handler('error_handler');
	}
	
	public function f113() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.f113.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes ($value);
		}
		$doc = new PDF_F113('L','mm','A4');
		$doc->Open();

		$doc->PrintFirstPage('Post payment blank');
		$doc->PrintAddrIndex($vals_array['addr_index']); // индекс получателя
		$doc->PrintSenderIndex($vals_array['sender_index']); // индекс отправителя
		$doc->PrintNumSum($vals_array['addr_sum']);
		$doc->PrintStrSum($vals_array['addr_sum']);
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address'],$vals_array['addr_index']);

		if ($vals_array['sender_jurfiz']){
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			$doc->PrintSenderBank($vals_array['sender_inn'], $vals_array['sender_bank'], $vals_array['sender_korr'], $vals_array['sender_rs'], $vals_array['sender_bik']);
		}
		else {
			$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
			$doc->PrindDocument($vals_array['sender_document_doc'], $vals_array['sender_document_ser'],
				$vals_array['sender_document_nomer'], $vals_array['sender_document_vydan'],
				$vals_array['sender_document_vydanday'], $vals_array['sender_document_vydanyear']);
		}

		$doc->PrintSecondPage();
		$doc->PrintNumSum2nd($vals_array['addr_sum']);
		$doc->PrintAddrName2nd($vals_array['addr_name']);
                // выводим адрес отправителя, для адресата -  $vals_array['addr_address'] и $vals_array['addr_index']
		$doc->PrintAddrAddress2nd($vals_array['addr_address'],$vals_array['addr_index']);
		//Выводим документ в браузер
		$doc->Output();
		set_error_handler('error_handler');
	}

	public function f116() {
		restore_error_handler();
		error_reporting(E_ALL ^ E_NOTICE);
		require(FPDF_LIBPATH.'fpdf.php');
		require(FPDF_LIBPATH.'fpdf.class.f116.php');

		$vals_array = $this->session->data['ufpdf_post_form'];
		foreach ($vals_array as $key => $value) {
			$vals_array[$key] = stripslashes ($value);
		}
		$doc = new PDF_F116('P','mm','A5');
		$doc->Open();

		$doc->PrintFirstPage('Post payment blank');
		$doc->PrintAddrIndex($vals_array['addr_index']); // индекс получателя
		$doc->PrintSenderIndex($vals_array['sender_index']); // индекс отправителя
		$doc->PrintNumSum($vals_array['addr_sum']);
		$doc->PrintStrSum($vals_array['addr_sum']);
		$doc->PrintAddrName($vals_array['addr_name']);
		$doc->PrintAddrAddress($vals_array['addr_address'],$vals_array['addr_index']);

		$doc->PrintSenderNameAddress($vals_array['sender_name'],$vals_array['sender_index'],$vals_array['sender_address']);
		$doc->PrintDocument($vals_array['sender_document_doc'], $vals_array['sender_document_ser'],
			$vals_array['sender_document_nomer'], $vals_array['sender_document_vydan'],
			$vals_array['sender_document_vydanday'], $vals_array['sender_document_vydanyear']);

		$doc->PrintSecondPage();
		//Выводим документ в браузер
		$doc->Output();
		set_error_handler('error_handler');
	}
	
	public function formprint() {
		$this->load->model('setting/setting');
		$settings = $this->config->get('ruspost_form_module');
		foreach ($settings as $i=>$setting) {
			$settings[$i] = array_map('html_entity_decode', $setting);
		}
		$this->data['modules'] = json_encode($settings);
		$this->load->model('sale/order');
		$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
		$arr = array();
		if (!($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$arr = (isset($settings[1]) ? 
				$settings[1]
				: array("sender_name" => '',
					"sender_index" => '',
					"sender_address" => 'Заполните профиль в настройках модуля "Форма почтового перевода почты России"',
					"sender_phone" => '',
					"sender_document_doc" => 'паспорт',
					"sender_document_ser" => '',
					"sender_document_nomer" => '',
					"sender_document_vydan" => '',
					"sender_document_vydanday" => '',
					"sender_document_vydanyear" => '',
					"sender_jurfiz" => '',
					"sender_inn" => '',
					"sender_bank" => '',
					"sender_korr" => '',
					"sender_rs" => '',
					"sender_bik" => '',
				)
        	);
			$arr['addr_name'] = trim($order_info['shipping_lastname'].' '.$order_info['shipping_firstname']);
			$arr['addr_index'] = $order_info['shipping_postcode'];
			$arr['addr_address'] = trim($order_info['shipping_zone'].', '.$order_info['shipping_city'].', '.$order_info['shipping_address_1'].' '.$order_info['shipping_address_2']);
			$arr['addr_phone'] = trim(preg_replace('/[^\d]/', '', str_replace('+7', '', $order_info['telephone'])));
			$arr['addr_sum'] = $order_info['total'];
			$arr['order_id'] = $order_info['order_id'];
			$this->data['arr'] = $arr;
			$this->template = 'module/ruspost_formprint.tpl';
			$this->response->setOutput($this->render());
		}
		else {
			$this->session->data['ufpdf_post_form'] = $this->request->post['arr'];
			if ($this->request->post['act'] == 'sticker')
				$this->redirect($this->url->link('module/ruspost_form/pdfsticker', 'token=' . $this->session->data['token'], 'SSL'));
			else if ($this->request->post['act'] == 'f113')
				$this->redirect($this->url->link('module/ruspost_form/f113', 'token=' . $this->session->data['token'], 'SSL'));
			else if ($this->request->post['act'] == 'f112ep')
				$this->redirect($this->url->link('module/ruspost_form/f112ep', 'token=' . $this->session->data['token'], 'SSL'));
			else if ($this->request->post['act'] == 'f116')
				$this->redirect($this->url->link('module/ruspost_form/f116', 'token=' . $this->session->data['token'], 'SSL'));
			else if ($this->request->post['act'] == 'opis')
				$this->redirect($this->url->link('module/ruspost_form/pdfopis', 'token=' . $this->session->data['token'].'&order_id='.$this->request->get['order_id'], 'SSL'));
			else
				$this->redirect($this->url->link('module/ruspost_form/pdfform', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	 
	public function index() {   
		$this->load->language('module/ruspost_form');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ruspost_form', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['entry_profile'] = $this->language->get('entry_profile');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_fio'] = $this->language->get('entry_fio');
		$this->data['entry_zip'] = $this->language->get('entry_zip');
		$this->data['entry_address'] = $this->language->get('entry_address');
		$this->data['entry_phone'] = $this->language->get('entry_phone');

		$this->data['entry_jurfiz'] = $this->language->get('entry_jurfiz');

		$this->data['entry_docname'] = $this->language->get('entry_docname');
		$this->data['entry_doccode'] = $this->language->get('entry_doccode');
		$this->data['entry_docissued'] = $this->language->get('entry_docissued');
		$this->data['entry_docdate'] = $this->language->get('entry_docdate');

		$this->data['entry_inn'] = $this->language->get('entry_inn');
		$this->data['entry_korr'] = $this->language->get('entry_korr');
		$this->data['entry_bank'] = $this->language->get('entry_bank');
		$this->data['entry_rs'] = $this->language->get('entry_rs');
		$this->data['entry_bik'] = $this->language->get('entry_bik');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_profile'] = $this->language->get('button_add_profile');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		$this->data['tab_module'] = $this->language->get('tab_module');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ruspost_form', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/ruspost_form', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['token'] = $this->session->data['token'];

		$this->data['modules'] = array();
		
		if (isset($this->request->post['ruspost_form_module'])) {
			$this->data['modules'] = $this->request->post['ruspost_form_module'];
		} elseif ($this->config->get('ruspost_form_module')) { 
			$this->data['modules'] = $this->config->get('ruspost_form_module');
		}	
				
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/ruspost_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ruspost_form')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>
