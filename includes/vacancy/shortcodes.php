<?php

/**
 * Shortcode to display the vacancy submission form
 */
add_shortcode( 'kinra_submit_vacancy', 'kinra_submit_vacancy_form' );
function kinra_submit_vacancy_form() {
    ob_start();
    ?>
    <form id="kinra_vacancy_form" class="kn-form" method="post">
        <div class="form-group kn-block kn-mb-4">
            <label for="employer_name" class="kn-block kn-mb-1.5"><?php _e( "Nama", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="employer_name" name="employer_name" aria-describedby="employer_name_error" placeholder="<?php _e( "John Doe", "kinra-lite" ); ?>" required>
            <span class="error" id="employer_name_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="employer_phone_number" class="kn-block kn-mb-1.5"><?php _e( "Nomor Hape", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="tel" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="employer_phone_number" name="employer_phone_number" aria-describedby="employer_phone_number_error" placeholder="<?php _e( "+62", "kinra-lite" ); ?>" required>
            <span class="error" id="employer_phone_number_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="employer_email" class="kn-block kn-mb-1.5"><?php _e( "Email", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="email" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="employer_email" name="employer_email" aria-describedby="employer_email_error" placeholder="<?php _e( "john_doe@email.com", "kinra-lite" ); ?>" required>
            <span class="error" id="employer_email_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="company" class="kn-block kn-mb-1.5"><?php _e( "PT Pemberi Kerja", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="company" name="company" aria-describedby="company_error" placeholder="<?php _e( "PT. Pointilis Noktah Teknologi", "kinra-lite" ); ?>" required>
            <span class="error" id="company_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="title" class="kn-block kn-mb-1.5"><?php _e( "Posisi Lowongan", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="title" name="title" aria-describedby="title_error" placeholder="<?php _e( "Desain Grafis", "kinra-lite" ); ?>" required>
            <span class="error" id="title_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="content" class="kn-block kn-mb-1.5"><?php _e( "Deskripsi Lowongan Kerja", "kinra-lite" ); ?><sup>*</sup></label>
            <textarea class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="content" name="content" rows="3" aria-describedby="content_error" placeholder="<?php _e( "Jelaskan lebih detail", "kinra-lite" ); ?>" required></textarea>
            <span class="error" id="content_error"></span>
        </div>

        <button type="submit" class="kn-mt-8 kn-block kn-w-full kn-bg-orange-600 kn-px-4 kn-py-4 kn-border kn-border-orange-800 kn-text-white kn-rounded-lg kn-text-xl"><?php _e( "Submit Lowongan", "kinra-lite" ); ?></button>
    </form>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode for displaying vacancys
 */
add_shortcode( 'kinra_vacancy_list', 'kinra_vacancy_list' );
function kinra_vacancy_list() {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'kinra_vacancy',
        'posts_per_page' => 15,
        'post_status' => 'publish',
        'paged' => $paged,
    );

    $vacancys = new WP_Query( $args );
    ob_start();
    ?>

    <ul class="kn-list-product kn-list-none kn-p-0 kn-m-0">
        <?php while( $vacancys->have_posts() ) : $vacancys->the_post(); 
            $employer_name = get_post_meta( get_the_ID(), 'employer_name', true );
            $employer_phone_number = get_post_meta( get_the_ID(), 'employer_phone_number', true );
            $employer_email = get_post_meta( get_the_ID(), 'employer_email', true );
            $company = get_post_meta( get_the_ID(), 'company', true );
        ?>
            <li class="kn-block kn-mt-5 kn-flex">
                <div class="kn-block">
                    <h3 class="kn-mt-0 kn-mb-2.5 kn-text-xl kn-font-semibold"><a href="<?php echo esc_url(the_permalink()); ?>" class="kn-no-underline"><?php the_title(); ?></a></h3>
                    <div><?php _e( 'Perusahaan', 'kinra-lite' ); ?>: <?php echo esc_html( $company ); ?></div>
                    <div><?php _e( 'Oleh', 'kinra-lite' ); ?>: <?php echo esc_html( $employer_name ); ?></div>
                    <div><?php _e( 'Nomor Handphone', 'kinra-lite' ); ?>: <?php echo esc_html( $employer_phone_number ); ?></div>
                    <div><?php _e( 'Email', 'kinra-lite' ); ?>: <?php echo esc_html( $employer_email ? $employer_email : '&mdash;' ); ?></div>
                </div>
            </li>
        <?php endwhile; wp_reset_query(); ?>
    </ul>

    <div class="kn-pagination">
        <?php 
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $vacancys->max_num_pages,
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