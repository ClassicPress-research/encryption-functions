<?php
/*
Plugin Name: ClassicPress Encryption
Plugin URI: https://github.com/ClassicPress-research/encryption-functions/
Description: Encryption features for GDPR and privacy laws compliance.
Author: Raymund John Ang
Author URI: https://open-nis.org/
Text Domain: cp-encryption
Version: 0.9.1
Credits: BasicPHP [Source code]. https://github.com/ray-ang/basicphp
        Open-NIS Nursing ekardex [Source code]. https://github.com/ray-ang/open-nis-patient-care-summary
*/

if ( ! class_exists('Basic') ) require __DIR__ . '/Basic.php'; // BasicPHP class library

add_filter( 'admin_init', 'cp_check_pass_phrase' ); // Require passphrase alert

function cp_check_pass_phrase() {

    if ( ! defined( 'CP_PASS_PHRASE' ) && is_admin() && ! wp_doing_ajax() && ( stristr($_SERVER['REQUEST_URI'], 'post.php') || stristr($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
        ?>
        <script>alert('Warning: Constant CP_PASS_PHRASE is not defined in wp-config.php file.');</script>
        <?php
    }

    if ( defined( 'CP_PASS_PHRASE' ) && is_admin() && ! wp_doing_ajax() && ( stristr($_SERVER['REQUEST_URI'], 'post.php') || stristr($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {

        if ( filter_var(CP_PASS_PHRASE, FILTER_VALIDATE_URL) ) {
            $api = CP_PASS_PHRASE . '?action=encrypt';
            $response = Basic::apiCall('POST', $api, ['key' => CP_PASS_PHRASE]);

            if ($response['code'] !== 200) {
                ?>
                <script>alert('Warning: Invalid Key-Encryption-Key API server URL.');</script>
                <?php
            }
        }

    }

}

/**
  * Open-NIS Nursing ekardex post meta encrypt & decrypt buttons
  */
add_action( 'admin_init', 'cp_admin_encrypt_btn' ); // Encrypt and decrypt buttons

function cp_admin_encrypt_btn() {

    if( is_admin() && ! wp_doing_ajax() && isset($_POST['encrypt']) && $_POST['encrypt'] === 'Encrypt' && ! empty($_POST) ) {

        foreach ( $_POST['meta'] as $meta ) {
            if ( ! stristr($meta['value'], 'encv') ) {
                $index = array_search($meta, $_POST['meta']);
                $_POST['meta'][$index]['value'] = Basic::encrypt($meta['value'], CP_PASS_PHRASE);
            }
        }

    }

    if( is_admin() && ! wp_doing_ajax() && isset($_POST['decrypt']) && $_POST['decrypt'] === 'Decrypt' && ! empty($_POST) ) {

        foreach ( $_POST['meta'] as $meta ) {
            if ( stristr($meta['value'], 'encv') ) {
                $index = array_search($meta, $_POST['meta']);
                $_POST['meta'][$index]['value'] = Basic::decrypt($meta['value'], CP_PASS_PHRASE);
            }
        }

    }

}

add_action( 'admin_footer', 'cp_admin_footer' ); // Admin - footer

function cp_admin_footer() {

    if ( is_admin() && ! wp_doing_ajax() && ( stristr($_SERVER['REQUEST_URI'], 'post.php') || stristr($_SERVER['REQUEST_URI'], 'post-new.php') ) ) {
        ?>
        <script>
            // Render encrypt and decrypt buttons
            const encryptBtn = document.createElement('input'); // Encrypt button
            encryptBtn.classList.add('button', 'button-info', 'button-large');
            encryptBtn.type = 'submit';
            encryptBtn.name = 'encrypt';
            encryptBtn.value = 'Encrypt';
            encryptBtn.style.marginRight = '3px';
            document.querySelector('#publishing-action').appendChild(encryptBtn);

            const decryptBtn = document.createElement('input'); // Decrypt button
            decryptBtn.classList.add('button', 'button-info', 'button-large');
            decryptBtn.type = 'submit';
            decryptBtn.name = 'decrypt';
            decryptBtn.value = 'Decrypt';
            document.querySelector('#publishing-action').appendChild(decryptBtn);
        </script>
        <?php
    }

}