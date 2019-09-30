(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const { RichText, MediaUpload } = wp.editor;
  const { Button, TextControl } = wp.components;

  class ItemComponent extends Component {

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
            title: '',
            location: '',
            discount: '',
            dates: '',
            description: ''
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { products, mainTitle } = attributes;

      const itemList = products
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
          return (
            <div key={index} className="box-item">
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
                <RichText
                  tagName="h2"
                  placeholder={__('Discount Title')}
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
                  placeholder={__('Location/Address')}
                  value={product.location}
                  className="location"
                  onChange={location => {

                    const newObject = Object.assign({}, product, {
                      location: location
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
                  className="discount"
                  placeholder={__('Discount')}
                  value={product.discount}
                  onChange={discount => {

                    const newObject = Object.assign({}, product, {
                      discount: discount
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
                  className="dates"
                  placeholder={__('Dates(s)')}
                  value={product.dates}
                  onChange={dates => {

                    const newObject = Object.assign({}, product, {
                      dates: dates
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
                  placeholder={__('Instructions on How to Redeem')}
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
              </div>
            </div>
          );
        });

      return (
        <div className="badge-discounts">
          <RichText
            tagName="h2"
            onChange={(value) => setAttributes({ mainTitle: value })}
            placeholder={__('Title')}
            value={mainTitle}
            className="badge-title"
          />
          <div className="box-main four-grid">
            {itemList}
            <div className="box-item additem">
              <button
                className="components-button add"
                onClick={content => {
                  setAttributes({
                    products: [
                      ...products,
                      {
                        index: products.length,
                        title: '',
                        location: '',
                        discount: '',
                        dates: '',
                        description: ''
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

  registerBlockType('nab/nab-badge-discounts', {
    title: __('Badge Discounts'),
    description: __('Badge Discounts'),
    icon: 'universal-access-alt',
    category: 'nabshow',
    keywords: [__('Badge'), __('Discounts'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      },
      mainTitle: {
        type: 'string'
      }
    },
    edit: ItemComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { products, mainTitle } = attributes;

      return (
        <div className="badge-discounts">
          <RichText.Content
            tagName="h2"
            value={mainTitle}
            className="badge-title"
          />
          <div className="box-main four-grid">
            {products.map((product, index) => (
              <Fragment>
                {
                  product.title && (
                    <div className="box-item">
                      <div className="box-inner">
                        {product.title && (
                          <RichText.Content
                            tagName="h2"
                            value={product.title}
                            className="title"
                          />
                        )}
                        {product.location && (
                          <RichText.Content
                            tagName="span"
                            value={product.location}
                            className="location"
                          />
                        )}
                        {product.discount && (
                          <RichText.Content
                            tagName="span"
                            className="discount"
                            value={product.discount}
                          />
                        )}
                        {product.dates && (
                          <RichText.Content
                            tagName="span"
                            className="dates"
                            value={product.dates}
                          />
                        )}
                        {product.description && (
                          <RichText.Content
                            tagName="p"
                            className="description"
                            value={product.description}
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
