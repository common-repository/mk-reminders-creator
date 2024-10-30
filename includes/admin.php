<?php

	if (!defined('ABSPATH')) exit;

	header('Content-Type: text/html; charset=utf-8');

	if (current_user_can('upload_files')) {

		global $wpdb;

		$mk_table_check = "SELECT * FROM {$wpdb->prefix}mk_reminders";
		$mk_table_check_db = $wpdb->query($mk_table_check);

		if ($mk_table_check_db !== FALSE) {

			echo '';

		} else {

			$create_mk_table = "CREATE TABLE {$wpdb->prefix}mk_reminders(remindersID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, reminderscontent VARCHAR(2550) NOT NULL, remindersdate VARCHAR(255) NOT NULL) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$create_mk_table_action = $wpdb->query($create_mk_table);

		}

		if (isset($_POST['mk_reminders_input'])) {

			$mk_input_content = sanitize_text_field($_POST['mk_reminders_input']);

			$mk_reminders_insert = "INSERT INTO {$wpdb->prefix}mk_reminders(reminderscontent, remindersdate) VALUES ('$mk_input_content', NOW())";
			$mk_reminders_insert_action = $wpdb->query($mk_reminders_insert);

			if ($mk_reminders_insert_action) {
				$mk_success = '<div class="alert alert-success" role="alert">Reminder Create is Success!</div>';
			} else {
				$mk_error = '<div class="alert alert-danger" role="alert">Reminder Create Error!</div>';
			}

		}


		if (isset($_POST['mk_date'])) {

			$mk_reminder_date = sanitize_text_field($_POST['mk_date']);

			$mk_reminder_delete = "DELETE FROM {$wpdb->prefix}mk_reminders WHERE remindersdate = '$mk_reminder_date'";
			$mk_reminder_delete_action = $wpdb->query($mk_reminder_delete);

			if ($mk_reminder_delete_action) {
				$mk_edit_success = '<div class="alert alert-success" role="alert">Reminder Deleted!</div>';
			}

		}


		?>

		<div class="container-fluid">
			<div class="row p-5">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<form id="mk_reminders_form" class="h-100 d-flex flex-column justify-content-center align-items-center" method="post">
						<div class="mk-reminders-input-area d-flex flex-column align-items-center justify-content-center">
							<label id="mk_reminders_input_title" for="mk_reminders_input" class="mb-2">Reminders Creator Area</label>
							<textarea id="mk_reminders_input" name="mk_reminders_input" placeholder="Create new reminders..."></textarea>
						</div>
						<div class="mk-reminders-submit-button d-flex flex-column align-items-center mt-3">
							<input type="submit" name="mk_create_button" class="btn btn-primary mb-2" value="Create!">
							<?php echo wp_kses_post($mk_success . $mk_error); ?>
						</div>
					</form>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div id="mk_last_reminders_form" class="h-100 w-100 d-flex flex-column justify-content-center align-items-center">
						<div class="mk-reminders-input-area d-flex flex-column align-items-center justify-content-center h-100 w-100">
							<label id="mk_reminders_input_title" for="mk_last_reminders_group" class="mb-2">Reminders</label>
							<div class="list-group w-100" id="mk_last_reminders_group">
								<a class="list-group-item list-group-item-action active">Last 5 Added Reminders</a>
								<?php


									$mklastreminderscheckaction = $wpdb->get_results("SELECT reminderscontent, remindersdate, remindersID FROM {$wpdb->prefix}mk_reminders ORDER BY remindersID  DESC limit 5");

									foreach ($mklastreminderscheckaction as $mkgetlastreminders) {

										echo '<form id="mk_reminders-info" class="w-100" method="post"><a style="word-wrap: break-word!important; cursor:default;" class="list-group-item list-group-item-action position-relative"><b>Note: </b>' . wp_kses_post($mkgetlastreminders->reminderscontent) . '<br><label class="mr-2" for="mk_date"><b>Date: </b></label>' . wp_kses_post($mkgetlastreminders->remindersdate) . '<input type="text" name="mk_date" class="mt-2 d-none" value="' . wp_kses_post($mkgetlastreminders->remindersdate) . ' " ><input name="reminders_edit_button" id="reminders_edit_button" type="submit" value="X" class="btn btn-primary"></a></form><br>';

									}
									echo wp_kses_post($mk_edit_success);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php

	}

?>