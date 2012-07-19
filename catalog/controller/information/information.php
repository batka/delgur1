<?php 
class ControllerInformationInformation extends Controller {
	public function index() {  
    	$this->language->load('information/information');
		
		$this->load->model('catalog/information');
		
		$this->data['breadcrumbs'] = array();
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);
		
		if (isset($this->request->get['information_id'])) {
			$information_id = $this->request->get['information_id'];
		} else {
			$information_id = 0;
		}
		
		$information_info = $this->model_catalog_information->getInformation($information_id);
   		
		if ($information_info) {
	  		$this->document->setTitle($information_info['title']); 

      		$this->data['breadcrumbs'][] = array(
        		'text'      => $information_info['title'],
				'href'      => $this->url->link('information/information', 'information_id=' .  $information_id),      		
        		'separator' => $this->language->get('text_separator')
      		);		
						
      		$this->data['heading_title'] = $information_info['title'];
      		
      		$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
      		
      		//Calculator
      		if ($information_info['title'] == 'Расчет доставки') {		
				$kg = '';
				$country = '';
				$price_ems = '';
				$price_chinapost = '';
				$price_chinapost_airmail = '';
				
				if(isset($_POST['country']) && isset($_POST['kg']) && isset($_POST['kg'])){
					switch ($_POST['country']) {
						case 'ru':
							$country = 'Россия';
							$country_code = 'ru';
							break;

						case 'bi':
							$country = 'Белорусия';
							$country_code = 'bi';
							break;

						case 'yu':
							$country = 'Украина';
							$country_code = 'yu';
							break;

						case 'ka':
							$country = 'Казахстан';
							$country_code = 'ka';
							break;
						
						default:
							
							break;
					} 
					$kg = $_POST['kg'];

					if($country_code = 'ru' && $kg <= 30){

						if($kg <= 1){
							$price_ems = 42;
							$price_chinapost = 34.65;
							
							if($kg <= 0.1)
								$price_chinapost_airmail = 4.63;
							elseif($kg <= 0.2)
								$price_chinapost_airmail = 6.98;
							elseif($kg <= 0.3)
								$price_chinapost_airmail = 9.33;
							elseif($kg <= 0.4)
								$price_chinapost_airmail = 11.68;
							elseif($kg <= 0.5)
								$price_chinapost_airmail = 14.03;
							elseif($kg <= 0.6)
								$price_chinapost_airmail = 16.39;
							elseif($kg <= 0.7)
								$price_chinapost_airmail = 18.74;
							elseif($kg <= 0.8)
								$price_chinapost_airmail = 21.09;
							elseif($kg <= 0.9)
								$price_chinapost_airmail = 23.44;
							elseif($kg <= 1)
								$price_chinapost_airmail = 25.79;
						}
						elseif($kg <= 2){
							$price_ems = 60;
							$price_chinapost = 43.90;
							
							if($kg <= 1.1)
								$price_chinapost_airmail = 28.15;
							elseif($kg <= 1.2)
								$price_chinapost_airmail = 30.50;
							elseif($kg <= 1.3)
								$price_chinapost_airmail = 32.85;
							elseif($kg <= 1.4)
								$price_chinapost_airmail = 35.20;
							elseif($kg <= 1.5)
								$price_chinapost_airmail = 37.55;
							elseif($kg <= 1.6)
								$price_chinapost_airmail = 38.91;
							elseif($kg <= 1.7)
								$price_chinapost_airmail = 42.36;
							elseif($kg <= 1.8)
								$price_chinapost_airmail = 44.61;
							elseif($kg <= 1.9)
								$price_chinapost_airmail = 46.96;
							elseif($kg <= 2)
								$price_chinapost_airmail = 49.31;
						}
						elseif ($kg <= 3) {
							$price_ems = 81;
							$price_chinapost = 53.16;
						}
						elseif ($kg <= 4) {
							$price_ems = 100;
							$price_chinapost = 62.56;
						}
						elseif ($kg <= 5) {
							$price_ems = 120;
							$price_chinapost = 71.81;
						}
						elseif ($kg <= 6) {
							$price_ems = 141;
							$price_chinapost = 81.07;
						}
						elseif ($kg <= 7) {
							$price_ems = 157.50;
							$price_chinapost = 90.32;
						}
						elseif ($kg <= 8) {
							$price_ems = 180;
							$price_chinapost = 99.72;
						}
						elseif ($kg <= 9) {
							$price_ems = 202.5;
							$price_chinapost = 108.98;
						}
						elseif ($kg <= 10) {
							$price_ems = 210;
							$price_chinapost = 118.23;
						}
						elseif ($kg > 10) {
							$price_ems = $kg * 22;
							if($kg <= 20) $price_chinapost = ($kg-1) * 9.52 + 34.65;
						}
					}elseif($country_code = 'bi' && $kg <= 30){

						if($kg <= 1){
							$price_ems = 43;
							$price_chinapost = 29.01;
							
							if($kg <= 0.1)
								$price_chinapost_airmail = 4.63;
							elseif($kg <= 0.2)
								$price_chinapost_airmail = 6.98;
							elseif($kg <= 0.3)
								$price_chinapost_airmail = 9.33;
							elseif($kg <= 0.4)
								$price_chinapost_airmail = 11.68;
							elseif($kg <= 0.5)
								$price_chinapost_airmail = 14.03;
							elseif($kg <= 0.6)
								$price_chinapost_airmail = 16.39;
							elseif($kg <= 0.7)
								$price_chinapost_airmail = 18.74;
							elseif($kg <= 0.8)
								$price_chinapost_airmail = 21.09;
							elseif($kg <= 0.9)
								$price_chinapost_airmail = 23.44;
							elseif($kg <= 1)
								$price_chinapost_airmail = 25.79;
						}
						elseif($kg <= 2){
							$price_ems = 62;
							$price_chinapost = 37.95;
							
							if($kg <= 1.1)
								$price_chinapost_airmail = 28.15;
							elseif($kg <= 1.2)
								$price_chinapost_airmail = 30.50;
							elseif($kg <= 1.3)
								$price_chinapost_airmail = 32.85;
							elseif($kg <= 1.4)
								$price_chinapost_airmail = 35.20;
							elseif($kg <= 1.5)
								$price_chinapost_airmail = 37.55;
							elseif($kg <= 1.6)
								$price_chinapost_airmail = 38.91;
							elseif($kg <= 1.7)
								$price_chinapost_airmail = 42.36;
							elseif($kg <= 1.8)
								$price_chinapost_airmail = 44.61;
							elseif($kg <= 1.9)
								$price_chinapost_airmail = 46.96;
							elseif($kg <= 2)
								$price_chinapost_airmail = 49.31;
						}
						elseif ($kg <= 3) {
							$price_ems = 84;
							$price_chinapost = 46.73;
						}
						elseif ($kg <= 4) {
							$price_ems = 104;
							$price_chinapost = 55.51;
						}
						elseif ($kg <= 5) {
							$price_ems = 125;
							$price_chinapost = 64.29;
						}
						elseif ($kg <= 6) {
							$price_ems = 147;
							$price_chinapost = 73.23;
						}
						elseif ($kg <= 7) {
							$price_ems = 164.5;
							$price_chinapost = 82.01;
						}
						elseif ($kg <= 8) {
							$price_ems = 184;
							$price_chinapost = 90.79;
						}
						elseif ($kg <= 9) {
							$price_ems = 202.5;
							$price_chinapost = 99.72;
						}
						elseif ($kg <= 10) {
							$price_ems = 220;
							$price_chinapost = 108.51;
						}
						elseif ($kg > 10) {
							$price_ems = $kg * 22;
							if ($kg <= 11) 
								$price_chinapost = 117.29;
							elseif ($kg <= 12) 
								$price_chinapost = 126.22;
							elseif ($kg <= 13) 
								$price_chinapost = 135.00;
							elseif ($kg <= 14) 
								$price_chinapost = 143.79;
							elseif ($kg <= 15) 
								$price_chinapost = 152.57;
							elseif ($kg <= 16) 
								$price_chinapost = 161.50;
							elseif ($kg <= 17) 
								$price_chinapost = 170.28;
							elseif ($kg <= 18) 
								$price_chinapost = 179.07;
							elseif ($kg <= 19) 
								$price_chinapost = 188.00;
							elseif ($kg <= 20) 
								$price_chinapost = 196.78;
						}
					}elseif($country_code = 'yu' && $kg <= 30){

						if($kg <= 1){
							$price_ems = 43;
							$price_chinapost = 33.24;
							
							if($kg <= 0.1)
								$price_chinapost_airmail = 4.63;
							elseif($kg <= 0.2)
								$price_chinapost_airmail = 6.98;
							elseif($kg <= 0.3)
								$price_chinapost_airmail = 9.33;
							elseif($kg <= 0.4)
								$price_chinapost_airmail = 11.68;
							elseif($kg <= 0.5)
								$price_chinapost_airmail = 14.03;
							elseif($kg <= 0.6)
								$price_chinapost_airmail = 16.39;
							elseif($kg <= 0.7)
								$price_chinapost_airmail = 18.74;
							elseif($kg <= 0.8)
								$price_chinapost_airmail = 21.09;
							elseif($kg <= 0.9)
								$price_chinapost_airmail = 23.44;
							elseif($kg <= 1)
								$price_chinapost_airmail = 25.79;
						}
						elseif($kg <= 2){
							$price_ems = 62;
							$price_chinapost = 41.71;
							
							if($kg <= 1.1)
								$price_chinapost_airmail = 28.15;
							elseif($kg <= 1.2)
								$price_chinapost_airmail = 30.50;
							elseif($kg <= 1.3)
								$price_chinapost_airmail = 32.85;
							elseif($kg <= 1.4)
								$price_chinapost_airmail = 35.20;
							elseif($kg <= 1.5)
								$price_chinapost_airmail = 37.55;
							elseif($kg <= 1.6)
								$price_chinapost_airmail = 38.91;
							elseif($kg <= 1.7)
								$price_chinapost_airmail = 42.36;
							elseif($kg <= 1.8)
								$price_chinapost_airmail = 44.61;
							elseif($kg <= 1.9)
								$price_chinapost_airmail = 46.96;
							elseif($kg <= 2)
								$price_chinapost_airmail = 49.31;
						}
						elseif ($kg <= 3) {
							$price_ems = 84;
							$price_chinapost = 50.18;
						}
						elseif ($kg <= 4) {
							$price_ems = 104;
							$price_chinapost = 58.64;
						}
						elseif ($kg <= 5) {
							$price_ems = 125;
							$price_chinapost = 67.11;
						}
						elseif ($kg <= 6) {
							$price_ems = 147;
							$price_chinapost = 75.58;
						}
						elseif ($kg <= 7) {
							$price_ems = 164.5;
							$price_chinapost = 84.04;
						}
						elseif ($kg <= 8) {
							$price_ems = 184;
							$price_chinapost = 92.51;
						}
						elseif ($kg <= 9) {
							$price_ems = 202.5;
							$price_chinapost = 110.98;
						}
						elseif ($kg <= 10) {
							$price_ems = 220;
							$price_chinapost = 109.60;
						}
						elseif ($kg > 10) {
							$price_ems = $kg * 22;
							if ($kg <= 11) 
								$price_chinapost = 118.07;
							elseif ($kg <= 12) 
								$price_chinapost = 126.54;
							elseif ($kg <= 13) 
								$price_chinapost = 135;
							elseif ($kg <= 14) 
								$price_chinapost = 143.17;
							elseif ($kg <= 15) 
								$price_chinapost = 151.95;
							elseif ($kg <= 16) 
								$price_chinapost = 160.1;
							elseif ($kg <= 17) 
								$price_chinapost = 168.67;
							elseif ($kg <= 18) 
								$price_chinapost = 177.34;
							elseif ($kg <= 19) 
								$price_chinapost = 185.81;
							elseif ($kg <= 20) 
								$price_chinapost = 194.43;
						}
					}elseif($country_code = 'ka' && $kg <= 30){

						if($kg <= 1){
							$price_ems = 44;
							$price_chinapost = 23.68;
							
							if($kg <= 0.1)
								$price_chinapost_airmail = 4.63;
							elseif($kg <= 0.2)
								$price_chinapost_airmail = 6.98;
							elseif($kg <= 0.3)
								$price_chinapost_airmail = 9.33;
							elseif($kg <= 0.4)
								$price_chinapost_airmail = 11.68;
							elseif($kg <= 0.5)
								$price_chinapost_airmail = 14.03;
							elseif($kg <= 0.6)
								$price_chinapost_airmail = 16.39;
							elseif($kg <= 0.7)
								$price_chinapost_airmail = 18.74;
							elseif($kg <= 0.8)
								$price_chinapost_airmail = 21.09;
							elseif($kg <= 0.9)
								$price_chinapost_airmail = 23.44;
							elseif($kg <= 1)
								$price_chinapost_airmail = 25.79;
						}
						elseif($kg <= 2){
							$price_ems = 66;
							$price_chinapost = 49.31;
							
							if($kg <= 1.1)
								$price_chinapost_airmail = 28.15;
							elseif($kg <= 1.2)
								$price_chinapost_airmail = 30.50;
							elseif($kg <= 1.3)
								$price_chinapost_airmail = 32.85;
							elseif($kg <= 1.4)
								$price_chinapost_airmail = 35.20;
							elseif($kg <= 1.5)
								$price_chinapost_airmail = 37.55;
							elseif($kg <= 1.6)
								$price_chinapost_airmail = 38.91;
							elseif($kg <= 1.7)
								$price_chinapost_airmail = 42.36;
							elseif($kg <= 1.8)
								$price_chinapost_airmail = 44.61;
							elseif($kg <= 1.9)
								$price_chinapost_airmail = 46.96;
							elseif($kg <= 2)
								$price_chinapost_airmail = 49.31;
						}
						elseif ($kg <= 3) {
							$price_ems = 87;
							$price_chinapost = 33.24;
						}
						elseif ($kg <= 4) {
							$price_ems = 110;
							$price_chinapost = 38.10;
						}
						elseif ($kg <= 5) {
							$price_ems = 130;
							$price_chinapost = 42.81;
						}
						elseif ($kg <= 6) {
							$price_ems = 150;
							$price_chinapost = 47.67;
						}
						elseif ($kg <= 7) {
							$price_ems = 171.50;
							$price_chinapost = 52.37;
						}
						elseif ($kg <= 8) {
							$price_ems = 192;
							$price_chinapost = 57.23;
						}
						elseif ($kg <= 9) {
							$price_ems = 211.5;
							$price_chinapost = 61.94;
						}
						elseif ($kg <= 10) {
							$price_ems = 230;
							$price_chinapost = 66.80;
						}
						elseif ($kg > 10) {
							$price_ems = $kg * 23;
							if ($kg <= 11) 
								$price_chinapost = 71.5;
							elseif ($kg <= 12) 
								$price_chinapost = 76.36;
							elseif ($kg <= 13) 
								$price_chinapost = 81.07;
							elseif ($kg <= 14) 
								$price_chinapost = 85.93;
							elseif ($kg <= 15) 
								$price_chinapost = 90.63;
							elseif ($kg <= 16) 
								$price_chinapost = 95.49;
							elseif ($kg <= 17) 
								$price_chinapost = 100.20;
							elseif ($kg <= 18) 
								$price_chinapost = 105.06;
							elseif ($kg <= 19) 
								$price_chinapost = 109.76;
							elseif ($kg <= 20) 
								$price_chinapost = 114.62;
						}
					}
				}
				$this->data['kg'] 		= $kg;
				$this->data['country'] 	= $country;
				$this->data['price_chinapost'] = $price_chinapost;
				$this->data['price_ems'] = $price_ems;
				$this->data['price_chinapost_airmail'] = $price_chinapost_airmail;
      		}
      		//END Calculator

      		//Button Continue
			//$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/information.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/information.tpl';
			} else {
				$this->template = 'default/template/information/information.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
	  		$this->response->setOutput($this->render());
    	} else {
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/information', 'information_id=' . $information_id),
        		'separator' => $this->language->get('text_separator')
      		);
				
	  		$this->document->setTitle($this->language->get('text_error'));
			
      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
					
	  		$this->response->setOutput($this->render());
    	}
  	}
	
	public function info() {
		$this->load->model('catalog/information');
		
		if (isset($this->request->get['information_id'])) {
			$information_id = $this->request->get['information_id'];
		} else {
			$information_id = 0;
		}      
		
		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {
			$output  = '<html dir="ltr" lang="en">' . "\n";
			$output .= '<head>' . "\n";
			$output .= '  <title>' . $information_info['title'] . '</title>' . "\n";
			$output .= '  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$output .= '</head>' . "\n";
			$output .= '<body>' . "\n";
			$output .= '  <br /><br /><h1>' . $information_info['title'] . '</h1>' . "\n";
			$output .= html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
			$output .= '  </body>' . "\n";
			$output .= '</html>' . "\n";			

			$this->response->setOutput($output);
		}
	}
}
?>