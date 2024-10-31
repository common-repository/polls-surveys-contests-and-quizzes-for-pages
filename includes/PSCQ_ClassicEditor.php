<?php

class PSCQ_ClassicEditor
{

    public function bind_actions()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_script('pscq_classic_editor-js', PSCQ_DIR_URL . "public/js/classic-editor.js");

            $data = array(
                'errorMessage' => __('error_message', 'pscq'),
                'urlRegex'     => PSCQ_Renderer::$url_regex,
            );
            wp_localize_script('pscq_classic_editor-js', 'classicTranslations', $data);
            wp_enqueue_style('pscq_classic_editor-style', PSCQ_DIR_URL . "public/css/classic-style.css");
        });

        $renderer = new PSCQ_Renderer();
        add_shortcode('fb_questionnaire', array(&$renderer, 'shortcode_to_script'));

        add_action('media_buttons', array(&$this, 'add_editor_button'), 10, 0);
        add_action('admin_print_footer_scripts', array(&$this, 'add_mce_popup'), 10, 0);
    }

    public function add_editor_button()
    {
        require_once PSCQ_PARTIALS_DIR . '/classic_button.php';
    }

    public function add_mce_popup()
    {
        require_once PSCQ_PARTIALS_DIR . '/classic_modal.php';
    }
}
