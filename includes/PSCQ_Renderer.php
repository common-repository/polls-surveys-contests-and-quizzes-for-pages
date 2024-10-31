<?php

class PSCQ_Renderer
{
    public static $url_regex = "^(https:\/\/[a-z0-9-_]{2,}.app.(do|ps))\/([^\/\?#]+)$";

    public function shortcode_to_script($atts)
    {
        extract(shortcode_atts(array(
            'url' => '',
        ), $atts));

        $valid_url = preg_match('/' . PSCQ_Renderer::$url_regex . '/', $url, $matches);

        if ($valid_url) {
            $domain     = $matches[1];
            $path       = $matches[3];
            $iframe_url = $domain . '/iframe/' . $path . '.js';
            return '<p><script type="text/javascript" src="' . $iframe_url . '"></script></p>';
        } else {
            return __('error_message', 'pscq');
        }
    }
}
