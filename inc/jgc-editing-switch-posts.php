<?php
/* 
 * Post metabox 
 */

add_action( 'add_meta_boxes', 'jgc_switch_posts_meta_box_init' );
function jgc_switch_posts_meta_box_init() {
    
    add_meta_box( 'jgc-switch-posts-meta-box', "JGC Editing Switch (" . __( 'Posts', 'jgc-editing-switch' ) . ")", 'jgc_switch_posts_meta_box', 'post', 'side', 'high' );
    
}

function jgc_switch_posts_meta_box( $post, $box ) {
	global $wpdb;
	$estado = '';
	
	$no_publish = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title, post_status FROM $wpdb->posts WHERE post_type = %s AND post_status <> %s", 'post', 'publish'));
    
    ?>
	
	<select name="post_list" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
		<option value=""><?php echo esc_attr( __( 'Select post to edit', 'jgc-editing-switch' ) ); ?></option> 
		<?php
		
		foreach ($no_publish as $np){
			$post_id = $np->ID;
			$post_title = $np->post_title;
			$post_status = $np->post_status;
			
			if( $post_status == 'future' || $post_status == 'draft' || $post_status == 'pending' || $post_status == 'private' ) {
				switch ($post_status){
					case 'future':
						$estado = __( 'Scheduled', 'jgc-editing-switch' );
						break;
					case 'draft':
						$estado = __( 'Draft', 'jgc-editing-switch' );
						break;
					case 'pending':
						$estado = __( 'Pending Review', 'jgc-editing-switch' );
						break;
					case 'private':
						$estado = __( 'Private', 'jgc-editing-switch' );
						break;
					default:
						
				}
				
				$titulo = ($post_title != '') ? $post_title : __( '(No title)', 'jgc-editing-switch' );
				
			?>
				<option value="<?php echo admin_url().'post.php?post=' . $post_id . '&action=edit'; ?>"><?php echo esc_attr( $titulo ) . ' &nbsp;[' . $estado . ']'; ?></option>
				
			<?php
			} //if
		} // foreach
		
		?>
		
	</select>
	
<?php

	jgcedsw_by();
	
}
?>