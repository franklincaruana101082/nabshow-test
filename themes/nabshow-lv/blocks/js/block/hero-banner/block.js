(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement, wpBlockEditor) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { MediaUpload, InspectorControls, RichText } = wpBlockEditor;
  const { Component, Fragment } = wpElement;
  const { PanelBody, RangeControl, ToggleControl, Button, PanelRow, ColorPalette } = wpComponents;

  const bannerBlockIcon = (
    <svg
      width="150px"
      height="150px"
      viewBox="181 181 150 150"
      enable-background="new 181 181 150 150"
    >
      <path
        fill="#0F6CB6"
        d="M321.437,192.815H190.563c-3.732,0-6.769,3.037-6.769,6.769v117.343c0,1.249,1.008,2.257,2.256,2.257h139.9
                c1.247,0,2.257-1.008,2.257-2.257V199.584C328.207,195.853,325.169,192.815,321.437,192.815z M188.307,206.354h135.387v108.318
                H188.307V206.354z M190.563,197.328h2.302c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256
                c1.246,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.742c-1.246,0-2.243,1.009-2.243,2.257
                c0,1.248,1.019,2.256,2.268,2.256c1.245,0,2.256-1.008,2.256-2.256c0-1.248-1.011-2.257-2.256-2.257h6.751
                c-1.246,0-2.243,1.009-2.243,2.257c0,1.248,1.02,2.256,2.268,2.256c1.246,0,2.257-1.008,2.257-2.256
                c0-1.248-1.011-2.257-2.257-2.257h115.004c1.246,0,2.257,1.011,2.257,2.257v2.256H206.43h-6.776h-6.767h-4.581v-2.256
                C188.307,198.339,189.317,197.328,190.563,197.328z"
      />
      <path
        fill="#0F6CB6"
        d="M201.846,217.636h-4.513v-1.322l1.598-1.595c0.882-0.88,0.882-2.309,0-3.191
                c-0.882-0.882-2.309-0.882-3.191,0l-2.257,2.254c-0.209,0.208-0.375,0.458-0.489,0.733c-0.115,0.275-0.173,0.569-0.173,0.864v4.513
                v6.77c0,1.248,1.008,2.256,2.256,2.256h6.77c1.248,0,2.256-1.008,2.256-2.256v-6.77
                C204.102,218.645,203.093,217.636,201.846,217.636z M199.589,224.405h-2.256v-2.256h2.256V224.405z"
      />
      <path
        fill="#0F6CB6"
        d="M215.384,228.918c1.248,0,2.256-1.008,2.256-2.256v-6.77c0-1.248-1.009-2.256-2.256-2.256h-4.513v-1.322
                l1.597-1.595c0.882-0.88,0.882-2.309,0-3.191c-0.882-0.882-2.309-0.882-3.191,0l-2.256,2.254c-0.21,0.208-0.375,0.458-0.489,0.733
                c-0.115,0.275-0.174,0.569-0.174,0.864v4.513v6.77c0,1.248,1.009,2.256,2.256,2.256H215.384L215.384,228.918z M213.127,224.405
                h-2.256v-2.256h2.256V224.405z"
      />
      <path
        fill="#0F6CB6"
        d="M316.926,292.091h-6.769c-1.248,0-2.257,1.01-2.257,2.257v6.77c0,1.248,1.009,2.257,2.257,2.257h4.513v1.322
                l-1.598,1.595c-0.882,0.881-0.882,2.309,0,3.191c0.439,0.44,1.018,0.661,1.595,0.661c0.578,0,1.155-0.221,1.596-0.661l2.257-2.254
                c0.209-0.208,0.374-0.459,0.489-0.734c0.114-0.274,0.174-0.568,0.174-0.863v-4.514v-6.77
                C319.183,293.101,318.174,292.091,316.926,292.091z M312.413,296.604h2.257v2.257h-2.257V296.604z"
      />
      <path
        fill="#0F6CB6"
        d="M303.388,292.091h-6.77c-1.248,0-2.256,1.01-2.256,2.257v6.77c0,1.248,1.008,2.257,2.256,2.257h4.513v1.322
                l-1.597,1.595c-0.884,0.881-0.884,2.309,0,3.191c0.439,0.44,1.017,0.661,1.595,0.661c0.577,0,1.155-0.221,1.596-0.661l2.255-2.254
                c0.211-0.208,0.375-0.459,0.491-0.734c0.114-0.274,0.173-0.568,0.173-0.863v-4.514v-6.77
                C305.644,293.101,304.635,292.091,303.388,292.091z M298.874,296.604h2.257v2.257h-2.257V296.604z"
      />
      <path
        fill="#0F6CB6"
        d="M208.608,265.044c0,1.247,1.008,2.256,2.256,2.256h90.271c1.247,0,2.257-1.009,2.257-2.256
                c0-1.248-1.01-2.257-2.257-2.257h-90.271C209.617,262.787,208.608,263.796,208.608,265.044L208.608,265.044z"
      />
      <path
        fill="#0F6CB6"
        d="M301.136,269.557h-90.271c-1.248,0-2.256,1.009-2.256,2.257c0,1.247,1.008,2.257,2.256,2.257h90.271
                c1.247,0,2.257-1.01,2.257-2.257C303.393,270.565,302.383,269.557,301.136,269.557z"
      />
      <path
        fill="#0F6CB6"
        d="M303.393,278.582c0-1.247-1.01-2.257-2.257-2.257h-90.271c-1.248,0-2.256,1.01-2.256,2.257
                c0,1.249,1.008,2.257,2.256,2.257h90.271C302.383,280.839,303.393,279.831,303.393,278.582z"
      />
      <path
        fill="#0F6CB6"
        d="M278.564,283.096h-45.129c-1.248,0-2.256,1.009-2.256,2.256c0,1.248,1.008,2.257,2.256,2.257h45.129
                c1.248,0,2.256-1.009,2.256-2.257C280.82,284.104,279.813,283.096,278.564,283.096z"
      />
      <path
        fill="#0F6CB6"
        d="M245.957,254.637c0.014,0.012,0.031,0.021,0.045,0.034c2.726,2.235,6.208,3.581,10,3.581
                c3.802,0,7.293-1.352,10.021-3.599c0.002-0.003,0.006-0.003,0.008-0.005c3.517-2.899,5.764-7.288,5.764-12.193
                c0-8.708-7.087-15.795-15.795-15.795c-8.708,0-15.795,7.088-15.795,15.795C240.205,247.354,242.445,251.738,245.957,254.637
                L245.957,254.637z M250.413,252.198c1.241-1.821,3.313-2.974,5.585-2.974c2.274,0,4.346,1.155,5.587,2.977
                c-1.651,0.952-3.543,1.539-5.584,1.539C253.958,253.739,252.069,253.152,250.413,252.198L250.413,252.198z M256,244.711
                c-1.246,0-2.257-1.011-2.257-2.256s1.011-2.257,2.257-2.257c1.245,0,2.257,1.011,2.257,2.257S257.245,244.711,256,244.711z
                M256,231.172c6.222,0,11.282,5.062,11.282,11.283c0,2.534-0.871,4.851-2.288,6.738c-0.916-1.212-2.082-2.2-3.389-2.952
                c0.735-1.081,1.164-2.383,1.164-3.786c0-3.732-3.038-6.77-6.77-6.77c-3.732,0-6.769,3.037-6.769,6.77
                c0,1.401,0.429,2.705,1.162,3.788c-1.307,0.752-2.471,1.737-3.39,2.95c-1.415-1.889-2.285-4.204-2.285-6.738
                C244.718,236.233,249.779,231.172,256,231.172L256,231.172z"
      />
    </svg>
  );

  class HeroBannerComp extends Component {
    constructor() {
      super(...arguments);
      this.state = {
        currentSelected: 0,
        lastSliderIndex: 0,
        inited: false,
        bxSliderObj: {},
        sliderActive: false,
        activeClass: false
      };

      this.initSlider = this.initSlider.bind(this);
      this.reloadSlider = this.reloadSlider.bind(this);
    }

    componentDidUpdate(prevProps) {
      const {
        sliderActive,
        adaptiveHeight,
        autoplay,
        speed,
        infiniteLoop,
        pager,
        controls,
        mode
      } = this.props.attributes;
      if (this.state.bxSliderObj.length === undefined && sliderActive) {
        this.initSlider();
      } else if (0 < this.state.bxSliderObj.length && ! sliderActive) {
        this.state.bxSliderObj.destroySlider();
        this.setState({ bxSliderObj: {} });
      }

      if (adaptiveHeight !== prevProps.attributes.adaptiveHeight) {
        this.reloadSlider();
      }
      if (autoplay !== prevProps.attributes.autoplay) {
        this.reloadSlider();
      }
      if (speed !== prevProps.attributes.speed) {
        this.reloadSlider();
      }
      if (infiniteLoop !== prevProps.attributes.infiniteLoop) {
        this.reloadSlider();
      }
      if (pager !== prevProps.attributes.pager) {
        this.reloadSlider();
      }
      if (controls !== prevProps.attributes.controls) {
        this.reloadSlider();
      }
      if (mode !== prevProps.attributes.mode) {
        this.reloadSlider();
      }
    }

    componentDidMount() {
      const { sliderActive, dataArray } = this.props.attributes;
      if (this.state.bxSliderObj.length === undefined && sliderActive) {
        this.initSlider();
      } else if (0 < this.state.bxSliderObj.length && ! sliderActive) {
        this.state.bxSliderObj.destroySlider();
        this.setState({ bxSliderObj: {} });
      }
      if (0 === dataArray.length) {
        this.initList();
      }
    }

    initList() {
      const { dataArray } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
        sliderActive: false,
        dataArray: [
          ...dataArray,
          {
            index: dataArray.length,
            title: '',
            disc: '',
            button: [
              {
                text: 'Learn More',
                link: '#',
                target: ''
              }
            ],
            link: '',
            backgroundImage: {
              url: '',
              id: '',
              backgroundSize: 'cover',
              backgroundPosition: 'center'
            },
            drafted: false
          }
        ]
      });
    }

    initSlider() {
      const {
        infiniteLoop,
        pager,
        controls,
        adaptiveHeight,
        speed,
        mode,
        dataArray
      } = this.props.attributes;
      const { clientId, setAttributes } = this.props;

      let darftArrs = [...dataArray];
      let finaldarftArrs = darftArrs.filter(element => false === element.drafted);
      setAttributes({
        newArr: finaldarftArrs
      });

      let sliderObj = jQuery(
        `#block-${clientId} .wp-block-nab-hero-banner`
      ).bxSlider({
        mode: mode,
        speed: speed,
        controls: controls,
        infiniteLoop: infiniteLoop,
        pager: pager,
        adaptiveHeight: adaptiveHeight,
        stopAutoOnClick: true,
        autoHover: true,
        touchEnabled: false
      });

      this.setState({ bxSliderObj: sliderObj });
    }

    reloadSlider() {
      const {
        infiniteLoop,
        pager,
        controls,
        adaptiveHeight,
        speed,
        mode,
        dataArray
      } = this.props.attributes;

      let darftArrs = [...dataArray];
      let finaldarftArrs = darftArrs.filter(element => false === element.drafted);
      this.props.setAttributes({
        newArr: finaldarftArrs
      });

      this.state.bxSliderObj.reloadSlider({
        mode: mode,
        speed: speed,
        controls: controls,
        infiniteLoop: infiniteLoop,
        pager: pager,
        adaptiveHeight: adaptiveHeight,
        stopAutoOnClick: true,
        autoHover: true,
        touchEnabled: false,
        onSlideAfter: function($slideElement, oldIndex, newIndex) {
          this.setState({ currentSelected: newIndex });
        }.bind(this)
      });
    }

    moveMedia(currentIndex, newIndex) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let arrayCopy = [...dataArray];
      arrayCopy[currentIndex].index = newIndex;
      arrayCopy[newIndex].index = currentIndex;
      setAttributes({ dataArray: arrayCopy });

      let darftArrs = [...dataArray];
      let finaldarftArrs = darftArrs.filter(element => false === element.drafted);
      setAttributes({
        newArr: finaldarftArrs
      });

      this.reloadSlider();
    }

    gotoLastSlider(index) {
      this.state.bxSliderObj.goToSlide(index);
    }

    render() {
      const { currentSelected } = this.state;
      const { attributes, setAttributes, clientId, className } = this.props;
      const {
        dataArray,
        sliderActive,
        autoplay,
        infiniteLoop,
        pager,
        controls,
        adaptiveHeight,
        speed,
        mode,
        headingFont,
        discFont,
        buttonFont,
        headingcolor,
        disccolor,
        buttoncolor,
        buttonBgcolor,
        headingLineHeight,
        discLineHeight,
        discWidth,
        spacingTop,
        spacingBottom,
        newArr
      } = attributes;

      const HeadingStyle = {};
      headingFont && (HeadingStyle.fontSize = headingFont + 'px');
      headingLineHeight && (HeadingStyle.lineHeight = headingLineHeight + 'px');
      headingcolor && (HeadingStyle.color = headingcolor);

      const detailsStyle = {};
      discWidth && (detailsStyle.width = discWidth + '%');
      discFont && (detailsStyle.fontSize = discFont + 'px');
      discLineHeight && (detailsStyle.lineHeight = discLineHeight + 'px');
      disccolor && (detailsStyle.color = disccolor);

      const buttonStyle = {};
      buttonFont && (buttonStyle.fontSize = buttonFont + 'px');
      buttoncolor && (buttonStyle.color = buttoncolor);
      buttonBgcolor && (buttonStyle.background = buttonBgcolor);

      let finalList;

      const heroBannerList = dataArray
        .sort((a, b) => a.index - b.index)
        .map((item, index) => {
          return (
            <div
              className="banner-item"
              style={{ paddingTop: spacingTop, paddingBottom: spacingBottom, backgroundImage: `url(${item.backgroundImage.url})`, backgroundPosition: item.backgroundImage.backgroundPosition, backgroundSize: item.backgroundImage.backgroundSize }}
              data-draft-item={item.drafted ? 'true' : 'false'}
            >
              { false === sliderActive &&
              <Fragment>
              <span
                className="remove-item"
                onClick={() => {
                  setAttributes({
                    dataArray: dataArray.filter((img, idx) => idx !== index),
                    newArr: newArr.filter((img, idx) => idx !== index)
                  });
                  this.reloadSlider();
                }}
              >
                <i className="fa fa-times" />
              </span>
              <div className="move-item">
                {0 < index && (
                  <span
                    onClick={() => {
                      this.moveMedia(index, index - 1);
                      this.reloadSlider();
                      this.gotoLastSlider(index - 1);
                    }}
                    class="dashicons dashicons-arrow-up-alt2"
                  ></span>
                )}
                {index + 1 < dataArray.length && (
                  <span
                    onClick={() => {
                      this.moveMedia(index, index + 1);
                      this.reloadSlider();
                      this.gotoLastSlider(index + 1);
                    }}
                    class="dashicons dashicons-arrow-down-alt2"
                  ></span>
                )}
              </div>
              </Fragment>
              }
              <div className="banner-item-inner">
                <RichText
                  tagName="h1"
                  placeholder={__('Title')}
                  value={item.title}
                  className="title"
                  style={HeadingStyle}
                  onChange={value => {
                    let arrayCopy = [...dataArray];
                    arrayCopy[index].title = value;
                    setAttributes({ dataArray: arrayCopy });
                  }}
                />
                <RichText
                  tagName="p"
                  placeholder={__('disc')}
                  value={item.disc}
                  style={detailsStyle}
                  className="disc"
                  onChange={value => {
                    let arrayCopy = [...dataArray];
                    arrayCopy[index].disc = value;
                    setAttributes({ dataArray: arrayCopy });
                  }}
                />
                <ul className="hero-buttons">
                  {item.button.map((data, i) => {
                    return (
                      <li className="button-item">
                        <span
                          className="remove-item"
                          onClick={() => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].button.splice(i, 1);
                            setAttributes({ dataArray: arrayCopy });
                            this.reloadSlider();
                          }}
                        >
                          <i className="fa fa-times" />
                        </span>
                        <RichText
                          tagName="span"
                          placeholder={__('Read More')}
                          value={data.text}
                          style={buttonStyle}
                          className="button"
                          onChange={value => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].button[i].text = value;
                            setAttributes({ dataArray: arrayCopy });
                          }}
                        />
                      </li>
                    );
                  })}
                  {5 > item.button.length ? (
                    <li
                      className="new-btn"
                      onClick={() => {
                        let arrayCopy = [...dataArray];
                        arrayCopy[index].button.push({
                          text: 'Learn More',
                          link: '#',
                          target: ''
                        });
                        setAttributes({ dataArray: arrayCopy });
                        this.reloadSlider();
                      }}
                    >
                      <span className="dashicons dashicons-plus"></span>
                    </li>
                  ) : (
                    ''
                  )}
                </ul>
                <div className="background-setting">
                  <MediaUpload
                    onSelect={img => {
                      let arrayCopy = [...dataArray];
                      arrayCopy[index].backgroundImage.url = img.url;
                      arrayCopy[index].backgroundImage.id = img.id;
                      setAttributes({ dataArray: arrayCopy });
                    }}
                    value={dataArray[index].backgroundImage.id}
                    type="image"
                    render={({ open }) => (
                      <Button
                        onClick={open}
                        className="button button-large set-background"
                      >
                        <span className="dashicons dashicons-plus"></span>
                        {dataArray[index].backgroundImage.url ?
                          'Edit Image' :
                          'Set Background Image'}
                      </Button>
                    )}
                  />
                  {
                    dataArray[index].backgroundImage.url ? (
                    <div className="inspector-field inspector-field-alignment">
                      <label className="inspector-mb-0">
                        Background Position
                      </label>
                      <div className="inspector-field-button-list inspector-field-button-list-fluid">
                        <button
                          className={'left' === dataArray[index].backgroundImage.backgroundPosition ? 'active  inspector-button' : 'inspector-button'}
                          onClick={() => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].backgroundImage.backgroundPosition = 'left';
                            setAttributes({ dataArray: arrayCopy });
                          }}
                        >
                          <i className="fa fa-align-left"></i>
                        </button>
                        <button
                          className={ 'center' === dataArray[index].backgroundImage.backgroundPosition ? 'active  inspector-button' : 'inspector-button' }
                          onClick={() => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].backgroundImage.backgroundPosition = 'center';
                            setAttributes({ dataArray: arrayCopy });
                          }}
                        >
                          <i className="fa fa-align-center"></i>
                        </button>
                        <button
                          className={ 'right' === dataArray[index].backgroundImage.backgroundPosition ? 'active  inspector-button' : 'inspector-button' }
                          onClick={() => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].backgroundImage.backgroundPosition = 'right';
                            setAttributes({ dataArray: arrayCopy });
                          }}
                        >
                          <i className="fa fa-align-right"></i>
                        </button>
                      </div>
                    </div>
                    ):''
                  }
                  {
                    dataArray[index].backgroundImage.url ? (
                      <div className="inspector-field inspector-field-alignment">
                        <label className="inspector-mb-0">
                          Background Size
                        </label>
                        <div className="inspector-field-button-list inspector-field-button-list-fluid">
                          <button
                            className={'cover' === dataArray[index].backgroundImage.backgroundSize ? 'active  inspector-button' : 'inspector-button'}
                            onClick={() => {
                              let arrayCopy = [...dataArray];
                              arrayCopy[index].backgroundImage.backgroundSize = 'cover';
                              setAttributes({ dataArray: arrayCopy });
                            }}
                          >
                            Cover
                          </button>
                          <button
                            className={ 'contain' === dataArray[index].backgroundImage.backgroundSize ? 'active  inspector-button' : 'inspector-button' }
                            onClick={() => {
                              let arrayCopy = [...dataArray];
                              arrayCopy[index].backgroundImage.backgroundSize = 'contain';
                              setAttributes({ dataArray: arrayCopy });
                            }}
                          >
                            Contain
                          </button>
                        </div>
                      </div>
                    ) : ''
                  }
                  <div className="draft-setting">
                    <div className="inspector-field inspector-field-alignment">
                      <ToggleControl
                        label={__('Save Slide as Draft:')}
                        checked={item.drafted}
                        className={true === dataArray[index].drafted ? 'inspector-button active' : 'inspector-button'}
                        onChange={() => {
                          let arrayCopy = [...dataArray];
                          arrayCopy[index].drafted = ! item.drafted;
                          finalList = arrayCopy.filter(element => false === element.drafted);
                          setAttributes({
                            newArr: finalList
                          });
                          return finalList;
                        }}
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          );
        });
      return (
        <div id={`block-${clientId}`} className={'hero-banner'}>
          <InspectorControls>
            <PanelBody title="General Settings">
              <PanelRow>
                <ToggleControl
                  label={__('Edit Slider')}
                  checked={sliderActive}
                  onChange={() =>
                    setAttributes({ sliderActive: ! sliderActive })
                  }
                />
              </PanelRow>
            </PanelBody>
            <PanelBody title="Typography" initialOpen={false}>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Heading Font Size (px)</label>
                  <RangeControl
                    value={headingFont}
                    min={15}
                    onChange={value => setAttributes({ headingFont: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Heading Line Height (px)</label>
                  <RangeControl
                    value={headingLineHeight}
                    min={15}
                    onChange={value => setAttributes({ headingLineHeight: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-color ">
                  <label className="inspector-mb-0">Heading Color</label>
                  <div className="inspector-ml-auto">
                    <ColorPalette
                      value={headingcolor}
                      onChange={headingcolor =>
                        setAttributes({
                          headingcolor: headingcolor
                        })
                      }
                    />
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Details Width (%)</label>
                  <RangeControl
                    value={discWidth}
                    min={40}
                    max={100}
                    onChange={value => setAttributes({ discWidth: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Details Font Size (px)</label>
                  <RangeControl
                    value={discFont}
                    min={15}
                    onChange={value => setAttributes({ discFont: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Details Line Height (px)</label>
                  <RangeControl
                    value={discLineHeight}
                    min={15}
                    onChange={value => setAttributes({ discLineHeight: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-color ">
                  <label className="inspector-mb-0">Details Color</label>
                  <div className="inspector-ml-auto">
                    <ColorPalette
                      value={disccolor}
                      onChange={disccolor =>
                        setAttributes({
                          disccolor: disccolor
                        })
                      }
                    />
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Button Font Size (px)</label>
                  <RangeControl
                    value={buttonFont}
                    min={15}
                    onChange={value => setAttributes({ buttonFont: value })}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-color ">
                  <label className="inspector-mb-0">Button Color</label>
                  <div className="inspector-ml-auto">
                    <ColorPalette
                      value={buttoncolor}
                      onChange={buttoncolor =>
                        setAttributes({
                          buttoncolor: buttoncolor
                        })
                      }
                    />
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-color ">
                  <label className="inspector-mb-0">Button BG Color</label>
                  <div className="inspector-ml-auto">
                    <ColorPalette
                      value={buttonBgcolor}
                      onChange={buttonBgcolor =>
                        setAttributes({
                          buttonBgcolor: buttonBgcolor
                        })
                      }
                    />
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title="Height Settings" initialOpen={false}>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Top (px)</label>
                  <RangeControl
                    value={spacingTop}
                    min={20}
                    onChange={value => {
                      setAttributes({ spacingTop: value });
                      if (sliderActive){
                        this.reloadSlider();
                      }
                    }}
                  />
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-fontsize ">
                  <label className="inspector-mb-0">Bottom (px)</label>
                  <RangeControl
                    value={spacingBottom}
                    min={20}
                    onChange={value => {
                      setAttributes({ spacingBottom: value });
                      if (sliderActive){
                        this.reloadSlider();
                      }
                    }}
                  />
                </div>
              </PanelRow>
            </PanelBody>
            {sliderActive && (
              <PanelBody title={__('Slider Settings')} initialOpen={false}>
                <ToggleControl
                  label={__('Pager')}
                  checked={pager}
                  onChange={() => {
                    setAttributes({ pager: ! pager });
                  }}
                />
                <ToggleControl
                  label={__('Controls')}
                  checked={controls}
                  onChange={() => setAttributes({ controls: ! controls })}
                />
                <ToggleControl
                  label={__('Autoplay')}
                  checked={autoplay}
                  onChange={() => setAttributes({ autoplay: ! autoplay })}
                />
                <ToggleControl
                  label={__('Infinite Loop')}
                  checked={infiniteLoop}
                  onChange={() =>
                    setAttributes({ infiniteLoop: ! infiniteLoop })
                  }
                />
                <ToggleControl
                  label={__('Adaptive Height')}
                  checked={adaptiveHeight}
                  onChange={() =>
                    setAttributes({ adaptiveHeight: ! adaptiveHeight })
                  }
                />
                <div className="inspector-field inspector-slider-speed">
                  <label>Speed</label>
                  <RangeControl
                    value={speed}
                    min={100}
                    max={2000}
                    onChange={speed => setAttributes({ speed: speed })}
                  />
                </div>
              </PanelBody>
            )}
          </InspectorControls>
          <div className={`${className} hero-banner-inner`}>
            {heroBannerList}
          </div>
          <div className="add-remove-btn">
            {1 < dataArray.length && false === sliderActive ? (
              <button
                className="components-button current"
                onClick={() => {
                  setAttributes({ sliderActive: true });
                }}
              >
                <span className="dashicons dashicons-yes"></span>
              </button>
            ) : (
              ''
            )}
            <button
              className="components-button add"
              onClick={content => {
                setAttributes({
                  sliderActive: false,
                  dataArray: [
                    ...dataArray,
                    {
                      index: dataArray.length,
                      title: '',
                      disc: '',
                      button: [
                        {
                          text: 'Learn More',
                          link: '#',
                          target: ''
                        }
                      ],
                      link: '',
                      backgroundImage: {
                        url: '',
                        id: '',
                        backgroundSize: 'cover',
                        backgroundPosition: 'center'
                      },
                      drafted: false
                    }
                  ]
                });
                this.reloadSlider();
                this.gotoLastSlider(dataArray.length);
              }}
            >
              <span className="dashicons dashicons-plus"></span>
            </button>
          </div>
        </div>
      );
    }
  }

  registerBlockType('nab/hero-banner', {
    title: __('Hero Banner'),
    icon: { src: bannerBlockIcon },
    category: 'nabshow',
    keywords: [__('Hero Banner'), __('gts')],

    attributes: {
      id: {
        type: 'string',
        default: ''
      },
      dataArray: {
        type: 'array',
        default: []
      },
      sliderActive: {
        type: 'boolean',
        default: false
      },
      autoplay: {
        type: 'boolean',
        default: false
      },
      infiniteLoop: {
        type: 'boolean',
        default: true
      },
      pager: {
        type: 'boolean',
        default: true
      },
      controls: {
        type: 'boolean',
        default: false
      },
      adaptiveHeight: {
        type: 'boolean',
        default: true
      },
      speed: {
        type: 'number',
        default: 500
      },
      mode: {
        type: 'string',
        default: 'horizontal'
      },
      headingFont: {
        type: 'number'
      },
      discFont: {
        type: 'number'
      },
      buttonFont: {
        type: 'number'
      },
      headingcolor: {
        type: 'string'
      },
      disccolor: {
        type: 'string'
      },
      buttoncolor: {
        type: 'string'
      },
      buttonBgcolor: {
        type: 'string'
      },
      headingLineHeight: {
        type: 'number'
      },
      discLineHeight: {
        type: 'number'
      },
      discWidth: {
        type: 'number'
      },
      spacingTop: {
        type: 'number',
        default: 130
      },
      spacingBottom: {
        type: 'number',
        default: 130
      },
      newArr: {
        type: 'array',
        default: []
      }
    },

    // edit Component
    edit: HeroBannerComp,

    save: props => {
      const {
        dataArray,
        headingFont,
        discFont,
        buttonFont,
        headingcolor,
        disccolor,
        buttoncolor,
        buttonBgcolor,
        autoplay,
        infiniteLoop,
        pager,
        controls,
        adaptiveHeight,
        speed,
        mode,
        headingLineHeight,
        discLineHeight,
        discWidth,
        spacingTop,
        spacingBottom,
        newArr
      } = props.attributes;

      const HeadingStyle = {};
      headingFont && (HeadingStyle.fontSize = headingFont + 'px');
      headingLineHeight && (HeadingStyle.lineHeight = headingLineHeight + 'px');
      headingcolor && (HeadingStyle.color = headingcolor);

      const detailsStyle = {};
      discWidth && (detailsStyle.width = discWidth + '%');
      discFont && (detailsStyle.fontSize = discFont + 'px');
      discLineHeight && (detailsStyle.lineHeight = discLineHeight + 'px');
      disccolor && (detailsStyle.color = disccolor);

      const buttonStyle = {};
      buttonFont && (buttonStyle.fontSize = buttonFont + 'px');
      buttoncolor && (buttonStyle.color = buttoncolor);
      buttonBgcolor && (buttonStyle.background = buttonBgcolor);

      let finalArray;
      if (0<newArr.length){
            finalArray = newArr;
      } else {
        finalArray = dataArray;
      }

      const heroBannerList = finalArray
          .sort((a, b) => a.index - b.index)
          .map((item, index) => {
            return (
              <div
                className="banner-item"
                style={{ paddingTop: spacingTop, paddingBottom: spacingBottom, backgroundImage: `url(${item.backgroundImage.url})`, backgroundPosition: item.backgroundImage.backgroundPosition, backgroundSize: item.backgroundImage.backgroundSize }}
                data-draft-item={item.drafted ? 'true' : 'false'}
              >
                <div className="banner-item-inner">
                  <RichText.Content
                    tagName="h1"
                    value={item.title}
                    className="title"
                    style={HeadingStyle}
                  />
                  <RichText.Content
                    tagName="p"
                    value={item.disc}
                    style={detailsStyle}
                    className="disc"
                  />
                  <ul className="hero-buttons">
                    {item.button.map((data, i) => {
                      return (
                        <li className="button-item">
                          <RichText.Content
                            tagName="span"
                            style={buttonStyle}
                            value={data.text}
                            className="button"
                          />
                        </li>
                      );
                    })}
                  </ul>
                </div>
              </div>
            );
          });

      if (0 < dataArray.length) {
        return (
          <div className={'hero-banner'}>
            <div
              className="hero-banner-inner nab-media-slider"
              data-mode={mode}
              data-autoplay={`${autoplay}`}
              data-speed={`${speed}`}
              data-infiniteloop={`${infiniteLoop}`}
              data-pager={`${pager}`}
              data-controls={`${controls}`}
              data-adaptiveheight={`${adaptiveHeight}`}
              data-touchEnabled={`${false}`}
            >
              {heroBannerList}
            </div>
          </div>
        );
      } else {
        return null;
      }
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor);
