<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-information">
    <dl class="first">
      <dt>Информация по размещению заказа</dt>
      <?php foreach($info_order as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <dt>Информация об оплате</dt>
      <?php foreach($info_payment as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <dt>Информация о доставке</dt>
      <?php foreach($info_ship as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <?php foreach($info_wholesale as $info) { ?>
        <dt><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dt>
      <?php } ?>
      <?php /*foreach($info_ship as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } */?>
    </dl>
    <dl>
      <?php foreach($info_faq as $info) { ?>
        <dt><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dt>
      <?php } ?>
      <?php /*foreach($info_ship as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } */?>
    </dl>
    <dl>
      <dt>Контактная информация</dt>
      <?php foreach($info_contact as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <dt>Личный Кабинет</dt>
      <?php foreach($info_account as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <dt>Рекламация</dt>
      <?php foreach($info_reklam as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
    <dl>
      <dt>Помощь</dt>
      <dd><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></dd>
      <?php foreach($info_help as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
      <dd><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></dd>
    </dl>
    <dl>
      <dt>Дополнительно</dt>
      <dd><a href="http://magazintao.com/brand">Производители (бренды)</a></dd>
      <dd><a href="http://magazintao.com/voucher">Подарочные сертификаты</a></dd>
      <dd><a href="http://magazintao.com/affiliate">Партнёрская программа</a></dd>
      <dd><a href="http://magazintao.com/special">Акции</a></dd>
    </dl>
	   <dl>
      <dt>Наш блог</dt>
      <?php foreach($informations as $info) { ?>
        <dd><a href="<?php echo $info['href']; ?>" title=""><?php echo $info['title']; ?></a></dd>
      <?php } ?>
    </dl>
  </div>
</div>
