(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
  const {__} = wpI18n;
  const { Fragment } = wpElement;
  const { registerBlockType } = wpBlocks;
  const { InspectorControls } = wpEditor;
  const { ServerSideRender, PanelBody, RadioControl, TextControl } = wpComponents;

  const allAttr = {
    formType: {
      type: 'string',
      default: 'startup-loft'
    },
    formEmail: {
      type: 'string',
      default: ''
    }
  };

  registerBlockType('nab/site-forms', {
    title: __('Forms'),
    icon: 'lock',
    category: 'nabshow',
    keywords: [__('forms'), __('startup'), __('contact')],
    attributes: allAttr,
    edit({ attributes, setAttributes }) {
      const { formType, formEmail } = attributes;
      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title={__('Form Settings')}>
              <div className="inspector-field inspector-field-radiocontrol nab-form-controls">
                <RadioControl
                  selected={formType}
                  label="Select Form Type"
                  options={[
                    { label: 'StartUp Loft', value: 'startup-loft' },
                    { label: 'Other', value: 'Other' },
                  ]}
                  onChange={(type) => setAttributes({ formType: type }) }
                />
              </div>
              <TextControl
                type="string"
                label={__('Send Copy To:')}
                value={formEmail}
                onChange={ (email) => setAttributes({formEmail: email }) }
              />
            </PanelBody>
          </InspectorControls>
          <ServerSideRender
            block="nab/site-forms"
            attributes={ { formType: formType } }
          />
        </Fragment>
      );
    },
    save() {
      return null;
    },
  });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
