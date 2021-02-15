(function (wpI18n, wpBlocks, wpBlockEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const {
    ServerSideRender,
  } = wpComponents;

  registerBlockType("nab/company-feature", {
    // built in attributes
    title: __("Company Feature"),
    description: __("Company Feature Block"),
    icon: "editor-code",
    category: "nab_amplify",
    keywords: [__("Feature"), __("Gutenberg")],
    edit() {
      return (
        <Fragment>
          <ServerSideRender block="nab/company-feature" />
        </Fragment>
      );
    },
    save() {
      return null;
    },
  });
})(wp.i18n, wp.blocks, wp.blockEditor, wp.components, wp.element);
