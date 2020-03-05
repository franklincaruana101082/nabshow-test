(function(wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText, InspectorControls } = wpEditor;
  const { PanelBody, PanelRow, ToggleControl, Tooltip, DropdownMenu, MenuGroup, MenuItem, CheckboxControl } = wpComponents;

  const scheduleBlockIcon = (
    <svg
      width="150px"
      height="150px"
      viewBox="181 181 150 150"
      enable-background="new 181 181 150 150"
    >
      <path
        fill="#0F6CB6"
        d="M186.837,288.539c1.152,0,2.087-0.932,2.087-2.086v-60.797h123.331v22.945c0,1.153,0.936,2.087,2.088,2.087
                      c1.154,0,2.087-0.934,2.087-2.087v-41.253c0-6.998-5.693-12.692-12.689-12.692h-5.474v-2.585c0-2.796-2.275-5.07-5.072-5.07h-3.878
                      c-2.795,0-5.069,2.274-5.069,5.07v2.586h-13.844v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.878c-2.796,0-5.07,2.274-5.07,5.07v2.586
                      h-13.846v-2.586c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-13.844v-2.586
                      c0-2.796-2.274-5.07-5.07-5.07h-3.877c-2.796,0-5.07,2.274-5.07,5.07v2.586h-3.218c-6.999,0-12.692,5.693-12.692,12.691v79.105
                      C184.75,287.607,185.685,288.539,186.837,288.539z M288.423,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878
                      c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.401,0.896-0.896,0.896h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z
                      M260.561,192.07c0-0.493,0.401-0.896,0.896-0.896h3.878c0.493,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.402,0.896-0.896,0.896
                      h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M232.697,192.07c0-0.493,0.402-0.896,0.896-0.896h3.877
                      c0.494,0,0.896,0.402,0.896,0.896v10.142c0,0.494-0.403,0.896-0.896,0.896h-3.877c-0.494,0-0.896-0.401-0.896-0.896V192.07z
                      M204.835,192.07c0-0.493,0.402-0.896,0.896-0.896h3.878c0.493,0,0.895,0.402,0.895,0.896v10.142c0,0.494-0.401,0.896-0.895,0.896
                      h-3.878c-0.494,0-0.896-0.401-0.896-0.896V192.07z M197.442,198.831h3.218v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878
                      c2.795,0,5.07-2.275,5.07-5.071v-3.381h13.845v3.381c0,2.796,2.274,5.071,5.07,5.071h3.878c2.796,0,5.071-2.275,5.071-5.071v-3.381
                      h13.844v3.381c0,2.796,2.273,5.071,5.07,5.071h3.879c2.794,0,5.069-2.275,5.069-5.071v-3.381h13.845v3.381
                      c0,2.796,2.273,5.071,5.07,5.071h3.877c2.796,0,5.071-2.275,5.071-5.071v-3.381h5.474c4.695,0,8.516,3.82,8.516,8.517v14.134
                      H188.925v-14.134C188.925,202.651,192.745,198.831,197.442,198.831z"
      />
      <path
        fill="#0F6CB6"
        d="M208.382,307.953h-18.202c-0.692,0-1.256-0.564-1.256-1.256v-10.732c0-1.152-0.935-2.088-2.087-2.088
                      s-2.087,0.936-2.087,2.088v10.732c0,2.994,2.437,5.43,5.431,5.43h18.202c1.152,0,2.087-0.934,2.087-2.086
                      C210.47,308.887,209.535,307.953,208.382,307.953z"
      />
      <path
        fill="#0F6CB6"
        d="M208.313,231.743h-7.256c-1.152,0-2.087,0.936-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256
                      c1.152,0,2.087-0.933,2.087-2.087C210.4,232.678,209.465,231.743,208.313,231.743z"
      />
      <path
        fill="#0F6CB6"
        d="M223.355,235.917h7.256c1.153,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.256
                      c-1.153,0-2.087,0.936-2.087,2.087C221.268,234.984,222.203,235.917,223.355,235.917z"
      />
      <path
        fill="#0F6CB6"
        d="M245.653,235.917h7.255c1.152,0,2.087-0.933,2.087-2.087c0-1.152-0.935-2.087-2.087-2.087h-7.255
                      c-1.153,0-2.087,0.936-2.087,2.087C243.565,234.984,244.5,235.917,245.653,235.917z"
      />
      <path
        fill="#0F6CB6"
        d="M267.95,235.917h7.256c1.153,0,2.088-0.933,2.088-2.087c0-1.152-0.935-2.087-2.088-2.087h-7.256
                      c-1.152,0-2.088,0.936-2.088,2.087C265.862,234.984,266.798,235.917,267.95,235.917z"
      />
      <path
        fill="#0F6CB6"
        d="M297.504,231.743h-7.255c-1.154,0-2.088,0.936-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255
                      c1.152,0,2.088-0.933,2.088-2.087C299.592,232.678,298.656,231.743,297.504,231.743z"
      />
      <path
        fill="#0F6CB6"
        d="M208.313,242.24h-7.256c-1.152,0-2.087,0.934-2.087,2.087c0,1.154,0.935,2.087,2.087,2.087h7.256
                      c1.152,0,2.087-0.934,2.087-2.087C210.4,243.174,209.465,242.24,208.313,242.24z"
      />
      <path
        fill="#0F6CB6"
        d="M223.355,246.415h7.256c1.153,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.256
                      c-1.153,0-2.087,0.934-2.087,2.087C221.268,245.481,222.203,246.415,223.355,246.415z"
      />
      <path
        fill="#0F6CB6"
        d="M245.653,246.415h7.255c1.152,0,2.087-0.934,2.087-2.087c0-1.153-0.935-2.087-2.087-2.087h-7.255
                      c-1.153,0-2.087,0.934-2.087,2.087C243.565,245.481,244.5,246.415,245.653,246.415z"
      />
      <path
        fill="#0F6CB6"
        d="M267.95,246.415h7.256c1.153,0,2.088-0.934,2.088-2.087c0-1.153-0.935-2.087-2.088-2.087h-7.256
                      c-1.152,0-2.088,0.934-2.088,2.087C265.862,245.481,266.798,246.415,267.95,246.415z"
      />
      <path
        fill="#0F6CB6"
        d="M297.504,242.24h-7.255c-1.154,0-2.088,0.934-2.088,2.087c0,1.154,0.934,2.087,2.088,2.087h7.255
                      c1.152,0,2.088-0.934,2.088-2.087C299.592,243.174,298.656,242.24,297.504,242.24z"
      />
      <path
        fill="#0F6CB6"
        d="M223.406,287.395l10.733,10.732c1.552,1.553,3.616,2.408,5.812,2.408s4.261-0.855,5.813-2.408l29.392-29.393
                      c3.205-3.205,3.205-8.42,0-11.625c-3.205-3.205-8.42-3.205-11.625,0l-23.58,23.58l-4.92-4.92c-3.204-3.205-8.419-3.205-11.625,0
                      C220.201,278.975,220.201,284.189,223.406,287.395z M226.358,278.721c0.788-0.787,1.824-1.184,2.86-1.184s2.072,0.396,2.86,1.184
                      l6.396,6.395c0.815,0.816,2.137,0.816,2.952,0l25.056-25.053c1.578-1.578,4.144-1.578,5.721-0.002c1.577,1.578,1.577,4.145,0,5.723
                      l-29.391,29.391c-0.764,0.766-1.78,1.186-2.86,1.186c-1.081,0-2.096-0.42-2.86-1.186l-10.732-10.732
                      C224.78,282.863,224.78,280.299,226.358,278.721z"
      />
      <path
        fill="#0F6CB6"
        d="M316.431,274.771v-16.657c0-1.153-0.933-2.087-2.087-2.087c-1.152,0-2.088,0.934-2.088,2.087v13.993
                      c-3.806-1.973-8.125-3.09-12.7-3.09c-15.271,0-27.693,12.424-27.693,27.693c0,4.002,0.854,7.805,2.386,11.242h-56.354
                      c-1.153,0-2.087,0.934-2.087,2.088c0,1.15,0.935,2.086,2.087,2.086h58.667c4.976,7.402,13.427,12.279,22.995,12.279
                      c15.271,0,27.694-12.424,27.694-27.695C327.25,287.789,323.006,279.838,316.431,274.771z M299.556,320.232
                      c-12.969,0-23.519-10.551-23.519-23.52s10.551-23.52,23.519-23.52c12.969,0,23.52,10.551,23.52,23.52
                      S312.524,320.232,299.556,320.232z"
      />
      <path
        fill="#0F6CB6"
        d="M299.556,276.209c-11.306,0-20.503,9.199-20.503,20.504s9.197,20.502,20.503,20.502
                      c11.307,0,20.502-9.197,20.502-20.502S310.861,276.209,299.556,276.209z M301.425,312.93c0.138-0.279,0.219-0.592,0.219-0.924
                      v-2.543c0-1.154-0.936-2.088-2.088-2.088c-1.151,0-2.087,0.934-2.087,2.088v2.543c0,0.332,0.079,0.645,0.219,0.924
                      c-7.513-0.859-13.489-6.836-14.35-14.348c0.278,0.139,0.594,0.219,0.926,0.219h2.542c1.153,0,2.087-0.936,2.087-2.088
                      c0-1.154-0.934-2.088-2.087-2.088h-2.542c-0.332,0-0.647,0.082-0.926,0.219c0.86-7.512,6.837-13.49,14.35-14.348
                      c-0.14,0.279-0.219,0.592-0.219,0.924v2.543c0,1.152,0.936,2.088,2.087,2.088c1.152,0,2.088-0.936,2.088-2.088v-2.543
                      c0-0.332-0.081-0.645-0.219-0.924c7.513,0.857,13.488,6.836,14.349,14.348c-0.279-0.137-0.593-0.219-0.925-0.219h-2.543
                      c-1.153,0-2.087,0.934-2.087,2.088c0,1.152,0.934,2.088,2.087,2.088h2.543c0.332,0,0.646-0.08,0.925-0.219
                      C314.912,306.094,308.938,312.07,301.425,312.93z"
      />
      <path
        fill="#0F6CB6"
        d="M304.157,294.625h-2.514v-2.141c0-1.152-0.935-2.086-2.088-2.086c-1.152,0-2.087,0.934-2.087,2.086v4.229
                      c0,1.152,0.935,2.088,2.087,2.088h4.602c1.153,0,2.087-0.936,2.087-2.088C306.244,295.559,305.309,294.625,304.157,294.625z"
      />
    </svg>
  );

  // On Click Schedule at a glance
  jQuery(document).on('click', '.move-item .components-dropdown-menu', function (e) {
    if (jQuery(this).parents('.schedule-row').hasClass('isToggleActive')) {
      jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
      jQuery('.schedule-row').removeClass('isToggleActive');
    }
    else {
      jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
      jQuery('.schedule-row').removeClass('isToggleActive');
      jQuery(this).parents('.schedule-row').addClass('isToggleActive');
    }
  });
  jQuery(document).on('click', '.move-item > i.fa', function (e) {
    jQuery('.schedule-row').removeClass('isToggleActive');
    jQuery(this).parents('.schedule-row').removeClass('isToggleActive');
  });

  class BlockComponent extends Component {
    componentDidMount() {
      const { dataArray } = this.props.attributes;
      if (0 === dataArray.length) {
        this.initList();
      }
    }

    initList() {
      const { dataArray } = this.props.attributes;
      const { setAttributes } = this.props;
      setAttributes({
        dataArray: [
          ...dataArray,

          {
            titleIndex: dataArray.length,
            title: '',
            detailList: [{
              index: dataArray.length,
              date: '',
              name: '',
              time: '',
              location: '',
              details: 'All Registered Attendees',
              type: ''
            }]
          }
        ]
      });
    }

    moveMedia(parentIndex, currentIndex, newIndex) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let allData = [...dataArray];

      if ( -1 === newIndex && 0 < parentIndex) {
        let prevBlockIndex = parentIndex - 1;
        let prevDetailListIndex = allData[prevBlockIndex].detailList.length - 1;
        allData[parentIndex].detailList[currentIndex].index = allData[prevBlockIndex].detailList[prevDetailListIndex] + 1;
        allData[prevBlockIndex].detailList.push(allData[parentIndex].detailList[currentIndex]);
        allData[parentIndex].detailList.splice(currentIndex, 1);
      } else if ( undefined === allData[parentIndex].detailList[newIndex] ) {
        let nextBlockIndex = parentIndex + 1;
        allData[nextBlockIndex].detailList.unshift(allData[parentIndex].detailList[currentIndex]);
        allData[parentIndex].detailList.splice(currentIndex, 1);
        allData[nextBlockIndex].detailList.map(( data, index) => ( allData[nextBlockIndex].detailList[index].index = index ));
      } else {
        allData[parentIndex].detailList[currentIndex].index = newIndex;
        allData[parentIndex].detailList[newIndex].index = currentIndex;
      }

      setAttributes({ dataArry: allData });
    }

    moveParentItem(currentIndex, newIndex) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let allData = [...dataArray];

      allData[currentIndex].titleIndex = newIndex;
      allData[newIndex].titleIndex = currentIndex;

      setAttributes({ dataArry: allData });
    }

    MoveItemToParent( currentParentIndex, parentIndex, index ) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let allData = [...dataArray];
      allData[currentParentIndex].detailList[index].index = allData[parentIndex].detailList.length;
      allData[parentIndex].detailList.push(allData[currentParentIndex].detailList[index]);
      allData[currentParentIndex].detailList.splice(index, 1);

      setAttributes({ dataArry: allData });
    }

    duplicate(parentIndex, currentIndex) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let allData = [...dataArray];

      allData[parentIndex].detailList.splice( currentIndex + 1, 0, {
        index: ( parseInt(allData[parentIndex].detailList[currentIndex].index ) + 1),
        name: allData[parentIndex].detailList[currentIndex].name,
        time: allData[parentIndex].detailList[currentIndex].time,
        location: allData[parentIndex].detailList[currentIndex].location,
        details: allData[parentIndex].detailList[currentIndex].details,
        type: allData[parentIndex].detailList[currentIndex].type
      });

      setAttributes({ dataArray: allData });
    }

    render() {
      const { attributes, setAttributes } = this.props;
      const { dataArray, showFilter, showTitle, showDateFilter, showOpenToFilter, showLocationFilter, showTypeFilter, showNameFilter, showTimeFilter, timeFilter } = attributes;

      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title="General Settings">
              <PanelRow>
                <ToggleControl
                  label={__('Include Times')}
                  checked={timeFilter}
                  onChange={() => setAttributes({ timeFilter: ! timeFilter })}
                />
                </PanelRow>
              <PanelRow>
                <ToggleControl
                  label={__('Show Filter')}
                  checked={showFilter}
                  onChange={() => setAttributes({ showFilter: ! showFilter })}
                />
              </PanelRow>
                {true === showFilter &&
                  <div className="inspector-field inspector-field-headings-design inspector-display-filter">
                    <PanelRow>
                      <CheckboxControl
                        className="in-checkbox"
                        label="Date Filter"
                        checked={showDateFilter}
                        onChange={isChecked => {
                          if (isChecked) {
                            setAttributes({ showDateFilter: true });
                          } else {
                            setAttributes({ showDateFilter: false });
                          }
                        }}
                      />
                    </PanelRow>
                    <PanelRow>
                      <CheckboxControl
                        className="in-checkbox"
                        label="Is Open To Filter"
                        checked={showOpenToFilter}
                        onChange={isChecked => {
                          if (isChecked) {
                            setAttributes({ showOpenToFilter: true });
                          } else {
                            setAttributes({ showOpenToFilter: false });
                          }
                        }}
                      />
                    </PanelRow>
                    <PanelRow>
                      <CheckboxControl
                        className="in-checkbox"
                        label="Location Filter"
                        checked={showLocationFilter}
                        onChange={isChecked => {
                          if (isChecked) {
                            setAttributes({ showLocationFilter: true });
                          } else {
                            setAttributes({ showLocationFilter: false });
                          }
                        }}
                      />
                    </PanelRow>
                    {timeFilter &&
                      <PanelRow>
                        <CheckboxControl
                          className="in-checkbox"
                          label="Time Filter"
                          checked={showTimeFilter}
                          onChange={isChecked => {
                            if (isChecked) {
                              setAttributes({ showTimeFilter: true });
                            } else {
                              setAttributes({ showTimeFilter: false });
                            }
                          }}
                        />
                      </PanelRow>
                    }
                    <PanelRow>
                      <CheckboxControl
                        className="in-checkbox"
                        label="Type Filter"
                        checked={showTypeFilter}
                        onChange={isChecked => {
                          if (isChecked) {
                            setAttributes({ showTypeFilter: true });
                          } else {
                            setAttributes({ showTypeFilter: false });
                          }
                        }}
                      />
                    </PanelRow>
                    <PanelRow>
                      <CheckboxControl
                        className="in-checkbox"
                        label="Name Filter"
                        checked={showNameFilter}
                        onChange={isChecked => {
                          if (isChecked) {
                            setAttributes({ showNameFilter: true });
                          } else {
                            setAttributes({ showNameFilter: false });
                          }
                        }}
                      />
                    </PanelRow>
                  </div>
                }
              <PanelRow>
                <ToggleControl
                  label={__('Show Title')}
                  checked={showTitle}
                  onChange={() => setAttributes({ showTitle: ! showTitle })}
                />
              </PanelRow>
            </PanelBody>
          </InspectorControls>
          {showFilter && (
            <div className="schedule-glance-filter">
              {showDateFilter &&
                <div className="date">
                  <label>Date</label>
                  <div className="schedule-select">
                    <select id="date">
                      <option>Select a Date</option>
                    </select>
                  </div>
                </div>
              }
              {showOpenToFilter &&
                <div className="pass-type">
                  <label>Is Open To</label>
                  <div className="schedule-select">
                    <select id="pass-type">
                      <option>Select an Open To</option>
                    </select>
                  </div>
                </div>
              }
              {showLocationFilter &&
                <div className="location">
                  <label>Location</label>
                  <div className="schedule-select">
                    <select id="location">
                      <option>Select a Location</option>
                    </select>
                  </div>
                </div>
              }
              {showTimeFilter &&
                <div className="time">
                  <label>Time</label>
                  <div className="schedule-select">
                    <select id="time">
                      <option>Select Time</option>
                    </select>
                  </div>
                </div>
              }
              {showTypeFilter &&
                <div className="type">
                  <label>Type</label>
                  <div className="schedule-select">
                    <select id="type">
                      <option>Select a Type</option>
                    </select>
                  </div>
                </div>
              }
              {showNameFilter &&
                <div className="search-box">
                  <label>Name</label>
                  <div className="schedule-select">
                    <input
                      id="box-main-search"
                      className="schedule-search"
                      name="schedule-search"
                      type="text"
                      placeholder="Filter by name..."
                    />
                  </div>
                </div>
              }
            </div>
          )}
          <div className="schedule-main">
            { 0 < dataArray.length &&
            dataArray
              .sort((a, b) => a.titleIndex - b.titleIndex)
              .map( (parentData, parentIndex )  => (
                  <Fragment>
                    <div className="shedule-details-parent">
                      <div className="move-item">
                        { 0 < parentIndex && (
                          <Tooltip text="Move UP">
                            <i
                              onClick={() => this.moveParentItem(parentIndex, parentIndex - 1)}
                              className="fa fa-chevron-up"
                            ></i>
                          </Tooltip>
                        )}
                        { parentIndex + 1 < dataArray.length && (
                          <Tooltip text="Move Down">
                            <i
                              onClick={() => this.moveParentItem(parentIndex, parentIndex + 1)}
                              className="fa fa-chevron-down"
                            ></i>
                          </Tooltip>
                        )}
                      </div>
                      <Tooltip text="Remove">
                        <i
                          onClick={() => {
                            let toDel = confirm('Are you sure you want to delete?');
                            if (true === toDel) {
                              let tempDataArray = [...dataArray];
                              tempDataArray.splice(parentIndex, 1);
                              setAttributes({ dataArray: tempDataArray });
                            }
                          }}
                          className="fa fa-times details-parent"
                        ></i>
                      </Tooltip>
                      {
                        showTitle && (
                          <RichText
                            tagName="h2"
                            value={parentData.title}
                            keepPlaceholderOnFocus="true"
                            placeholder={__('Date')}
                            onChange={value =>  {
                              let tempDataArray = [...dataArray];
                              tempDataArray[parentIndex].title = value;
                              setAttributes({ dataArray: tempDataArray});
                            }}
                          />
                        )
                      }
                      <div className="schedule-data">
                        { parentData.detailList
                          .sort((a, b) => a.index - b.index)
                          .map((data, index) => (
                            <div className="schedule-row">
                              <div className="move-item">
                                { ( 0 !== parentIndex || 0 !== index ) && (
                                  <Tooltip text="Move UP">
                                    <i
                                      onClick={() => this.moveMedia(parentIndex, index, index - 1)}
                                      className="fa fa-chevron-up"
                                    ></i>
                                  </Tooltip>
                                )}
                                { ( parentIndex + 1 !== dataArray.length || index + 1 < parentData.detailList.length ) && (
                                  <Tooltip text="Move Down">
                                    <i
                                      onClick={() => this.moveMedia(parentIndex, index, index + 1)}
                                      className="fa fa-chevron-down"
                                    ></i>
                                  </Tooltip>
                                )}
                                <Tooltip text="Duplicate">
                                  <i
                                    onClick={() => this.duplicate(parentIndex, index)}
                                    className="fa fa-clone"
                                  ></i>
                                </Tooltip>
                                {1 < dataArray.length &&
                                <DropdownMenu
                                  icon="arrow-right-alt"
                                  label="Move To"
                                >
                                  { ( { onClose } ) => (
                                    <Fragment>
                                      <MenuGroup>
                                        { dataArray.map( ( parentTitle, titleIndex) => (
                                          ( '' !== parentTitle.title &&
                                            ( parentIndex !== titleIndex &&
                                              <MenuItem
                                                className="schedule-move-to-list"
                                                onClick={() => { this.MoveItemToParent( parentIndex, titleIndex, index); onClose(); }}
                                              >
                                                {parentTitle.title}
                                              </MenuItem>
                                            )
                                          )
                                        ))
                                        }
                                      </MenuGroup>
                                    </Fragment>
                                  ) }
                                </DropdownMenu>
                                }
                                <Tooltip text="Remove">
                                  <i
                                    onClick={() => {
                                      let toDelete = confirm('Are you sure you want to delete?');
                                      if (true === toDelete) {
                                        let tempDataArray = [...dataArray];
                                        tempDataArray[parentIndex].detailList.splice(index, 1);
                                        setAttributes({ dataArray: tempDataArray});
                                      }
                                    }}
                                    className="fa fa-times"
                                  ></i>
                                </Tooltip>
                              </div>
                              <div className="name">
                                <RichText
                                  tagName="strong"
                                  keepPlaceholderOnFocus="true"
                                  placeholder={__('Registration Open')}
                                  value={data.name}
                                  onChange={name => {
                                    let tempDataArray = [...dataArray];
                                    tempDataArray[parentIndex].detailList[index].name = name;
                                    setAttributes({ dataArray: tempDataArray});
                                  }}
                                />
                              </div>
                              {timeFilter &&
                                <div className="time">
                                  <RichText
                                    tagName="p"
                                    placeholder={__('Time')}
                                    value={data.time}
                                    keepPlaceholderOnFocus="true"
                                    onChange={time => {
                                      let tempDataArray = [...dataArray];
                                      tempDataArray[parentIndex].detailList[index].time = time;
                                      setAttributes({ dataArray: tempDataArray });
                                    }}
                                  />
                                </div>
                              }
                              <div className="location">
                                <RichText
                                  tagName="p"
                                  placeholder={__('Location')}
                                  value={data.location}
                                  keepPlaceholderOnFocus="true"
                                  onChange={location => {
                                    let tempDataArray = [...dataArray];
                                    tempDataArray[parentIndex].detailList[index].location = location;
                                    setAttributes({ dataArray: tempDataArray});
                                  }}
                                />
                              </div>
                              <div className="details">
                                <RichText
                                  tagName="p"
                                  placeholder={__('All Registered Attendees')}
                                  value={data.details}
                                  keepPlaceholderOnFocus="true"
                                  onChange={details => {
                                    let tempDataArray = [...dataArray];
                                    tempDataArray[parentIndex].detailList[index].details = details;
                                    setAttributes({ dataArray: tempDataArray});
                                  }}
                                />
                              </div>
                              <div className="type">
                                <RichText
                                  tagName="p"
                                  placeholder={__('Type')}
                                  value={data.type}
                                  keepPlaceholderOnFocus="true"
                                  onChange={type => {
                                    let tempDataArray = [...dataArray];
                                    tempDataArray[parentIndex].detailList[index].type = type;
                                    setAttributes({ dataArray: tempDataArray});
                                  }}
                                />
                              </div>
                            </div>
                          ))
                        }
                        <div className="add-remove-btn">
                          <button
                            className="add"
                            onClick={content => {
                              let tempDataArray = [...dataArray];
                              tempDataArray[parentIndex].detailList.push({
                                index: dataArray[parentIndex].detailList.length,
                                name: '',
                                time: '',
                                location: '',
                                details: 'All Registered Attendees',
                                type: ''
                              });
                              setAttributes({ dataArray: tempDataArray });
                            }}
                          >
                            <span className="dashicons dashicons-plus"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </Fragment>
                )
              )
            }
            <div className="add-remove-btn">
              <button
                className="add"
                onClick={content => {
                  setAttributes({
                    dataArray: [
                      ...dataArray,
                      {
                        titleIndex: dataArray.length,
                        title: '',
                        detailList: [{
                          index: 0,
                          name: '',
                          time: '',
                          location: '',
                          details: 'All Registered Attendees',
                          type: ''
                        }]
                      }
                    ]
                  });
                }}
              >
                <span className="dashicons dashicons-plus"></span>
              </button>
            </div>
          </div>
        </Fragment>
      );
    }
  }

  registerBlockType('nab/schedule', {
    title: __('Schedule'),
    description: __('Schedule'),
    icon: { src: scheduleBlockIcon },
    category: 'nabshow',
    keywords: [__('Schedule'), __('gutenberg'), __('nab')],
    attributes: {
      dataArray: {
        type: 'array',
        default: []
      },
      showFilter: {
        type: 'boolean',
        default: false
      },
      timeFilter: {
        type: 'boolean',
        default: false
      },
      showTitle: {
        type: 'boolean',
        default: true
      },
      showDateFilter: {
        type: 'boolean',
        default: true
      },
      showOpenToFilter: {
        type: 'boolean',
        default: true
      },
      showLocationFilter: {
        type: 'boolean',
        default: true
      },
      showTypeFilter: {
        type: 'boolean',
        default: true
      },
      showNameFilter: {
        type: 'boolean',
        default: true
      },
      showTimeFilter: {
        type: 'boolean',
        default: true
      },
    },
    edit: BlockComponent,

    save: props => {
      const { attributes } = props;
      const { dataArray, showFilter, showTitle, showDateFilter, showOpenToFilter, showLocationFilter, showTypeFilter, showNameFilter, showTimeFilter, timeFilter } = attributes;

      return (
        <Fragment>
          {showFilter && (
            <div className="schedule-glance-filter">
              {showDateFilter &&
                <div className="date">
                  <label>Date</label>
                  <div className="schedule-select">
                    <select id="date">
                      <option>Select a Date</option>
                    </select>
                  </div>
                </div>
              }
              {showOpenToFilter &&
                <div className="pass-type">
                  <label>Is Open To</label>
                  <div className="schedule-select">
                    <select id="pass-type">
                      <option>Select an Open To</option>
                    </select>
                  </div>
                </div>
              }
              { showLocationFilter &&
                <div className="location">
                  <label>Location</label>
                  <div className="schedule-select">
                    <select id="location">
                      <option>Select a Location</option>
                    </select>
                  </div>
                </div>
              }
              { showTimeFilter &&
                <div className="time">
                  <label>Time</label>
                  <div className="schedule-select">
                    <select id="time">
                      <option>Select Time</option>
                    </select>
                  </div>
                </div>
              }
              {showTypeFilter &&
                <div className="type">
                  <label>Type</label>
                  <div className="schedule-select">
                    <select id="type">
                      <option>Select a Type</option>
                    </select>
                  </div>
                </div>
              }
              { showNameFilter &&
                <div className="search-box">
                  <label>Name</label>
                  <div className="schedule-select">
                    <input
                      id="box-main-search"
                      className="schedule-search"
                      name="schedule-search"
                      type="text"
                      placeholder="Filter by name..."
                    />
                  </div>
                </div>
              }
            </div>
          )}
          { 0 < dataArray.length && dataArray.map( (parentData)  => (
            <div className="schedule-main">
              {showTitle && <RichText.Content tagName="h2" value={parentData.title} />}
              <div className="schedule-data">
                { parentData.detailList
                  .sort((a, b) => a.index - b.index)
                  .map((data) => (
                    <div className="schedule-row" data-type={data.type}>
                      <div className="name">
                        <RichText.Content
                          tagName="strong"
                          value={data.name === undefined ? '-' : data.name}
                        />
                      </div>
                      {timeFilter &&
                        <div className="time">
                          <RichText.Content
                            tagName="p"
                            value={
                              (data.time === undefined || '' === data.time) ? '' : data.time
                            }
                          />
                        </div>
                      }
                      <div className="location">
                        <RichText.Content
                          tagName="p"
                          value={
                            data.location === undefined ? '-' : data.location
                          }
                        />
                      </div>
                      <div className="details">
                        <RichText.Content
                          tagName="p"
                          value={data.details === undefined ? '-' : data.details}
                        />
                      </div>
                    </div>
                  ))}
              </div>
            </div>
          ))
          }
        </Fragment>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);
