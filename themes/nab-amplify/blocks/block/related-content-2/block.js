(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
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
  } = wpComponents;

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
            buttonText: '<a href="#">Read More</a>',
            shortcode: '',
            bookmark: ''
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

      const itemList = dataArray.map((data, index) => {
        return (
          <div className={`item`}>
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
            <div className='inner'>
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
        )
      })

      return (
        <Fragment>
          {/* <InspectorControls>
            <PanelBody title='General Settings'>
              <PanelRow>Test</PanelRow>
            </PanelBody>
          </InspectorControls> */}
          <div className='related-content-2'>
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

  registerBlockType('rg/related-content-2', {
    title: __('Related Content'),
    description: __('Related Content'),
    icon: 'editor-code',
    category: 'nab_amplify',
    keywords: [__('Related Content 2'), __('Gutenberg')],
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
          <div className='related-content-2'>
            {dataArray.map((data, index) => (
              <div className={`item`}>
                <div className='inner'>
                  {data.bookmark &&
                    <RichText.Content
                      tagName='div'
                      value={data.bookmark}
                      className='bookmark-wrap'
                    />
                  } 
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
                </div>
              </div>
            ))}
          </div>
        </Fragment>
      )
    }
  })
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element)