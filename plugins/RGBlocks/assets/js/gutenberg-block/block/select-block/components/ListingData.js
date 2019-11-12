import React, { Component } from 'react';
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import ReusableBlocksList from './ReusableBlocks';


import { Logo, Loader, LoadMoreSmall } from '../../icons';

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
            reusableType: 'normal',
            customeSelect: false,
            blocksCategory: []
        };
        this.tabChange = this.tabChange.bind(this);
        this.onScrollEvent = this.onScrollEvent.bind(this);
        this.handleReusableTypeRadioChange = this.handleReusableTypeRadioChange.bind(this);
    }

    componentDidMount() {
        this.fetchReusableBlocks();
        this.fetchBlocksCategory();
    }

    componentDidUpdate(prevProps, prevState) {
        const {
            ReusableOnSubmitVal,
            CurrentBlockCategory
        } = this.state;

        if (ReusableOnSubmitVal !== prevState.ReusableOnSubmitVal) {
            this.setState({
                reusablePageNo: 1,
                reusableBlocksLoadMore: false,
                isLoading: true,
                reusableBlocks: []
            });
            this.fetchReusableBlocks();
        }
        if ( CurrentBlockCategory !== prevState.CurrentBlockCategory) {
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
        const { reusablePageNo, reusableBlocks, NoOfPost, CurrentBlockCategory } = this.state;
        this.setState({ reusableHasMoreData: false });
        let SearchBlocks = this.state.ReusableOnSubmitVal;
        wp.apiFetch({ path: `/rg_blocks/request/reusable-blocks?search=${SearchBlocks}&category=${CurrentBlockCategory}&page=${reusablePageNo}&per_page=${NoOfPost}`, method: 'GET' }).then(data => {
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
                data.map((cat) => {
                    categoryList.push({ label: cat.name, value: cat.slug });
                });
                this.setState({ blocksCategory: categoryList });
            }
        });
    }

    tabChange(e, tabName) {
        if (this.state.blockName !== e) {
            this.setState({
                blockName: e
            });
        }
    }

    onScrollEvent(e) {
        let CurrentPosion = e.target.scrollTop + 800;
        if (
            CurrentPosion > e.target.scrollHeight
        ) {
            if ('reusableblocks' === this.state.blockName && true === this.state.reusableHasMoreData) {
                this.fetchReusableBlocks();
            }
        }
    }

    handleReusableTypeRadioChange(event) {

        // set the new value of checked radion button to state using setState function which is async function
        this.setState({
            reusableType: event.target.value
        });
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
            CurrentBlockCategory,
            reusableType
        } = this.state;

        return (
            <div
                className="select_block_popup"
                style={{ overflowY: 'scroll', height: '100%' }}
            >
                <Tabs>
                    <div className="popup-top">
                        <div className="logo">{Logo}</div>
                        <div className="right-tabs">
                            <TabList>
                                <Tab
                                    onClick={() => {
                                        this.tabChange('reusableblocks');
                                    }}
                                >
                                    Reusable Blocks
                                </Tab>
                            </TabList>
                        </div>
                        <div className="user-preference">
                            <span> Block Print Type: </span>
                            <div check>
                                <input
                                    type="radio"
                                    id="normal_radio"
                                    value="normal" // this is te value which will be picked up after radio button change
                                    checked={'normal' === this.state.reusableType} // when this is true it show the normal radio button in checked
                                    onChange={this.handleReusableTypeRadioChange} // whenever it changes from checked to uncheck or via-versa it goes to the handleReusableTypeRadioChange function
                                />
                                <label for="normal_radio">Normal Block</label>
                            </div>
                            <div check>
                                <input
                                    type="radio"
                                    id="reusable_radio"
                                    value="reusable"
                                    checked={'reusable' === this.state.reusableType}
                                    onChange={this.handleReusableTypeRadioChange}
                                />
                                <label for="reusable_radio">Reusable Block</label>
                            </div>
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
                                                    reusablePageNo: 1,
                                                });
                                            }}
                                            key="all"
                                        >
                                            All
                                        </li>
                                        {
                                            blocksCategory.map(item => {
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
                                                        className={ CurrentBlockCategory === item.value ? 'selected' : ''}
                                                    >
                                                        {item.label}
                                                    </li>
                                                );
                                            })
                                        }
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
                                            reusableType={reusableType}
                                        />
                                        { 4 < reusableBlocks.length && reusableBlocksLoadMore ? (
                                            <li
                                                className="MoreDataLoading"
                                                style={{ width: '100%', textAlign: 'center' }}
                                            >
                                                {LoadMoreSmall}
                                            </li>
                                        ) : (
                                            1 === reusablePageNo ? <li className="NoMoreData">Result Not Found!</li> : <li className="NoMoreData">No more data found!</li>
                                        )
                                        }
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
