<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($heading_title == 'Расчет доставки') { ?>
    <form action="" method="post"> 
      <table class="calculator" width="600" cellpadding="4" cellspacing="0">
        <tbody>
          <tr>
            <td rowspan="2" style="vertical-align: top; margin-right: 20px;">
            </td>
            <td style="width: 80px;">
              Страна:
            </td>
            <td>
              <select name="country" id="country_list" class="calculator_field" style="width:150px;">
                <option selected="selected" value="ru">Россия</option>
                <option value="bi">Белорусия</option>
                <option value="yu">Украина</option>
                <option value="ka">Казахстан</option>
              </select>
            </td>
            <td rowspan="3">
            </td>
          </tr>
          <tr>
            <td >
              Вес (кг):
            </td>
            <td>
              <input name="kg" type="text" value="<?php echo $kg; ?>" id="kg_field" class="calculator_field" style="width:145px;">
            </td>
            <td>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            </td>
            <td>
              <input type="submit" name="submit" value="Рассчитать" id="" class="calculator_field" style="width:145px;">
            </td>
            <td>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
      <?php if($kg > 0) { ?>
      <div id="" class="results">
        <p>Стоимость доставки посылки весом
          <strong><?php echo $kg; ?></strong>
          кг в страну:
          <strong><?php echo $country; ?></strong>
        </p>
          
        <table width="600">

        <tbody><tr>
          <td style="color: Black; width: 80px;">
            <?php if($price_chinapost > 0) echo "$".$price_chinapost; ?>
          </td>
          <td>
            <div>
              <strong>"Экономичный" - China Post до 20 кг</strong>
            </div>
            <div style="font-weight: normal; font-style: italic;">
              Срок доставки 20-45 дней. Получение в ближайшем почтовом отделении.
            </div>
            
          </td>
        </tr>

        <tr>
          <td style="color: Black; width: 80px;">
            <?php if($price_chinapost_airmail > 0)echo "$".$price_chinapost_airmail; ?>
          </td>
          <td>
            <div>
              <strong>"Экономичный" - China Post Airmail для посылок весом до 2 кг</strong>
            </div>
            <div style="font-weight: normal; font-style: italic;">
              Срок доставки 20-45 дней. Получение в ближайшем почтовом отделении.
            </div>
            
          </td>
        </tr>

        <tr>
          <td style="color: Black; width: 80px;">
            <?php if($price_ems > 0)echo "$".$price_ems; ?>
          </td>
          <td>
            <div>
              <strong>"Быстрый" - EMS до 30 кг</strong>
            </div>
            <div style="font-weight: normal; font-style: italic;">
              Cрок доставки 14-21 день. Доставка курьером по указанному адресу.
            </div>
            
          </td>
        </tr>

        </tbody></table>
            
      </div>
    <?php } ?>
  <?php } ?>
  <?php echo $description; ?>
  <?php /*<div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>*/ ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>