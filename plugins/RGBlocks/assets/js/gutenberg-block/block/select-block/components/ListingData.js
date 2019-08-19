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
            reusablePageNo: 1,
            reusableHasMoreData: true,
            reusableBlocksLoadMore: false,
        };
        this.tabChange = this.tabChange.bind(this);
        this.onScrollEvent = this.onScrollEvent.bind(this);
    }

    componentDidMount() {
        this.fetchReusableBlocks();
    }

    componentDidUpdate(prevProps, prevState) {
        const {
            ReusableOnSubmitVal
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
    }

    fetchReusableBlocks() {
        const { reusablePageNo, reusableBlocks, NoOfPost } = this.state;
        this.setState({ reusableHasMoreData: false });
        let SearchBlocks = this.state.ReusableOnSubmitVal;
        wp.apiFetch({ path: `/wp/v2/blocks?search=${SearchBlocks}&page=${reusablePageNo}&per_page=${NoOfPost}`, method: 'GET' }).then(data => {
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

    render() {
        const {
            reusableBlocks,
            isLoading,
            reusableSearchInputValue,
            blockName,
            reusableBlocksLoadMore
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
                    </div>
                    <div className="filter-bar with-out-tab">
                        <div className="filter-bar-left">
                            <strong>
                                <i className="fas fa-filter" />
                                Filter By:
                            </strong>
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
                                        disabled={ ! this.state.reusableSearchInputValue }
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
                                    {/*{4 < reusableBlocks.length && reusableBlocksLoadMore ? (
                                        <li
                                            className="MoreDataLoading"
                                            style={{ width: '100%', textAlign: 'center' }}
                                        >
                                            {LoadMoreSmall}
                                        </li>
                                    ) : (
                                        <li className="NoMoreData">No more data found!</li>
                                    )}*/}
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