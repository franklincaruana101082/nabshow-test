(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const { RichText, MediaUpload } = wp.editor;
  const { TextControl, Button } = wp.components;

  class BlockComponent extends Component {

    componentDidMount() {
      const { dataArry } = this.props.attributes;
      if (0 === dataArry.length) {
        this.initList();
      }
    }

    initList() {
      const { dataArry } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
        dataArry: [
          ...dataArry,
          {
            index: dataArry.length,
            title: '',
            date: '',
            location: '',
            description: '',
            arrayContact: [
              {
                contact: '',
                phone: '',
                email: ''
              }
            ]
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { dataArry } = attributes;

      const dataArryList = dataArry
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
          return (
            <div className="box-item">
              <div className="box-inner">
                <span
                  className="remove"
                  onClick={() => {
                    const qewQusote = dataArry
                      .filter(item => item.index != product.index)
                      .map(t => {
                        if (t.index > product.index) {
                          t.index -= 1;
                        }
                        return t;
                      });

                    setAttributes({
                      dataArry: qewQusote
                    });
                  }}
                >
                  <span className="dashicons dashicons-no-alt"></span>
                </span>
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
                      dataArry: [
                        ...dataArry.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="strong"
                  placeholder={__('Date | Time')}
                  value={product.date}
                  className="date-time"
                  onChange={date => {
                    const newObject = Object.assign({}, product, {
                      date: date
                    });
                    setAttributes({
                      dataArry: [
                        ...dataArry.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                <RichText
                  tagName="strong"
                  placeholder={__('Location')}
                  value={product.location}
                  className="location"
                  onChange={location => {
                    const newObject = Object.assign({}, product, {
                      location: location
                    });
                    setAttributes({
                      dataArry: [
                        ...dataArry.filter(
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
                  placeholder={__('Details')}
                  value={product.description}
                  onChange={description => {
                    const newObject = Object.assign({}, product, {
                      description: description
                    });
                    setAttributes({
                      dataArry: [
                        ...dataArry.filter(
                          item => item.index != product.index
                        ),
                        newObject
                      ]
                    });
                  }}
                />
                {
                  product.arrayContact.map((data, i) => {
                    return (
                      <div className="contact-item">
                        <span
                          onClick={() => {
                            let tempProdcut = [...dataArry];
                            const newObject = tempProdcut[index].arrayContact.splice(i, 1);
                            setAttributes({ dataArry: tempProdcut });
                          }}
                          >
                          <span className="dashicons dashicons-no-alt"></span>
                        </span>
                        <RichText
                          tagName="p"
                          className="contact-name"
                          placeholder={__('Contact: Name')}
                          value={data.contact}
                          onChange={value => {
                            let tempProdcut = [...dataArry];
                            tempProdcut[index].arrayContact[i].contact = value;
                            setAttributes({ dataArry: tempProdcut });
                          }}
                        />
                        <RichText
                          tagName="p"
                          className="phone"
                          placeholder={__('Phone')}
                          value={data.phone}
                          onChange={value => {
                            let tempProdcut = [...dataArry];
                            tempProdcut[index].arrayContact[i].phone = value;
                            setAttributes({ dataArry: tempProdcut });
                          }}
                        />
                        <TextControl
                          type="text"
                          className="email"
                          placeholder={__('Email')}
                          value={data.email}
                          onChange={value => {
                            let tempProdcut = [...dataArry];
                            tempProdcut[index].arrayContact[i].email = value;
                            setAttributes({ dataArry: tempProdcut });
                          }}
                        />
                      </div>
                    );
                  })
                }
                <div className="new-contact">
                  <button
                    className="components-button add"
                    onClick={() => {
                      let tempProdcut = [...dataArry];
                      const newObject = tempProdcut[index].arrayContact.push(
                        {
                          contact: '',
                          phone: '',
                          email: ''
                        }
                      );
                      setAttributes({ dataArry: tempProdcut });
                      }
                    }
                  >
                    <span className="dashicons dashicons-plus"></span> Add New Contact
                  </button>
                </div>
              </div>
            </div>
          );
        });

      return (
        <div className="news-conference-schedule">
          <div className="box-main four-grid">
            {dataArryList}
            <div className="box-item additem">
              <button
                className="components-button add"
                onClick={content => {
                  setAttributes({
                    dataArry: [
                      ...dataArry,
                      {
                        index: dataArry.length,
                        title: '',
                        date: '',
                        location: '',
                        description: '',
                        arrayContact: [
                          {
                            contact: '',
                            phone: '',
                            email: ''
                          }
                        ]
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

  registerBlockType('nab/news-conference-schedule', {
    title: __('News Conference Schedule'),
    description: __('News Conference Schedule'),
    icon: 'buddicons-buddypress-logo',
    category: 'nabshow',
    keywords: [__('News Conference Schedule'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: [],
      }
    },
    edit: BlockComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { dataArry } = attributes;

      return (
        <div className="news-conference-schedule">
          <div className="box-main four-grid">
            {dataArry.map((product, index) => (
              <Fragment>
                {
                  product.title && (
                    <div className="box-item">
                      <div className="box-inner">
                        <RichText.Content
                          tagName="h3"
                          value={product.title}
                          className="title"
                        />
                        {product.date && (
                          <RichText.Content
                            tagName="strong"
                            value={product.date}
                            className="date-time"
                          />
                        )}
                        {product.location && (
                          <RichText.Content
                            tagName="strong"
                            value={product.location}
                            className="location"
                          />
                        )}
                        {product.description && (
                          <RichText.Content
                            tagName="p"
                            className="description"
                            value={product.description}
                          />
                        )}
                        {
                          product.arrayContact.map((data, i) => {
                            return (
                              <div className="contact-item">
                                {data.contact && (
                                  <RichText.Content
                                    tagName="p"
                                    className="contact-name"
                                    value={data.contact}
                                  />
                                )}
                                {data.phone && (
                                  <RichText.Content
                                    tagName="p"
                                    className="phone"
                                    value={data.phone}
                                  />
                                )}
                                {data.email && (
                                  <a className="email" href={`mailto:${data.email}`}>
                                    Email
                                  </a>
                                )}
                              </div>
                            );
                          })
                        }
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
