(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { InspectorControls, RichText, MediaUpload } = wpEditor;
  const { PanelBody, PanelRow, Button, TextControl, ToggleControl } = wpComponents;

  const officialVendorBlockIcon = (
    <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
      <path fill="#0F6CB6" d="M249.032,288.517c0-14.086-11.461-25.548-25.548-25.548c-14.087,0-25.548,11.462-25.548,25.548
        c0,14.087,11.461,25.548,25.548,25.548C237.57,314.064,249.032,302.603,249.032,288.517z M223.484,309.42
        c-11.525,0-20.903-9.376-20.903-20.903s9.378-20.903,20.903-20.903c11.524,0,20.903,9.376,20.903,20.903
        S235.008,309.42,223.484,309.42z"/>
      <path fill="#0F6CB6" d="M223.484,281.549c1.28,0,2.322,1.041,2.322,2.322h4.645c0-3.023-1.948-5.578-4.645-6.54v-5.072h-4.645v4.646
        h-4.645v6.967c0,3.842,3.126,6.968,6.968,6.968c1.28,0,2.322,1.041,2.322,2.323v2.322h-2.322c-1.28,0-2.323-1.04-2.323-2.322h-4.645
        c0,3.023,1.948,5.579,4.645,6.54v5.072h4.645v-4.645h4.645v-6.968c0-3.842-3.126-6.968-6.967-6.968c-1.28,0-2.323-1.041-2.323-2.323
        v-2.322H223.484z"/>
      <path fill="#0F6CB6" d="M207.226,286.194h4.645v4.645h-4.645V286.194z"/>
      <path fill="#0F6CB6" d="M235.097,286.194h4.645v4.645h-4.645V286.194z"/>
      <path fill="#0F6CB6" d="M323.354,281.549c0-14.397-9.414-26.621-22.404-30.885c5.089-3.317,8.469-9.051,8.469-15.566
        c0-10.245-8.336-18.581-18.581-18.581c-10.244,0-18.58,8.335-18.58,18.581c0,6.513,3.374,12.242,8.459,15.562
        c-4.797,1.565-9.2,4.227-12.872,7.898c-5.389,5.389-8.649,12.335-9.369,19.821l-1.879-0.627c-0.567-1.754-1.264-3.442-2.081-5.05
        l2.998-5.994L256,265.193v-16.16c0-14.398-9.413-26.621-22.403-30.886c5.089-3.317,8.468-9.051,8.468-15.566
        c0-10.245-8.336-18.581-18.581-18.581c-10.245,0-18.581,8.336-18.581,18.581c0,6.515,3.379,12.249,8.468,15.566
        c-12.99,4.264-22.403,16.488-22.403,30.886v16.16l-1.514,1.515l2.998,5.994c-0.817,1.605-1.515,3.296-2.081,5.05L184,279.874v17.282
        l6.371,2.123c0.566,1.754,1.264,3.442,2.081,5.05l-2.998,5.996l12.221,12.222l5.994-2.996c1.605,0.817,3.296,1.513,5.05,2.081
        l2.123,6.369h8.643h8.642h91.228v-32.517c2.563,0,4.646-2.083,4.646-4.646v-4.645C327.999,283.633,325.916,281.549,323.354,281.549
        L323.354,281.549z M318.709,281.549h-6.968v-9.29h-4.646v9.29H294.84l12.714-22.25C314.313,264.39,318.709,272.456,318.709,281.549z
        M290.838,253.678c1.87,0,3.695,0.193,5.463,0.543l-5.463,5.463l-5.472-5.473C287.15,253.859,288.98,253.678,290.838,253.678z
        M297.485,267.558l-3.535-4.418l7.393-7.393c0.781,0.319,1.54,0.676,2.283,1.063L297.485,267.558z M287.726,263.141l-3.535,4.417
        l-6.152-10.767c0.746-0.386,1.503-0.746,2.279-1.062L287.726,263.141z M290.838,266.687l4.167,5.21l-4.167,7.295l-4.167-7.295
        L290.838,266.687z M276.902,235.098c0-7.686,6.25-13.936,13.936-13.936s13.936,6.25,13.936,13.936s-6.25,13.936-13.936,13.936
        C283.153,249.033,276.902,242.783,276.902,235.098z M271.129,261.842c0.937-0.936,1.946-1.77,2.987-2.555l12.72,22.262H274.58v-9.29
        h-4.645v9.29h-6.968C262.968,274.104,265.866,267.104,271.129,261.842z M251.354,249.033v11.515l-6.062-6.064l-0.906,0.456v-15.197
        h-4.645v17.52l-0.443,0.223c-1.605-0.817-3.296-1.512-5.049-2.082l-2.123-6.371h-4.64l12.714-22.25
        C246.958,231.874,251.354,239.94,251.354,249.033L251.354,249.033z M210.696,224.295c2.222-1.154,4.608-2.032,7.128-2.555
        l-2.03,11.478L210.696,224.295z M222.638,221.204c0.283-0.007,0.56-0.042,0.846-0.042c0.285,0,0.562,0.035,0.845,0.042l3.24,18.318
        l-4.085,7.153l-4.085-7.151L222.638,221.204z M231.171,233.219l-2.03-11.478c2.52,0.522,4.905,1.4,7.128,2.555L231.171,233.219z
        M209.548,202.582c0-7.686,6.25-13.936,13.936-13.936c7.685,0,13.935,6.25,13.935,13.936s-6.25,13.936-13.935,13.936
        C215.798,216.517,209.548,210.267,209.548,202.582z M195.613,249.033c0-9.093,4.396-17.159,11.155-22.25l12.714,22.25h-4.641
        l-2.125,6.371c-1.754,0.567-3.442,1.263-5.05,2.081l-0.441-0.223v-17.519h-4.645v15.197l-0.906-0.453l-6.062,6.062V249.033z
        M223.484,323.355h-5.293l-1.833-5.493l-1.178-0.339c-2.248-0.642-4.385-1.521-6.35-2.617l-1.07-0.598l-5.17,2.583l-7.486-7.485
        l2.583-5.171l-0.597-1.07c-1.094-1.967-1.977-4.104-2.618-6.348l-0.336-1.18l-5.49-1.828v-10.589l5.493-1.83l0.336-1.18
        c0.641-2.246,1.524-4.383,2.618-6.348l0.597-1.07l-2.583-5.17l7.486-7.488l5.167,2.585l1.071-0.597
        c1.965-1.096,4.102-1.977,6.35-2.618l1.178-0.339l1.832-5.488h10.589l1.833,5.493l1.178,0.339c2.248,0.642,4.385,1.521,6.35,2.618
        l1.071,0.597l5.168-2.585l7.485,7.488l-2.583,5.17l0.597,1.071c1.094,1.967,1.977,4.104,2.618,6.348l0.336,1.18l5.49,1.827v0.647
        v9.938l-5.493,1.83l-0.337,1.18c-0.641,2.246-1.524,4.383-2.618,6.348l-0.597,1.071l2.583,5.17l-7.485,7.485l-5.17-2.583
        l-1.071,0.598c-1.965,1.096-4.102,1.977-6.35,2.617l-1.177,0.34l-1.83,5.49H223.484z M318.709,323.355h-85.034l0.576-1.726
        c1.753-0.566,3.444-1.264,5.049-2.081l5.995,2.996l12.222-12.222l-2.999-5.994c0.817-1.604,1.514-3.296,2.081-5.05l6.369-2.12
        v-1.675h55.741V323.355z M323.354,290.839h-60.387v-4.645h60.387V290.839z"/>
      <path fill="#0F6CB6" d="M309.419,314.064h4.645v4.646h-4.645V314.064z"/>
      <path fill="#0F6CB6" d="M300.129,314.064h4.645v4.646h-4.645V314.064z"/>
      <path fill="#0F6CB6" d="M290.838,314.064h4.646v4.646h-4.646V314.064z"/>
    </svg>
  );

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
      const { attributes, setAttributes } = this.props;
      const { products, showFilter } = attributes;

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
                  keepPlaceholderOnFocus="true"
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
                  keepPlaceholderOnFocus="true"
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
                  keepPlaceholderOnFocus="true"
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
                  keepPlaceholderOnFocus="true"
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
                  placeholder="Email"
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
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter new-this-year-filter official-vendors-filter">
              <div className="ov-filter">
                <div className="category"><label>Service</label>
                  <div className="box-main-select"><select id="box-main-category-offven" className="select-opt"><option>Select a Service</option></select></div>
                </div>
                <div className="category">
                  <label>Vendor Name</label>
                  <div className="box-main-select"><select id="box-main-category-vendor" className="select-opt"><option>Select a Vendor</option></select></div>
                </div>
                <div className="badgeslist"><a>Exclusive</a><a>Preferred</a></div>
              </div>
              <div className="search-box">
                <label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
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
        </Fragment>
      );
    }
  }

  registerBlockType('nab/nab-official-vendors', {
    title: __('Official Vendors'),
    description: __('Official Vendors'),
    icon: { src: officialVendorBlockIcon },
    category: 'nabshow',
    keywords: [__('Official Vendors'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: EditOfficialVendor,

    save: props => {
      const { attributes } = props;
      const { products, showFilter } = attributes;

      return (
        <Fragment>
          {showFilter &&
            <div className="box-main-filter main-filter new-this-year-filter official-vendors-filter">
              <div className="ov-filter">
                <div className="category"><label>Service</label>
                  <div className="box-main-select"><select id="box-main-category-offven" className="select-opt"><option>Select a Service</option></select></div>
                </div>
                <div className="category">
                  <label>Vendor Name</label>
                  <div className="box-main-select"><select id="box-main-category-vendor" className="select-opt"><option>Select a Vendor</option></select></div>
                </div>
                <div className="badgeslist"><a>Exclusive</a><a>Preferred</a></div>
              </div>
              <div className="search-box">
                <label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
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
                              <img src={product.media} alt={product.mediaAlt} className="img" />
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
                            <a className="email" href={`mailto:${product.email}`}>Email us</a>
                          )}
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
