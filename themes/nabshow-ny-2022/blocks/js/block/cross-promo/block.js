(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment } = wpElement;
  const { RichText, InspectorControls } = wpEditor;
  const { Button, PanelBody, TextControl } = wpComponents;

    const crossPromoBlockIcon = (
      <svg version="1.1" id="crossPromoBlockIcon" width="150px" height="150px" viewBox="200 200 150 150" enable-background="new 200 200 150 150">
        <g>
          <g>
            <path fill="#146DB6" d="M332.136,233.885V223.15c0-7.089-5.767-12.856-12.855-12.856h-88.56c-7.088,0-12.855,5.767-12.855,12.856
              v10.735c-4.987,1.769-8.57,6.532-8.57,12.119v91.417c0,2.366,1.918,4.284,4.285,4.284h122.842c2.366,0,4.284-1.918,4.284-4.284
              v-91.417C340.706,240.417,337.123,235.654,332.136,233.885z M266.43,241.719h17.14v8.57c0,4.726-3.844,8.57-8.57,8.57
              c-4.726,0-8.57-3.844-8.57-8.57L266.43,241.719L266.43,241.719z M232.149,333.136h-14.284v-66.682
              c1.81,0.638,3.737,0.976,5.714,0.976c3.121,0,6.047-0.842,8.57-2.306L232.149,333.136L232.149,333.136z M232.149,250.289
              c0,4.726-3.845,8.57-8.57,8.57c-2.133,0-4.152-0.783-5.713-2.183v-10.672c0-2.363,1.922-4.285,4.285-4.285h9.999V250.289
              L232.149,250.289z M240.719,250.289v-8.57h17.141v8.57c0,4.726-3.845,8.57-8.57,8.57S240.719,255.015,240.719,250.289z
              M259.217,275.898c4.726,0,8.57,3.845,8.57,8.57s-3.845,8.57-8.57,8.57c-4.726,0-8.57-3.845-8.57-8.57
              S254.491,275.898,259.217,275.898z M290.642,324.464c-4.727,0-8.57-3.845-8.57-8.57c0-4.727,3.844-8.57,8.57-8.57
              c4.726,0,8.569,3.844,8.569,8.57C299.211,320.619,295.367,324.464,290.642,324.464z M298.027,281.887l-39.995,39.995
              c-0.836,0.836-1.933,1.254-3.03,1.254s-2.193-0.417-3.03-1.254c-1.673-1.674-1.673-4.388,0-6.061l39.996-39.995
              c1.673-1.673,4.386-1.673,6.059,0C299.701,277.5,299.701,280.214,298.027,281.887z M309.282,250.289
              c0,4.726-3.846,8.57-8.571,8.57s-8.57-3.844-8.57-8.57v-8.57h17.142V250.289L309.282,250.289z M332.136,333.136h-14.283v-68.012
              c2.522,1.463,5.449,2.306,8.569,2.306c1.978,0,3.904-0.338,5.714-0.976V333.136L332.136,333.136z M332.136,256.676
              c-1.562,1.4-3.58,2.183-5.714,2.183c-4.726,0-8.569-3.844-8.569-8.57v-8.571h9.998c2.362,0,4.285,1.923,4.285,4.286V256.676z"/>
          </g>
        </g>
        </svg>
    );

  registerBlockType('nab/cross-promo', {
    title: __('Cross Promo'),
    icon: { src: crossPromoBlockIcon },
    category: 'nabshow',
    keywords: [__('cross'), __('promo'), __('nab')],
    attributes: {
      title: {
        type: 'string'
      },
      description: {
        type: 'string',
        default: ''
      },
      ButtonText: {
        type: 'string',
        default: 'Learn More'
      },
      postID: {
        type: 'number',
      }
    },
    edit: (props) => {

      const { attributes, setAttributes } = props;
      const { title, description, ButtonText, postID } = attributes;

      const getExcerpt = () => {

        if ( postID ) {
          wp.apiFetch({ path: '/nab_api/request/post-excerpt/?id=' + postID }).then((excerpt) => {

            if ( '' !== excerpt ) {
              setAttributes({ description: excerpt});
            } else if ( '' === description) {
              setAttributes({ description: 'Post excerpt not found for given id. Either change the id or enter manually.'});
            }
          });
        }

      };

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title="Settings">
              <TextControl
                type="number"
                label="Enter post ID to fetch excerpt"
                value={postID}
                onChange={value => setAttributes({ postID: parseInt(value) })}
              />
              <Button className="button button-large button-primary" onClick={getExcerpt}>{__('Fetch')}</Button>
            </PanelBody>
          </InspectorControls>
          <div className="cross-promo-outner">
            <div className="cross-promo-inner">
                <RichText
                  tagName="h3"
                  onChange={value => setAttributes({ title: value })}
                  value={title}
                  className="title"
                  placeholder={__('Title')}
                />
                <RichText
                  tagName="p"
                  onChange={value => setAttributes({ description: value })}
                  value={description}
                  className="description"
                  placeholder={__('Description')}
                />
                <RichText
                  tagName="a"
                  className="promo-link"
                  onChange={ButtonText => setAttributes({ ButtonText: ButtonText })}
                  value={ButtonText}
                  rel='noopener noreferrer'
                />
            </div>
          </div>
        </Fragment>
      );
    },
    save: (props) => {
      const { title, description, ButtonText } = props.attributes;

      return (
        <div className="cross-promo-outner">
          <div className="cross-promo-inner">
            {title && <RichText.Content tagName="h3" value={title} className="title" /> }
            {description && <RichText.Content tagName="p" value={description} className="description" /> }
            {ButtonText && <RichText.Content tagName="a" value={ButtonText} className="promo-link" /> }
          </div>
        </div>
      );
    }
  });

})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
