(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, InspectorControls } = wpEditor;
  const { PanelBody, PanelRow, ToggleControl } = wpComponents;

  const badgeDiscountBlockIcon = (
    <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
      <g>
          <path fill="#146DB6" d="M123.53,4.704h-97.06c-12.002,0-21.767,9.764-21.767,21.767v114.707c0,2.274,1.844,4.117,4.119,4.117
              h132.354c2.274,0,4.119-1.843,4.119-4.117V26.471C145.296,14.468,135.531,4.704,123.53,4.704z M137.059,137.059H83.53v-13.973
              c0-1.092-0.434-2.14-1.206-2.912l-9.88-9.879l9.88-9.879c0.772-0.773,1.206-1.821,1.206-2.913V83.531h13.973
              c1.092,0,2.14-0.434,2.912-1.207l9.879-9.879l9.88,9.879c0.772,0.772,1.82,1.207,2.912,1.207h13.973V137.059z M137.059,75.292
              h-12.266l-11.586-11.584c-0.772-0.773-1.82-1.207-2.912-1.207c-1.093,0-2.14,0.434-2.912,1.207L95.798,75.292H79.412
              c-2.274,0-4.118,1.846-4.118,4.119v16.386l-11.586,11.585c-1.608,1.608-1.608,4.216,0,5.825l11.586,11.586v12.266H12.942V48.236
              h124.117V75.292z M137.059,39.999H12.942V26.471c0-7.46,6.069-13.529,13.529-13.529h97.06c7.459,0,13.528,6.069,13.528,13.529
              V39.999z"/>
          <path fill="#146DB6" d="M94.146,120.618c-1.608,1.608-1.608,4.216,0,5.824s4.216,1.608,5.825,0l26.471-26.471
              c1.608-1.608,1.608-4.217,0-5.825s-4.216-1.608-5.825,0L94.146,120.618z"/>
          <circle fill="#146DB6" cx="26.471" cy="26.47" r="4.119"/>
          <circle fill="#146DB6" cx="44.118" cy="26.47" r="4.119"/>
          <circle fill="#146DB6" cx="61.765" cy="26.47" r="4.119"/>
          <path fill="#146DB6" d="M97.059,105.59c2.275,0,4.119-1.844,4.119-4.118v-4.413c0-2.274-1.844-4.119-4.119-4.119
              c-2.274,0-4.119,1.845-4.119,4.119v4.413C92.939,103.746,94.784,105.59,97.059,105.59z"/>
          <path fill="#146DB6" d="M123.53,115c-2.274,0-4.119,1.844-4.119,4.119v4.411c0,2.274,1.845,4.119,4.119,4.119
              s4.119-1.845,4.119-4.119v-4.411C127.649,116.843,125.805,115,123.53,115z"/>
          <path fill="#146DB6" d="M26.471,65.883h26.471c2.274,0,4.119-1.844,4.119-4.119c0-2.274-1.844-4.119-4.119-4.119H26.471
              c-2.275,0-4.119,1.845-4.119,4.119C22.352,64.04,24.195,65.883,26.471,65.883z"/>
          <path fill="#146DB6" d="M26.471,83.53h35.294c2.275,0,4.119-1.843,4.119-4.119c0-2.273-1.844-4.119-4.119-4.119H26.471
              c-2.275,0-4.119,1.846-4.119,4.119C22.352,81.688,24.195,83.53,26.471,83.53z"/>
          <path fill="#146DB6" d="M26.471,101.178h17.647c2.274,0,4.119-1.844,4.119-4.119c0-2.274-1.845-4.119-4.119-4.119H26.471
              c-2.275,0-4.119,1.845-4.119,4.119C22.352,99.334,24.195,101.178,26.471,101.178z"/>
       </g>
    </svg>
  );

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
      const { attributes, setAttributes } = this.props;
      const { products, mainTitle, showFilter } = attributes;

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
                <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/badge-discounts.mp4" target="_blank">How to use block?</a>
              </PanelBody>
          </InspectorControls>
          {showFilter &&
            <div className="box-main-filter main-filter badge-discount-filter">
              <div id="box-main-listing" className="badgeslist"></div>
              <div className="search-box">
                <label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
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
        </Fragment>
      );
    }
  }

  registerBlockType('nab/nab-badge-discounts', {
    title: __('Badge Discounts'),
    description: __('Badge Discounts'),
    icon: { src: badgeDiscountBlockIcon},
    category: 'nabshow',
    keywords: [__('Badge'), __('Discounts'), __('gutenberg'), __('nab')],
    attributes: {
      products: {
        type: 'array',
        default: [],
      },
      mainTitle: {
        type: 'string'
      },
      showFilter: {
        type: 'boolean',
        default: false
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props;
      const { products, mainTitle, showFilter } = attributes;

      return (
        <Fragment>
          {showFilter &&
            <div className="box-main-filter main-filter badge-discount-filter">
              <div id="box-main-listing" className="badgeslist"></div>
              <div className="search-box">
                <label>Keyword</label>
                <div className="search-item icon-right"><input id="box-main-search" className="search" name="box-main-search" type="text" placeholder="Filter by keyword..." /></div>
              </div>
            </div>
          }
          <div className="badge-discounts">
           <RichText.Content
            tagName="h2"
            value={mainTitle}
            className="badge-title"
          />
          <div className="box-main four-grid">
            {products.map((product) => (
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
      </Fragment>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
