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
    Button,
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
            bgMedia: '',
            buttonText: '<a href="#" class="btn">Read More</a>'
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
      const { attributes, setAttributes, clientId } = this.props
      const { dataArray } = attributes
      setAttributes({ blockClientId: clientId })

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
                      className='dashicons dashicons-arrow-up-alt2'
                      onClick={() => this.moveItem(index, index - 1)}
                    ></span>
                  </Tooltip>
                )}
                {index + 1 < dataArray.length && (
                  <Tooltip text='Move Right'>
                    <span
                      className='dashicons dashicons-arrow-down-alt2'
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
            <div className='inner'>
             
              <div className='main-image'>
                <div className="main-image-wrap">
                  <MediaUpload
                    onSelect={media => {
                      let arrayCopy = [...dataArray]
                      arrayCopy[index].bgMedia = media.url
                      setAttributes({ dataArray: arrayCopy })
                    }}
                    type='image'
                    value={attributes.imageID}
                    render={({ open }) => {
                      if (dataArray[index].bgMedia) {
                        return (
                          <Fragment>
                            <span
                              onClick={open}
                              className='dashicons dashicons-edit edit-image'
                            ></span>
                            <img src={dataArray[index].bgMedia} className='img' />
                          </Fragment>
                        )
                      } else {
                        return (
                          <Button onClick={open} className='button button-large'>
                            <span className='dashicons dashicons-upload'></span>{' '}
                            Upload Main Image
                          </Button>
                        )
                      }
                    }}
                  />
                </div>
              </div>
              <div className="item-list-right">
                <div className="item-list-main">
                  <div className="item-list-wrap">
                    <style>
                      {`#block-${clientId} .grid-list .item.active .left{background:${attributes.ThumbBgColor}}`}
                    </style>
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
                        style={{
                          color:attributes.TitleColor
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
                        style={{
                          color:attributes.SubTitleColor
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
                        style={{
                          color:attributes.DescriptionColor
                      }}
                      />
                      <RichText
                        tagName='div'
                        placeholder={__('Read More')}
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        )
      })

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title="Color Settings" initialOpen={false}>
              <div className="inspector-field">
                  <label>Header Title Color:</label>
                  <ColorPalette
                      value={attributes.HeaderTitleColor}
                      onChange={(HeaderTitleColor) =>
                          setAttributes({HeaderTitleColor:HeaderTitleColor})
                      }
                  />
              </div>
              <div className="inspector-field">
                  <label>Title Color:</label>
                  <ColorPalette
                      value={attributes.TitleColor}
                      onChange={(TitleColor) =>
                          setAttributes({TitleColor:TitleColor})
                      }
                  />
              </div>
              <div className="inspector-field">
                  <label>Sub-Title Color:</label>
                  <ColorPalette
                      value={attributes.SubTitleColor}
                      onChange={(SubTitleColor) =>
                          setAttributes({SubTitleColor:SubTitleColor})
                      }
                  />
              </div>
              <div className="inspector-field">
                  <label>Description text Color:</label>
                  <ColorPalette
                      value={attributes.DescriptionColor}
                      onChange={(DescriptionColor) =>
                          setAttributes({DescriptionColor:DescriptionColor})
                      }
                  />
              </div>
              <div className="inspector-field">
                  <label>Active Thumbnail Background:</label>
                  <ColorPalette
                      value={attributes.ThumbBgColor}
                      onChange={(ThumbBgColor) =>
                          setAttributes({ThumbBgColor:ThumbBgColor})
                      }
                  />
              </div>
              
            </PanelBody>
          </InspectorControls>
          <div className='community-curator'>
            <div className='community-curator-header'>
              <RichText
                  tagName='h2'
                  placeholder={__('Title')}
                  keepPlaceholderOnFocus='true'
                  value={attributes.HeaderTitle}
                  className='title'
                  onChange={value => {
                    setAttributes({ HeaderTitle: value })
                  }}
                  style={{
                    color:attributes.HeaderTitleColor
                }}
                />
            </div>
            <div className="community-curator-body">
              {itemList}
              <div className='item additem'>
                <button
                  className='components-button add'
                  onClick={() => {
                    this.initList()
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

  registerBlockType('rg/community-curator', {
    title: __('Community Curator'),
    description: __('community-curator'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Community Curator'), __('Gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      TitleColor:{
        type: 'string',
        default: '#fff'
      },
      SubTitleColor:{
        type:'string',
        default:'#0ca5ea'
      },
      DescriptionColor:{
        type:'string',
        default:'#fff'
      },
      ThumbBgColor:{
        type:'string',
        default:'#0ca5ea'
      },
      HeaderTitle:{
        type:'string',
        default:''
      },
      HeaderTitleColor:{
        type:'string',
        default:'#fdd80f'
      },
      blockClientId:{
        type:'string',
        default:''
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props
      const { dataArray } = attributes

      return (
        <div className='community-curator' id={'block-'+attributes.blockClientId}>
          <div className="community-curator-header">
            <RichText.Content
                tagName='h2'
                value={attributes.HeaderTitle}
                style={{color:attributes.HeaderTitleColor}}
              />
          </div>
          <div className="community-curator-body">
            <div
              className='big-section'
              style={{
                backgroundImage: `url(${dataArray[0].bgMedia})`
              }}
            >
              <div className='contents'>
                {dataArray[0].title && (
                  <RichText.Content
                    tagName='h3'
                    value={dataArray[0].title}
                    className='title'
                    style={{
                      color:attributes.TitleColor
                    }}
                  />
                )}
                {dataArray[0].subTitle && (
                  <RichText.Content
                    tagName='strong'
                    value={dataArray[0].subTitle}
                    className='sub-title'
                    style={{
                      color:attributes.SubTitleColor
                    }}
                  />
                )}
                {dataArray[0].description && (
                  <RichText.Content
                    tagName='p'
                    value={dataArray[0].description}
                    className='description'
                    style={{
                      color:attributes.DescriptionColor
                    }}
                  />
                )}
                {dataArray[0].buttonText && (
                  <RichText.Content
                    tagName='div'
                    value={dataArray[0].buttonText}
                    className='button-wrap'
                  />
                )}
              </div>
            </div>
            <div className='grid-list'>
            {dataArray.map((data, index) => (
              <Fragment>
                {data.title && (
                  <div className={`item ${index == 0 ? 'active' : ''}`}>
                    <div className='inner'>
                      {data.bgMedia ? (
                          <div className="main-image-wrap">
                            <img className='main-image' src={data.bgMedia} alt={data.title} style={{
                              display: 'none'
                            }} />
                          </div>
                        ) : null }
                      <div className="item-list-right">
                        <div className="item-list-main">
                          <div className="item-list-wrap">
                            <style>
                            {`#block-${attributes.blockClientId} .grid-list .item.active .left{background:${attributes.ThumbBgColor}}`}
                            </style>
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
                                  style={{
                                    color:attributes.TitleColor
                                  }}
                                />
                              )}
                              {data.subTitle && (
                                <RichText.Content
                                  tagName='strong'
                                  value={data.subTitle}
                                  className='sub-title'
                                  style={{
                                    color:attributes.SubTitleColor
                                  }}
                                />
                              )}
                              {data.description && (
                                <RichText.Content
                                  tagName='p'
                                  value={data.description}
                                  className='description'
                                  style={{
                                    color:attributes.DescriptionColor
                                  }}
                                />
                              )}
                              {data.buttonText && (
                                <RichText.Content
                                  tagName='div'
                                  value={data.buttonText}
                                  className='button-wrap'
                                />
                              )}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                )}
              </Fragment>
            ))}
          </div>
          </div>
        </div>
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element, wp.blockEditor)
