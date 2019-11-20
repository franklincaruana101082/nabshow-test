(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { InspectorControls, RichText } = wpEditor;
  const { PanelBody, PanelRow, TextControl, ToggleControl } = wpComponents;

  const newsConfBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <g>
          <path fill="#0F6CB6" d="M351.121,345.459l-5.65-2.26v-1.935c2.787-2.071,4.475-5.354,4.475-8.829v-5.69
            c0-2.357-0.92-4.572-2.59-6.236c-1.663-1.656-3.867-2.567-6.213-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017
            c-3.212,0.012-6.024,1.758-7.553,4.346l-3.744-1.497v-1.935c2.786-2.071,4.474-5.353,4.474-8.829v-5.69
            c0-2.357-0.919-4.572-2.589-6.236c-1.663-1.656-3.868-2.567-6.214-2.567c-0.011,0-0.021,0-0.032,0l-4.474,0.016
            c-4.837,0.018-8.771,3.967-8.771,8.804v5.674c0,3.477,1.687,6.758,4.474,8.829v1.935l-3.729,1.491
            c-0.379-0.645-0.842-1.246-1.387-1.788c-1.662-1.656-3.867-2.567-6.212-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017
            c-3.211,0.012-6.024,1.758-7.552,4.346l-3.744-1.497v-1.935c2.786-2.071,4.474-5.354,4.474-8.829v-5.69
            c0-2.357-0.919-4.572-2.589-6.236c-1.663-1.656-3.867-2.567-6.213-2.567c-0.011,0-0.021,0-0.033,0l-4.474,0.016
            c-4.836,0.017-8.771,3.967-8.771,8.803v5.675c0,3.477,1.687,6.758,4.473,8.829v1.935l-3.728,1.491
            c-0.379-0.646-0.842-1.246-1.386-1.789c-1.662-1.656-3.867-2.567-6.212-2.567c-0.011,0-0.022,0-0.033,0l-4.474,0.017
            c-4.837,0.018-8.772,3.967-8.772,8.804v5.674c0,3.477,1.688,6.758,4.474,8.829v1.935l-5.65,2.26
            c-3.361,1.345-5.534,4.553-5.534,8.174v13.351c0,1.156,0.937,2.094,2.093,2.094s2.093-0.938,2.093-2.094v-13.352
            c0-1.898,1.14-3.582,2.903-4.287l6.592-2.637h8.141l6.592,2.637c1.763,0.705,2.902,2.389,2.902,4.287v13.352
            c0,1.156,0.938,2.094,2.093,2.094s2.093-0.938,2.093-2.094v-13.351c0-3.621-2.172-6.83-5.534-8.174l-5.65-2.261v-1.935
            c2.786-2.071,4.474-5.353,4.474-8.829v-5.69c0-0.14-0.004-0.278-0.01-0.417l5.031-2.012h8.142l5.032,2.013
            c-0.007,0.144-0.011,0.287-0.011,0.433v5.675c0,3.476,1.687,6.757,4.474,8.829v1.934l-5.65,2.261
            c-3.361,1.344-5.534,4.553-5.534,8.174v13.351c0,1.156,0.937,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.352
            c0-1.899,1.139-3.582,2.903-4.287l6.591-2.637h8.142l6.592,2.637c1.764,0.705,2.902,2.388,2.902,4.287v13.352
            c0,1.156,0.938,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.352c0-3.621-2.172-6.829-5.533-8.174l-5.65-2.26v-1.935
            c2.786-2.071,4.474-5.353,4.474-8.829v-5.69c0-0.139-0.004-0.278-0.011-0.417l5.031-2.012h8.142l5.031,2.012
            c-0.007,0.144-0.011,0.288-0.011,0.434v5.674c0,3.477,1.688,6.758,4.474,8.829v1.935l-5.65,2.26
            c-3.361,1.345-5.533,4.553-5.533,8.174v13.352c0,1.156,0.937,2.094,2.093,2.094c1.155,0,2.093-0.938,2.093-2.094v-13.352
            c0-1.899,1.139-3.582,2.902-4.287l6.592-2.637h8.142l6.592,2.637c1.764,0.705,2.902,2.388,2.902,4.287v13.352
            c0,1.156,0.938,2.094,2.093,2.094c1.156,0,2.094-0.938,2.094-2.094v-13.351C356.655,350.012,354.483,346.804,351.121,345.459z
            M265.233,332.436c0,2.441-1.284,4.646-3.434,5.897c-0.644,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381
            c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.434-3.456-3.434-5.897v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017
            c1.237,0.006,2.4,0.475,3.276,1.347c0.875,0.873,1.358,2.034,1.358,3.271L265.233,332.436L265.233,332.436z M281.932,315.94
            c-0.645,0.375-1.041,1.063-1.041,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.252-3.434-3.456-3.434-5.897
            v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.011,0,0.017,0c1.23,0,2.387,0.479,3.259,1.347
            c0.876,0.873,1.358,2.035,1.358,3.271v5.69C285.365,312.484,284.082,314.689,281.932,315.94z M302.063,338.333
            c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.434-3.456-3.434-5.897
            v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.012,0,0.018,0c1.229,0,2.387,0.479,3.258,1.347
            c0.876,0.873,1.359,2.034,1.359,3.271v5.69l0,0C305.496,334.877,304.213,337.082,302.063,338.333z M322.194,315.94
            c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.041-1.809c-2.149-1.252-3.433-3.456-3.433-5.897
            v-5.675c0-2.537,2.064-4.608,4.601-4.617l4.474-0.017c0.006,0,0.012,0,0.018,0c1.229,0,2.387,0.479,3.259,1.347
            c0.876,0.873,1.358,2.035,1.358,3.271v5.69C325.628,312.484,324.345,314.689,322.194,315.94z M342.326,338.333
            c-0.645,0.375-1.04,1.063-1.04,1.809v2.381h-4.762v-2.381c0-0.745-0.396-1.435-1.04-1.809c-2.15-1.251-3.435-3.456-3.435-5.897
            v-5.675c0-2.537,2.064-4.608,4.602-4.617l4.474-0.017c1.244,0.006,2.4,0.475,3.276,1.347c0.876,0.873,1.358,2.034,1.358,3.271
            v5.69C345.76,334.877,344.477,337.082,342.326,338.333z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M322.79,265.226c-0.382-0.617-1.055-0.993-1.78-0.993h-6.854v-4.089c0-2.503-1.391-4.754-3.63-5.874
            l-5.238-2.619c-0.049-0.025-0.079-0.074-0.079-0.129v-3.092c0-0.025-0.003-0.05-0.004-0.076c2.714-2.013,4.478-5.24,4.478-8.872
            v-4.474c0-4.854-3.949-8.804-8.804-8.804h-4.474c-4.854,0-8.803,3.949-8.803,8.804v4.474c0,3.631,1.763,6.858,4.478,8.872
            c-0.001,0.025-0.004,0.05-0.004,0.076v3.091c0,0.055-0.031,0.104-0.08,0.129l-5.238,2.619c-2.239,1.119-3.63,3.37-3.63,5.873v4.09
            h-6.854c-0.725,0-1.399,0.375-1.781,0.993c-0.381,0.617-0.416,1.387-0.091,2.036l4.473,8.947c0.355,0.709,1.079,1.157,1.872,1.157
            h2.381v13.565c0,1.156,0.937,2.093,2.093,2.093c1.156,0,2.093-0.937,2.093-2.093v-13.565h22.656v13.565
            c0,1.156,0.938,2.093,2.094,2.093c1.155,0,2.093-0.937,2.093-2.093v-13.565h2.381c0.792,0,1.518-0.448,1.871-1.157l4.474-8.947
            C323.206,266.613,323.172,265.843,322.79,265.226z M291.787,239.483v-4.474c0-2.546,2.071-4.618,4.618-4.618h4.473
            c2.547,0,4.618,2.071,4.618,4.618v4.474c0,3.779-3.075,6.854-6.854,6.854C294.862,246.338,291.787,243.263,291.787,239.483z
            M301.604,253.693l-2.86,2.861c-0.057,0.056-0.147,0.056-0.203,0l-2.861-2.861c0.374-0.646,0.582-1.389,0.582-2.171v-1.26
            c0.768,0.17,1.564,0.262,2.381,0.262s1.613-0.092,2.381-0.261v1.26C301.022,252.304,301.23,253.047,301.604,253.693z
            M287.313,260.143L287.313,260.143c0-0.908,0.504-1.724,1.316-2.129l3.634-1.817l3.317,3.316c0.844,0.844,1.953,1.266,3.062,1.266
            c1.108,0,2.217-0.422,3.062-1.266l3.316-3.316l3.634,1.817c0.812,0.406,1.316,1.222,1.316,2.129v4.09h-22.657V260.143
            L287.313,260.143z M315.243,273.18H282.04l-2.381-4.761h37.965L315.243,273.18z"/>
        </g>
      </g>
      <g>
        <g>
          <path fill="#0F6CB6" d="M303.115,282.127h-8.947c-1.156,0-2.093,0.937-2.093,2.093c0,1.156,0.937,2.093,2.093,2.093h8.947
            c1.155,0,2.093-0.937,2.093-2.093C305.208,283.064,304.271,282.127,303.115,282.127z"/>
        </g>
      </g>
    </svg>
  );

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
      const { attributes, setAttributes } = this.props;
      const { dataArry, showFilter } = attributes;

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
        <Fragment>
          <InspectorControls>
            <PanelBody title="General Settings">
              <PanelRow>
                <ToggleControl
                  label={__('Show Filter')}
                  checked={showFilter}
                  onChange={() => setAttributes({ showFilter: ! showFilter })}
                />
              </PanelRow>
            </PanelBody>
            <PanelBody title={__('Help')} initialOpen={false}>
              <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/news-conference-schedule.mp4" target="_blank">How to use block?</a>
            </PanelBody>
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter news-conference">
              <div className="div-left">
                <div className="category"><label>Company Name</label>
                  <div className="box-main-select"><select id="company-name" className="select-opt">
                    <option>Select a Company</option>
                  </select></div>
                </div>
                <div className="category"><label>Date</label>
                  <div className="box-main-select"><select id="date-filter" className="select-opt">
                    <option>Select a Date</option>
                  </select></div>
                </div>
                <div className="category"><label>Location</label>
                  <div className="box-main-select"><select id="location-filter" className="select-opt">
                    <option>Select a Location</option>
                  </select></div>
                </div>
              </div>
              <div className="div-right">
                <div className="search-box"><label>Keyword</label>
                  <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
                </div>
              </div>
            </div>
          }
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
        </Fragment>
      );
    }
  }

  registerBlockType('nab/news-conference-schedule', {
    title: __('News Conference Schedule'),
    description: __('News Conference Schedule'),
    icon: { src: newsConfBlockIcon },
    category: 'nabshow',
    keywords: [__('News Conference Schedule'), __('gutenberg'), __('nab')],
    attributes: {
      dataArry: {
        type: 'array',
        default: [],
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: BlockComponent,

    save: props => {
      const { attributes } = props;
      const { dataArry, showFilter } = attributes;

      return (
        <Fragment>
        {showFilter &&
        <div className="box-main-filter main-filter news-conference">
          <div className="div-left">
            <div className="category"><label>Company Name</label>
              <div className="box-main-select"><select id="company-name" className="select-opt">
                <option>Select a Company</option>
              </select></div>
            </div>
            <div className="category"><label>Date</label>
              <div className="box-main-select"><select id="date-filter" className="select-opt">
                <option>Select a Date</option>
              </select></div>
            </div>
            <div className="category"><label>Location</label>
              <div className="box-main-select"><select id="location-filter" className="select-opt">
                <option>Select a Location</option>
              </select></div>
            </div>
          </div>
          <div className="div-right">
            <div className="search-box"><label>Keyword</label>
              <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
            </div>
          </div>
        </div>
        }
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
        </Fragment>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
