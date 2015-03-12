<?php

/* Custom WP 3.0 Menus */
/*------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {

add_action( 'init', 'register_bizz_menus' );

function register_bizz_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}

}

/* Post Type Class */
/*------------------------------------------------------------------*/
class BizzFAQ {
	
	function BizzFAQ(){
		
		// Register custom post types
		register_post_type(	
			'faqs', array(	
				'label' 				=> __('FAQ Items'),
				'labels' 				=> array(	
					'name' 					=> __('FAQ Items'),
					'singular_name' 		=> __('FAQ Items'),
					'add_new' 				=> __('Add New'),
					'add_new_item' 			=> __('Add New FAQ'),
					'edit' 					=> __('Edit'),
					'edit_item' 			=> __('Edit FAQ'),
					'new_item' 				=> __('New FAQ'),
					'view_item'				=> __('View FAQ'),
					'search_items' 			=> __('Search FAQ'),
					'not_found' 			=> __('No FAQs found'),
					'not_found_in_trash' 	=> __('No FAQs found in trash')	
				),
				'public' 				=> true,
				'can_export'			=> true,
				'show_ui' 				=> true, #UI in admin panel
				'_builtin' 				=> false, #it's a custom post type, not built in
				'_edit_link' 			=> 'post.php?post=%d',
				'capability_type' 		=> 'post',
				'hierarchical' 			=> false,
				'rewrite' 				=> array( #permalinks
					"slug" => "faqs"	
				), 
				'has_archive' 			=> true,
				'menu_position' 		=> 35,
				'query_var' 			=> "faqs", #this goes to the WP_Query schema
				'supports' 				=> array(	
					'title', 
					'editor', 
					'custom-fields', 
					'author',
					'revisions', 
					'page-attributes'	
				) ,
				'show_in_nav_menus'	=> true ,
				'taxonomies'		=> array(	
					'faq_category',
					'faq_tag'
				)
			)
		);
		
		//Custom columns
		add_filter("manage_edit-faqs_columns", array(&$this, "faqs_edit_columns"));
		add_action("manage_posts_custom_column", array(&$this, "faqs_custom_columns"));
		//Custom update messages
		add_filter('post_updated_messages', array(&$this, "faqs_updated_messages"));
		
		// Register custom faq_category taxonomy
		register_taxonomy( "faq_category", 
			array(
				'faqs'	
			), 
			array(	
				'hierarchical' 		=> true, 
				'label' 			=> 'FAQ Categories', 
				'labels' 			=> array(	
					'name' 				=> __('FAQ Categories'),
					'singular_name' 	=> __('FAQ Category'),
					'search_items' 		=> __('Search FAQ Categories'),
					'popular_items' 	=> __('Popular FAQ Categories'),
					'all_items' 		=> __('All FAQ Categories'),
					'parent_item' 		=> __('Parent FAQ Category'),
					'parent_item_colon' => __('Parent FAQ Category:'),
					'edit_item' 		=> __('Edit FAQ Category'),
					'update_item'		=> __('Update FAQ Category'),
					'add_new_item' 		=> __('Add New FAQ Category'),
					'new_item_name' 	=> __('New FAQ Category Name')	
				),  
				'public' 			=> true,
				'show_ui' 			=> true,
				'rewrite' 			=> array(
					'slug' => 'slide_cats'	
				)	
			)
		);
		
		// Register custom faq_tag taxonomy
		register_taxonomy( "faq_tag", 
			array(
				'faqs'	
			), 
			array(	
				'hierarchical' 		=> false, 
				'label' 			=> 'FAQ Tags', 
				'labels' 			=> array(	
					'name' 				=> __('FAQ Tags'),
					'singular_name' 	=> __('FAQ Tag'),
					'search_items' 		=> __('Search FAQ Tags'),
					'popular_items' 	=> __('Popular FAQ Tags'),
					'all_items' 		=> __('All FAQ Tags'),
					'parent_item' 		=> __('Parent FAQ Tag'),
					'parent_item_colon' => __('Parent FAQ Tag:'),
					'edit_item' 		=> __('Edit FAQ Tag'),
					'update_item'		=> __('Update FAQ Tag'),
					'add_new_item' 		=> __('Add New FAQ Tag'),
					'new_item_name' 	=> __('New FAQ Tag Name')	
				),  
				'public' 			=> true,
				'show_ui' 			=> true,
				'rewrite' 			=> array(
					'slug' => 'slide_tags'	
				)	
			)
		);
		
	}
	
	//custom post type edit headers
	function faqs_edit_columns($columns){
		$columns = array(
			"cb" 					=> "<input type=\"checkbox\" />",
			"title" 				=> "FAQ Title",
			"faqs_type" 			=> "FAQ Category",
			"comments" 				=> '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>'
		);
		return $columns;
	}
	
	//custom post type edit output
	function faqs_custom_columns($column){
		global $post;
		switch ($column){
			case "faqs_type":
				$faq_categorys = get_the_terms($post->ID, "faq_category");
				$faq_categorys_html = array();
				if ($faq_categorys) {
					foreach ($faq_categorys as $faq_category)
						array_push($faq_categorys_html, '<a href="' . get_term_link($faq_category->slug, "faq_category") . '">' . $faq_category->name . '</a>');
					
					echo implode($faq_categorys_html, ", ");
				}
				else {
					_e('None', 'bizzthemes');
				}
			break;
		}
	}
	
	function faqs_updated_messages( $messages ) {
		global $post, $post_ID;
		
  		$messages['faqs'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('FAQ updated. <a href="%s">View slide</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('FAQ updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('FAQ restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('FAQ published. <a href="%s">View FAQ</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('FAQ saved.'),
			8 => sprintf( __('FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>'),
				date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  		);
		return $messages;
	}
	
}

// Initiate the plugin
add_action("init", "BizzFAQInit");
function BizzFAQInit() { 
	global $faqs_cpt; 
	$faqs_cpt = new BizzFAQ(); 
}

/* Custom Post Type Filters */
/*------------------------------------------------------------------*/

// Custom Taxonomy Filters
if ( isset($_GET['post_type']) ) {
	$post_type = $_GET['post_type'];
}
else {
	$post_type = '';
}

if ( $post_type == 'faqs' ) {
	add_action('restrict_manage_posts', 'faqs_restrict_manage_posts');
	add_filter('posts_where', 'faqs_posts_where');
}

// The drop down with filter
function faqs_restrict_manage_posts() {
?>
        <form name="location_attachmentform" id="location_attachmentform" action="" method="get">
            <fieldset>
<?php
				//FAQ Types
            	$category_ID = ( isset($_GET['type_names']) ) ? $_GET['type_names'] : '';
            	if ($category_ID > 0) {
            		//Do nothing
            	} 
				else {
            		$category_ID = 0;
            	}
            	$dropdown_options = array(	
					'show_option_all'	=> __('View all FAQs'), 
					'hide_empty' 		=> 0, 
					'hierarchical' 		=> 1,
					'show_count' 		=> 0, 
					'orderby' 			=> 'name',
					'name' 				=> 'type_names',
					'id' 				=> 'type_names',
					'taxonomy' 			=> 'faq_category', 
					'selected' 			=> $category_ID
				);
				wp_dropdown_categories($dropdown_options);
?>
            <input type="submit" name="submit" value="<?php _e('Filter') ?>" class="button" />
        </fieldset>
        </form>
<?php
}

// Custom Query to filter edit grid
function faqs_posts_where($where) {
    if( is_admin() ) {
        global $wpdb;
        $type_ID = ( isset($_GET['type_names']) ) ? $_GET['type_names'] : '';;
		if ( ($type_ID > 0) ) {
			$type_tax_names =  &get_term( $type_ID, 'faq_category' );
			$string_post_ids = '';
 			//faqs types
			if ($type_ID > 0) {
				$type_tax_name = $type_tax_names->slug;
				$type_myposts = get_posts('nopaging=true&post_type=faqs&faq_category='.$type_tax_name);
				foreach($type_myposts as $post) {
					$string_post_ids .= $post->ID.',';
				}
			}
			$string_post_ids = chop($string_post_ids,',');
   			$where .= "AND ID IN (" . $string_post_ids . ")";
		}
    }
    return $where;
}

?>