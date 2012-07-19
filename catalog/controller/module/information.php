<?php  
class ControllerModuleInformation extends Controller {
	protected function index() {
		$this->language->load('module/information');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	
		$this->data['text_contact'] = $this->language->get('text_contact');
    	$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		
		$this->load->model('catalog/information');
		
		$this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
      		
      		//Информация по размещению заказа
      		if($result['information_id'] == 28 
      		|| $result['information_id'] == 13
      		|| $result['information_id'] == 20
      		|| $result['information_id'] == 29
      		|| $result['information_id'] == 23
      		|| $result['information_id'] == 14
      		|| $result['information_id'] == 18
      		){ 
      			$this->data['info_order'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Информация об оплате
      		}elseif($result['information_id'] == 30
      			 || $result['information_id'] == 16
      		){ 
      			$this->data['info_payment'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Информация о доставке
      		}elseif($result['information_id'] == 6
      			 || $result['information_id'] == 33
      			 || $result['information_id'] == 21
      			 || $result['information_id'] == 25
      			 || $result['information_id'] == 22
      			 || $result['information_id'] == 19
      			 || $result['information_id'] == 11
      		){ 
      			$this->data['info_ship'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Контактная информация
      		}elseif($result['information_id'] == 4
      			 || $result['information_id'] == 32
      			 || $result['information_id'] == 31
      		){ 
      			$this->data['info_contact'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);	
      		//Рекламация
      		}elseif($result['information_id'] == 10 //Претензии и рекламации
      			 || $result['information_id'] == 5  //Условия договора
      			 || $result['information_id'] == 3  //Политика безопасности
      		){ 
      			$this->data['info_reklam'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Помощь
      		}elseif($result['information_id'] == 8 ){ //Онлайн-чат с оператором
      			$this->data['info_help'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Часто задаваемые вопросы
      		}elseif($result['information_id'] == 17 ){ //Часто задаваемые вопросы
      			$this->data['info_faq'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		//Информация для оптовиков
      		}elseif($result['information_id'] == 34 ){ 
      			$this->data['info_wholesale'][] = array(
      				'title' => $result['title'],
      				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		}elseif($result['information_id'] == 15 ){ 
                        $this->data['info_account'][] = array(
                              'title' => $result['title'],
                              'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
                        );
                  }else{
      			$this->data['informations'][] = array(
        			'title' => $result['title'],
	    			'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
      			);
      		}
    	}

		$this->data['contact'] = $this->url->link('information/contact');
    	$this->data['sitemap'] = $this->url->link('information/sitemap');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/information.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/information.tpl';
		} else {
			$this->template = 'default/template/module/information.tpl';
		}
		
		$this->render();
	}
	function array_delete($idx,$array) {  
	    unset($array[$idx]);  
	    return (is_array($array)) ? array_values($array) : null;  
	}
}
?>