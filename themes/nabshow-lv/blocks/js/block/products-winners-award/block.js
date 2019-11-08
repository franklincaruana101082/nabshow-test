(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, InspectorControls, MediaUpload } = wpEditor;
  const { PanelBody, PanelRow, ToggleControl, Button } = wpComponents;

  const productWinnerAwardBlockIcon = (
    <svg width="150px" height="150px" viewBox="173 173 150 150" enable-background="new 173 173 150 150">
      <path fill="#0F6CB6" d="M296.272,181.181h-9.234v-4.618h-18.472v4.618h-9.234v6.927c0,3.818,3.107,6.926,6.927,6.926h3.592
        c1.225,2.099,3.235,3.664,5.644,4.29v3.281l-26.266,8.755c0.551-1.494,0.867-3.098,0.867-4.782v-6.926
        c0-7.641-6.213-13.853-13.853-13.853c-7.641,0-13.853,6.212-13.853,13.853v6.926c0,1.684,0.317,3.288,0.868,4.782l-27.23-9.075
        c-0.644-0.216-1.312-0.324-1.988-0.324c-3.462,0-6.283,2.819-6.283,6.283v0.733c0,2.167,1.146,4.217,2.99,5.349l27.025,16.631
        v74.902h-9.236v13.853h73.883v-23.089h-11.543v-20.177c0-2.381-0.722-4.672-2.088-6.619l-14.075-20.107v-18.762l20.78-12.787v4.569
        h-4.617v4.618h13.853v-4.618h-4.618v-7.414l1.627-1.002c1.845-1.134,2.991-3.181,2.991-5.347v-0.733c0-2.884-1.965-5.294-4.618-6.03
        v-2.887c2.408-0.626,4.417-2.191,5.644-4.29h3.592c3.817,0,6.926-3.108,6.926-6.927V181.181z M266.259,190.417
        c-1.272,0-2.31-1.038-2.31-2.309v-2.309h4.617v4.618H266.259z M227.008,199.652c0-5.093,4.142-9.235,9.235-9.235
        c5.094,0,9.235,4.142,9.235,9.235v6.926c0,5.093-4.142,9.236-9.235,9.236c-5.093,0-9.235-4.143-9.235-9.236V199.652z
        M238.456,240.352l-2.212,2.211l-2.212-2.211l1.994-19.932c0.072,0.002,0.144,0.012,0.218,0.012c0.075,0,0.146-0.009,0.217-0.012
        L238.456,240.352z M277.803,315.095h-64.648v-4.619h36.941v-9.234h27.707V315.095z M252.405,296.623h-6.927v9.236h-9.235v-43.077
        c0-0.684,1-1.027,1.417-0.487l14.745,18.958V296.623z M280.111,208.977c0,0.575-0.302,1.115-0.791,1.418l-29.225,17.981v22.798
        l14.912,21.3c0.816,1.17,1.251,2.543,1.251,3.973v20.177h-9.236v-16.952l-15.716-20.209c-1.032-1.327-2.588-2.088-4.271-2.088
        c-2.983,0-5.409,2.426-5.409,5.408v43.077h-9.235v-77.483l-29.224-17.983c-0.489-0.3-0.791-0.842-0.791-1.415v-0.734
        c0-1.097,1.152-1.923,2.192-1.58l33.729,11.245c0.974,0.686,2.038,1.239,3.174,1.657l-2.249,22.504l7.021,7.023l7.023-7.024
        l-2.25-22.504c1.135-0.418,2.201-0.975,3.175-1.657l33.73-11.245c1.037-0.348,2.189,0.483,2.189,1.58V208.977z M282.42,190.417
        c0,2.546-2.07,4.617-4.617,4.617s-4.617-2.071-4.617-4.617v-9.236h9.234V190.417z M291.655,188.108c0,1.271-1.036,2.309-2.309,2.309
        h-2.309v-4.618h4.617V188.108z"/>
      <path fill="#0F6CB6" d="M300.891,204.27h4.617v4.618h-4.617V204.27z"/>
      <path fill="#0F6CB6" d="M296.272,208.888h4.618v4.617h-4.618V208.888z"/>
      <path fill="#0F6CB6" d="M300.891,213.505h4.617v4.618h-4.617V213.505z"/>
      <path fill="#0F6CB6" d="M305.508,208.888h4.617v4.617h-4.617V208.888z"/>
      <path fill="#0F6CB6" d="M196.993,234.285h4.617v4.618h-4.617V234.285z"/>
      <path fill="#0F6CB6" d="M192.375,238.902h4.618v4.617h-4.618V238.902z"/>
      <path fill="#0F6CB6" d="M196.993,243.52h4.617v4.618h-4.617V243.52z"/>
      <path fill="#0F6CB6" d="M201.61,238.902h4.618v4.617h-4.618V238.902z"/>
      <path fill="#0F6CB6" d="M206.228,178.873h4.618v4.617h-4.618V178.873z"/>
      <path fill="#0F6CB6" d="M201.61,183.49h4.618v4.618h-4.618V183.49z"/>
      <path fill="#0F6CB6" d="M206.228,188.108h4.618v4.617h-4.618V188.108z"/>
      <path fill="#0F6CB6" d="M210.846,183.49h4.617v4.618h-4.617V183.49z"/>
    </svg>
  );

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
      const { products, title, titleActive } = attributes;

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
    icon: { src: productWinnerAwardBlockIcon },
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
      const { products, title, titleActive } = attributes;

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
