;(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
            bgMedia: ''
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
      const { dataArray } = attributes

      const getImageButton = (openEvent, index) => {
        if (dataArray[index].media) {
          return (
            <Fragment>
              <span
                onClick={openEvent}
                className='dashicons dashicons-edit'
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
              {0 < index && (
                <Tooltip text='Move Left'>
                  <span
                    className='dashicons dashicons-arrow-left-alt2'
                    onClick={() => this.moveItem(index, index - 1)}
                  ></span>
                </Tooltip>
              )}
              {index + 1 < dataArray.length && (
                <Tooltip text='Move Right'>
                  <span
                    className='dashicons dashicons-arrow-right-alt2'
                    onClick={() => this.moveItem(index, index + 1)}
                  ></span>
                </Tooltip>
              )}
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
                            className='dashicons dashicons-edit'
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
            <PanelBody title='General Settings'>
              <PanelRow>Test</PanelRow>
            </PanelBody>
          </InspectorControls>
          <div className='community-curator'>
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
        </Fragment>
      )
    }
  }

  registerBlockType('rg/community-curator', {
    title: __('Community Curator'),
    description: __('community-curator'),
    icon: 'heart',
    category: 'common',
    keywords: [__('Community Curator'), __('Gutenberg')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props
      const { dataArray } = attributes

      return (
        <div className='community-curator'>
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
                />
              )}
              {dataArray[0].subTitle && (
                <RichText.Content
                  tagName='strong'
                  value={dataArray[0].subTitle}
                  className='sub-title'
                />
              )}
              {dataArray[0].description && (
                <RichText.Content
                  tagName='p'
                  value={dataArray[0].description}
                  className='description'
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
                          <img className='main-image' src={data.bgMedia} alt={data.title} style={{
                            display: 'none'
                          }} />
                        ) : null }
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
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element)
