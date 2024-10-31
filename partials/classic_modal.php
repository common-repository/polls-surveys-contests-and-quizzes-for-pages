<div id="pscq-modal">
    <div id="pscq-modal-bg"></div>
    <div class='pscq-modal-content'>
        <button type="button" id="pscq-modal-close">
          <span class="dashicons-before dashicons-no"></span>
        </button>
        <h1>
          <?php _e('classic_modal_title', 'pscq')?>
        </h1>
        <div class="pscq-modal-instructions">
          <?php _e('instructions', 'pscq')?>
        </div>
        <form id="pscq-modal-form">
          <div id="pscq-modal-errors"></div>
          <input type="text" id="pscq-modal-input-url" placeholder="<?php _e('textbox_placeholder', 'pscq')?>">
          <button class="button-primary"><?php _e('classic_submit_button', 'pscq')?></button>
        </form>
        <div class="pscq-modal-learn-more">
          <a href="<?php _e('blog_post_url', 'pscq')?>" target="_blank">
            <?php _e('learn_more', 'pscq')?>
            <span class="dashicons-before dashicons-external"></span>
          </a>
        </div>
    </div>
</div>