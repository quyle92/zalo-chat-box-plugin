<?php
$data = $this->data();
var_dump($data);
?>

<div class="wrap">

	<h2><?php esc_html_e( 'Contact Me on Zalo Settings' ); ?></h2>

	<?php echo $_SESSION['success']??"" ?>
	<?php $this->message(); ?>

	<form method="post" id="cmoz-settings-form" action="<?php echo $this->form_action();// bỏ đi cũng đc ?>">

		<hr>
		<div class="col-md-6">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Zalo Oaid' ); ?>
						</th>
						<td>
							<input id="zcb_oaid" name="zcb_options[zalo-oaid]" type="text" class="regular-text" value="<?php echo esc_attr( $data['zalo-oaid'] ); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Data-welcome-message' ); ?>
						</th>
						<td>
							<input  name="zcb_options[data-welcome-message]" type="text" value="<?php echo esc_attr( $data['data-welcome-message'] ); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Right' ); ?>
						</th>
						<td>
							<input  name="zcb_options[right]" type="number" value="<?php echo esc_attr( $data['right'] ); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Bottom' ); ?>
						</th>
						<td>
							<input  name="zcb_options[bottom]" type="number" value="<?php echo esc_attr( $data['bottom'] ); ?>" />
						</td>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Tel' ); ?>
						</th>
						<td>
							<input id="tel" name="zcb_options[tel]" type="text" class="regular-text" value="<?php echo esc_attr( $data['tel'] ); ?>" />
						</td>	
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'Background-color' ); ?>
						</th>
						<td id="cp-component">
							<input  name="zcb_options[bg-color]" type="text" value="<?php echo esc_attr( $data['bg-color'] ); ?>"  />
							<span class="input-group-addon"><i></i></span>
						</td>	
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php esc_html_e( 'FB Page link' ); ?>
						</th>
						<td>
							<input  name="zcb_options[fb]" type="text" value="<?php echo esc_attr( $data['fb'] ); ?>"  />
						
						</td>	
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-md-12">
			<?php submit_button(); ?>
			<?php wp_nonce_field( 'zcb-settings', 'zcb-settings-nonce' ); ?>
		</div>
	</form>

	<hr />


</div>


<script type="text/javascript">
	$(function () {
	  $('#cp-component').colorpicker();
	});

$('#tel').keypress(function (event) {
	var keycode = event.which;
	if ( ! (keycode >= 48 && keycode <= 57) ) {
	    event.preventDefault();
	    alert('number only');
	}
});
</script>

<style>
span.input-group-addon
{
  	display: inline-block;
    width: 3em;
    margin-left: -4px;
    margin-bottom: 2px;
    transform: scale(1.0);
}
  </style>