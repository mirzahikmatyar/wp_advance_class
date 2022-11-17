<?php

/**
 * Plugin Name: Portofolio
 * Description: Portofolio
 * Version: 1.0.0
 * Author: Bayu Wardani
 */

function belajar_jalan_saat_aktifasi()
{
    // ini akan berjalan saat aktivasi
    update_option('plugin_portofolio', 'aktif');
}

function belajar_jalan_saat_dimatikan()
{
    // ini akan berjalan saat di matikan
    update_option('plugin_portofolio', 'dimatikan');
}

function belajar_jalan_saat_dihapus()
{
    // ini akan belajar saat plugin di hapus
    delete_option('plugin_portofolio');
}

add_action( 'init', 'belajar_register_post_type' );
function belajar_register_post_type()
{
    $args = array(
        'label' => 'My Portofolio',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'portofolio'],
        'supports'           => ['title', 'editor', 'thumbnail']
    );
    register_post_type('portofolio', $args);
}

function belajar_jalan_saat_metabox_dijalankan($post) 
{
    $my_portofolio_posisi = get_post_meta( $post->ID, 'my_portofolio_posisi', true );
    $my_portofolio_url = get_post_meta( $post->ID, 'my_portofolio_url', true );
    $my_portofolio_tanggal_mulai = get_post_meta( $post->ID, 'my_portofolio_tanggal_mulai', true );
    $my_portofolio_tanggal_akhir = get_post_meta( $post->ID, 'my_portofolio_tanggal_akhir', true );
    
    ?>
    <div class="inline-edit-row">
        <div class="input-text-wrap" id="my_portofolio_url-wrap">
			<label for="my_portofolio_posisi" class="mb-1">Sebagai (Posisi)</label>
			<input class="mt-1 mb-1" type="text" value="<?=  $my_portofolio_posisi; ?>"  name="my_portofolio_posisi" id="my_portofolio_posisi" autocomplete="off" placeholder="Posisi">
		</div>
        <div class="input-text-wrap" id="my_portofolio_url-wrap">
			<label for="my_portofolio_url" class="mb-1">URL Demo</label>
			<input class="mt-1 mb-1" type="text" value="<?= $my_portofolio_url; ?>" name="my_portofolio_url" id="my_portofolio_url" autocomplete="off" placeholder="Url Demo">
		</div>
        <div class="input-text-wrap" id="my_portofolio_url-wrap">
			<label for="my_portofolio_tanggal_mulai" class="mb-1">Tanggal Mulai</label>
			<input class="mt-1 mb-1" type="date"  value="<?= $my_portofolio_tanggal_mulai; ?>" name="my_portofolio_tanggal_mulai" id="my_portofolio_tanggal_mulai" autocomplete="off" placeholder="Tanggal Mulai">
		</div>
        <div class="input-text-wrap" id="my_portofolio_url-wrap">
			<label for="my_portofolio_tanggal_akhir" class="mb-1">Tanggal Berakhir</label>
			<input class="mt-1 mb-1" type="date" value="<?= $my_portofolio_tanggal_akhir; ?>" name="my_portofolio_tanggal_akhir" id="my_portofolio_tanggal_akhir" autocomplete="off" placeholder="Tanggal Berakhir">
		</div>
    </div>
    <?php
}

add_action( 'add_meta_boxes', 'belajar_add_meta_box' );
function belajar_add_meta_box() {
    add_meta_box(
        'belajar_add_meta_box',
        'Informasi lainya',
        'belajar_jalan_saat_metabox_dijalankan',
        'portofolio'
    );
}

add_action('save_post', 'belajar_save_metabox');
function belajar_save_metabox($postId)
{
    $fields = ['my_portofolio_posisi', 'my_portofolio_url', 'my_portofolio_tanggal_mulai', 'my_portofolio_tanggal_akhir'];
    foreach($fields as $field) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta(
                $postId,
                $field,
                $_POST[$field]
            );
        }
    }
}

add_action( 'init', 'belajar_tambah_taxonomy' );
function belajar_tambah_taxonomy()
{
    $labels = array(
        'name'              => _x( 'Teknologi', 'taxonomy general name' ),
        'singular_name'     => _x( 'Teknologi', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Teknologi' ),
        'all_items'         => __( 'All Teknologi' ),
        'parent_item'       => __( 'Parent Teknologi' ),
        'parent_item_colon' => __( 'Parent Teknologi:' ),
        'edit_item'         => __( 'Edit Teknologi' ),
        'update_item'       => __( 'Update Teknologi' ),
        'add_new_item'      => __( 'Add New Teknologi' ),
        'new_item_name'     => __( 'New Teknologi Name' ),
        'menu_name'         => __( 'Teknologi' ),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'teknologi' ],
    );
    register_taxonomy( 'Teknologi', [ 'portofolio' ], $args );
}

add_shortcode('my_protofolio', 'belajar_shortcode');
function belajar_shortcode() {
    $args = [
        'post_type' => 'portofolio',
        'per_page' => '20'
    ];
    $portofolio_list = new WP_Query($args);
    $html = '<div>';
    while ( $portofolio_list->have_posts() ) {
        $portofolio_list->the_post();
        $post_type = get_post_type(get_the_ID());   
        $taxonomies = get_object_taxonomies($post_type);   
        $taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names"));

        $teknologis = '';

        foreach($taxonomy_names as $teknologi) {
            $teknologis .= '<button class="tag">'.$teknologi.'</button>';
        }

        $posisi = get_post_meta( get_the_ID(), 'my_portofolio_posisi', true );
        $url = get_post_meta( get_the_ID(), 'my_portofolio_url', true );
        $tanggal_awal = get_post_meta( get_the_ID(), 'my_portofolio_tanggal_akhir', true );
        $tanggal_akhir = get_post_meta( get_the_ID(), 'my_portofolio_tanggal_mulai', true );

        $html .= '<div class="card mb-2" >
        <img src='.get_the_post_thumbnail_url($portofolio_list->ID).' alt="Avatar" style="width:100%">
        <div class="container">
          <p><b>'.get_the_title().'</b> / <small>'.$posisi.'</small></p>
          <p><a href='.$url.'>'.$url.'</a></p>
          <p>'.$teknologis.'</p>
          <p>'.$tanggal_awal. ' s/d '.$tanggal_akhir.'</p>
          <p>'.$portofolio_list->post->post_content.'</p>
        </div>
      </div>';
    }
    $html .= '</div>';
    return $html;
}


add_filter('manage_portofolio_posts_columns', 'belajar_tabel_head');
function belajar_tabel_head( $defaults ) {
    $defaults['sebagai']          = 'Sebagai';
    $defaults['url_demo']         = 'Url Demo';
    $defaults['tanggal_mulai']    = 'Tanggal Mulai';
    $defaults['tanggal_berakhir'] = 'Tanggal Berakhir';
    unset($defaults['date']);
    return $defaults;
}

// 
add_action( 'manage_portofolio_posts_custom_column', 'belajar_table_content', 10, 2 );
function belajar_table_content( $column_name, $post_id ) {
    if ($column_name == 'sebagai') {
        $value = get_post_meta( $post_id, 'my_portofolio_posisi', true );
        echo $value;
    }

    if ($column_name == 'url_demo') {
        $value = get_post_meta( $post_id, 'my_portofolio_url', true );
        echo $value;
    }

    if ($column_name == 'tanggal_mulai') {
        $value = get_post_meta( $post_id, 'my_portofolio_tanggal_mulai', true );
        echo $value;
    }

    if ($column_name == 'tanggal_berakhir') {
        $value = get_post_meta( $post_id, 'my_portofolio_tanggal_akhir', true );
        echo $value;
    }
}

$pluginDir = plugins_url('/assets/css/css.css');

function load_css()
{
    wp_enqueue_style( 'portofolio-css', plugin_dir_url(__FILE__) . 'assets/css.css' , false, '1.0.0' );
}

function load_js()
{
    wp_enqueue_script( 'portofolio-js', plugin_dir_url(__FILE__) . 'assets/js.js', false, '1.0.0' );

}

add_action( 'wp_enqueue_scripts', 'load_css' );
add_action( 'wp_enqueue_scripts', 'load_js' );

add_action( 'admin_enqueue_scripts', 'load_css' );
add_action( 'admin_enqueue_scripts', 'load_js' );


add_filter('bulk_actions-edit-portofolio', function($bulk_actions) {
	$bulk_actions['sebuah-action'] = __('Sebuah Action', 'txtdomain');
	return $bulk_actions;
});

add_filter('handle_bulk_actions-edit-portofolio', function($redirect_url, $action, $post_ids) {
	if ($action == 'sebuah-action') {
		wp_die("aksi berjalan");
		$redirect_url = add_query_arg('sebuah-action', count($post_ids), $redirect_url);
	}
	return $redirect_url;
}, 10, 3);

register_activation_hook(__FILE__, 'belajar_jalan_saat_aktifasi');
register_deactivation_hook(__FILE__, 'belajar_jalan_saat_dimatikan');
register_uninstall_hook(__FILE__, 'belajar_jalan_saat_dihapus');