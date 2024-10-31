<?php
/**
 * Plugin Name: Polls, Surveys, Contests and Quizzes for Pages
 * Description: Embed polls, surveys, contests and quizzes into your WordPress site and get valuable feedback from your customers.
 * Plugin URI: https: //poll-app.com/worpdress
 * Version: 1.2
 * Author: Code Rubik
 * Author URI: https://coderubik.com
 * Text Domain: pscq
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

define('PSCQ_DIR', dirname(__FILE__));
define('PSCQ_PUBLIC_DIR', PSCQ_DIR . '/public');
define('PSCQ_INCLUDES_DIR', PSCQ_DIR . '/includes');
define('PSCQ_PARTIALS_DIR', PSCQ_DIR . '/partials');
define('PSCQ_DIR_URL', plugin_dir_url(__FILE__));

function pscq_set_locale($locale, $domain)
{
    if ('pscq' == $domain) {
        $language = substr($locale, 0, 2);
        switch ($language) {
            case 'fr':
                $locale = 'fr_FR';
                break;
            case 'es':
                $locale = 'es_ES';
                break;
            case 'pt':
                $locale = 'pt_BR';
                break;
            case 'de':
                $locale = 'de_DE';
                break;
            default:
                $locale = 'en_US';
        }
    }
    return $locale;
}

function pscq_init()
{
    require_once PSCQ_INCLUDES_DIR . '/PSCQ_Renderer.php';
    require_once PSCQ_INCLUDES_DIR . '/PSCQ_ClassicEditor.php';
    require_once PSCQ_INCLUDES_DIR . '/PSCQ_GutenbergBlock.php';

    add_filter('plugin_locale', 'pscq_set_locale', 10, 2);
    load_plugin_textdomain('pscq', false, '/polls-surveys-contests-and-quizzes-for-pages/languages/');

    $classic_editor = new PSCQ_ClassicEditor();
    $classic_editor->bind_actions();

    $gutenberg_editor = new PSCQ_GutenbergBlock();
    $gutenberg_editor->bind_actions();
}

add_action('init', 'pscq_init');
