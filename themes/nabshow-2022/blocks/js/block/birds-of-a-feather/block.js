(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { InspectorControls, RichText } = wpEditor;
  const { PanelBody, PanelRow, TextControl, ToggleControl } = wpComponents;

  const featherBlockIcon = (
    <svg  width="150px" height="150px" viewBox="181 181 150 150" enableBackground="new 181 181 150 150">
    <g>
      <g>
        <g>
          <g>
            <path fill="#0F6CB6" d="M289.34,232.903c-1.488,0-2.696-1.207-2.696-2.696v-18.436c0-1.489,1.208-2.696,2.696-2.696
              c1.489,0,2.696,1.208,2.696,2.696v18.436C292.036,231.696,290.829,232.903,289.34,232.903z"/>
          </g>
        </g>
        <g>
          <g>
            <circle fill="#0F6CB6" cx="289.328" cy="203.094" r="2.696"/>
          </g>
        </g>
        <g>
          <path fill="#0F6CB6" d="M317.648,215.303c0-15.619-12.704-28.326-28.32-28.326c-6.464,0-12.428,2.177-17.199,5.836h-67.964
            c-5.411,0-9.813,4.401-9.813,9.813v98.08c0,5.411,4.402,9.813,9.813,9.813h8.555v4.691c0,5.411,4.402,9.813,9.813,9.813h70.495
            c5.41,0,9.813-4.401,9.813-9.813v-37.396c0-1.489-1.208-2.696-2.696-2.696c-1.489,0-2.696,1.207-2.696,2.696v37.396
            c0,2.438-1.983,4.421-4.42,4.421h-70.495c-2.438,0-4.42-1.983-4.42-4.421v-4.691h56.548c5.41,0,9.813-4.401,9.813-9.813v-57.495
            c1.578,0.274,3.2,0.417,4.855,0.417c2.821,0,5.546-0.415,8.119-1.186v10.995c0,1.489,1.207,2.696,2.696,2.696
            s2.696-1.207,2.696-2.696v-13.245C311.654,235.385,317.648,226.031,317.648,215.303L317.648,215.303z M279.08,300.707
            c0,2.437-1.982,4.42-4.42,4.42h-70.496c-2.438,0-4.42-1.982-4.42-4.42v-98.081c0-2.438,1.982-4.42,4.42-4.42h62.598
            c-3.385,4.458-5.48,9.944-5.729,15.9H215.12c-1.489,0-2.696,1.208-2.696,2.696v11.387c0,1.489,1.208,2.696,2.696,2.696h48.585
            c0.612,0,1.178-0.205,1.631-0.549c3.221,5.124,8.036,9.148,13.744,11.372V300.707z M261.009,219.499v5.995h-43.193v-5.995
            H261.009z M289.328,238.235c-12.643,0-22.928-10.288-22.928-22.933c0-12.646,10.285-22.934,22.928-22.934
            s22.928,10.288,22.928,22.934C312.256,227.948,301.971,238.235,289.328,238.235z"/>
          <g>
            <g>
              <path fill="#0F6CB6" d="M300.143,268.273c-1.111,0-2.129-0.711-2.521-1.748c-0.402-1.063-0.073-2.314,0.811-3.034
                c0.886-0.722,2.161-0.808,3.133-0.205c0.97,0.603,1.466,1.789,1.203,2.902C302.485,267.393,301.382,268.273,300.143,268.273z"
                />
            </g>
          </g>
        </g>
        <g>
          <g>
            <g>
              <g>
                <path fill="#0F6CB6" d="M263.705,245.655H215.12c-1.489,0-2.696-1.207-2.696-2.696c0-1.489,1.208-2.696,2.696-2.696h48.585
                  c1.488,0,2.695,1.207,2.695,2.696C266.4,244.448,265.193,245.655,263.705,245.655z"/>
              </g>
            </g>
            <g>
              <g>
                <path fill="#0F6CB6" d="M263.705,258.443H215.12c-1.489,0-2.696-1.207-2.696-2.696c0-1.489,1.208-2.696,2.696-2.696h48.585
                  c1.488,0,2.695,1.207,2.695,2.696C266.4,257.236,265.193,258.443,263.705,258.443z"/>
              </g>
            </g>
            <g>
              <g>
                <path fill="#0F6CB6" d="M263.705,271.231H215.12c-1.489,0-2.696-1.207-2.696-2.696c0-1.488,1.208-2.696,2.696-2.696h48.585
                  c1.488,0,2.695,1.208,2.695,2.696C266.4,270.024,265.193,271.231,263.705,271.231z"/>
              </g>
            </g>
            <g>
              <g>
                <path fill="#0F6CB6" d="M263.705,284.02H215.12c-1.489,0-2.696-1.207-2.696-2.696c0-1.488,1.208-2.696,2.696-2.696h48.585
                  c1.488,0,2.695,1.208,2.695,2.696C266.4,282.813,265.193,284.02,263.705,284.02z"/>
              </g>
            </g>
          </g>
        </g>
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
            attend: '',
            hosting: '',
            organizer: ''
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
                  placeholder={__('Session Name')}
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
                  tagName="p"
                  className="description"
                  placeholder={__('Description')}
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
                <RichText
                  tagName="span"
                  placeholder={__('Who Should Attend')}
                  value={product.attend}
                  className="attend"
                  onChange={attend => {
                    const newObject = Object.assign({}, product, {
                      attend: attend
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
                  tagName="span"
                  placeholder={__('Hosting Organization(s)')}
                  value={product.hosting}
                  className="hosting"
                  onChange={hosting => {
                    const newObject = Object.assign({}, product, {
                      hosting: hosting
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
                  tagName="span"
                  placeholder={__('Organizer(s)')}
                  value={product.organizer}
                  className="organizer"
                  onChange={organizer => {
                    const newObject = Object.assign({}, product, {
                      organizer: organizer
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
              <a href="#" target="_blank">How to use block?</a>
            </PanelBody>
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter news-conference birds-of-feather-filter">
            <div className="div-left">
                <div className="category"><label>Date</label>
                  <div className="box-main-select"><select id="birdDate-filter" className="select-opt">
                    <option>Select a Date</option>
                  </select></div>
                </div>
                <div className="category"><label>Who Should Attend</label>
                  <div className="box-main-select"><select id="attend-filter" className="select-opt">
                    <option>Select a Attendee</option>
                  </select></div>
                </div>
                <div className="category"><label>Hosting Organization(s)</label>
                  <div className="box-main-select"><select id="hosting-filter" className="select-opt">
                    <option>Select a Hosting Organization</option>
                  </select></div>
                </div>
                <div className="category"><label>Organizer(s)</label>
                  <div className="box-main-select"><select id="organizer-filter" className="select-opt">
                    <option>Select an Organizer</option>
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
          <div className="birds-of-a-feather">
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
                          attend: '',
                          hosting: '',
                          organizer: ''
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

  registerBlockType('nab/birds-of-a-feather', {
    title: __('Birds of a Feather'),
    description: __('Birds of a Feather'),
    icon: { src: featherBlockIcon },
    category: 'nabshow',
    keywords: [__('Birds of a Feather'), __('gutenberg'), __('nab')],
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
            <div className="box-main-filter main-filter news-conference birds-of-feather-filter">
              <div className="div-left">
                <div className="category"><label>Date</label>
                  <div className="box-main-select"><select id="birdDate-filter" className="select-opt">
                    <option>Select a Date</option>
                  </select></div>
                </div>
                <div className="category"><label>Who Should Attend</label>
                  <div className="box-main-select"><select id="attend-filter" className="select-opt">
                    <option>Select a Attendee</option>
                  </select></div>
                </div>
                <div className="category"><label>Hosting Organization(s)</label>
                  <div className="box-main-select"><select id="hosting-filter" className="select-opt">
                    <option>Select a Hosting Organization</option>
                  </select></div>
                </div>
                <div className="category"><label>Organizer(s)</label>
                  <div className="box-main-select"><select id="organizer-filter" className="select-opt">
                    <option>Select an Organizer</option>
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
        <div className="birds-of-a-feather">
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
                        {product.description && (
                          <RichText.Content
                            tagName="p"
                            className="description"
                            value={product.description}
                          />
                        )}
                        <div className="bottom-info">
                          {product.attend && (
                            <p><b>Who Should Attend: </b>
                              <RichText.Content
                                tagName="span"
                                value={product.attend}
                                className="attend"
                              />
                            </p>
                          )}
                          {product.hosting && (
                            <p><b>Hosting Organization(s): </b>
                            <RichText.Content
                              tagName="span"
                              value={product.hosting}
                              className="hosting"
                            />
                            </p>
                          )}
                          {product.organizer && (
                            <p><b>Organizer(s): </b>
                            <RichText.Content
                              tagName="span"
                              value={product.organizer}
                              className="organizer"
                            />
                            </p>
                          )}
                        </div>
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
