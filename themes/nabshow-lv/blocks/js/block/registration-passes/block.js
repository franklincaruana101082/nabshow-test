(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
  const { __ } = wpI18n;
  const { registerBlockType } = wpBlocks;
  const { Fragment, Component } = wpElement;
  const { RichText } = wpEditor;
  const { TextControl, Tooltip, DropdownMenu, MenuGroup, MenuItem } = wpComponents;

  const registrationPassesAwardBlockIcon = (
    <svg width="150px" height="150px" viewBox="222.64 222.641 150 150" enable-background="new 222.64 222.641 150 150">
      <g>
        <path fill="#0F6CB6" d="M350.696,331.655c-0.431,0.45-0.69,1.07-0.69,1.689s0.238,1.238,0.69,1.69c0.45,0.428,1.072,0.69,1.69,0.69
          c0.619,0,1.237-0.263,1.689-0.69c0.429-0.452,0.69-1.071,0.69-1.69s-0.262-1.239-0.69-1.689
          C353.196,330.798,351.602,330.774,350.696,331.655z"/>
        <path fill="#0F6CB6" d="M282.497,326.83l-8.66-4.423v-0.922c3.875-2.115,6.601-5.603,8.122-10.39
          c2.307-1.222,3.78-3.602,3.78-6.271v-2.381c0-2.206-1.026-4.252-2.74-5.594c-1.485-8.998-7.765-13.558-18.683-13.558
          c-0.517,0-1.021,0.021-1.514,0.06c-2.059,0.159-5.067-0.007-7.674-1.764c-0.976-0.657-1.711-1.294-2.182-1.895
          c-0.8-1.019-2.145-1.374-3.335-0.878c-1.193,0.49-1.895,1.685-1.745,2.97c0.1,0.886,0.25,1.924,0.476,3.059
          c0.459,2.321,0.459,2.321-0.186,3.708c-0.243,0.526-0.542,1.167-0.895,2.03c-0.788,1.929-1.347,4.04-1.668,6.299
          c-1.69,1.343-2.699,3.378-2.699,5.563v2.38c0,2.67,1.473,5.05,3.78,6.274c1.521,4.789,4.246,8.276,8.122,10.39v0.896l-8.974,4.42
          c-3.275,1.788-5.308,5.215-5.308,8.947v3.151c0,1.911,0,6.387,23.803,6.387c23.803,0,23.803-4.476,23.803-6.387v-2.961
          C288.119,332.063,285.965,328.569,282.497,326.83z M283.358,338.364c-1.483,0.903-7.524,2.162-19.042,2.162
          c-11.519,0-17.56-1.259-19.043-2.162v-2.615c0-1.987,1.086-3.815,2.74-4.721l9.184-4.521c1.433-0.7,2.358-2.183,2.358-3.781v-4.293
          l-1.437-0.622c-3.611-1.552-5.958-4.52-7.177-9.077l-0.34-1.268l-1.252-0.39c-0.997-0.31-1.694-1.237-1.694-2.252v-2.38
          c0-0.864,0.493-1.664,1.288-2.088l1.116-0.596l0.131-1.256c0.236-2.235,0.733-4.294,1.481-6.118
          c0.316-0.774,0.585-1.352,0.804-1.826c0.807-1.735,1.1-2.63,0.897-4.465c2.797,1.6,6.158,2.283,9.812,2.004
          c0.369-0.031,0.748-0.048,1.135-0.048c8.913,0,13.264,3.228,14.113,10.471l0.147,1.245l1.109,0.583
          c0.795,0.422,1.29,1.221,1.29,2.093v2.381c0,1.015-0.697,1.941-1.694,2.251l-1.252,0.391l-0.34,1.267
          c-1.218,4.559-3.565,7.526-7.177,9.078l-1.437,0.621v4.313c0,1.586,0.878,3.023,2.294,3.749l8.969,4.58l0.017,0.009
          c1.852,0.926,3.002,2.79,3.002,4.858V338.364L283.358,338.364z"/>
        <path fill="#0F6CB6" d="M300.02,295.303h23.804c1.315,0,2.38-1.064,2.38-2.38c0-1.316-1.064-2.38-2.38-2.38H300.02
          c-1.315,0-2.38,1.064-2.38,2.38C297.64,294.239,298.704,295.303,300.02,295.303z"/>
        <path fill="#0F6CB6" d="M302.4,331.008h-2.381c-1.315,0-2.38,1.063-2.38,2.38s1.064,2.381,2.38,2.381h2.381
          c1.316,0,2.381-1.064,2.381-2.381S303.717,331.008,302.4,331.008z"/>
        <path fill="#0F6CB6" d="M316.682,331.008h-4.76c-1.316,0-2.381,1.063-2.381,2.38s1.064,2.381,2.381,2.381h4.76
          c1.317,0,2.381-1.064,2.381-2.381S317.999,331.008,316.682,331.008z"/>
        <path fill="#0F6CB6" d="M328.584,331.008h-2.381c-1.316,0-2.38,1.063-2.38,2.38s1.063,2.381,2.38,2.381h2.381
          c1.315,0,2.38-1.064,2.38-2.381S329.899,331.008,328.584,331.008z"/>
        <path fill="#0F6CB6" d="M342.866,331.008h-4.761c-1.317,0-2.381,1.063-2.381,2.38s1.063,2.381,2.381,2.381h4.761
          c1.315,0,2.379-1.064,2.379-2.381S344.182,331.008,342.866,331.008z"/>
        <path fill="#0F6CB6" d="M352.387,304.824H300.02c-1.315,0-2.38,1.063-2.38,2.381c0,1.315,1.064,2.38,2.38,2.38h52.367
          c1.316,0,2.38-1.064,2.38-2.38C354.767,305.888,353.704,304.824,352.387,304.824z"/>
        <path fill="#0F6CB6" d="M352.387,319.105H300.02c-1.315,0-2.38,1.064-2.38,2.381s1.064,2.38,2.38,2.38h52.367
          c1.316,0,2.38-1.063,2.38-2.38S353.704,319.105,352.387,319.105z"/>
        <path fill="#0F6CB6" d="M357.914,259.555h-43.613v-18.297c0-3.038-2.467-5.505-5.505-5.505h-22.315
          c-3.035,0-5.503,2.468-5.503,5.505v18.297h-43.612c-6.139,0-11.135,4.996-11.135,11.135v77.705c0,6.137,4.996,11.133,11.135,11.133
          h120.55c6.137,0,11.133-4.996,11.133-11.136V270.69C369.049,264.551,364.053,259.555,357.914,259.555z M285.738,241.258
          c0-0.41,0.335-0.745,0.743-0.745h22.315c0.41,0,0.745,0.335,0.745,0.745v18.297v13.539c0,0.407-0.335,0.743-0.745,0.743h-22.315
          c-0.407,0-0.743-0.336-0.743-0.743v-13.539V241.258z M364.288,348.393c0,3.516-2.858,6.375-6.374,6.375H237.366
          c-3.516,0-6.375-2.859-6.375-6.375V270.69c0-3.516,2.858-6.375,6.375-6.375h43.612v8.779c0,3.035,2.468,5.503,5.503,5.503h22.315
          c3.037,0,5.505-2.468,5.505-5.503v-8.779h43.612c3.516,0,6.375,2.859,6.375,6.375V348.393L364.288,348.393z"/>
        <path fill="#0F6CB6" d="M297.64,261.936c5.252,0,9.521-4.27,9.521-9.521s-4.27-9.521-9.521-9.521c-5.251,0-9.521,4.27-9.521,9.521
          S292.389,261.936,297.64,261.936z M297.64,247.654c2.626,0,4.761,2.135,4.761,4.761c0,2.626-2.135,4.761-4.761,4.761
          s-4.761-2.135-4.761-4.761C292.879,249.789,295.014,247.654,297.64,247.654z"/>
      </g>
    </svg>
  );

  class ItemComponent extends Component {

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
            details: '',
            detailList: [{
              index: dataArray.length,
              itemTitle: '',
              itemDetails: '',
              price: '',
              subPrice: '',
              link: '',
              comming: false
            }]
          }
        ]
      });
    }


    moveMedia(parentIndex, currentIndex, newIndex) {
      const { setAttributes, attributes } = this.props;
      const { dataArray } = attributes;
      let allData = [...dataArray];

      if (-1 === newIndex && 0 < parentIndex) {
        let prevBlockIndex = parentIndex - 1;
        let prevDetailListIndex = allData[prevBlockIndex].detailList.length - 1;
        allData[parentIndex].detailList[currentIndex].index = allData[prevBlockIndex].detailList[prevDetailListIndex] + 1;
        allData[prevBlockIndex].detailList.push(allData[parentIndex].detailList[currentIndex]);
        allData[parentIndex].detailList.splice(currentIndex, 1);
      } else if (undefined === allData[parentIndex].detailList[newIndex]) {
        let nextBlockIndex = parentIndex + 1;
        allData[nextBlockIndex].detailList.unshift(allData[parentIndex].detailList[currentIndex]);
        allData[parentIndex].detailList.splice(currentIndex, 1);
        allData[nextBlockIndex].detailList.map((data, index) => (allData[nextBlockIndex].detailList[index].index = index));
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

    MoveItemToParent(currentParentIndex, parentIndex, index) {
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

      allData[parentIndex].detailList.push({
        index: dataArray[parentIndex].detailList.length,
        itemTitle: allData[parentIndex].detailList[currentIndex].itemTitle,
        itemDetails: allData[parentIndex].detailList[currentIndex].itemDetails,
        price: allData[parentIndex].detailList[currentIndex].price,
        subPrice: allData[parentIndex].detailList[currentIndex].subPrice,
        link: allData[parentIndex].detailList[currentIndex].link,
        comming: allData[parentIndex].detailList[currentIndex].comming
      });

      setAttributes({ dataArray: allData });
    }

    render() {
      const { attributes, setAttributes } = this.props;
      const { dataArray, title, details } = attributes;

      return (
        <Fragment>
        <div className="registration-passes">
          {0 < dataArray.length &&
            dataArray
              .sort((a, b) => a.titleIndex - b.titleIndex)
              .map((parentData, parentIndex) => (
                <Fragment>
                  <div className="shedule-details-parent">
                    <div className="move-item">
                      {0 < parentIndex && (
                        <Tooltip text="Move UP">
                          <i
                            onClick={() => this.moveParentItem(parentIndex, parentIndex - 1)}
                            className="fa fa-chevron-up"
                          ></i>
                        </Tooltip>
                      )}
                      {parentIndex + 1 < dataArray.length && (
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
                          let tempDataArray = [...dataArray];
                          tempDataArray.splice(parentIndex, 1);
                          setAttributes({ dataArray: tempDataArray });
                        }}
                        className="fa fa-times details-parent"
                      ></i>
                    </Tooltip>

                    <div className="registration-head">
                    <RichText
                      tagName="h2"
                      placeholder={__('Title')}
                      value={parentData.title}
                        className="title"
                        onChange={value => {
                          let tempDataArray = [...dataArray];
                          tempDataArray[parentIndex].title = value;
                          setAttributes({ dataArray: tempDataArray });
                        }}
                    />
                    <RichText
                      tagName="p"
                      placeholder={__('Description')}
                      value={parentData.details}
                        className="description"
                        onChange={value => {
                          let tempDataArray = [...dataArray];
                          tempDataArray[parentIndex].details = value;
                          setAttributes({ dataArray: tempDataArray });
                        }}
                    />
                    </div>

                    <div className="schedule-data">
                      {parentData.detailList
                        .sort((a, b) => a.index - b.index)
                        .map((product, index) => (
                          <div className={`registration-item re-pass-item ${product.comming ? 'comming-soon' : ''}`}>

                            <div className="move-item">
                              {(0 !== parentIndex || 0 !== index) && (
                                <Tooltip text="Move UP">
                                  <i
                                    onClick={() => this.moveMedia(parentIndex, index, index - 1)}
                                    className="fa fa-chevron-up"
                                  ></i>
                                </Tooltip>
                              )}
                              {(parentIndex + 1 !== dataArray.length || index + 1 < parentData.detailList.length) && (
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
                                  {({ onClose }) => (
                                    <Fragment>
                                      <MenuGroup>
                                        {dataArray.map((parentTitle, titleIndex) => (
                                          ('' !== parentTitle.title &&
                                            (parentIndex !== titleIndex &&
                                              <MenuItem
                                                className="schedule-move-to-list"
                                                onClick={() => { this.MoveItemToParent(parentIndex, titleIndex, index); onClose(); }}
                                              >
                                                {parentTitle.title}
                                              </MenuItem>
                                            )
                                          )
                                        ))
                                        }
                                      </MenuGroup>
                                    </Fragment>
                                  )}
                                </DropdownMenu>
                              }
                              <Tooltip text="Remove">
                                <i
                                  onClick={() => {
                                    let tempDataArray = [...dataArray];
                                    tempDataArray[parentIndex].detailList.splice(index, 1);
                                    setAttributes({ dataArray: tempDataArray });
                                  }}
                                  className="fa fa-times"
                                ></i>
                              </Tooltip>
                            </div>
                            {/* <span
                              className="remove"
                              onClick={() => {
                                let tempDataArray = [...dataArray];
                                tempDataArray.splice(parentIndex, 1);
                                setAttributes({ dataArray: tempDataArray });
                              }}
                            >
                              <span className="dashicons dashicons-no-alt"></span>
                            </span> */}
                            <div className="plus-sec">
                              {false === product.comming && (
                                <Fragment>
                                  <span>+</span>
                                  <div className="plus-link">
                                    <TextControl
                                      type="string"
                                      value={product.link}
                                      placeholder="#"
                                      onChange={link => {
                                        let tempDataArray = [...dataArray];
                                        tempDataArray[parentIndex].detailList[index].link = link;
                                        setAttributes({ dataArray: tempDataArray });
                                      }}
                                    />
                                  </div>
                                </Fragment>
                              )}
                            </div>
                            <div className="middle-sec">
                              <RichText
                                tagName="h3"
                                placeholder={__('Item Title')}
                                value={product.itemTitle}
                                className="item-title"
                                onChange={itemTitle => {
                                  let tempDataArray = [...dataArray];
                                  tempDataArray[parentIndex].detailList[index].itemTitle = itemTitle;
                                  setAttributes({ dataArray: tempDataArray });
                                }}
                              />
                              <RichText
                                tagName="p"
                                placeholder={__('Description')}
                                value={product.itemDetails}
                                className="item-description"
                                onChange={itemDetails => {
                                  let tempDataArray = [...dataArray];
                                  tempDataArray[parentIndex].detailList[index].itemDetails = itemDetails;
                                  setAttributes({ dataArray: tempDataArray });
                                }}
                              />
                            </div>
                            <div className="last-sec">
                              <RichText
                                tagName="p"
                                placeholder={__('Price')}
                                value={product.price}
                                className="price"
                                onChange={price => {
                                  let tempDataArray = [...dataArray];
                                  tempDataArray[parentIndex].detailList[index].price = price;
                                  setAttributes({ dataArray: tempDataArray });
                                }}
                              />
                              {
                                false == product.comming ? (
                                  <RichText
                                    tagName="span"
                                    placeholder={__('Sub Price')}
                                    value={product.subPrice}
                                    className="sub-price"
                                    onChange={subPrice => {
                                      let tempDataArray = [...dataArray];
                                      tempDataArray[parentIndex].detailList[index].subPrice = subPrice;
                                      setAttributes({ dataArray: tempDataArray });
                                    }}
                                  />
                                ) : ''}
                            </div>
                          </div>

                        ))}
                    </div>
                    {/* Inner Buttons */}
                    <div className="registration-item additem">
                      <button
                        className="components-button add"
                        onClick={content => {
                          let tempDataArray = [...dataArray];
                          tempDataArray[parentIndex].detailList.push({
                            index: dataArray[parentIndex].detailList.length,
                            itemTitle: '',
                            itemDetails: '',
                            price: '',
                            subPrice: '',
                            link: '',
                            comming: false
                          });
                          setAttributes({ dataArray: tempDataArray });
                        }}
                      >
                        <span className="dashicons dashicons-plus"></span> Add New Item
                      </button>
                      <button
                        className="components-button add coming-btn"
                        onClick={content => {
                          let tempDataArray = [...dataArray];
                          tempDataArray[parentIndex].detailList.push({
                            index: dataArray[parentIndex].detailList.length,
                            itemTitle: '',
                            itemDetails: '',
                            price: 'Registration Coming Soon!',
                            subPrice: '',
                            link: '',
                            comming: true
                          });
                          setAttributes({ dataArray: tempDataArray });
                        }}
                      >
                        <span className="dashicons dashicons-plus"></span> Add Coming Soon Item
                      </button>
                    </div>


                  </div>
                </Fragment>
              )
            )
          }
        </div>

          {/* outer Buttons */}
          <div className="registration-item outer-btns additem">
            <button
              className="components-button add"
              onClick={content => {
                setAttributes({
                  dataArray: [
                    ...dataArray,
                    {
                      titleIndex: dataArray.length,
                      title: '',
                      details: '',
                      detailList: [{
                        index: dataArray.length,
                        itemTitle: '',
                        itemDetails: '',
                        price: '',
                        subPrice: '',
                        link: '',
                        comming: false
                      }]
                    }
                  ]
                });
              }
              }
            >
              <span className="dashicons dashicons-plus"></span> Add New Block
              </button>
          </div>
        </Fragment>
      );
    }
  }

  registerBlockType('nab/registration-passes', {
    title: __('Registration Passes'),
    description: __('registration-passes'),
    icon: { src: registrationPassesAwardBlockIcon },
    category: 'nabshow',
    keywords: [__('registration-passes'), __('gutenberg'), __('nab')],
    attributes: {
      dataArray: {
        type: 'array',
        default: [],
      },
      title: {
        type: 'string'
      },
      details: {
        type: 'string'
      }
    },
    edit: ItemComponent,

    save: props => {
      const { attributes } = props;
      const { dataArray, title, details } = attributes;

      return (
        <Fragment>
          { 0 < dataArray.length && dataArray.map((parentData) => (
            <div className="registration-passes">
              <div className="registration-head">
                <RichText.Content
                  tagName="h2"
                  value={parentData.title}
                  className="title"
                />
                <RichText.Content
                  tagName="p"
                  value={parentData.details}
                  className="description"
                />
                </div>
                {parentData.detailList
                  .sort((a, b) => a.index - b.index)
                  .map((product) => (
                  <Fragment>
                    { product.itemTitle && (
                      <div className={`registration-item ${product.comming ? 'comming-soon' : ''}`}>
                        <div className="plus-sec">
                          {product.link && (
                            <a href={product.link} target="_blank" rel="noopener noreferrer">+</a>
                          )}
                        </div>
                        <div className="middle-sec">
                          <RichText.Content
                            tagName="h3"
                            value={product.itemTitle}
                            className="item-title"
                          />
                          <RichText.Content
                            tagName="p"
                            value={product.itemDetails}
                            className="item-description"
                          />
                        </div>
                        <div className="last-sec">
                          {product.price && (
                            <RichText.Content
                              tagName="p"
                              value={product.price}
                              className="price"
                            />
                          )}
                          {product.subPrice && (
                            <RichText.Content
                              tagName="span"
                              value={product.subPrice}
                              className="sub-price"
                            />
                          )}
                        </div>
                      </div>
                    )}
                  </Fragment>
                  ))}
                </div>
            ))}
        </Fragment>
      );
    }
  });
})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);