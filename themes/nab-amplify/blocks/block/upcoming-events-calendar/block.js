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
    componentDidMount () {
      const { dataArray } = this.props.attributes
      if (0 === dataArray.length) {
        this.initList()
      }
    }

    initList () {
      const { dataArray } = this.props.attributes
      const { setAttributes } = this.props
      setAttributes({
        dataArray: [
          ...dataArray,
          {
            index: dataArray.length,
            title: '',
            subTitle: '',
            description: '',
            media: '',
            mediaAlt: ''
          }
        ]
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
      const { dataArray, headerTitle, headerTitleColor, headerLink, headerLinkColor, backgroundColor } = attributes

      const getImageButton = (openEvent, index) => {
        if (dataArray[index].media) {
          return (
            <Fragment>
              <span
                onClick={openEvent}
                className='dashicons dashicons-edit edit-image'
              ></span>
              <img
                src={dataArray[index].media}
                alt={dataArray[index].title}
                className='img'
              />
            </Fragment>
          )
        } else {
          return (
            <Button onClick={openEvent} className='button button-large'>
              <span className='dashicons dashicons-upload'></span> Upload Image
            </Button>
          )
        }
      }

      const itemList = dataArray.map((data, index) => {
        return (
          <div className='item'>
            <div className='settings'>
              <div className="move-item-controls">
                {0 < index && (
                  <Tooltip text='Move Left'>
                    <span
                      className='dashicons dashicons-arrow-left-alt2 item-move-left'
                      onClick={() => this.moveItem(index, index - 1)}
                    ></span>
                  </Tooltip>
                )}
                {index + 1 < dataArray.length && (
                  <Tooltip text='Move Right'>
                    <span
                      className='dashicons dashicons-arrow-right-alt2 item-move-right'
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
              <div className='left'>
                <MediaUpload
                  onSelect={media => {
                    let arrayCopy = [...dataArray]
                    arrayCopy[index].media = media.url
                    setAttributes({ dataArray: arrayCopy })
                  }}
                  type='image'
                  value={attributes.imageID}
                  render={({ open }) => getImageButton(open, index)}
                />
              </div>
              <div className='right'>
                <RichText
                  tagName='h3'
                  placeholder={__('Title')}
                  keepPlaceholderOnFocus='true'
                  value={data.title}
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
                  keepPlaceholderOnFocus='true'
                  value={data.subTitle}
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
                <RichText
                  tagName='p'
                  placeholder={__('Description')}
                  value={data.description}
                  keepPlaceholderOnFocus='true'
                  className='description'
                  onChange={value => {
                    value = value.replace(/&lt;!--td.*}--><br>/, '')
                    value = value.replace(/<br>.*}<br>/, '')
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                    let arrayCopy = [...dataArray]
                    arrayCopy[index].description = value
                    setAttributes({ dataArray: arrayCopy })
                  }}
                />
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
                <label>Title Color</label>
                <ColorPalette
                    value={headerTitleColor}
                    onChange={(headerTitleColor) =>
                        setAttributes({headerTitleColor})
                    }
                />
              </div>
              <div className="inspector-field">
                <label>Link Color</label>
                <ColorPalette
                    value={headerLinkColor}
                    onChange={(headerLinkColor) =>
                        setAttributes({headerLinkColor})
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
          <div className='upcoming-events-calendar'>
            <div className='upcoming-events-header'>
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
                <RichText
                  tagName='span'
                  placeholder={__('View All')}
                  value={headerLink}
                  keepPlaceholderOnFocus='true'
                  className='header-link'
                  style={{color:headerLinkColor}}
                  onChange={value => {
                    value = value.replace(/&lt;!--td.*}--><br>/, '')
                    value = value.replace(/<br>.*}<br>/, '')
                    value = value.replace(/<br><br><br>&lt.*--><br>/, '')
                    setAttributes({ headerLink: value })
                  }}
                />
            </div>
            <div className='upcoming-events-body'>
              {itemList}
              <div className='item additem'>
                <button
                  className='components-button add'
                  onClick={content => {
                    setAttributes({
                      dataArray: [
                        ...dataArray,
                        {
                          index: dataArray.length,
                          title: '',
                          subTitle: '',
                          description: '',
                          media: ''
                        }
                      ]
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

  registerBlockType('rg/upcoming-events-calendar', {
    title: __('Upcoming Events Calendar'),
    description: __('upcoming-events-calendar'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Upcoming Events Calendar'), __('Gutenberg')],
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
      headerLink: {
        type: 'string',
        default: '<a href="#" class="view-all">View All</a>'
      },
      headerLinkColor: {
        type: 'string',
        default: '#999'
      },
      backgroundColor: {
        type: 'string',
        default: '#333'
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes  } = props
      const { dataArray, headerTitle, headerTitleColor, headerLink, headerLinkColor, backgroundColor } = attributes

      return (
        <Fragment>
          <div className='upcoming-events-calendar'>
            <div className='upcoming-events-header'>
              {headerTitle && (
                <RichText.Content
                  tagName='h2'
                  value={headerTitle}
                  className='header-title'
                  style={{color:headerTitleColor}}
                />
              )}
              {headerLink && (
                <RichText.Content
                  tagName='span'
                  value={headerLink}
                  className='header-link'
                  style={{color:headerLinkColor}}
                />
              )}
            </div>
            <div className='upcoming-events-body'>
              {dataArray.map((data, index) => (
                <Fragment>
                  {data.title && (
                    <div className='item'>
                      <div className='inner' style={{backgroundColor:backgroundColor}}>
                        <div className='left'>
                          {data.media ? (
                            <img src={data.media} alt={data.title} />
                          ) : (
                            <div className='no-image'>No Image</div>
                          )}
                        </div>
                        <div className='right'>
                          {data.title && (
                            <RichText.Content
                              tagName='h3'
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
                          {data.description && (
                            <RichText.Content
                              tagName='p'
                              value={data.description}
                              className='description'
                            />
                          )}
                        </div>
                      </div>
                    </div>
                  )}
                </Fragment>
              ))}
            </div>
          </div>
        </Fragment>
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor)
