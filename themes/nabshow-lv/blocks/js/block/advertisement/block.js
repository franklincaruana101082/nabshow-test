import pick from 'lodash/pick';
import {sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6} from "../icons";
(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
  const { __ } = wpI18n;
  const { Component, Fragment } = wpElement;
  const { registerBlockType } = wpBlocks;
  const { InspectorControls, MediaUpload} = wpEditor;
  const { PanelBody, PanelRow, DateTimePicker, Tooltip, IconButton, ToggleControl, TextControl, Button, Placeholder } = wpComponents;

  const adUploadIcon = (
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="2 2 22 22" className="dashicon">
      <path fill="none" d="M0 0h24v24H0V0z" />
      <path d="M20 4h-3.17L15 2H9L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM9.88 4h4.24l1.83 2H20v12H4V6h4.05" />
      <path d="M15 11H9V8.5L5.5 12 9 15.5V13h6v2.5l3.5-3.5L15 8.5z" />
    </svg>
  );

  const adBlockIcon = (
    <svg width="150px" height="150px" viewBox="0 0 150 150" enable-background="new 0 0 150 150">
      <g>
        <g>
          <g>
            <path fill="#146DB6" d="M133.758,4.449H16.676c-7.175,0-13.009,5.834-13.009,13.009v117.083c0,7.175,5.834,13.009,13.009,13.009
                            h117.082c7.176,0,13.011-5.834,13.011-13.009V17.458C146.768,10.283,140.934,4.449,133.758,4.449z M140.263,134.541
                            c0,3.585-2.919,6.506-6.505,6.506H16.676c-3.586,0-6.505-2.921-6.505-6.506V36.972h130.092V134.541L140.263,134.541z
                            M140.263,30.467H10.171V17.458c0-3.586,2.918-6.504,6.505-6.504h117.082c3.586,0,6.505,2.918,6.505,6.504V30.467L140.263,30.467
                            z"/>
            <circle fill="#146DB6" cx="19.928" cy="20.71" r="3.252"/>
            <circle fill="#146DB6" cx="32.938" cy="20.71" r="3.252"/>
            <circle fill="#146DB6" cx="45.946" cy="20.71" r="3.252"/>
            <path fill="#146DB6" d="M26.433,108.521h65.045c1.798,0,3.252-1.454,3.252-3.252V53.234c0-1.798-1.455-3.253-3.252-3.253H26.433
                            c-1.798,0-3.253,1.455-3.253,3.253v52.036C23.18,107.067,24.635,108.521,26.433,108.521z M29.685,56.485h58.541v45.533H29.685
                            V56.485z"/>
            <path fill="#146DB6" d="M45.946,62.99c-5.379,0-9.756,4.377-9.756,9.756v19.515c0,1.797,1.455,3.252,3.253,3.252
                            c1.797,0,3.252-1.455,3.252-3.252V89.01h6.504v3.251c0,1.797,1.455,3.252,3.253,3.252c1.797,0,3.251-1.455,3.251-3.252V72.746
                            C55.704,67.367,51.327,62.99,45.946,62.99z M49.199,82.503h-6.505v-9.757c0-1.794,1.458-3.251,3.252-3.251
                            c1.795,0,3.253,1.458,3.253,3.251V82.503L49.199,82.503z"/>
            <path fill="#146DB6" d="M71.964,62.99H65.46c-1.797,0-3.252,1.455-3.252,3.253v26.018c0,1.797,1.455,3.252,3.252,3.252h6.504
                            c5.381,0,9.757-4.377,9.757-9.755V72.746C81.722,67.367,77.346,62.99,71.964,62.99z M75.217,85.758
                            c0,1.792-1.458,3.252-3.253,3.252h-3.251V69.495h3.251c1.795,0,3.253,1.458,3.253,3.251V85.758L75.217,85.758z"/>
            <path fill="#146DB6" d="M26.433,128.037h97.569c1.797,0,3.251-1.454,3.251-3.254c0-1.797-1.454-3.252-3.251-3.252H26.433
                            c-1.798,0-3.253,1.455-3.253,3.254C23.18,126.583,24.635,128.037,26.433,128.037z"/>
            <path fill="#146DB6" d="M104.487,69.495h19.515c1.799,0,3.253-1.455,3.253-3.251c0-1.798-1.456-3.253-3.253-3.253h-19.515
                            c-1.798,0-3.251,1.456-3.251,3.253C101.236,68.04,102.689,69.495,104.487,69.495z"/>
            <path fill="#146DB6" d="M104.487,89.01h19.515c1.799,0,3.253-1.455,3.253-3.252c0-1.8-1.456-3.255-3.253-3.255h-19.515
                            c-1.798,0-3.251,1.457-3.251,3.255C101.236,87.555,102.689,89.01,104.487,89.01z"/>
            <path fill="#146DB6" d="M104.487,108.521h19.515c1.799,0,3.253-1.454,3.253-3.252c0-1.797-1.456-3.251-3.253-3.251h-19.515
                            c-1.798,0-3.251,1.454-3.251,3.251C101.236,107.067,102.689,108.521,104.487,108.521z"/>
          </g>
        </g>
      </g>
    </svg>
  );

  class NabAdvertisement extends Component {
    constructor() {
      super(...arguments);
      this.state = {
        currentSelected: 0,
      };
    }

    updateMediaData(data) {

      const { currentSelected } = this.state;

      if ('number' !== typeof currentSelected) {
        return null;
      }

      const { attributes, setAttributes } = this.props;
      const { imgSources } = attributes;

      const newSources = imgSources.map((imgSources, index) => {
        if (index === currentSelected) {
          imgSources = Object.assign({}, imgSources, data);
        }
        return imgSources;
      });

      setAttributes({ imgSources: newSources });
    }

    render() {
      const { attributes: { imgSources, imgWidth, imgHeight, linkTarget, scheduleAd, startDate, endDate, showCal, addAlign }, setAttributes, isSelected } = this.props;

      const { currentSelected } = this.state;

      const style = {};

      imgWidth && (style.width = imgWidth + 'px');
      imgHeight && (style.height = imgHeight + 'px');

      $(document).on('click', '.inspector-field-toggleCal .components-form-toggle__input', function (e) {
        e.stopImmediatePropagation();
        if (! $('.inspector-field-datetime .components-datetime__date').hasClass('toggled')) {
          $('.inspector-field-datetime .components-datetime__date').show();
          $('.components-datetime .components-datetime__date').addClass('toggled');
          $('.components-datetime .components-datetime__date > div').removeClass('DayPicker__hidden');
          setAttributes({ showCal: ! showCal });
        } else {
          $('.inspector-field-datetime .components-datetime__date').hide();
          $('.components-datetime .components-datetime__date').removeClass('toggled');
          $('.components-datetime .components-datetime__date > div').addClass('DayPicker__hidden');
          setAttributes({ showCal: showCal });
        }
      });


      if (0 === imgSources.length) {
        return (
          <Placeholder
            icon={adUploadIcon}
            label={__('Advertisement')}
            instructions={__('No image selected. Add image to start using this block.')}
          >
            <MediaUpload
              allowedTypes={['image']}
              value={null}
              multiple
              onSelect={(item) => {
                const mediaInsert = item.map((source) => ({
                  url: source.url,
                  id: source.id,
                }));

                setAttributes({
                  imgSources: [
                    ...imgSources,
                    ...mediaInsert,
                  ]
                });
              }}
              render={({ open }) => (
                <Button className="button button-large button-primary" onClick={open}>
                  {__('Add image')}
                </Button>
              )}
            />
          </Placeholder>
        );
      }

      if ( ! startDate ) {
        setAttributes({startDate: moment().format('YYYY-MM-DDTHH:mm:ss')});
      }
      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title={__('Schedule Display Settings')}>
              <ToggleControl
                label={__('Display According to Date time')}
                checked={scheduleAd}
                onChange={() => setAttributes({ scheduleAd: ! scheduleAd })}
              />
              { scheduleAd &&
              <Fragment>
                <div className="inspector-field inspector-field-toggleCal components-base-control">
                  <div className="toggleCalender">
                        <span className="cal">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M436 160H12c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zM12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40z"></path>
                          </svg>
                        </span>
                    <span className="text">Toggle Calendar</span>
                  </div>
                  <ToggleControl
                    checked={showCal}
                  />
                </div>
                <div className="inspector-field inspector-field-datetime components-base-control">
                  <label className="inspector-mb-0">Select Date time to start display</label>
                  <div className="inspector-ml-auto">
                    <DateTimePicker
                      currentDate={startDate}
                      onChange={(date) => setAttributes({startDate: date})}
                    />
                  </div>
                </div>
                <div className="inspector-field inspector-field-datetime components-base-control">
                  <label className="inspector-mb-0">Select Date time to remove</label>
                  <div className="inspector-ml-auto">
                    <DateTimePicker
                      currentDate={endDate}
                      onChange={(date) => setAttributes({endDate: date})}
                    />
                  </div>
                </div>
              </Fragment>
              }
            </PanelBody>
            <PanelBody title={__('Image Settings')} initialOpen={false}>
              <PanelRow>
                <div className="inspector-field alignment-settings">
                  <div className="alignment-wrapper">
                    <TextControl
                      label="Width"
                      type="number"
                      value={imgWidth}
                      min={1}
                      max={1500}
                      step={1}
                      onChange={(width) => setAttributes({ imgWidth: parseInt(width) })}
                    />
                  </div>
                  <div className="alignment-wrapper">
                    <TextControl
                      label="Height"
                      type="number"
                      value={imgHeight}
                      min={1}
                      max={1500}
                      step={1}
                      onChange={(height) => setAttributes({ imgHeight: parseInt(height) })}
                    />
                  </div>
                </div>
              </PanelRow>
              <PanelRow>
                <div className="inspector-field inspector-field-alignment">
                  <label className="inspector-mb-0">Alignment</label>
                  <div className="inspector-field-button-list inspector-field-button-list-fluid">
                    <button className={'left' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'left' })}><i className="fa fa-align-left"></i></button>
                    <button className={'center' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'center' })}><i className="fa fa-align-center"></i></button>
                    <button className={'right' === addAlign ? 'active  inspector-button' : 'inspector-button'} onClick={() => setAttributes({ addAlign: 'right' })}><i className="fa fa-align-right"></i></button>
                  </div>
                </div>
              </PanelRow>
            </PanelBody>
            <PanelBody title={__('Link Settings')} initialOpen={false}>
              <ToggleControl
                label={__('Open in New Tab')}
                checked={linkTarget}
                onChange={() => setAttributes({ linkTarget: ! linkTarget })}
              />
            </PanelBody>
            <PanelBody title={__('Help')} initialOpen={false}>
              <a href="https://nabshow-com.go-vip.net/2020/wp-content/uploads/sites/3/2019/11/advertisement.mp4" target="_blank">How to use block?</a>
            </PanelBody>
          </InspectorControls>
          <div className="nab-banner-main" style={{textAlign: addAlign}}>
            <div className="nab-banner-inner">
              <p className="banner-text">Advertisement</p>
              <img src={imgSources[currentSelected].url}
                   className="banner-img"
                   alt={__('image')}
                   style={style}
              />
              {isSelected && (
                <div className="nab-ad-controls">
                  <div className="nab-controls-wrapper">
                    <div className="nab-ad-field img-link">
                      <TextControl
                        label={__('Link URL')}
                        placeholder="https://"
                        value={imgSources[currentSelected] ? imgSources[currentSelected].bannerLink || '' : ''}
                        onChange={(value) => this.updateMediaData({ bannerLink: value || '' })}
                      />
                    </div>
                    <strong>Google Event</strong>
                    <div className="nab-ad-field google-event">
                      <TextControl
                        label={__('Event Category')}
                        placeholder="Enter Category"
                        value={imgSources[currentSelected] ? imgSources[currentSelected].eventCategory || '' : ''}
                        onChange={(value) => this.updateMediaData({ eventCategory: value || '' })}
                      />
                    </div>
                    <div className="nab-ad-field google-event">
                      <TextControl
                        label={__('Event Action')}
                        placeholder="Enter Action"
                        value={imgSources[currentSelected] ? imgSources[currentSelected].eventAction || '' : ''}
                        onChange={(value) => this.updateMediaData({ eventAction: value || '' })}
                      />
                    </div>
                    <div className="nab-ad-field google-event">
                      <TextControl
                        label={__('Event Label')}
                        placeholder="Enter Label"
                        value={imgSources[currentSelected] ? imgSources[currentSelected].eventLabel || '' : ''}
                        onChange={(value) => this.updateMediaData({ eventLabel: value || '' })}
                      />
                    </div>
                  </div>
                  <div className="nab-ad-list">
                    { imgSources.map((source, index) => (
                      <div className="nab-ad-img-list-item" key={index}>
                        <img src={source.url}
                             className="nab-ad-img"
                             alt={__('Ad-Image')}
                             height="100px"
                             width="100px"
                             onClick={() => {
                               this.setState({ currentSelected: index });
                             }}
                        />
                        <Tooltip text={__('Remove Image')}>
                          <IconButton
                            className="nab-ad-item-remove"
                            icon="no"
                            onClick={() => {
                              if (index === currentSelected) { this.setState({ currentSelected: 0 }); }
                              setAttributes({ imgSources: imgSources.filter((img, idx) => idx !== index) });
                            }}
                          />
                        </Tooltip>
                      </div>
                    ))}
                    <div className="nab-advertisement-add-item">
                      <MediaUpload
                        allowedTypes={['image']}
                        value={null}
                        multiple
                        onSelect={(items) => setAttributes({
                          imgSources: [...imgSources, ...items.map((item) => pick(item, 'url', 'id'))],
                        })}
                        render={({ open }) => (
                          <IconButton
                            label={__('Add media')}
                            icon="plus"
                            onClick={open}
                          />
                        )}
                      />
                    </div>
                  </div>
                </div>
              )}
            </div>
          </div>
        </Fragment >
      );
    }

  }

  const allAttr = {
    imgSources: {
      type: 'array',
      default: [],
    },
    imgWidth: {
      type: 'number',
    },
    imgHeight: {
      type: 'number',
    },
    linkTarget: {
      type: 'boolean',
      default: true,
    },
    scheduleAd: {
      type: 'boolean',
      default: false,
    },
    startDate: {
      type: 'string',
    },
    endDate: {
      type: 'string',
    },
    showCal: {
      type: 'boolean',
      default: false,
    },
    addAlign: {
      type: 'string',
      default: 'center'
    }
  };


  registerBlockType('nab/advertisement', {
    title: __('Advertisement'),
    icon: { src: adBlockIcon},
    category: 'nabshow',
    keywords: [__('ad'), __('advertisement')],
    attributes: allAttr,
    edit: NabAdvertisement,
    save() {
      return null;
    },
  });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
