<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<section id="content">
	<?php echo $content_top; ?>
  	<section class="breadcrumb">
    	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    		<?php echo $breadcrumb['separator']; ?>
			<a href="<?php echo $breadcrumb['href']; ?>">
				<?php echo $breadcrumb['text']; ?>
			</a>
    	<?php } ?>
  	</section>
  	<h1><?php echo $heading_title; ?></h1>
  	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="newsletter">
   		<section class="content">
   			<table class="form">
      			<tr>
       				<td>
						<label for="newsletter"><?php echo $entry_newsletter; ?></label>
					</td>
       				<td>
						<?php if ($newsletter) { ?>
            				<input type="radio" name="newsletter" value="1" checked="checked" />
            				<?php echo $text_yes; ?>&nbsp;
            				<input type="radio" name="newsletter" value="0" />
            				<?php echo $text_no; ?>
            			<?php } else { ?>
            				<input type="radio" name="newsletter" value="1" />
            				<?php echo $text_yes; ?>&nbsp;
            				<input type="radio" name="newsletter" value="0" checked="checked" />
            				<?php echo $text_no; ?>
            			<?php } ?>
					</td>
        		</tr>
      		</table>
    	</section>
    	<div class="buttons">
   			<div class="left">
				<a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a>
			</div>
   			<div class="right">
				<a onclick="$('#newsletter').submit();" class="button"><?php echo $button_continue; ?></a>
			</div>
   		</div>
  	</form>
  	<?php echo $content_bottom; ?>
</section>
<?php echo $footer; ?>