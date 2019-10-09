(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wp.i18n;
  const { registerBlockType } = wp.blocks;
  const { Fragment, Component } = wp.element;
  const { RichText, MediaUpload } = wp.editor;
  const { Button, CheckboxControl } = wp.components;

  class BlockComponent extends Component {

    componentDidMount() {
      const { DataArray } = this.props.attributes;
      if (0 === DataArray.length) {
        this.initList();
      }
    }

    initList() {
      const { DataArray } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
        DataArray: [
          ...DataArray,
          {
            index: DataArray.length,
            media: '',
            mediaAlt: '',
            title: '',
            cost: '',
            exclusivity: 'Exclusivity',
            description: '',
            sold: false
          }
        ]
      });
    }

    render() {
      const { attributes, setAttributes, clientId, className } = this.props;
      const { DataArray, title } = attributes;

      const getImageButton = (openEvent, index) => {
        if (DataArray[index].media) {
          return (
            <img src={DataArray[index].media} alt={DataArray[index].alt} className="img" />
          );
        } else {
          return (
            <Button onClick={openEvent} className="button button-large"><span className="dashicons dashicons-upload"></span> Upload Image</Button>
          );
        }
      };

      const DataArrayList = DataArray
        .sort((a, b) => a.index - b.index)
        .map((product, index) => {
          return (
            <div className="box-item">
              <span
                className="remove"
                onClick={() => {
                  const qewQusote = DataArray
                    .filter(item => item.index != product.index)
                    .map(t => {
                      if (t.index > product.index) {
                        t.index -= 1;
                      }

                      return t;
                    });

                  setAttributes({
                    DataArray: qewQusote
                  });
                }}
              >
                <span className="dashicons dashicons-no-alt"></span>
              </span>
              <div className="box-inner">
                {
                  product.sold && (
                    <span className="sold">Sold</span>
                  )
                }
                <div className="media-img">
                  <MediaUpload
                    onSelect={media => {
                      const newObject = Object.assign({}, product, {
                        media: media.url,
                        mediaAlt: media.alt
                      });
                      setAttributes({
                        DataArray: [
                          ...DataArray.filter(
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
                        DataArray: [
                          ...DataArray.filter(
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
                <div className="details-sec">
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
                        DataArray: [
                          ...DataArray.filter(
                            item => item.index != product.index
                          ),
                          newObject
                        ]
                      });
                    }}
                  />
                  <RichText
                    tagName="span"
                    className="cost"
                    placeholder={__('Cost')}
                    value={product.cost}
                    onChange={cost => {
                      const newObject = Object.assign({}, product, {
                        cost: cost
                      });
                      setAttributes({
                        DataArray: [
                          ...DataArray.filter(
                            item => item.index != product.index
                          ),
                          newObject
                        ]
                      });
                    }}
                  />
                  <RichText
                    tagName="span"
                    className="exclusivity"
                    placeholder={__('Exclusivity')}
                    value={product.exclusivity}
                    onChange={exclusivity => {
                      const newObject = Object.assign({}, product, {
                        exclusivity: exclusivity
                      });
                      setAttributes({
                        DataArray: [
                          ...DataArray.filter(
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
                        DataArray: [
                          ...DataArray.filter(
                            item => item.index != product.index
                          ),
                          newObject
                        ]
                      });
                    }}
                  />
                  <CheckboxControl
                      className="sold-checkbox"
                      label="Sold"
                      checked={product.sold}
                      onChange={() => {
                        let tempProdcut = [...DataArray];
                        tempProdcut[index].sold = product.sold ? false : true;
                        setAttributes({ DataArray: tempProdcut });
                      }}
                  />
                </div>
              </div>
            </div>
          );
        });

      return (
        <div className="opportunities">
          <RichText
            tagName="h2"
            placeholder={__('Title')}
            value={title}
            className="main-title"
            onChange={title => {
              setAttributes({
                title: title
              });
            }}
          />
          <div className="box-main two-item">
            {DataArrayList}
            <div className="box-item additem">
              <button
                className="components-button add"
                onClick={content => {
                  setAttributes({
                    DataArray: [
                      ...DataArray,
                      {
                        index: DataArray.length,
                        media: '',
                        mediaAlt: '',
                        title: '',
                        cost: '',
                        exclusivity: 'Exclusivity',
                        description: '',
                        sold: false
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

  registerBlockType('nab/opportunities', {
    title: __('Opportunities'),
    description: __('Opportunities'),
    icon: 'businessman',
    category: 'nabshow',
    keywords: [__('Opportunities'), __('gutenberg'), __('nab')],
    attributes: {
      DataArray: {
        type: 'array',
        default: [],
      },
      title: {
        type: 'string',
      }
    },
    edit: BlockComponent,

    save: props => {
      const {
        attributes,
        className
      } = props;
      const { DataArray, title } = attributes;

      return (
        <div className="opportunities">
          <RichText.Content
            tagName="h2"
            value={title}
            className="main-title"
          />
          <div className="box-main two-item">
            {DataArray.map((product, index) => (
              <Fragment>
                {
                  product.title && (
                    <div className="box-item">
                      <div className="box-inner">
                        {
                          product.sold && (
                            <span className="sold">Sold</span>
                          )
                        }
                        <div className="media-img">
                          {product.media ? (
                            <img src={product.media} alt={product.alt} className="img" />
                          ) : (
                              <div className="no-image">No Featured Image</div>
                            )}
                        </div>
                        <div className="details-sec">
                          {product.title && (
                            <RichText.Content
                              tagName="h3"
                              value={product.title}
                              className="title"
                            />
                          )}
                          {product.cost && (
                            <RichText.Content
                              tagName="span"
                              className="cost"
                              value={product.cost}
                            />
                          )}
                          {product.exclusivity && (
                            <RichText.Content
                              tagName="span"
                              className="exclusivity"
                              value={product.exclusivity}
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
