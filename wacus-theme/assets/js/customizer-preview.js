/**
 * WACUS Theme - Customizer Preview
 * Live preview scripts for the WordPress Customizer
 */

(function($) {
    'use strict';

    // Primary Color
    wp.customize('wacus_primary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-primary', newval);
        });
    });

    // Secondary Color
    wp.customize('wacus_secondary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-secondary', newval);
        });
    });

    // Accent Color
    wp.customize('wacus_accent_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-accent', newval);
        });
    });

    // Background Color
    wp.customize('wacus_bg_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-bg', newval);
        });
    });

    // Text Color
    wp.customize('wacus_text_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-text', newval);
        });
    });

    // Cursor Color
    wp.customize('wacus_cursor_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--cursor-color', newval);
        });
    });

    // Header CTA Text
    wp.customize('wacus_header_cta_text', function(value) {
        value.bind(function(newval) {
            $('.header-cta .btn-text').text(newval);
        });
    });

    // Copyright Text
    wp.customize('wacus_copyright_text', function(value) {
        value.bind(function(newval) {
            $('.copyright-text').html(newval);
        });
    });

    // Footer Description
    wp.customize('wacus_footer_description', function(value) {
        value.bind(function(newval) {
            $('.footer-description').text(newval);
        });
    });

    // 404 Title
    wp.customize('wacus_404_title', function(value) {
        value.bind(function(newval) {
            $('.error-title').text(newval);
        });
    });

    // 404 Description
    wp.customize('wacus_404_description', function(value) {
        value.bind(function(newval) {
            $('.error-description').text(newval);
        });
    });

})(jQuery);
