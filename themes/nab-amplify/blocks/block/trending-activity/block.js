;(function (wpBlocks, wpBlockEditor, wpComponents, wpElement, wpI18n) {
  const { registerBlockType } = wpBlocks
  const { Component, Fragment, useState } = wpElement
  const { __ } = wpI18n
  const {
    RichText,
    InspectorControls,
    MediaUpload,
    AlignmentToolbar,
    InnerBlocks
  } = wpBlockEditor
  const {
    PanelBody,
    PanelRow,
    ServerSideRender,
    CheckboxControl,
  } = wpComponents

  class trendingActivity extends Component {
    constructor () {
      super(...arguments)
      this.state = {
        postTypeList: [],
        checkedItems:[]
      }
    }

    componentWillMount () {
      let postTypeKey,
        postOptions = [],
        excludePostTypes = ['attachment', 'wp_block', 'page', 'template','post']

      // Fetch all post types
      wp.apiFetch({ path: '/wp/v2/types' }).then(postTypes => {
        postTypeKey = Object.keys(postTypes).filter(
          postType => !excludePostTypes.includes(postType)
        )

        postTypeKey.forEach(function (key) {
          postOptions.push({
            label: __(postTypes[key].name),
            value: __(postTypes[key].slug)
          })
        })
        this.setState({ postTypeList: postOptions })
      })
    }

    componentDidUpdate (previousProps, previousState) {}

    render () {
      const { attributes, setAttributes, clientId } = this.props
      const {
      attributes: { checkedItems }
      } = this.props
      // multiple checkbox control for taxonomies
      const MyCheckboxControl = props => {
        const [isChecked, setChecked] = useState(false)

        return (
          <CheckboxControl
            name='nab_trending_post_types[]'
            label={props.label}
            checked={attributes.checkedItems.indexOf(props.value) > -1}
            onChange={isChecked => {
              let index,
                temppostType = [...checkedItems]

              if (isChecked) {
                temppostType.push(props.value)

                setAttributes({ checkedItems: temppostType })
                this.setState({ checkedItems: temppostType })
              } else {
                index = temppostType.indexOf(props.value)
                temppostType.splice(index, 1)
                setAttributes({ checkedItems: temppostType })
                this.setState({ checkedItems: temppostType })
              }
            }}
            value={props.value}
          />
        )
      }
      return (
        <div>
          <Fragment>
            <InspectorControls>
              <PanelBody
                title={__('Settings')}
                initialOpen={true}
                className='range-setting'
              >
                <PanelRow>
                  {0 < this.state.postTypeList.length && (
                    <div>
                      <label
                        className='components-base-control__label'
                        for='inspector-select-control-2'
                      >
                        Select Content Type
                      </label>
                      <div className='editor-post-taxonomies__hierarchical-terms-choice'>
                        <ul>
                          {Object.keys(this.state.postTypeList).map(key => {
                            return (
                              <li>
                                <MyCheckboxControl
                                  label={this.state.postTypeList[key].label}
                                  value={this.state.postTypeList[key].value}
                                />
                              </li>
                            )
                          })}
                        </ul>
                      </div>
                    </div>
                  )}
                </PanelRow>
              </PanelBody>
            </InspectorControls>
          </Fragment>
          <div id='trending_activity' className='nab-trending-activity'>
            <ServerSideRender block='amplify/trendingactivity'  attributes={{
              checkedItems: attributes.checkedItems}}/>
          </div>
        </div>
      )
    }
  }
  registerBlockType('amplify/trendingactivity', {
    // built in attributes
    title: 'Trending Activity',
    description:
      'Shows Latest trennding post based on most reactions achieved.',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      postTypeList: {
        type: 'array',
        default: []
      },
      checkedItems: {
        type: 'array',
        default: []
      }
    },
    edit: trendingActivity,
    save () {
      return null
    }
  })
})(wp.blocks, wp.blockEditor, wp.components, wp.element, wp.i18n)
