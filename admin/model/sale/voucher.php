<?php
class ModelSaleVoucher extends Model {
	public function addVoucher($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "voucher SET code = '" . $this->db->escape($data['code']) . "', from_name = '" . $this->db->escape($data['from_name']) . "', from_email = '" . $this->db->escape($data['from_email']) . "', to_name = '" . $this->db->escape($data['to_name']) . "', to_email = '" . $this->db->escape($data['to_email']) . "', message = '" . $this->db->escape($data['message']) . "', amount = '" . (float)$data['amount'] . "', voucher_theme_id = '" . (int)$data['voucher_theme_id'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}
	
	public function editVoucher($voucher_id, $data) {
      	$this->db->query("UPDATE " . DB_PREFIX . "voucher SET code = '" . $this->db->escape($data['code']) . "', from_name = '" . $this->db->escape($data['from_name']) . "', from_email = '" . $this->db->escape($data['from_email']) . "', to_name = '" . $this->db->escape($data['to_name']) . "', to_email = '" . $this->db->escape($data['to_email']) . "', message = '" . $this->db->escape($data['message']) . "', amount = '" . (float)$data['amount'] . "', voucher_theme_id = '" . (int)$data['voucher_theme_id'] . "', status = '" . (int)$data['status'] . "' WHERE voucher_id = '" . (int)$voucher_id . "'");
	}
	
	public function deleteVoucher($voucher_id) {
      	$this->db->query("DELETE FROM " . DB_PREFIX . "voucher WHERE voucher_id = '" . (int)$voucher_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "voucher_history WHERE voucher_id = '" . (int)$voucher_id . "'");
	}
	
	public function getVoucher($voucher_id) {
      	$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "voucher WHERE voucher_id = '" . (int)$voucher_id . "'");
		
		return $query->row;
	}
	
	public function getVouchers($data = array()) {
		$sql = "SELECT v.voucher_id, v.code, v.from_name, v.from_email, v.to_name, v.to_email, v.amount, (SELECT vtd.name FROM " . DB_PREFIX . "voucher_theme_description vtd WHERE vtd.voucher_theme_id = v.voucher_theme_id AND vtd.language_id = '" . (int)$this->config->get('config_language_id') . "' ) AS theme, v.status, v.date_added FROM " . DB_PREFIX . "voucher v";
		
		$sort_data = array(
			'v.code',
			'v.from_name',
			'v.from_email',
			'v.to_name',
			'v.to_email',
			'v.amount',
			'v.theme',
			'v.status',
			'v.date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY v.date_added";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getVouchersByOrderId($order_id) {
		$query = $this->db->query("SELECT v.voucher_id, v.code, v.from_name, v.from_email, v.to_name, v.to_email, v.amount, vtd.name AS theme, v.status, v.date_added FROM " . DB_PREFIX . "voucher v LEFT JOIN " . DB_PREFIX . "voucher_theme_description vtd ON (v.voucher_theme_id = vtd.voucher_theme_id) WHERE v.order_id = '" . (int)$order_id . "' AND vtd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->rows;
	}
	
	public function sendVoucher($voucher_id) {
		$voucher_info = $this->getVoucher($voucher_id);
		
		if ($voucher_info) {
			if ($voucher_info['order_id']) {
				$order_id = $voucher_info['order_id'];
			} else {
				$order_id = 0;
			}
			
			$this->load->model('sale/order');
			
			$order_info = $this->model_sale_order->getOrder($order_id);
			
			// If voucher belongs to an order
			if ($order_info) {
				$this->load->model('localisation/language');
				
				$language = new Language('russian');
				$language->load('russian');
				$language->load('mail/voucher');
				
				// HTML Mail
				$template = new Template();				
				
				$template->data['title'] = sprintf($language->get('text_subject'), $voucher_info['from_name']);
				
				$template->data['text_greeting'] = sprintf($language->get('text_greeting'), $this->currency->format($voucher_info['amount'], $order_info['currency_code'], 1));
				$template->data['text_from'] = sprintf($language->get('text_from'), $voucher_info['from_name']);
				$template->data['text_message'] = $language->get('text_message');
				$template->data['text_redeem'] = sprintf($language->get('text_redeem'), $voucher_info['code']);
				$template->data['text_footer'] = $language->get('text_footer');	
				
				$this->load->model('sale/voucher_theme');
					
				$voucher_theme_info = $this->model_sale_voucher_theme->getVoucherTheme($voucher_info['voucher_theme_id']);
				
				if ($voucher_info && file_exists(DIR_IMAGE . $voucher_theme_info['image'])) {
					$template->data['image'] = 'cid:' . md5(basename($voucher_theme_info['image']));
				} else {
					$template->data['image'] = '';
				}
				
				$template->data['store_name'] = $order_info['store_name'];
				$template->data['store_url'] = $order_info['store_url'];
				$template->data['message'] = nl2br($voucher_info['message']);
	
				$mail = new Mail(); 
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');			
				$mail->setTo($voucher_info['to_email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order_info['store_name']);
				$mail->setSubject(sprintf($language->get('text_subject'), $voucher_info['from_name']));
				$mail->setHtml($template->fetch('mail/voucher.tpl'));
				
				if ($voucher_info && file_exists(DIR_IMAGE . $voucher_theme_info['image'])) {
					$mail->addAttachment(DIR_IMAGE . $voucher_theme_info['image'], md5(basename($voucher_theme_info['image'])));
				}
				
				$mail->send();
			
			// If voucher does not belong to an order				
			}  else {
			
				$language_ru = new Language('russian');
				$language_ru->load('russian');
				$language_ru->load('mail/voucher');
				
				$template = new Template();		
				
				$template->data['title'] = sprintf($language_ru->get('text_subject'), $voucher_info['from_name']);
				
				$template->data['text_greeting'] = sprintf($language_ru->get('text_greeting'), $this->currency->format($voucher_info['amount'], $order_info['currency_code'], 1));
				$template->data['text_from'] = sprintf($language_ru->get('text_from'), $voucher_info['from_name']);
				$template->data['text_message'] = $language_ru->get('text_message');
				$template->data['text_redeem'] = sprintf($language_ru->get('text_redeem'), $voucher_info['code']);
				$template->data['text_footer'] = $language_ru->get('text_footer');					
			
				$this->load->model('sale/voucher_theme');
					
				$voucher_theme_info = $this->model_sale_voucher_theme->getVoucherTheme($voucher_info['voucher_theme_id']);
				
				if ($voucher_info && file_exists(DIR_IMAGE . $voucher_theme_info['image'])) {
					$template->data['image'] = 'cid:' . md5(basename($voucher_theme_info['image']));
				} else {
					$template->data['image'] = '';
				}
				
				$template->data['store_name'] = $this->config->get('config_name');
				$template->data['store_url'] = HTTP_CATALOG;
				$template->data['message'] = nl2br($voucher_info['message']);
	
				$mail = new Mail(); 
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');			
				$mail->setTo($voucher_info['to_email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($this->config->get('config_name'));
				$mail->setSubject(sprintf($language_ru->get('text_subject'), $voucher_info['from_name']));
				$mail->setHtml($template->fetch('mail/voucher.tpl'));
				
				if ($voucher_info && file_exists(DIR_IMAGE . $voucher_theme_info['image'])) {
					$mail->addAttachment(DIR_IMAGE . $voucher_theme_info['image'], md5(basename($voucher_theme_info['image'])));
				}
				
				$mail->send();				
			}
		}
	}
			
	public function getTotalVouchers() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "voucher");
		
		return $query->row['total'];
	}	
	
	public function getTotalVouchersByVoucherThemeId($voucher_theme_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "voucher WHERE voucher_theme_id = '" . (int)$voucher_theme_id . "'");
		
		return $query->row['total'];
	}	
	
	public function getVoucherHistories($voucher_id, $start = 0, $limit = 10) {
		$query = $this->db->query("SELECT vh.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, vh.amount, vh.date_added FROM " . DB_PREFIX . "voucher_history vh LEFT JOIN `" . DB_PREFIX . "order` o ON (vh.order_id = o.order_id) WHERE vh.voucher_id = '" . (int)$voucher_id . "' ORDER BY vh.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function getTotalVoucherHistories($voucher_id) {
	  	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "voucher_history WHERE voucher_id = '" . (int)$voucher_id . "'");

		return $query->row['total'];
	}			
}
?>