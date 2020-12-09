;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement, wpBlockEditor) {
  const { __ } = wpI18n
  const { registerBlockType } = wpBlocks
  const { Fragment, Component } = wpElement
  const { InspectorControls, RichText, MediaUpload } = wpEditor
  const {
    PanelBody,
    PanelRow,
    ToggleControl,
    TextControl,
    Tooltip,
    Button
  } = wpComponents
  const { ColorPalette } = wpBlockEditor

  class ItemComponent extends Component {
    constructor (props) {
      super(props)
      this.state = { popup: false }
      this.addNewItem = this.addNewItem.bind(this)
    }

    addNewItem (name) {
      const { dataArray } = this.props.attributes
      const { setAttributes } = this.props
      let attr
      if (name == 'option-1') {
        attr = {
          index: dataArray.length,
          option: name,
          advertising: 'Sponsored',
          media: '',
          mediaAlt: '',
          title: '',
          subTitle: '',
          buttonText: '<a href="#" class="btn">Learn More</a>'
        }
      }
      if (name == 'option-2') {
        attr = {
          index: dataArray.length,
          option: name,
          bgMedia: '',
          media: '',
          mediaAlt: '',
          videoIcon: '',
          title: '',
          subTitle: '',
          date: '',
          shortcode: '',
          buttonText: '<a href="#" class="btn">Watch</a>'
        }
      }

      if (name == 'option-3') {
        attr = {
          index: dataArray.length,
          option: name,
          advertising: 'Sponsored',
          media: '',
          mediaAlt: '',
          buttonText: '<a href="#" class="btn">Learn More</a>'
        }
      }

      if (name == 'option-4') {
        attr = {
          index: dataArray.length,
          option: name,
          bgMedia: '',
          media: '',
          mediaAlt: '',
          title: '',
          subTitle: '',
          buttonText: '<a href="#" class="btn">Message</a>'
        }
      }

      if (name == 'option-5') {
        attr = {
          index: dataArray.length,
          option: name,
          bgMedia: '',
          title: '',
          subTitle: '',
          buttonText: '<a href="#" class="btn">View Product</a>'
        }
      }

      if (name == 'option-6') {
        attr = {
          index: dataArray.length,
          option: name,
          advertising: 'Sponsored',
          media: '',
          mediaAlt: '',
          shortcode: '',
          bookmark: ''
        }
      }

      setAttributes({
        dataArray: [...dataArray, attr]
      })
      this.setState({
        popup: false
      })
    }

    moveItem (oldIndex, newIndex) {
      const { attributes, setAttributes } = this.props
      const { dataArray } = attributes

      let copyData = [...dataArray]

      copyData[oldIndex] = dataArray[newIndex]
      copyData[newIndex] = dataArray[oldIndex]

      setAttributes({
        dataArray: copyData
      })

      this.forceUpdate()
    }

    render () {
      const { attributes, setAttributes } = this.props
      const { popup } = this.state
      const { dataArray, headerTitle, headerTitleColor, backgroundColor } = attributes

      const itemList = dataArray.map((data, index) => {
        return (
          <div className={`item ${data.option}`}>
            <div className='settings'>
              <div className="move-item-controls">
                {0 < index && (
                  <Tooltip text='Move Left'>
                    <span
                      className='dashicons dashicons-arrow-left-alt2 move-left'
                      onClick={() => this.moveItem(index, index - 1)}
                    ></span>
                  </Tooltip>
                )}
                {index + 1 < dataArray.length && (
                  <Tooltip text='Move Right'>
                    <span
                      className='dashicons dashicons-arrow-right-alt2 move-right'
                      onClick={() => this.moveItem(index, index + 1)}
                    ></span>
                  </Tooltip>
                )}
              </div>
              <span
                className='dashicons dashicons-no-alt remove'
                onClick={() => {
                  const qewQusote = dataArray
                    .filter(item => item.index != data.index)
                    .map(t => {
                      if (t.index > data.index) {
                        t.index -= 1
                      }

                      return t
                    })

                  setAttributes({
                    dataArray: qewQusote
                  })
                }}
              ></span>
            </div>
            <div className='inner' style={{backgroundColor:backgroundColor}}>
              {data.option == 'option-1' || data.option == 'option-4' ? (
                <div className='background-image'>
                  <MediaUpload
                    onSelect={media => {
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].bgMedia = media.url
                      setAttributes({ dataArray: arrayCopy })
                    }}
                    type='image'
                    render={({ open }) => {
                      if (data.bgMedia) {
                        return (
                          <Fragment>
                            <span
                              onClick={open}
                              className='dashicons dashicons-edit edit-image'
                            ></span>
                            <img src={data.bgMedia} />
                          </Fragment>
                        )
                      } else {
                        return (
                          <Button
                            onClick={open}
                            className='button button-large'
                          >
                            <span className='dashicons dashicons-upload'></span>
                            Upload Cover Image
                          </Button>
                        )
                      }
                    }}
                  />
                </div>
              ) : null}
              {data.option == 'option-1' || data.option == 'option-3' || data.option == 'option-6' ? (
                <div className='advertising'>
                  <RichText
                    tagName='span'
                    placeholder={__('Sponsored')}
                    keepPlaceholderOnFocus='true'
                    value={data.advertising}
                    onChange={value => {
                      value = value.replace(/&lt;!--td.*}--><br>/, '')
                      value = value.replace(/<br>.*}<br>/, '')
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].advertising = value
                      setAttributes({ dataArray: arrayCopy })
                    }}
                  />
                </div>
              ) : null}
              {'option-2' === data.option && (
                <RichText
                  tagName='div'
                  placeholder={__('Bookmark')}
                  value={data.bookmark}
                  keepPlaceholderOnFocus='true'
                  className='bookmark-wrap'
                  onChange={value => {
                    value = value.replace(/&lt;!--td.*}--><br>/, '')
                    value = value.replace(/<br>.*}<br>/, '')
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                    let arrayCopy = [...dataArray]
                    arrayCopy[index].bookmark = value
                    setAttributes({ dataArray: arrayCopy })
                  }}
                />
              )}
              {data.option !== 'option-6' ? (
                <div className='image'>
                  <MediaUpload
                    onSelect={media => {
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].media = media.url
                      arrayCopy[index].mediaAlt = media.alt
                      setAttributes({ dataArray: arrayCopy })
                    }}
                    type='image'
                    render={({ open }) => {
                      if (data.media) {
                        return (
                          <Fragment>
                            <span
                              onClick={open}
                              className='dashicons dashicons-edit edit-image'
                            ></span>
                            {'option-2' === data.option && (
                              <span
                                className='dashicons dashicons-no-alt remove'
                                onClick={() => {
                                  let arrayCopy = [...dataArray]
                                  arrayCopy[index].media = ''
                                  arrayCopy[index].mediaAlt = ''
                                  setAttributes({ dataArray: arrayCopy })
                                }}
                              ></span>
                            )}
                            
                            <img src={data.media} alt={data.alt} />
                          </Fragment>
                        )
                      } else {
                        return (
                          <Button onClick={open} className='button button-large'>
                            <span className='dashicons dashicons-upload'></span>{' '}
                            Upload Image
                          </Button>
                        )
                      }
                    }}
                  />
                </div>
              ) : null}
              {data.option == 'option-2' ? (
                <div className='video-icon'>
                <MediaUpload
                    onSelect={media => {
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].videoIcon = media.url
                      setAttributes({ dataArray: arrayCopy })
                    }}
                    type='image'
                    render={({ open }) => {
                      if (data.videoIcon) {
                        return (
                          <Fragment>
                            <span
                              onClick={open}
                              className='dashicons dashicons-edit edit-image'
                            ></span>
                            <span
                                className='dashicons dashicons-no-alt remove'
                                onClick={() => {
                                  let arrayCopy = [...dataArray]
                                  arrayCopy[index].videoIcon = '';
                                  setAttributes({ dataArray: arrayCopy })
                                }}
                              ></span>
                            <img src={data.videoIcon} />
                          </Fragment>
                        )
                      } else {
                        return (
                          <Button
                            onClick={open}
                            className='button button-large'
                          >
                            <span className='dashicons dashicons-upload'></span>
                            Upload Icon
                          </Button>
                        )
                      }
                    }}
                  />
                </div>
              ) : null}
              <div className="related-content-wrap">
                {data.option !== 'option-3' && data.option !== 'option-6' && (
                  <Fragment>
                    <RichText
                      tagName='h2'
                      placeholder={__('Title')}
                      value={data.title}
                      keepPlaceholderOnFocus='true'
                      className='title'
                      onChange={value => {
                        value = value.replace(/&lt;!--td.*}--><br>/, '')
                        value = value.replace(/<br>.*}<br>/, '')
                        value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                        let arrayCopy = [...dataArray]
                        arrayCopy[index].title = value
                        setAttributes({ dataArray: arrayCopy })
                      }}
                    />
                    <RichText
                      tagName='strong'
                      placeholder={__('Sub Title')}
                      value={data.subTitle}
                      keepPlaceholderOnFocus='true'
                      className='sub-title'
                      onChange={value => {
                        value = value.replace(/&lt;!--td.*}--><br>/, '')
                        value = value.replace(/<br>.*}<br>/, '')
                        value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                        let arrayCopy = [...dataArray]
                        arrayCopy[index].subTitle = value
                        setAttributes({ dataArray: arrayCopy })
                      }}
                    />
                  </Fragment>
                )}

                {data.option == 'option-2' && (
                  <Fragment>
                    <RichText
                      tagName='span'
                      placeholder={__('date')}
                      value={data.date}
                      keepPlaceholderOnFocus='true'
                      className='date'
                      onChange={value => {
                        value = value.replace(/&lt;!--td.*}--><br>/, '')
                        value = value.replace(/<br>.*}<br>/, '')
                        value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                        let arrayCopy = [...dataArray]
                        arrayCopy[index].date = value
                        setAttributes({ dataArray: arrayCopy })
                      }}
                    />
                  </Fragment>
                )}
                {data.option == 'option-2' && (
                  <div className="bottom-container">
                    <RichText
                      tagName='div'
                      placeholder={__('Add Reactions')}
                      value={data.shortcode}
                      keepPlaceholderOnFocus='true'
                      className='shortcode-wrap'
                      onChange={value => {
                        value = value.replace(/&lt;!--td.*}--><br>/, '')
                        value = value.replace(/<br>.*}<br>/, '')
                        value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                        let arrayCopy = [...dataArray]
                        arrayCopy[index].shortcode = value
                        setAttributes({ dataArray: arrayCopy })
                      }}
                    />
                    <RichText
                      tagName='div'
                      placeholder={__('Learn More')}
                      value={data.buttonText}
                      keepPlaceholderOnFocus='true'
                      className='button-wrap'
                      onChange={value => {
                        value = value.replace(/&lt;!--td.*}--><br>/, '')
                        value = value.replace(/<br>.*}<br>/, '')
                        value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                        let arrayCopy = [...dataArray]
                        arrayCopy[index].buttonText = value
                        setAttributes({ dataArray: arrayCopy })
                      }}
                    />
                  </div>
                )}
                {( data.option !== 'option-6' && 'option-2' !== data.option ) && (
                  <RichText
                    tagName='div'
                    placeholder={__('Learn More')}
                    value={data.buttonText}
                    keepPlaceholderOnFocus='true'
                    className='button-wrap'
                    onChange={value => {
                      value = value.replace(/&lt;!--td.*}--><br>/, '')
                      value = value.replace(/<br>.*}<br>/, '')
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].buttonText = value
                      setAttributes({ dataArray: arrayCopy })
                    }}
                  />
                )}
                {data.option == 'option-6' && (
                  <label>Shortcode</label>,
                  <RichText
                    tagName='div'
                    placeholder={__('Add Shortcode')}
                    value={data.shortcode}
                    keepPlaceholderOnFocus='true'
                    className='shortcode-wrap'
                    onChange={value => {
                      value = value.replace(/&lt;!--td.*}--><br>/, '')
                      value = value.replace(/<br>.*}<br>/, '')
                      value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].shortcode = value
                      setAttributes({ dataArray: arrayCopy })
                    }}
                  />
                )}
              </div>
            </div>
          </div>
        )
      })

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title='Color Settings'>
              <div className="inspector-field">
                <label>Header Title Color</label>
                <ColorPalette
                    value={headerTitleColor}
                    onChange={(headerTitleColor) =>
                        setAttributes({headerTitleColor})
                    }
                />
              </div>
              <div className="inspector-field">
                <label>Background Color</label>
                <ColorPalette
                    value={backgroundColor}
                    onChange={(backgroundColor) =>
                        setAttributes({backgroundColor})
                    }
                />
              </div>
            </PanelBody>
          </InspectorControls> 
          {popup && (
            <div className='internal-popup'>
              <div className='popup-inner'>
                <span
                  onClick={() => {
                    this.setState({
                      popup: false
                    })
                  }}
                  className='dashicons dashicons-no-alt remove'
                ></span>
                <h3>Select Item Layout:</h3>
                <ul>
                  <li
                    className='option-1'
                    onClick={() => this.addNewItem('option-1')}
                  >
                    Option 1
                  </li>
                  <li
                    className='option-2'
                    onClick={() => this.addNewItem('option-2')}
                  >
                    Option 2
                  </li>
                  <li
                    className='option-3'
                    onClick={() => this.addNewItem('option-3')}
                  >
                    Option 3
                  </li>
                  <li
                    className='option-4'
                    onClick={() => this.addNewItem('option-4')}
                  >
                    Option 4
                  </li>
                  <li
                    className='option-5'
                    onClick={() => this.addNewItem('option-5')}
                  >
                    Option 5
                  </li>
                  <li
                    className='option-6'
                    onClick={() => this.addNewItem('option-6')}
                  >
                    Option 6
                  </li>
                </ul>
              </div>
            </div>
          )}
          <div className='related-content'>
            <div className="related-content-header">
              <RichText
                tagName='h2'
                placeholder={__('Title')}
                value={headerTitle}
                keepPlaceholderOnFocus='true'
                className='header-title'
                style={{color:headerTitleColor}}
                onChange={value => {
                  value = value.replace(/&lt;!--td.*}--><br>/, '')
                  value = value.replace(/<br>.*}<br>/, '')
                  value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                  setAttributes({ headerTitle: value })
                }}
              />
            </div>
            <div className="related-content-body">
              {itemList}
              <div className='item addNewitem'>
                <button
                  className='components-button add'
                  onClick={() => {
                    this.setState({
                      popup: true
                    })
                  }}
                >
                  <span className='dashicons dashicons-plus'></span> Add New Item
                </button>
              </div>
            </div>
          </div>
        </Fragment>
      )
    }
  }

  registerBlockType('rg/related-content', {
    title: __('Related Content multi layout'),
    description: __('Related Content multi layout'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Related Content'), __('gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      headerTitle: {
        type: 'string',
        default: ''
      },
      headerTitleColor: {
        type: 'string',
        default: '#fdd80f'
      },
      backgroundColor: {
        type: 'string',
        default: '#303030'
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props
      const { dataArray, headerTitle, headerTitleColor, backgroundColor } = attributes

      return (
        <Fragment>
          <div className='related-content'>
            <div className="related-content-header">
              {headerTitle && (
                <RichText.Content
                  tagName='h2'
                  value={headerTitle}
                  className='header-title'
                  style={{color:headerTitleColor}}
                />
              )}
            </div>
            <div className="related-content-body">
              {dataArray.map((data, index) => (
                <div className={`item ${data.option}`}>
                  <div className="inner" style={{backgroundColor:backgroundColor}}>
                    {data.bgMedia && data.option == 'option-1' || data.option == 'option-4' ? (
                      <div className='background-image'>
                        <img src={data.bgMedia} />
                      </div>
                    ) : null}
                    {data.option == 'option-1' || data.option == 'option-3' || data.option == 'option-6' ? (
                        <div className='advertising'>
                          <RichText.Content tagName='span' value={data.advertising} />
                        </div>
                      ) : null}
                    {data.media && (
                      <div className='image'>
                        <img src={data.media} alt={data.mediaAlt} />
                      </div>
                    )}
                    {('option-2' === data.option && data.bookmark) && (
                      <RichText.Content
                        tagName='div'
                        value={data.bookmark}
                        className='bookmark-wrap'
                      />
                    )}
                    {data.videoIcon && (
                      <div className='video-icon'>
                        <img src={data.videoIcon} alt={data.videoIcon} />
                      </div>
                    )}
                    <div className="related-content-wrap">
                      {data.option !== 'option-3' && data.option !== 'option-6' && (
                        <Fragment>
                          {data.title && (
                            <RichText.Content
                              tagName='h2'
                              value={data.title}
                              className='title'
                            />
                          )}
                          {data.subTitle && (
                            <RichText.Content
                              tagName='strong'
                              value={data.subTitle}
                              className='sub-title'
                            />
                          )}
                        </Fragment>
                      )}
                      {data.date && data.option == 'option-2' && (
                        <Fragment>
                          <RichText.Content
                            tagName='span'
                            value={data.date}
                            className='date'
                          />
                        </Fragment>
                      )}
                      {data.option == 'option-2' && (
                        <div className="bottom-container">
                          {data.shortcode &&
                            <RichText.Content
                              tagName='div'
                              value={data.shortcode}
                              className='shortcode-wrap'
                            />
                          }
                          <RichText.Content
                            tagName='div'
                            value={data.buttonText}
                            className='button-wrap'
                          />
                        </div>
                      )}
                      {(data.option !== 'option-6' && data.option !== 'option-2') && (
                        <RichText.Content
                          tagName='div'
                          value={data.buttonText}
                          className='button-wrap'
                        />
                      )}
                      {data.option == 'option-6' && (
                        <RichText.Content
                          tagName='div'
                          value={data.shortcode}
                          className='shortcode-wrap'
                        />
                      )}
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </Fragment>
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor)
