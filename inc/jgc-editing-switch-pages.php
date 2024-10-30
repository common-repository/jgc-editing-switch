<?php
/* 
 * Page metabox 
 */

add_action( 'add_meta_boxes', 'jgc_switch_pages_meta_box_init' );
function jgc_switch_pages_meta_box_init() {
    
    add_meta_box( 'jgc-switch-pages-meta-box', "JGC Editing Switch (" . __( 'Pages', 'jgc-editing-switch' ) . ")", 'jgc_switch_pages_meta_box', 'page', 'side', 'high' );
    
}

function jgc_switch_pages_meta_box( $post, $box ) {
	
	$args = array(
			'post_status' => 'publish,future,draft,pending,private', // Si se deja espacio despues de la coma, FALLA
			);
			
	$paginas = get_pages( $args );
    
    ?>
	
	<select name="page_list" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
		<option value=""><?php echo esc_attr( __( 'Select page to edit', 'jgc-editing-switch' ) ); ?></option> 
		<?php
		
		foreach ($paginas as $pagina){
			$post_id = $pagina->ID;
			$post_status = $pagina->post_status;
			$post_title = $pagina->post_title;
			$identacion = '';
			$n = 0;
			
			switch ($post_status){
				case 'publish':
					$estado = __( 'Published', 'jgc-editing-switch' );
					break;
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
			}
			
			// Si la página tiene padres, la identamos
			if ($pagina->post_parent){
				$padres = get_post_ancestors( $post_id );
				$n = count($padres);
			
				$identacion = str_repeat('&#8212; ', $n);
			}
			
			$titulo = ($post_title != '') ? $identacion . $post_title : __( '(No title)', 'jgc-editing-switch' );
			
		?>
			<option value="<?php echo admin_url().'post.php?post=' . $post_id . '&action=edit'; ?>"><?php echo esc_attr( $titulo ) . ' &nbsp;[' . $estado . ']'; ?></option>
		<?php
		
		}
		
		?>
		
	</select>
	
<?php

	jgcedsw_by();
	
}
?>