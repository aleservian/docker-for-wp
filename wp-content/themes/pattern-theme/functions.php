<?php 
  if (function_exists('add_image_size')) {
    //add_image_size('img-bannerhome', 1920, 779, true);
}
function my_deregister_javascript() {
wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'my_deregister_javascript', 100 );


function my_acf_google_map_api( $api ){
  
  $api['key'] = 'AIzaSyC7kT3015QVSC3fMk4_J0kQFBaQGUrCC24';
  
  return $api;
  
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head','feed_links', 2 );
remove_action( 'wp_head','feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

function pagination() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
 
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

 
    if ( $paged >= 1 )
        $links[] = $paged;
 
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    $activeButtonNavPrev = '';
    $activeButtonNavNext = '';
    $urlPrevious = '';
    $urlNext = '';
 
    echo '<div class="storePagination">' . "\n";
    
    
    if ( get_previous_posts_link() ){
      $activeButtonNavPrev = 'storePagination-nav--active';
      
      $urlPrevious = 'href="'.get_previous_posts_page_link().'"';
    }
    $htmlPrev = '<a class="storePagination-nav storePagination-nav--prev '.$activeButtonNavPrev.'" '.$urlPrevious.' title="Anterior">
                    <div class="icon storePagination-prev-icon"></div>
                </a>';
    echo $htmlPrev;

    echo '<ul class="storePagination-list">';

    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 

    sort( $links );
    foreach ( (array) $links as $link ) {

        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><a>…</a></li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    echo '</ul>';
 
    if ( get_next_posts_link() ){
      $activeButtonNavNext = 'storePagination-nav--active';    
      $urlNext = 'href="'.get_next_posts_page_link().'"';
    }
    $htmlNext = '<a class="storePagination-nav storePagination-nav--next '.$activeButtonNavNext.'" '.$urlNext.' title="Próximo">
                    <div class="icon storePagination-next-icon"></div>
                </a>';
     echo $htmlNext;
 
    echo '</div>' . "\n";
 
}



 ?>