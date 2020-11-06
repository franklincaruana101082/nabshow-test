import times from 'lodash/times'
import memoize from 'memize'
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
  const { createBlock } = wp.blocks
  const { getBlock } = wp.data.select('core/block-editor')
  const { insertBlock } = wp.data.dispatch('core/block-editor')
  const {
    PanelBody,
    PanelRow,
    Button,
    RangeControl,
    ToggleControl,
    ServerSideRender,
    ColorPicker,
    BaseControl,
    FontSizePicker,
    ColorPalette,
    BoxControl
  } = wpComponents

  class amplifyTabs extends Component {
    constructor () {
      super(...arguments)
      this.state = {
        tabs: []
      }
    }

    reInitTabs () {
      setTimeout(() => {
        jQuery('#tabs').tabs('refresh')
      }, 500)
    }

    InitTabs () {
      setTimeout(() => {
        jQuery('#tabs').tabs()
      }, 500)
    }

    componentWillMount () {
      this.InitTabs()
    }

    componentDidUpdate (previousProps, previousState) {
      const { tabs } = this.props.attributes
      const { clientId } = this.props
      this.props.setAttributes({ tabsCount: tabs.length })
      this.props.setAttributes({ amplifyTabBlockid: clientId })
      
    }
    makeid (length) {
      var result = ''
      var characters =
        '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
      var charactersLength = 20
      for (var i = 0; i < length; i++) {
        result += characters.charAt(
          Math.floor(Math.random() * charactersLength)
        )
      }
      return result
    }
    removeTab (e, index) {
      if (confirm('Are you sure want to delete?')) {
        e.preventDefault()
        const { tabs } = this.props.attributes
        let tempTabs = [...tabs]
        tempTabs.splice(index, 1)
        this.props.setAttributes({ tabs: tempTabs })
        this.reInitTabs()
      }
    }

    insertTab (newBlock) {
      const { clientId } = this.props
      const block = getBlock(clientId)
      insertBlock(newBlock, parseInt(block.innerBlocks.length), clientId)
    }

    render () {
      const { attributes, setAttributes, clientId } = this.props
      const fontSizes = [
        {
          name: __('Small'),
          slug: 'small',
          size: 12
        },
        {
          name: __('Big'),
          slug: 'big',
          size: 26
        }
      ]
      const fallbackFontSize = 16
      const colors = [
        { name: 'blue', color: '#0ca5ea' },
        { name: 'yellow', color: '#fdd80f' },
        { name: 'white', color: '#fff' },
        { name: 'light black', color: '#383838' },
        { name: 'pink', color: '#e5018b' }
      ]

      const updateTab = (contentSrc, data, index) => {
        const { tabs } = this.props.attributes
        let tempTabs = [...tabs]
        if (contentSrc === 'tabTitle') {
          tempTabs[index].tabTitle = data
        }
        if (contentSrc === 'tabContent') {
          tempTabs[index].tabContent = data
        }
        this.props.setAttributes({ tabs: tempTabs })
        this.reInitTabs()
      }

      const addTab = () => {
        const { tabs, tabsCount } = this.props.attributes
        let tempTabs = [...tabs]
        let newtabId = this.makeid(10)
        tempTabs.push({ tabId: newtabId, tabTitle: 'new tab', tabContent: '' })
        this.props.setAttributes({ tabs: tempTabs })
        this.setState({ tabs: tempTabs })
        const newBlock = createBlock('amplify/amplifyinnerblock', {
          id: tabsCount + 1
        })
        this.props.setAttributes({ tabsCount: tabsCount + 1 })
        this.insertTab(newBlock)
        this.reInitTabs()
      }

      const tabLiStyle = {
        background: attributes.tabActiveColor
      }

      const annchorStyle = {
        color: attributes.tabanchorColor
      }

      const ALLOWED_BLOCKS = ['amplify/amplifyinnerblock']

      const getPanesTemplate = memoize(columns => {
        return times(columns, n => ['amplify/amplifyinnerblock', { id: n + 1 }])
      })

      const renderCSS = (
        <style>
          {`.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
    border: 1px solid #003eff;
    background:${attributes.tabActiveBg} !important;
    font-weight: normal;
    color: ${attributes.tabActiveTitleColor} !important;
}
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
  color: ${attributes.tabActiveTitleColor} !important;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
  border: 1px solid #c5c5c5;
  background:${attributes.tabInActiveBg};
}
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
  color: ${attributes.tabInActiveTitleColor}
}
.ui-tabs-nav{
  background: none;
    border: none;
    border-bottom: 1px solid ${attributes.panelBorderColor} !important;
    padding: 0 !important;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
  border-bottom-left-radius: 0px !important;
}
.amplify-tabs{
  border:${
    attributes.panelBorderSize ? attributes.panelBorderSize : '4'
  }px solid ${attributes.panelBorderColor}
}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor {
  font-size: ${attributes.tabFontSize ? attributes.tabFontSize : '14'}px;
}
`}
        </style>
      )

      return (
        <div>
          {renderCSS}
          <Fragment>
            <InspectorControls>
              <PanelBody
                title={__('Tabs Color ')}
                initialOpen={true}
                className='range-setting'
              >
                <PanelRow>
                  <BaseControl
                    id='active-tab-background'
                    label='Active Tab Background'
                    help='Set Active tab background color'
                  >
                    <ColorPalette
                      colors={colors}
                      value={attributes.tabActiveBg}
                      onChange={newval =>
                        setAttributes({ tabActiveBg: newval })
                      }
                    />
                  </BaseControl>
                </PanelRow>
                <PanelRow>
                  <BaseControl
                    id='active-tab-title-color'
                    label='Active Tab Title Color'
                    help='Set Active tab Title color'
                  >
                    <ColorPalette
                      colors={colors}
                      value={attributes.tabActiveTitleColor}
                      onChange={newval =>
                        setAttributes({ tabActiveTitleColor: newval })
                      }
                    />
                  </BaseControl>
                </PanelRow>
                <PanelRow>
                  <BaseControl
                    id='inactive-tab-background'
                    label='InActive Tab Background'
                    help='Set InActive tab background color'
                  >
                    <ColorPalette
                      colors={colors}
                      value={attributes.tabInActiveBg}
                      onChange={newval =>
                        setAttributes({ tabInActiveBg: newval })
                      }
                    />
                  </BaseControl>
                </PanelRow>
                <PanelRow>
                  <BaseControl
                    id='inactive-title-color'
                    label='InActive Tab Title Color'
                    help='Set InActive tab Title color'
                  >
                    <ColorPalette
                      colors={colors}
                      value={attributes.tabInActiveTitleColor}
                      onChange={newval =>
                        setAttributes({ tabInActiveTitleColor: newval })
                      }
                    />
                  </BaseControl>
                </PanelRow>
                <PanelRow>
                  <BaseControl
                    id='panel-border-color'
                    label='Panel border Color'
                    help='Set Border color'
                  >
                    <ColorPalette
                      colors={colors}
                      value={attributes.panelBorderColor}
                      onChange={newval =>
                        setAttributes({ panelBorderColor: newval })
                      }
                    />
                  </BaseControl>
                </PanelRow>
              </PanelBody>
              <PanelBody
                title={__('Tabs Typography ')}
                initialOpen={true}
                className='range-setting'
              >
                <PanelRow>
                  <BaseControl
                    id='panel-border-size'
                    label='Panel border Size'
                    help='Set Panel Border Size'
                  >
                    <FontSizePicker
                      fontSizes={fontSizes}
                      value={attributes.panelBorderSize}
                      fallbackFontSize={fallbackFontSize}
                      onChange={newBorderSize => {
                        setAttributes({
                          panelBorderSize: parseInt(newBorderSize)
                        })
                      }}
                    />
                  </BaseControl>
                </PanelRow>
                <PanelRow>
                  <BaseControl
                    id='panel-font-size'
                    label='Tab Font Size'
                    help='Set Tab Font Size'
                  >
                    <FontSizePicker
                      fontSizes={fontSizes}
                      value={attributes.tabFontSize}
                      fallbackFontSize={fallbackFontSize}
                      onChange={newFontSize => {
                        setAttributes({
                          tabFontSize: parseInt(newFontSize)
                        })
                      }}
                    />
                  </BaseControl>
                </PanelRow>
              </PanelBody>
            </InspectorControls>
          </Fragment>
          <div id='tabs' className='backend_tab'>
            <ul>
              {attributes.tabs.map((tab, index) => (
                <li>
                  <span
                    onClick={e => this.removeTab(e, index)}
                    className='dashicons dashicons-no-alt remove'
                  ></span>
                  <a href={'#tab_' + `${index + 1}`}>
                    <RichText
                      tagName='h4' // The tag here is the element output and editable in the admin
                      value={tab.tabTitle} // Any existing content, either from the database or an attribute default
                      onChange={tabTitle =>
                        updateTab('tabTitle', tabTitle, index)
                      } // Store updated content as a block attribute
                      placeholder='tab title' // Display this text before any content has been added by the user
                    />
                  </a>
                </li>
              ))}

              <li className='additem'>
                <button className='add' onClick={addTab}>
                  <span class='dashicons dashicons-plus-alt2'></span>
                </button>
              </li>
            </ul>
            <div id={`${attributes.amplifyTabBlockid}-amplify-tabs`} class="amplify-tabs">
              <InnerBlocks
                template={getPanesTemplate(attributes.tabsCount)}
                templateLock={false}
                allowedBlocks={ALLOWED_BLOCKS}
              />
            </div>
          </div>
        </div>
      )
    }
  }
  registerBlockType('amplify/tabs', {
    // built in attributes
    title: 'Tabs',
    description: 'Tab Block',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      content: {
        type: 'string',
        default: ''
      },
      tabs: {
        type: 'array',
        default: [{ tabId: 'sdsd65asda', tabTitle: 'Tab 1', tabContent: '' }]
      },
      tabTitle: {
        type: 'string',
        default: ''
      },
      tabContent: {
        type: 'string',
        default: ''
      },
      tabActiveBg: {
        type: 'string',
        default: '#0ca5ea'
      },
      tabActiveTitleColor: {
        type: 'string',
        default: '#404040'
      },
      tabsCount: {
        type: 'number',
        default: 1
      },
      tabInActiveBg: {
        type: 'string',
        default: '#383838'
      },
      tabInActiveTitleColor: {
        type: 'string',
        default: '#ffffff'
      },
      panelBorderColor: {
        type: 'string',
        default: '#0ca5ea'
      },
      panelBorderSize: {
        type: 'string',
        default: 4
      },
      tabFontSize: {
        type: 'number',
        default: 20
      },
      amplifyTabBlockid: {
        type: 'string',
        default: ''
      }
    },
    edit: amplifyTabs,
    save (props) {
      const { attributes, setAttributes, clientId } = props
      const renderCSS = (
        <style>
          {`.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
    border: 1px solid #003eff;
    background:${attributes.tabActiveBg} !important;
    font-weight: normal;
    color: ${attributes.tabActiveTitleColor} !important;
}
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
  color: ${attributes.tabActiveTitleColor} !important;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
  border: 1px solid #c5c5c5;
  background:${attributes.tabInActiveBg};
}
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited, a.ui-button, a:link.ui-button, a:visited.ui-button, .ui-button {
  color: ${attributes.tabInActiveTitleColor}
}
.ui-tabs-nav{
  background: none;
    border: none;
    border-bottom: 1px solid ${attributes.panelBorderColor} !important;
    padding: 0 !important;
}
.ui-widget.ui-widget-content {
  border: none;
}
.amplify-tabs{
  border:${
    attributes.panelBorderSize ? attributes.panelBorderSize : '4'
  }px solid ${attributes.panelBorderColor}
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
  border-bottom-left-radius: 0px !important;
}
.ui-tabs .ui-tabs-nav .ui-tabs-anchor {
  font-size: ${attributes.tabFontSize ? attributes.tabFontSize : '15'}px;
}
`}
        </style>
      )

      return (
        <div id={clientId}>
          {renderCSS}
          <div id='tabs' className='backend_tab'>
            <ul>
              {attributes.tabs.map((tab, index) => (
                <li>
                  <a href={'#tab_' + `${index + 1}`}>{tab.tabTitle}</a>
                </li>
              ))}
            </ul>

            <div id={`${attributes.amplifyTabBlockid}-amplify-tabs`} class="amplify-tabs">
              <InnerBlocks.Content />
            </div>
          </div>
        </div>
      )
    }
  })
  registerBlockType('amplify/amplifyinnerblock', {
    // ...
    parent: ['amplify/tabs'],
    title: 'Amplify Inner block',
    description: 'Amplify Inner block',
    icon: 'editor-code',
    category: 'nab_amplify',
    attributes: {
      id: {
        type: 'number',
        default: 1
      },
      text: {
        type: 'number',
        default: 0
      }
    },

    edit (props) {
      const { attributes } = props
      return (
        <div className={props.className} id={`tab_${attributes.id}`}>
          <InnerBlocks templateLock={false} />
        </div>
      )
    },

    save (props) {
      const { attributes } = props
      return (
        <div className={props.className} id={`tab_${attributes.id}`}>
          <InnerBlocks.Content />
        </div>
      )
    }
  })
})(wp.blocks, wp.blockEditor, wp.components, wp.element, wp.i18n)
