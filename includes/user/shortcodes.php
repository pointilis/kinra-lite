<?php

/**
 * Shortcode to display the register submission form
 */
add_shortcode( 'kinra_register_form', 'kinra_register_form' );
function kinra_register_form() {
    ob_start();
    ?>

<form id="kinra_register_form" class="kn-form" method="post">
        <div class="form-group kn-block kn-mb-4">
            <label for="name" class="kn-block kn-mb-1.5"><?php _e( "Nama Lengkap", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="text" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="name" name="name" aria-describedby="name_error" placeholder="<?php _e( "John Doe", "kinra-lite" ); ?>" required>
            <span class="error" id="name_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="email" class="kn-block kn-mb-1.5"><?php _e( "Email", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="email" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="email" name="email" aria-describedby="email_error" placeholder="<?php _e( "john_doe@email.com", "kinra-lite" ); ?>" required>
            <span class="error" id="email_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="phone_number" class="kn-block kn-mb-1.5"><?php _e( "Nomor Hape", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="tel" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="phone_number" name="phone_number" aria-describedby="phone_number_error" placeholder="<?php _e( "+62", "kinra-lite" ); ?>" required>
            <span class="error" id="phone_number_error"></span>
        </div>

        <div class="form-group kn-block kn-mb-4">
            <label for="password" class="kn-block kn-mb-1.5"><?php _e( "Password", "kinra-lite" ); ?><sup>*</sup></label>
            <input type="password" class="form-control kn-border kn-border-neutral-400 kn-px-4 kn-py-3 kn-w-full" id="password" name="password" aria-describedby="password_error" placeholder="<?php _e( "Harap lebih dari 6 karakter", "kinra-lite" ); ?>" required>
            <span class="error" id="password_error"></span>
        </div>

        <button type="submit" class="kn-mt-8 kn-block kn-w-full kn-bg-orange-600 kn-px-4 kn-py-4 kn-border kn-border-orange-800 kn-text-white kn-rounded-lg kn-text-xl"><?php _e( "Register", "kinra-lite" ); ?></button>
    </form>

    <?php
    return ob_get_clean();
}