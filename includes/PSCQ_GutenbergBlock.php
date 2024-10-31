<?php

class PSCQ_GutenbergBlock
{

    public function bind_actions()
    {

        if ( ! function_exists( 'register_block_type' ) ) {
		    // Gutenberg is not active.
		    return;
        }

        wp_register_script(
            'pscq-gutenberg-block',
            plugin_dir_url(PSCQ_PUBLIC_DIR) . '/public/js/gutenberg-block.js'
        );

        wp_register_style(
            'pscq-gutenberg-style',
            PSCQ_DIR_URL . "public/css/gutenberg-style.css"
        );

        $data = array(
            'gutenbergBlockName'        => __('gutenberg_block_name', 'pscq'),
            'gutenbergBlockDescription' => __('gutenberg_block_description', 'pscq'),
            'placeholder'               => __('textbox_placeholder', 'pscq'),
            'popupText'                 => __('instructions', 'pscq'),
            'button'                    => __('gutenberg_submit_button', 'pscq'),
            'errorMessage'              => __('error_message', 'pscq'),
            'blogPostUrl'               => __('blog_post_url', 'pscq'),
            'learnMore'                 => __('learn_more', 'pscq'),
            'urlRegex'                  => PSCQ_Renderer::$url_regex,
        );
        wp_localize_script('pscq-gutenberg-block', 'gutenbergTranslations', $data);

        register_block_type('pscq/pscq-gutenberg-block', array(
            'editor_style'    => 'pscq-gutenberg-style',
            'editor_script'   => 'pscq-gutenberg-block',
            'render_callback' => function ($atts) {
                $renderer = new PSCQ_Renderer();
                return $renderer->shortcode_to_script($atts);
            },
            'attributes'      => [
                'url'   => [
                    'type' => 'string',
                ],
                'valid' => [
                    'type'    => 'boolean',
                    'default' => false,
                ],
            ],
        ));
    }
}
