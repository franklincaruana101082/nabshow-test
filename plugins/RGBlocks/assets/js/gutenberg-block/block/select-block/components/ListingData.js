import React, { Component } from 'react';
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import ReusableBlocksList from './ReusableBlocks';

import { SelectBlock, Loader, LoadMoreSmall } from '../../icons';

class ListingData extends Component {
  constructor(props) {
    super(props);
    this.state = {
      reusableBlocks: [],
      isLoading: true,
      NoOfPost: 12,
      reusableSearchInputValue: '',
      ReusableOnSubmitVal: '',
      blockName: 'reusableblocks',
      CurrentBlockCategory: 'all',
      blockCategoryName: 'Select Category',
      reusablePageNo: 1,
      reusableHasMoreData: true,
      reusableBlocksLoadMore: false,
      customeSelect: false,
      blocksCategory: []
    };
    this.onScrollEvent = this.onScrollEvent.bind(this);
  }

  componentDidMount() {
    this.fetchReusableBlocks();
    this.fetchBlocksCategory();
  }

  componentDidUpdate(prevProps, prevState) {
    const { ReusableOnSubmitVal, CurrentBlockCategory } = this.state;

    if (ReusableOnSubmitVal !== prevState.ReusableOnSubmitVal) {
      this.setState({
        reusablePageNo: 1,
        reusableBlocksLoadMore: false,
        isLoading: true,
        reusableBlocks: []
      });
      this.fetchReusableBlocks();
    }
    if (CurrentBlockCategory !== prevState.CurrentBlockCategory) {
      this.setState({
        reusablePageNo: 1,
        reusableBlocksLoadMore: false,
        isLoading: true,
        reusableBlocks: []
      });
      this.fetchReusableBlocks();
    }
  }

  fetchReusableBlocks() {
    const {
      reusablePageNo,
      reusableBlocks,
      NoOfPost,
      CurrentBlockCategory
    } = this.state;
    this.setState({ reusableHasMoreData: false });
    let SearchBlocks = this.state.ReusableOnSubmitVal;
    wp.apiFetch({
      path: `/rg_blocks/request/reusable-blocks?search=${SearchBlocks}&category=${CurrentBlockCategory}&page=${reusablePageNo}&per_page=${NoOfPost}`,
      method: 'GET'
    }).then(data => {
      if (false === data.status) {
        this.setState({
          reusableHasMoreData: false,
          isLoading: false,
          reusableBlocksLoadMore: false
        });
      } else if (1 === reusablePageNo) {
        this.setState({
          reusableBlocks: data,
          isLoading: false,
          reusableBlocksLoadMore: true,
          reusableHasMoreData: true,
          reusablePageNo: reusablePageNo + 1
        });
      } else {
        this.setState({
          reusableBlocks: [...reusableBlocks, ...data],
          isLoading: false,
          reusableBlocksLoadMore: true,
          reusableHasMoreData: true,
          reusablePageNo: reusablePageNo + 1
        });
      }
    });
  }

  fetchBlocksCategory() {
    let categoryList = this.state.blocksCategory;
    wp.apiFetch({ path: '/rg_blocks/request/get-blocks-terms' }).then(data => {
      if (0 < data.length) {
        data.map(cat => {
          categoryList.push({ label: cat.name, value: cat.slug });
        });
        this.setState({ blocksCategory: categoryList });
      }
    });
  }

  onScrollEvent(e) {
    let CurrentPosion = e.target.scrollTop + 800;
    if (CurrentPosion > e.target.scrollHeight) {
      if (
        'reusableblocks' === this.state.blockName &&
        true === this.state.reusableHasMoreData
      ) {
        this.fetchReusableBlocks();
      }
    }
  }

  render() {
    const {
      reusableBlocks,
      isLoading,
      reusableSearchInputValue,
      blockName,
      customeSelect,
      reusablePageNo,
      blocksCategory,
      blockCategoryName,
      reusableBlocksLoadMore,
      CurrentBlockCategory
    } = this.state;

    return (
      <div
        className="select_block_popup"
        style={{ overflowY: 'scroll', height: '100%' }}
      >
        <Tabs>
          <div className="popup-top">
            <div className="logo">{SelectBlock}</div>
            <div className="right-tabs">
              <TabList>
                <Tab>Reusable Blocks</Tab>
              </TabList>
            </div>
          </div>
          <div className="filter-bar with-out-tab">
            <div className="filter-bar-left">
              <strong>
                <i className="fas fa-filter" />
                Filter By:
              </strong>
              <div className="Select-Category Select-box">
                <i className="fas fa-caret-down" />
                <div className="custom-select-box-main">
                  <span
                    className={customeSelect ? 'active' : ''}
                    onClick={() =>
                      this.setState({ customeSelect: ! customeSelect })
                    }
                  >
                    {blockCategoryName}
                  </span>
                  <ul className={customeSelect ? 'active' : ''}>
                    <li
                      onClick={e => {
                        this.setState({
                          CurrentBlockCategory: 'all',
                          blockCategoryName: 'All',
                          customeSelect: false,
                          reusablePageNo: 1
                        });
                      }}
                      key="all"
                    >
                      All
                    </li>
                    {blocksCategory.map(item => {
                      return (
                        <li
                          onClick={e => {
                            this.setState({ customeSelect: false });
                            if (CurrentBlockCategory !== item.value) {
                              this.setState({
                                CurrentBlockCategory: item.value,
                                customeSelect: false,
                                reusableBlocksLoadMore: false,
                                isLoading: true,
                                reusablePageNo: 1,
                                blockCategoryName: item.label,
                                reusableBlocks: []
                              });

                              e.preventDefault();
                            }
                          }}
                          key={item.value}
                          className={
                            CurrentBlockCategory === item.value ?
                              'selected' :
                              ''
                          }
                        >
                          {item.label}
                        </li>
                      );
                    })}
                  </ul>
                </div>
              </div>
              <div className="Select-box search-box">
                <form
                  onSubmit={event => {
                    if ('reusableblocks' === blockName) {
                      this.setState({
                        ReusableOnSubmitVal: reusableSearchInputValue,
                        reusablePageNo: 1
                      });
                    }
                    event.preventDefault();
                  }}
                >
                  <input
                    type="text"
                    value={reusableSearchInputValue}
                    placeholder="Search"
                    onChange={event => {
                      var searchValueFunc =
                        '' === event.target.value ? ' ' : event.target.value;
                      if ('reusableblocks' === blockName) {
                        this.setState({
                          reusableSearchInputValue: searchValueFunc
                        });
                      }
                    }}
                  />
                  <button
                    type="submit"
                    disabled={! this.state.reusableSearchInputValue}
                  >
                    <i className="fas fa-search" />
                  </button>
                </form>
              </div>
            </div>
          </div>
          <TabPanel>
            <div className="select_block_data">
              {isLoading ? (
                <p className="BlocksLoading">{Loader}</p>
              ) : (
                <ul onScroll={this.onScrollEvent}>
                  <ReusableBlocksList
                    data={this.props.data}
                    blocks={reusableBlocks}
                    isLoading={isLoading}
                  />
                  {4 < reusableBlocks.length && reusableBlocksLoadMore ? (
                    <li
                      className="MoreDataLoading"
                      style={{ width: '100%', textAlign: 'center' }}
                    >
                      {LoadMoreSmall}
                    </li>
                  ) : 1 === reusablePageNo ? (
                    <li className="NoMoreData">Result Not Found!</li>
                  ) : (
                    <li className="NoMoreData">No more data found!</li>
                  )}
                </ul>
              )}
            </div>
          </TabPanel>
        </Tabs>
      </div>
    );
  }
}

export default ListingData;
