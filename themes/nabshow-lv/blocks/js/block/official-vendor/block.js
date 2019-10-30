(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, MediaUpload } = wpEditor;
  const { Button } = wpComponents;

  class EditOfficialVendor extends Component {

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
        products: [
          ...products,
          {
            index: products.length,
            media: '',
            mediaAlt: '',
            title: '',
            companyName: '',
            type: '',
            description: '',
            email: ''
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { products } = attributes;

      const getImageButton = (openEvent, index) => {
        if (products[index].media) {
          return (
            <img src={products[index].media} alt={products[index].alt} className="img" />
          );
        } else {
          return (
            <Button onClick={openEvent} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Logo</Button>
          );
        }
      };

      const productsList = products
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
          return (
            <div className="box-item">
              <div className="box-inner">
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
                  placeholder={__('title')}
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
                  tagName="p"
                  className="companyName"
                  placeholder={__('Company Name')}
                  value={product.companyName}
                  onChange={companyName => {
                    const newObject = Object.assign({}, product, {
                      companyName: companyName
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
                  className="type"
                  placeholder={__('Type: Exclusive OR Preferred')}
                  value={product.type}
                  onChange={type => {
                    const newObject = Object.assign({}, product, {
                      type: type
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
                  className="description"
                  placeholder={__('Description')}
                  value={product.description}
                  onChange={description => {
                    const newObject = Object.assign({}, product, {
                      description: description
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
                  tagName="a"
                  className="email"
                  placeholder={__('Email')}
                  value={product.email}
                  onChange={email => {
                    const newObject = Object.assign({}, product, {
                      email: email
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
        <div className="new-this-year official-vendors">
          <div className="box-main">
            {productsList}
            <div className="box-item additem">
              <button
                className="components-button add"
                onClick={content => {
                  setAttributes({
                    products: [
                      ...products,
                      {
                        index: products.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        companyName: '',
                        type: '',
                        description: '',
                        email: ''
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

  registerBlockType('nab/nab-official-vendors', {
    title: __('Official Vendors'),
    description: __('Official Vendors'),
    icon: 'buddicons-buddypress-logo',
    category: 'nabshow',
    keywords: [__('Official Vendors'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      }
    },
    edit: EditOfficialVendor,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { products } = attributes;

      return (
        <div className="new-this-year official-vendors">
          <div className="box-main">
            {products.map((product, index) => (
              <Fragment>
                {
                  product.title && (
                    <div className="box-item">
                      <div className="box-inner">
                        <div className="media-img">
                          {product.media ? (
                            <img src={product.media} alt={product.alt} className="img" />
                          ) : (
                              <div className="no-image">No Logo</div>
                            )}
                        </div>
                        {product.title && (
                          <RichText.Content
                            tagName="h3"
                            value={product.title}
                            className="title"
                          />
                        )}
                        {product.companyName && (
                          <RichText.Content
                            tagName="p"
                            className="companyName"
                            value={product.companyName}
                          />
                        )}
                        {product.type && (
                          <RichText.Content
                            tagName="p"
                            className="type"
                            value={product.type}
                          />
                        )}
                        {product.description && (
                          <RichText.Content
                            tagName="p"
                            className="description"
                            value={product.description}
                          />
                        )}
                        {product.email && (
                          <RichText.Content
                            tagName="a"
                            className="email"
                            value={product.email}
                          />
                        )}
                      </div>
                    </div>
                  )
                }
              </Fragment>
            ))}
          </div>
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
