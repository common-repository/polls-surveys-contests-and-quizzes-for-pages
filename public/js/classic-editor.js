jQuery(document).ready(function ($) {
  $("#pscq-editor-button").on("click", openModal);
  $("#pscq-modal-bg, #pscq-modal-close").on("click", closeModal);
  $("#pscq-modal-form").on("submit", validateURL);
  $("#pscq-modal-input-url").on("input", showErrorMessage);

  function openModal() {
    $("#pscq-modal").show();
  }

  function closeModal() {
    showErrorMessage(""); // Clear messages
    $("#pscq-modal").hide();
  }

  function validateURL(event) {
    event.preventDefault();
    var $input = $("#pscq-modal-input-url");
    var url = $input.val();
    var urlRegex = new RegExp(classicTranslations.urlRegex);

    if (url.match(urlRegex)) {
      insertShortCode(url);
      $input.val("");
      closeModal();
    } else {
      showErrorMessage(classicTranslations.errorMessage);
    }
  }

  function showErrorMessage(message) {
    $("#pscq-modal-errors").html(message);
  }

  function insertShortCode(url) {
    window.send_to_editor('[fb_questionnaire url="' + url + '"]');
  }
});
