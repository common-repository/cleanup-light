<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="form-group row">
	<label  class="col-md-2   control-label"> 
	<?php esc_html_e( 'Reminder Email Subject :', 'cleanup' );?> </label>
	<div class="col-md-10 ">
		<?php
			$cleanup_reminder_email_subject = get_option( 'cleanup_reminder_email_subject');
		?>
		<input type="text" class="form-control" id="cleanup_reminder_email_subject" name="cleanup_reminder_email_subject" value="<?php echo esc_attr($cleanup_reminder_email_subject); ?>" placeholder="Enter reminder email subject">
	</div>
</div>
<div class="form-group row">
	<label  class="col-md-2   control-label">
	<?php esc_html_e( 'Reminder Email Tempalte :', 'cleanup' );?> </label>
	<div class="col-md-10 ">
		<?php
			$settings_a = array(															
			'textarea_rows' =>20,															 
			);
			$content_reminder = get_option( 'cleanup_reminder_email');
			$editor_id = 'reminder_email_template';
		?>
		<textarea id="reminder_email_template" name="reminder_email_template" rows="20" class="col-md-12 ">
			<?php echo esc_html($content_reminder); ?>
		</textarea>
	</div>
</div>
<div class="form-group row">
	<label  class="col-md-2   control-label"> 
	<?php esc_html_e( 'Send Email Before # Days :', 'cleanup' );?> </label>
	<div class="col-md-10 ">
		<?php
			$cleanup_reminder_day = get_option( 'cleanup_reminder_day');
		?>
		<input type="text" class="form-control" id="cleanup_reminder_day" name="cleanup_reminder_day" value="<?php echo esc_attr($cleanup_reminder_day); ?>" placeholder="Enter number of day">
	</div>
</div>
<div class="row form-group row">
	<label  class="col-md-2   control-label"> <?php  esc_html_e('Short Code:','cleanup');?>  </label>
	<div class="col-md-10 ">			
		<h4>  <span class="label label-info">[cleanup_reminder_email_cron] </span></h4>
	</div>
</div>