(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText } = wpEditor;
  const { TextControl } = wpComponents;

  class ItemComponent extends Component {

    componentDidMount() {
      const { dataArray } = this.props.attributes;
      if (0 === dataArray.length) {
        this.initList();
      }
    }

    initList() {
      const { dataArray } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
        dataArray: [
          ...dataArray,
          {
            index: dataArray.length,
            itemTitle: '',
            itemDetails: '',
            price: '',
            subPrice: '',
            link: '',
            comming: false
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { dataArray, title, details } = attributes;

      const itemList = dataArray
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
          return (
            <div className={`registration-item ${product.comming ? 'comming-soon' : ''}`}>
              <span
                className="remove"
                onClick={() => {
                  const qewQusote = dataArray
                    .filter(item => item.index != product.index)
                    .map(t => {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                  setAttributes({
                    dataArray: qewQusote
                  });
                }}
              >
                <span className="dashicons dashicons-no-alt"></span>
              </span>
              <div className="plus-sec">
                {false === product.comming && (
                  <Fragment>
                    <span>+</span>
                    <div className="plus-link">
                      <TextControl
                        type="string"
                        value={product.link}
                        placeholder="#"
                        onChange={link => {
                          const newObject = Object.assign({}, product, {
                            link: link
                          });
                          setAttributes({
                            dataArray: [
                              ...dataArray.filter(
                                item => item.index != product.index
                              ),
                              newObject
                            ]
                          });
                        }}
                      />
                    </div>
                  </Fragment>
                )}
              </div>
              <div className="middle-sec">
                <RichText
                  tagName="h3"
                  placeholder={__('Item Title')}
                  value={product.itemTitle}
                  className="item-title"
                  onChange={itemTitle => {
                    const newObject = Object.assign({}, product, {
                      itemTitle: itemTitle
                    });
                    setAttributes({
                      dataArray: [
                        ...dataArray.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('Description')}
                  value={product.itemDetails}
                  className="item-description"
                  onChange={itemDetails => {
                    const newObject = Object.assign({}, product, {
                      itemDetails: itemDetails
                    });
                    setAttributes({
                      dataArray: [
                        ...dataArray.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
              </div>
              <div className="last-sec">
                <RichText
                  tagName="p"
                  placeholder={__('Price')}
                  value={product.price}
                  className="price"
                  onChange={price => {
                    const newObject = Object.assign({}, product, {
                      price: price
                    });
                    setAttributes({
                      dataArray: [
                        ...dataArray.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                {
                  false == product.comming ? (
                    <RichText
                      tagName="span"
                      placeholder={__('Sub Price')}
                      value={product.subPrice}
                      className="sub-price"
                      onChange={subPrice => {
                        const newObject = Object.assign({}, product, {
                          subPrice: subPrice
                        });
                        setAttributes({
                          dataArray: [
                            ...dataArray.filter(
                              item => item.index != product.index
                            ),
                            newObject
                          ]
                        });
                      }}
                    />
                  ) : ''}
              </div>
            </div>
          );
        });

      return (
        <div className="registration-passes">
          <div className="registration-head">
            <RichText
              tagName="h2"
              placeholder={__('Title')}
              value={title}
              className="title"
              onChange={title => {
                setAttributes({ title: title });
              }}
            />
            <RichText
              tagName="p"
              placeholder={__('Description')}
              value={details}
              className="description"
              onChange={details => {
                setAttributes({ details: details });
              }}
            />
          </div>
          {itemList}
          <div className="registration-item additem">
            <button
              className="components-button add"
              onClick={content => {
                setAttributes({
                  dataArray: [
                    ...dataArray,
                    {
                      index: dataArray.length,
                      itemTitle: '',
                      itemDetails: '',
                      price: '',
                      subPrice: '',
                      link: '',
                      comming: false
                    }
                  ]
                });
              }
              }
            >
              <span className="dashicons dashicons-plus"></span> Add New Item
              </button>
            <button
              className="components-button add coming-btn"
              onClick={content => {
                setAttributes({
                  dataArray: [
                    ...dataArray,
                    {
                      index: dataArray.length,
                      itemTitle: '',
                      itemDetails: '',
                      price: 'Registration Coming Soon!',
                      subPrice: '',
                      link: '',
                      comming: true
                    }
                  ]
                });
              }
              }
            >
              <span className="dashicons dashicons-plus"></span> Add Comming Soon
              </button>
          </div>
        </div>
      );
    }
  }

  registerBlockType('nab/registration-passes', {
    title: __('Registration Passes'),
    description: __('registration-passes'),
    icon: 'universal-access-alt',
    category: 'nabshow',
    keywords: [__('registration-passes'), __('gutenberg'), __('nab')],
    attributes: {
      dataArray: {
        type: 'array',
        default: [],
      },
      title: {
        type: 'string'
      },
      details: {
        type: 'string'
      }
    },
    edit: ItemComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { dataArray, title, details } = attributes;

      return (
        <div className="registration-passes">
          <div className="registration-head">
            <RichText.Content
              tagName="h2"
              value={title}
              className="title"
            />
            <RichText.Content
              tagName="p"
              value={details}
              className="description"
            />
          </div>
          {dataArray.map((product, index) => (
            <Fragment>{
              product.itemTitle && (
                <div className={`registration-item ${product.comming ? 'comming-soon' : ''}`}>
                  <div className="plus-sec">
                    {product.link && (
                      <a href={product.link} target="_blank" rel="noopener noreferrer">+</a>
                    )}
                  </div>
                  <div className="middle-sec">
                    <RichText.Content
                      tagName="h3"
                      value={product.itemTitle}
                      className="item-title"
                    />
                    <RichText.Content
                      tagName="p"
                      value={product.itemDetails}
                      className="item-description"
                    />
                  </div>
                  <div className="last-sec">
                    {product.price && (
                      <RichText.Content
                        tagName="p"
                        value={product.price}
                        className="price"
                      />
                    )}
                    {product.subPrice && (
                      <RichText.Content
                        tagName="span"
                        value={product.subPrice}
                        className="sub-price"
                      />
                    )}
                  </div>
                </div>
              )
            }
            </Fragment>
          ))}
        </div>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
