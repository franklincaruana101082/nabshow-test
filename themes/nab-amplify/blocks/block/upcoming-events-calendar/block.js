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
      const { dataArray } = attributes

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
            <div className='inner'>
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
          <div className='upcoming-events-calendar'>
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
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props
      const { dataArray } = attributes

      return (
        <Fragment>
          <div className='upcoming-events-calendar'>
            {dataArray.map((data, index) => (
              <Fragment>
                {data.title && (
                  <div className='item'>
                    <div className='inner'>
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
        </Fragment>
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element)
