(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, MediaUpload } = wpEditor;
  const { Button, CheckboxControl } = wpComponents;

  const opportunityBlockIcon = (
    <svg width="150px" height="150px" viewBox="181 181 150 150" enable-background="new 181 181 150 150">
      <path fill="#0F6CB6" d="M266.264,288.3c5.165-3.367,8.594-9.188,8.594-15.799c0-10.398-8.459-18.858-18.857-18.858
        c-10.398,0-18.858,8.459-18.858,18.858c0,6.611,3.43,12.432,8.595,15.799c-13.185,4.327-22.739,16.733-22.739,31.346v9.43h66.003
        v-9.43C289.001,305.033,279.447,292.627,266.264,288.3z M269.168,314.932l-9.43,9.43h-0.476l9.831-29.766
        c1.688,0.886,3.279,1.928,4.746,3.124l-1.127,6.383l-8.625,5.749L269.168,314.932z M239.29,304.101l-1.127-6.384
        c1.466-1.196,3.057-2.237,4.745-3.123l9.833,29.768h-0.476l-9.429-9.43l5.082-5.08L239.29,304.101z M241.856,272.501
        c0-7.801,6.343-14.144,14.144-14.144c7.8,0,14.144,6.343,14.144,14.144c0,7.8-6.344,14.144-14.144,14.144
        C248.2,286.645,241.856,280.301,241.856,272.501z M264.736,292.755L256,319.2l-8.734-26.445c2.753-0.896,5.686-1.396,8.734-1.396
        C259.051,291.358,261.98,291.858,264.736,292.755L264.736,292.755z M227.713,319.646c0-6.77,2.397-12.988,6.378-17.862l0.903,5.122
        l5.519,3.68l-4.347,4.347l9.429,9.43h-17.882V319.646z M284.287,324.361h-17.882l9.43-9.43l-4.349-4.35l5.519-3.68l0.903-5.122
        c3.982,4.877,6.379,11.096,6.379,17.865V324.361z"/>
      <path fill="#0F6CB6" d="M244.213,248.928h23.573v-28.287h11.478L256,185.747l-23.264,34.895h11.478V248.928z M241.547,215.927
        L256,194.247l14.452,21.68h-7.381v28.287h-14.143v-28.287H241.547z"/>
      <path fill="#0F6CB6" d="M186.991,215.278l8.13,40.656l7.989-7.988l20.051,20.849l17.345-17.344l-20.85-20.051l7.988-7.989
        L186.991,215.278z M233.776,251.517l-10.546,10.546l-20.051-20.85l-5.16,5.158l-5.016-25.082l25.084,5.016l-5.158,5.16
        L233.776,251.517z"/>
      <path fill="#0F6CB6" d="M271.492,251.45l17.345,17.345l20.05-20.85l7.989,7.989l8.131-40.656l-40.656,8.131l7.989,7.988
        L271.492,251.45z M318.997,221.289l-5.016,25.084l-5.16-5.158l-20.05,20.851l-10.547-10.546l20.849-20.051l-5.156-5.16
        L318.997,221.289z"/>
      <path fill="#0F6CB6" d="M189.997,197.068c3.899,0,7.072-3.173,7.072-7.072s-3.173-7.072-7.072-7.072
        c-3.898,0-7.072,3.173-7.072,7.072S186.098,197.068,189.997,197.068z M189.997,187.64c1.299,0,2.357,1.058,2.357,2.357
        s-1.058,2.357-2.357,2.357s-2.357-1.058-2.357-2.357S188.697,187.64,189.997,187.64z"/>
      <path fill="#0F6CB6" d="M208.729,212.071l3.333-3.333l3.167,3.166l-3.333,3.333L208.729,212.071z"/>
      <path fill="#0F6CB6" d="M195.398,198.735l3.333-3.333l3.333,3.333l-3.333,3.333L195.398,198.735z"/>
      <path fill="#0F6CB6" d="M202.065,205.404l3.333-3.333l3.333,3.333l-3.333,3.333L202.065,205.404z"/>
      <path fill="#0F6CB6" d="M189.997,314.932c-3.898,0-7.072,3.172-7.072,7.072c0,3.898,3.173,7.071,7.072,7.071
        c3.899,0,7.072-3.173,7.072-7.071C197.068,318.104,193.896,314.932,189.997,314.932z M189.997,324.361
        c-1.299,0-2.357-1.06-2.357-2.357c0-1.299,1.058-2.358,2.357-2.358s2.357,1.06,2.357,2.358
        C192.354,323.302,191.296,324.361,189.997,324.361z"/>
      <path fill="#0F6CB6" d="M208.72,299.921l3.167-3.166l3.333,3.333l-3.167,3.167L208.72,299.921z"/>
      <path fill="#0F6CB6" d="M195.386,313.254l3.333-3.332l3.333,3.332l-3.333,3.333L195.386,313.254z"/>
      <path fill="#0F6CB6" d="M202.054,306.585l3.333-3.333l3.333,3.333l-3.333,3.334L202.054,306.585z"/>
      <path fill="#0F6CB6" d="M322.004,314.932c-3.9,0-7.072,3.172-7.072,7.072c0,3.898,3.172,7.071,7.072,7.071
        c3.898,0,7.071-3.173,7.071-7.071C329.075,318.104,325.902,314.932,322.004,314.932z M322.004,324.361
        c-1.299,0-2.358-1.06-2.358-2.357c0-1.299,1.06-2.358,2.358-2.358c1.298,0,2.357,1.06,2.357,2.358
        C324.361,323.302,323.302,324.361,322.004,324.361z"/>
      <path fill="#0F6CB6" d="M309.903,313.266l3.334-3.335l3.333,3.335l-3.333,3.332L309.903,313.266z"/>
      <path fill="#0F6CB6" d="M296.74,300.099l3.332-3.334l3.167,3.167l-3.334,3.333L296.74,300.099z"/>
      <path fill="#0F6CB6" d="M303.235,306.597l3.333-3.334l3.334,3.334l-3.334,3.333L303.235,306.597z"/>
      <path fill="#0F6CB6" d="M322.004,197.068c3.898,0,7.071-3.173,7.071-7.072s-3.173-7.072-7.071-7.072c-3.9,0-7.072,3.173-7.072,7.072
        S318.104,197.068,322.004,197.068z M322.004,187.64c1.298,0,2.357,1.058,2.357,2.357s-1.06,2.357-2.357,2.357
        c-1.299,0-2.358-1.058-2.358-2.357S320.705,187.64,322.004,187.64z"/>
      <path fill="#0F6CB6" d="M303.249,205.416l3.333-3.333l3.334,3.333l-3.334,3.333L303.249,205.416z"/>
      <path fill="#0F6CB6" d="M309.915,198.749l3.334-3.333l3.332,3.333l-3.332,3.333L309.915,198.749z"/>
      <path fill="#0F6CB6" d="M296.748,211.911l3.167-3.167l3.333,3.333l-3.166,3.167L296.748,211.911z"/>
      <path fill="#0F6CB6" d="M322.004,270.144c-3.9,0-7.072,3.174-7.072,7.071c0,3.9,3.172,7.072,7.072,7.072
        c3.898,0,7.071-3.172,7.071-7.072C329.075,273.316,325.902,270.144,322.004,270.144z M322.004,279.573
        c-1.299,0-2.358-1.06-2.358-2.358c0-1.298,1.06-2.357,2.358-2.357c1.298,0,2.357,1.06,2.357,2.357
        C324.361,278.514,323.302,279.573,322.004,279.573z"/>
      <path fill="#0F6CB6" d="M305.502,274.857h4.716v4.716h-4.716V274.857z"/>
      <path fill="#0F6CB6" d="M286.645,274.857h4.714v4.716h-4.714V274.857z"/>
      <path fill="#0F6CB6" d="M296.074,274.857h4.714v4.716h-4.714V274.857z"/>
      <path fill="#0F6CB6" d="M189.997,284.287c3.899,0,7.072-3.172,7.072-7.072c0-3.897-3.173-7.071-7.072-7.071
        c-3.898,0-7.072,3.174-7.072,7.071C182.925,281.115,186.098,284.287,189.997,284.287z M189.997,274.857
        c1.299,0,2.357,1.06,2.357,2.357c0,1.299-1.058,2.358-2.357,2.358s-2.357-1.06-2.357-2.358
        C187.64,275.917,188.697,274.857,189.997,274.857z"/>
      <path fill="#0F6CB6" d="M211.212,274.857h4.715v4.716h-4.715V274.857z"/>
      <path fill="#0F6CB6" d="M201.783,274.857h4.714v4.716h-4.714V274.857z"/>
      <path fill="#0F6CB6" d="M220.641,274.857h4.714v4.716h-4.714V274.857z"/>
    </svg>
  );

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
    icon: { src: opportunityBlockIcon },
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
