<?php 
/**
 * class i8_CustomTermField
 * 
 * Register and manage custom term meta fields.
 *
 * @since 1.0.0
 */
class i8_CustomTermField {

	/**
	 * Array of custom fields.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array $fields Array of custom fields.
	 */
	private $fields = [
		'i8_CustomTerm_color' => [
			'type' => 'color',
			'label' => 'رنگ',
			'default' => '#000',
		],
		'i8_CustomTerm_icon' => [
			'type' => 'textarea',
			'label' => 'آیکون(کد svg)',
			'default' => '',
		],
	];
	
	/**
	 * Constructor.
	 *
	 * Register hooks for rendering and saving custom term meta fields.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		if ( is_admin() ) {
			// Register all the hooks.
			add_action( 'category_add_form_fields', [ $this, 'wpturbo_render_meta_fields' ], 10, 2 );
			add_action( 'category_edit_form_fields', [ $this, 'wpturbo_edit_meta_fields' ],  10, 2 );
			add_action( 'created_category', [ $this, 'wpturbo_save_meta_fields' ], 10, 1 );
			add_action( 'edited_category',  [ $this, 'wpturbo_save_meta_fields' ], 10, 1 );
		}
	}
	
	/**
	 * Render fields on the add taxonomy page.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $taxonomy Current taxonomy name.
	 */
	public function wpturbo_render_meta_fields( string $taxonomy ) : void {
		$html = '';
		foreach( $this->fields as $field_id => $field ){
			$meta_value = '';
			if ( isset( $field['default'] ) ) {
				$meta_value = $field['default'];
			}
	
			$field_html = $this->wpturbo_render_input_field( $field_id, $field, $meta_value );
			$label = "<label for='$field_id'>{$field['label']}</label>";
			$html .= $this->wpturbo_format_field( $label, $field_html );
		}
		echo $html;
	}
	
	/**
	 * Render fields on the edit taxonomy page.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param WP_Term $term     Current term object.
	 * @param string  $taxonomy Current taxonomy name.
	 */
	public function wpturbo_edit_meta_fields( WP_Term $term, string $taxonomy ) : void {
		$html = '';
		foreach( $this->fields as $field_id => $field ){
			$meta_value = get_term_meta( $term->term_id, $field_id, true );
			$field_html = $this->wpturbo_render_input_field( $field_id, $field, $meta_value );
			$label = "<label for='$field_id'>{$field['label']}</label>";
			$html .= $this->wpturbo_format_field( $label, $field_html );
		}
		echo $html;
	}
	
	/**
	 * Format every field to table display.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $label Label for the field.
	 * @param string $field Field HTML.
	 *
	 * @return string Formatted field HTML.
	 */
	public function wpturbo_format_field( string $label, string $field ): string {
		return '<tr class="form-field"><th>'.$label.'</th><td>'.$field.'</td></tr>';
	}
	
	/**
	 * Render each individual field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $field_id Field ID.
	 * @param array  $field    Field settings.
	 * @param string $field_value Field value.
	 *
	 * @return string Rendered field HTML.
	 */
	public function wpturbo_render_input_field( string $field_id, array $field, string $field_value): string {
		switch( $field['type'] ) {
			case 'select': {
				$field_html = '<select name="'.$field_id.'" id="'.$field_id.'">';
					foreach( $field['options'] as $key => $value ){
						$key = ! is_numeric( $key ) ? $key : $value;
						$selected = '';
						if( $field_value === $key ){
							$selected = 'selected="selected"';
						}
						$field_html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				$field_html .= '</select><p id="description-description">شما میتوانید یک رنگ برای دسته بندی انتخاب کنید تا در بخش های مختلف هدر های مربوط به این دسته بندی با این رنگ نمایش داده شود.</p>';
				$field_html .='';
				break;
			}
			case 'textarea': {
				$field_html = '<textarea name="'.$field_id.'" id="'.$field_id.'" rows="5" cols="40" >'.$field_value.'</textarea>';
				$field_html .='<p id="description-description">شما میتوانید کد svg هر آیکنی را مثل آیکن های bootstrap icon و یا font awsome در اینجا قرار دهید.</p>';
				break;
			}
			default: {
				$field_html = "<input s type='{$field['type']}' id='$field_id' name='$field_id' value='$field_value' />";
				break;
			}
		}
	
		return $field_html;
	}
	
	/**
	 * Save the new meta values for our taxonomy.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param int $term_id Term ID.
	 */
	public function wpturbo_save_meta_fields( int $term_id ) : void {
		foreach ( $this->fields as $field_id => $field ) {
			if( isset( $_POST[$field_id] ) ){
				// Sanitize fields that need to be sanitized.
				switch( $field['type'] ){
					case 'email': {
						$_POST[$field_id] = sanitize_email( $_POST[$field_id] );
						break;
					}
					case 'text': {
						$_POST[$field_id] = sanitize_text_field( $_POST[$field_id] );
						break;
					}
				}
				update_term_meta( $term_id, $field_id, $_POST[$field_id] );
			}
		}
	}
	
}

if ( class_exists( 'i8_CustomTermField' ) ) {
	new i8_CustomTermField();
}