jQuery(document).ready(function ($) {
  const { registerBlockType } = wp.blocks;
  const el = wp.element.createElement;
  const { Button, Placeholder, ExternalLink } = wp.components;

  let previewMode = false;
  const icon = el(
    "svg",
    {
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 260.4 228.98",
      "aria-hidden": "true",
    },
    el(
      "g",
      null,
      el("path", {
        d:
          "M-.4,182.27c22.9,13.74,106.15,62.9,106.15,62.9S145.7,145.71,260,99.71c0,0-28.36-47.51-48.65-83.53C140.2,61.64,92.17,186.6,92.17,186.6L25.68,120.71S2.44,174.79-.4,182.27Z",
      })
    )
  );

  registerBlockType("pscq/pscq-gutenberg-block", {
    title: gutenbergTranslations.gutenbergBlockName,
    description: gutenbergTranslations.gutenbergBlockDescription,
    icon: icon,
    category: "embed",
    attributes: {
      url: {
        type: "string",
      },
      valid: {
        type: "boolean",
        default: false,
      },
    },
    edit({ attributes, className, setAttributes }) {
      if (previewMode) {
        return el(wp.serverSideRender, {
          block: "pscq/pscq-gutenberg-block",
          attributes: attributes,
        });
      }

      var validate = (event) => {
        event.preventDefault();
        setAttributes({ valid: false });
        form = event.target;
        const $input = $("input[type=url]", form);
        const url = $input.val();
        const urlRegex = new RegExp(gutenbergTranslations.urlRegex);

        if (url.match(urlRegex)) {
          previewMode = true;
          console.debug("valid", attributes.valid);
          setAttributes({ valid: true });
        } else {
          $(".pscq-error-message", form).html(gutenbergTranslations.errorMessage);
        }
      };

      return el(
        Placeholder,
        {
          icon: icon,
          label: gutenbergTranslations.gutenbergBlockName,
          instructions: gutenbergTranslations.popupText,
          className: "wp-block-embed",
        },
        [
          el("form", { className: "pscq-form", onSubmit: validate }, [
            el("div", { className: "pscq-error-message" }),
            el("input", {
              type: "url",
              value: attributes.url,
              className: "components-placeholder__input",
              placeholder: gutenbergTranslations.placeholder,
              onChange: function (event) {
                $(".pscq-error-message", this.form).html("");
                setAttributes({ url: event.target.value, valid: false });
              },
            }),
            el(Button, { type: "submit", isPrimary: true }, gutenbergTranslations.button),
          ]),
          el("div", { className: "components-placeholder__learn-more" }, [
            el(
              ExternalLink,
              { href: gutenbergTranslations.blogPostUrl },
              gutenbergTranslations.learnMore
            ),
          ]),
        ]
      );
    },
    save() {
      // Displayed by the back-end
      return null;
    },
  });

  // HACK: Insert the script node directly because it doesn't run when added with innerHTML
  $(document).on(
    "DOMNodeInserted",
    "[data-type='pscq/pscq-gutenberg-block']",
    function (e) {
      $elem = $(e.target);
      $script = $("script", $elem);
      if ($script.length) {
        var newScript = document.createElement("script");
        newScript.src = $script.attr("src");
        $script.parent()[0].appendChild(newScript);
        $script.remove();
      }
    }
  );
});
