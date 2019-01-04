<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       wpgenius.in
 * @since      1.0.0
 *
 * @package    Photo_Gallery
 * @subpackage Photo_Gallery/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Photo_Gallery
 * @subpackage Photo_Gallery/admin
 * @author     Team WPGenius <deepak@wpgenius.in>
 */
class Photo_Gallery_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Photo_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photo_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/photo-gallery-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Photo_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photo_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/photo-gallery-admin.js', array( 'jquery' ), $this->version, false );

	}
    
//Created post type and taxonomy for the photo gallery
public function wpg_photo_post_type() {

		$video_labels = array(
			 			'name' => _x( 'Photos','' ),
						'singular_name'         => _x( 'Photo', '' ),	
						'menu_name'             => __( 'Photo', '' ),
						'name_admin_bar'        => __( 'Photo', '' ),
						'archives'              => __( 'Photo Archive', '' ),
						'parent_item_colon'     => __( 'Parent Photo:', '' ),		
						'all_items'             => __( 'All Photos', '' ),		
						'add_new_item'          => __( 'Add New Photo', '' ),		
						'add_new'               => __( 'Add New Photo', '' ),		
						'new_item'              => __( 'New Photos', '' ),		
						'edit_item'             => __( 'Edit Photos', '' ),		
						'update_item'           => __( 'Update Photos', '' ),		
						'view_item'             => __( 'View Photos', '' ),		
						'search_items'          => __( 'Search Photos', '' ),		
						'not_found'             => __( 'Not found', '' ),		
						'not_found_in_trash'    => __( 'Not found in Trash', '' ),		
						'featured_image'        => __( 'Featured Image', '' ),		
						'set_featured_image'    => __( 'Set thumbnail image', '' ),		
						'remove_featured_image' => __( 'Remove thumbnail image', '' ),		
						'use_featured_image'    => __( 'Use as thumbnail image', '' ),		
						'insert_into_item'      => __( 'Insert into Photo', '' ),		
						'uploaded_to_this_item' => __( 'Uploaded to this Photo', '' ),		
						'items_list'            => __( 'Photo list', '' ),		
						'items_list_navigation' => __( 'Photo list navigation', '' ),		
						'filter_items_list'     => __( 'Filter Photo list', '' ),	
					);

		$photo_args = array(	
						'label'                 => __( 'Photos', 'crezza' ),		
						'description'           => __( 'Photos', 'crezza' ),
						'labels'                => $video_labels,
						'supports'              => array( 'title', 'thumbnail'),
						'hierarchical'          => false,
						'public'                => true,
						'show_ui'               => true,
						'show_in_menu'          => true,
						'menu_position'         => 10,
						'menu_icon'             => 'dashicons-camera',
						'show_in_admin_bar'     => true,
						'show_in_nav_menus'     => true,
						'can_export'            => true,
						'has_archive'           => true,
						'exclude_from_search'   => false,
						'publicly_queryable'    => true,
						/*'capability_type'       => 'page',*/
						'rewrite'				=> array(											
													'slug'                       => 'photos',											
													'with_front'                 => false,											
													'hierarchical'               => false,										
												),		
					);

		register_post_type( 'photo-gallery', $photo_args );

		$args = array( 

					'hierarchical' => true,
					'label' => 'Photo Albums',
					'show_admin_column' => true, 
					'show_ui' => true, 
					'show_in_menu' => true,
					'public'=> true ,
					'publicly_queryable' => false , 
					'query_var' => true,
					'singular_label' => 'Photo Album'

				);
  
  		register_taxonomy( 'gallery-photo-albums', array( 'photo-gallery'), $args );

	}
    
//function to enque the css and js files    
function gallery_metabox_enqueue($hook) {
   
    if( $hook != 'post-new.php' && $hook!='post.php' )
        return;
    
      wp_enqueue_media();
      wp_enqueue_style( 'gallery-metabox', plugin_dir_url( __FILE__ ) .'/css/gallery-metabox.css', array(), $this->version, 'all' );
      wp_enqueue_script('gallery-metabox', plugin_dir_url( __FILE__ ) .'/js/gallery-metabox.js',array(), $this->version, 'all');

    }
    
    
function wpg_gallery_metabox($post_type) {
    $types = array('post', 'page', 'photo-gallery');
    if (in_array($post_type, $types)) {
      add_meta_box('gallery-metabox','Gallery',array($this, 'wpg_photo_meta_box'),$post_type,'advanced','high');
    }
    }

//function to create meta box for the images gallery    
function wpg_photo_meta_box($post) {
    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
    ?>
    <table class="form-table">
        <tr>
          <td>
              
            <a class="gallery-add button button button-primary button-large" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Upload images</a>
              
             <ul id="gallery-metabox-list">
                 
                <?php if ($ids) :
                foreach ($ids as $key => $value) :
                  $image = wp_get_attachment_image_src($value); ?>
                   <li>
                    <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                    <img class="image-preview" src="<?php echo $image[0]; ?>">
                    <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
                    <small><a class="remove-image" href="#">Remove image</a></small>
                  </li>
                 <?php endforeach; endif; ?>
                 
            </ul>
              
        </td>
       </tr>
    </table>
  <?php }

//function to save and update the meta box values
  function wpg_gallery_meta_save($post_id) {
    if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(isset($_POST['vdw_gallery_id'])) {
      update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
    } else {
      delete_post_meta($post_id, 'vdw_gallery_id');
    }
  }

//Created submenu option settings in the photo gallery menu
function photo_setting_menu(){
    
   // add_menu_page( 'Slider settings', 'Slider settings', 'delete_others_pages', 'slider-settings', 'slider_setting_optoins' );
    
    add_submenu_page( 'edit.php?post_type=photo-gallery', 'Photo settings', 'Photo Settings', 'delete_others_pages', 'photo-gallery', array($this,'photo_set_options',) );
    
    
}


function photo_set_options(){
    
    ?>
    <h1> Customize Photo</h1>
    <form method="POST" action="#">
        <?php 
        
        settings_fields( 'photo_group' ); //to in Settings API as option group name
    
        do_settings_sections( 'photo-gallery' ); 	//pass slug name of page
    
        submit_button();
        
        ?>
    </form>
    <?php
    
}
    
function photo_settings_api_init() {
    add_settings_section(
        'photo-section',
        'Photo Display Options',
        'photo_section',
        'photo-gallery'
		
	); 
    
    add_settings_field(
		'photo_title',
		'Show titles of images below slides',
		'photo_title_toggle',
		'photo-settings',
		'photo-section'
	);
    
	//register_setting( $option_group, $option_name, $args )

 	register_setting( 'slider_group', 'photo_title' );    

}

 function photo_section() {
 	echo '<p>Manage your slider</p>';
 }    

}
