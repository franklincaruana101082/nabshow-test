(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
                  country: '',
                  description: '',
                  email: ''
              }
          ]
      });
    }

    render() {
        const { attributes, setAttributes, clientId, className } = this.props;
        const {products} = attributes;

        const itemList = products
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
                      <RichText
                          tagName="h2"
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
                          placeholder={__('Country/Countries')}
                          value={product.country}
                          className="country"
                          onChange={country => {
                              const newObject = Object.assign({}, product, {
                                  country: country
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
                          placeholder={__('Company Name and other details')}
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
                      <TextControl
                        type="text"
                        className="email"
                        value={product.email}
                        placeholder="Email Address"
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
          <div className="delegation">
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
                                country: '',
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

  registerBlockType('nab/delegation', {
    title: __('Delegation'),
    description: __('Delegation'),
    icon: 'universal-access-alt',
    category: 'nabshow',
    keywords: [__('Delegation'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      }
    },
    edit: ItemComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const {products} = attributes;

      return (
        <div className="delegation">
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
                        {product.country && (
                            <RichText.Content
                              tagName="span"
                              value={product.country}
                              className="country"
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
                            <a className="email" href={`mailto:${product.email}`}>{product.email}</a>
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
