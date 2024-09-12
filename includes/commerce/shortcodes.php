<?php

/**
 * Shortcode to display the product submission form
 */
add_shortcode( 'kinra_submit_product', 'kinra_submit_product_form' );
function kinra_submit_product_form() {
    ob_start();
    ?>
    <form id="kinra_product_form" method="post">
        <div class="form-group">
            <label for="seller_name"><?php _e( "Nama Lengkap", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control" id="seller_name" name="seller_name" aria-describedby="seller_name_error" placeholder="<?php _e( "John Doe", "kinra-lite" ); ?>" required>
            <span class="error" id="seller_name_error"></span>
        </div>

        <div class="form-group">
            <label for="seller_phone_number"><?php _e( "Nomor Hape", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="tel" class="form-control" id="seller_phone_number" name="seller_phone_number" aria-describedby="seller_phone_number_error" placeholder="<?php _e( "+62", "kinra-lite" ); ?>" required>
            <span class="error" id="seller_phone_number_error"></span>
        </div>

        <div class="form-group">
            <label for="seller_email"><?php _e( "Email", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="email" class="form-control" id="seller_email" name="seller_email" aria-describedby="seller_email_error" placeholder="<?php _e( "john_doe@email.com", "kinra-lite" ); ?>" required>
            <span class="error" id="seller_email_error"></span>
        </div>

        <div class="form-group">
            <label for="title"><?php _e( "Nama Produk", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title_error" placeholder="<?php _e( "Toples Kelinci", "kinra-lite" ); ?>" required>
            <span class="error" id="title_error"></span>
        </div>

        <div class="form-group">
            <label for="content"><?php _e( "Deskripsi Produk", "kinra-lite" ); ?><sup>*</sup></label>
            <textarea class="form-control" id="content" name="content" rows="3" aria-describedby="content_error" placeholder="<?php _e( "Toples Kelinci", "kinra-lite" ); ?>" required></textarea>
            <span class="error" id="content_error"></span>
        </div>

        <button type="submit"><?php _e( "Submit Produk", "kinra-lite" ); ?></button>
    </form>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode for displaying products
 */
add_shortcode( 'kinra_products_list', 'kinra_products_list' );
function kinra_products_list() {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'kinra_product',
        'posts_per_page' => 15,
        'post_status' => 'publish',
        'paged' => $paged,
    );

    $products = new WP_Query( $args );
    ob_start();
    ?>

    <ul>
        <?php while( $products->have_posts() ) : $products->the_post(); 
            $seller_name = get_post_meta( get_the_ID(), 'seller_name', true );
            $seller_phone_number = get_post_meta( get_the_ID(), 'seller_phone_number', true );
            $seller_email = get_post_meta( get_the_ID(), 'seller_email', true );
        ?>
            <li>
                <h3><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                <div><?php _e( 'Penjual', 'kinra-lite' ); ?>: <?php echo esc_html( $seller_name ); ?></div>
                <div><?php _e( 'Nomor Handphone', 'kinra-lite' ); ?>: <?php echo esc_html( $seller_phone_number ); ?></div>
                <div><?php _e( 'Email', 'kinra-lite' ); ?>: <?php echo esc_html( $seller_email ? $seller_email : '&mdash;' ); ?></div>
            </li>
        <?php endwhile; wp_reset_query(); ?>
    </ul>

    <div class="pagination">
        <?php 
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $products->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
    </div>

    <?php
    return ob_get_clean();
}