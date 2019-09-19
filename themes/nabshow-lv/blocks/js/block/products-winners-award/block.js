(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const {
    RichText,
    InspectorControls,
    MediaUpload
  } = wp.editor;
  const {
    PanelBody,
    PanelRow,
    ToggleControl,
    Button
  } = wp.components;


  class NabMediaSlider extends Component {
    constructor() {
        super(...arguments);
        this.state = {
            bxSliderObj: {},
        };
    }

    componentDidMount() {
      const { products } = this.props.attributes;
      if (0 === products.length) {
          this.initList();
      }
  }

    initList() {
      const { products } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
          sliderActive: false,
          products: [
              ...products,
              {
                  index: products.length,
                  media: '',
                  mediaAlt: '',
                  title: '',
                  subtitle: '',
                  content: '',
              }
          ]
      });
    }

    render() {
        const { attributes, setAttributes, clientId } = this.props;
        const {products, title, titleActive} = attributes;

        const getImageButton = (openEvent, index) => {
          if (products[index].media) {
            return (
              <img src={products[index].media} alt={products[index].alt} className="img" />
            );
          } else {
            return (
              <Button onClick={openEvent} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Product Image</Button>
            );
          }
        };

        const productsList = products
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
            return (
                <div className="product-item">
                  <div className="product-inner">
                      <span
                          className="remove"
                          onClick={() => {
                              const qewQusote = products
                                  .filter(item => item.index != product.index)
                                  .map(t => {
                                      if (t.index > product.index) {
                                          t.index -= 1;
                                      }

                                      return t;
                                  });

                              setAttributes({
                                  products: qewQusote
                              });
                          }}
                      >
                          <span className="dashicons dashicons-no-alt"></span>
                      </span>
                      <div className="media-img">
                        <MediaUpload
                          onSelect={media => {
                            const newObject = Object.assign({}, product, {
                              media: media.url,
                              mediaAlt: media.alt
                            });
                            setAttributes({
                                products: [
                                    ...products.filter(
                                        item => item.index != product.index
                                    ),
                                    newObject
                                ]
                            });
                          }}
                          type="image"
                          value={attributes.imageID}
                          render={({ open }) => <span onClick={open} className="dashicons dashicons-edit"></span>}
                        />
                        <MediaUpload
                          onSelect={media => {
                            const newObject = Object.assign({}, product, {
                              media: media.url,
                              mediaAlt: media.alt
                            });
                            setAttributes({
                                products: [
                                    ...products.filter(
                                        item => item.index != product.index
                                    ),
                                    newObject
                                ]
                            });
                          }}
                          type="image"
                          value={attributes.imageID}
                          render={({ open }) => getImageButton(open, index)}
                        />
                      </div>
                      <RichText
                          tagName="h3"
                          placeholder={__('Title')}
                          value={product.title}
                          className="title"
                          onChange={title => {
                              const newObject = Object.assign({}, product, {
                                  title: title
                              });
                              setAttributes({
                                  products: [
                                      ...products.filter(
                                          item => item.index != product.index
                                      ),
                                      newObject
                                  ]
                              });
                          }}
                      />
                      <RichText
                          tagName="span"
                          className="subtitle"
                          placeholder={__('Company Name')}
                          value={product.subtitle}
                          onChange={subtitle => {
                              const newObject = Object.assign({}, product, {
                                  subtitle: subtitle
                              });
                              setAttributes({
                                  products: [
                                      ...products.filter(
                                          item => item.index != product.index
                                      ),
                                      newObject
                                  ]
                              });
                          }}
                      />
                      <RichText
                          tagName="p"
                          className="content"
                          placeholder={__('Description')}
                          value={product.content}
                          onChange={content => {
                              const newObject = Object.assign({}, product, {
                                  content: content
                              });
                              setAttributes({
                                  products: [
                                      ...products.filter(
                                          item => item.index != product.index
                                      ),
                                      newObject
                                  ]
                              });
                          }}
                      />
                    </div>
                </div>
            );
        });

        return (
          <div className="products-winners">
            <InspectorControls>
              <PanelBody title="General Settings">
                <PanelRow>
                  <ToggleControl
                    label={__('Show Title')}
                    checked={titleActive}
                    onChange={() => setAttributes({ titleActive: ! titleActive })}
                  />
                </PanelRow>
              </PanelBody>
            </InspectorControls>
            {titleActive && (
                <RichText
                  tagName="h2"
                  className="product-title"
                  placeholder={__('Category')}
                  value={title}
                  onChange={value => setAttributes({ title: value })}
                />
            )}
            <div className="product-main">
             {productsList}
             <div className="product-item additem">
              <button
                  className="components-button add"
                  onClick={content => {
                      setAttributes({
                          sliderActive: false,
                          products: [
                              ...products,
                              {
                                index: products.length,
                                media: '',
                                mediaAlt: '',
                                title: '',
                                subtitle: '',
                                content: '',
                            }
                          ]
                      });
                  }
                  }
              >
                <span className="dashicons dashicons-plus"></span> Add New Item
              </button>
              </div>
            </div>
          </div>
        );
    }
}

  /* Parent schedule Block */
  registerBlockType('nab/products-winners-award', {
    title: __('Products Winners Award'),
    description: __('Products Winners'),
    icon: 'products',
    category: 'nabshow',
    keywords: [__('Products Winners Award'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      },
      title: {
        type: 'string'
      },
      titleActive: {
        type: 'boolean',
        default: true
      }
    },
    edit: NabMediaSlider,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const {products, title, titleActive} = attributes;

      return (
        <div className="products-winners">
          {titleActive && title && (
              <RichText.Content
                tagName="h2"
                className="product-title"
                value={title}
            />
          )}
          <div className="product-main">
            {products.map((product, index) => (
              <div className="product-item">
                <div className="product-inner">
                  <div className="media-img">
                    {product.media ? (
                      <img src={product.media} alt={product.alt} className="img" />
                    ) : (
                      <div className="no-image">No Media</div>
                    )}
                  </div>
                  {product.title && (
                      <RichText.Content
                        tagName="h3"
                        value={product.title}
                        className="title"
                      />
                  )}
                  {product.subtitle && (
                      <RichText.Content
                        tagName="span"
                        className="subtitle"
                        value={product.subtitle}
                      />
                  )}
                  {product.content && (
                      <RichText.Content
                        tagName="p"
                        className="content"
                        value={product.content}
                      />
                  )}
                </div>
            </div>
            ))}
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
