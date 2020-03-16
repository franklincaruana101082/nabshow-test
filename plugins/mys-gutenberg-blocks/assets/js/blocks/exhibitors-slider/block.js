import { sliderArrow1, sliderArrow2, sliderArrow3, sliderArrow4, sliderArrow5, sliderArrow6, sliderArrow7, sliderArrow8 } from '../icons';

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    const { __ } = wpI18n;
    const { Component, Fragment } = wpElement;
    const { registerBlockType } = wpBlocks;
    const { InspectorControls } = wpEditor;
    const { PanelBody, Disabled, ToggleControl, SelectControl, TextControl, ServerSideRender, CheckboxControl, RangeControl } = wpComponents;

    const exhibitorSliderBlockIcon = (
        <svg width="150px" height="150px" viewBox="162.5 162.5 150 150" enable-background="new 162.5 162.5 150 150">
            <path fill="#92c83e" d="M233.983,256.903c0-1.35-1.095-2.443-2.445-2.443c-1.35,0-2.444,1.094-2.444,2.443
                c0,0.316-0.255,0.572-0.571,0.572c-0.314,0-0.57-0.256-0.57-0.572c0-1.35-1.094-2.443-2.444-2.443c-1.35,0-2.444,1.094-2.444,2.443
                c0,3.016,2.444,5.46,5.458,5.46S233.983,259.919,233.983,256.903z"/>
            <path fill="#92c83e" d="M243.599,262.363c3.013-0.003,5.456-2.446,5.459-5.46c0-1.35-1.094-2.443-2.443-2.443
                c-1.351,0-2.444,1.094-2.444,2.443c-0.007,0.311-0.262,0.559-0.571,0.559c-0.311,0-0.563-0.248-0.571-0.559
                c0-1.35-1.094-2.443-2.443-2.443c-1.351,0-2.444,1.094-2.444,2.443C238.144,259.918,240.584,262.36,243.599,262.363z"/>
            <path fill="#92c83e" d="M167.555,310.197h43.428c1.375-0.009,2.497-1.102,2.54-2.476v-4.246h45.828v4.246
                c0.043,1.374,1.166,2.467,2.54,2.476h43.43c1.35,0,2.303-1.127,2.303-2.476v-11.946c0-6.13-4.846-11.242-10.977-11.242h-3.688
                v-0.736c3.513-2.981,5.526-7.366,5.499-11.975v-3.241c0.306,0.032,0.572,0.05,0.856,0.05c0.493,0,0.983-0.044,1.469-0.131
                c3.278-0.583,5.88-3.084,6.594-6.336c0.715-3.251-0.6-6.612-3.33-8.517c-2.721-1.894-6.328-1.842-9.077-0.173
                c-4.072-4.904-10.783-6.729-16.778-4.561c-5.995,2.169-9.986,7.864-9.979,14.24v8.668c0.004,4.852,2.262,9.425,6.11,12.374v0.337
                h-3.758c-0.856,0.038-1.707,0.175-2.533,0.407c-2.232-5.453-7.556-9-13.449-8.962h-6.229v-2.756c0.611-0.55,1.402-1.142,2.032-1.788
                c3.775-3.831,5.898-8.99,5.912-14.368v-5.629c0.682,0.154,1.379,0.229,2.078,0.226c4.583-0.004,8.631-2.983,9.999-7.357
                c1.366-4.373-0.265-9.127-4.03-11.74c-3.703-2.582-8.714-2.325-12.294,0.253c-5.224-6.864-14.246-9.626-22.417-6.867
                c-8.173,2.76-13.671,10.429-13.666,19.055v12.061c-0.003,5.374,2.104,10.532,5.866,14.368c0.837,0.842,1.735,1.619,2.692,2.322
                v2.222h-6.231c-5.893-0.039-11.216,3.509-13.449,8.962c-0.827-0.232-1.677-0.369-2.534-0.407h-3.759v-0.736
                c3.513-2.981,5.526-7.366,5.5-11.975v-3.241c0.306,0.032,0.607,0.05,0.89,0.05c0.498,0,0.996-0.044,1.486-0.131
                c3.279-0.578,5.887-3.078,6.604-6.329c0.718-3.253-0.594-6.617-3.326-8.523c-2.72-1.894-6.326-1.842-9.074-0.173
                c-4.084-4.906-10.802-6.73-16.806-4.564c-6.004,2.167-10.011,7.859-10.022,14.244v8.668c0.004,4.852,2.262,9.425,6.111,12.374v0.337
                h-3.688c-6.131,0-10.978,5.112-10.978,11.242v11.946C165.25,309.07,166.205,310.197,167.555,310.197z M189.121,288.538l-2.274-1.484
                c1.59,0.235,3.207,0.208,4.788-0.08L189.121,288.538z M283.457,288.538l-2.273-1.484c1.59,0.235,3.208,0.208,4.79-0.08
                L283.457,288.538z M302.736,295.775v9.534h-16.804v-12.514l5.154-3.375h5.561C300.082,289.421,302.736,292.342,302.736,295.775z
                M301.252,257.658c1.109,0.772,1.645,2.14,1.353,3.46c-0.294,1.322-1.353,2.336-2.686,2.569c-0.486,0.083-0.983,0.063-1.461-0.064
                v-0.472c0.005-1.87-0.34-3.725-1.017-5.47C298.595,256.921,300.089,256.91,301.252,257.658z M283.345,252.899
                c3.085,0,6.005,1.391,7.947,3.789c-0.098-0.028-0.198-0.05-0.299-0.065c-0.986-0.139-1.959,0.334-2.458,1.195
                c-2.025,3.5-5.45,5.481-10.196,5.89c-1.748,0.14-3.504,0.082-5.238-0.175v-0.379C273.103,257.496,277.687,252.906,283.345,252.899z
                M273.101,268.463c1.138,0.14,2.282,0.211,3.428,0.21c0.663,0,1.351-0.025,2.063-0.08c4.796-0.382,8.733-2.084,11.615-4.98
                c0.896,1.311,2.04,2.435,3.364,3.309v4.901c0,5.693-4.677,10.502-10.235,10.502c-5.558,0-10.234-4.81-10.234-10.502V268.463z
                M266.649,303.476c1.351,0.017,2.46-1.063,2.479-2.415v-10.668c0-0.223-0.026-0.508-0.035-0.729c0.479-0.14,0.973-0.222,1.471-0.242
                h5.499l4.981,3.34v12.549H264.24v-1.834H266.649z M264.24,290.393v8.195h-25.664v-12.874l7.996-4.847h8.01
                c2.546-0.021,4.993,0.972,6.805,2.76C263.2,285.414,264.227,287.849,264.24,290.393z M261.533,236.576
                c2.551,1.757,3.2,5.246,1.456,7.802c-1.534,2.199-4.552,2.96-6.69,1.966v-1.338c-0.02-2.733-0.598-5.436-1.699-7.938
                C256.552,235.383,259.415,235.099,261.533,236.576z M236.07,229.782c7.736,0.011,14.238,5.818,15.118,13.505
                c-1.173-1.332-2.053-2.897-2.578-4.592c-0.239-0.967-1.043-1.691-2.03-1.83c-0.986-0.14-1.959,0.334-2.457,1.197
                c-2.992,5.169-8.031,8.086-14.991,8.67c-2.764,0.214-5.542,0.086-8.275-0.381v-1.346C220.86,236.604,227.668,229.793,236.07,229.782
                z M220.856,257.066v-5.763c1.894,0.28,3.805,0.421,5.719,0.424c0.901,0,1.838-0.032,2.806-0.108
                c6.893-0.548,12.535-3.121,16.441-7.506c1.374,2.304,3.292,4.233,5.587,5.62v7.333c-0.022,4.105-1.654,8.041-4.544,10.959
                c-2.805,2.943-6.693,4.608-10.76,4.608c-4.066,0-7.954-1.665-10.76-4.608C222.471,265.101,220.859,261.167,220.856,257.066z
                M236.084,277.521c2.529-0.011,5.033-0.499,7.38-1.439v0.887l-7.223,4.489l-6.831-4.454v-0.648
                C231.552,277.127,233.81,277.521,236.084,277.521z M208.635,290.393c0.016-2.544,1.042-4.979,2.854-6.766
                c1.811-1.788,4.26-2.78,6.805-2.76h7.934l7.46,4.813v12.907h-25.053V290.393z M203.782,289.663
                c-0.011,0.221-0.036,0.507-0.036,0.729v10.668c0.021,1.352,1.13,2.432,2.479,2.415h2.409v1.834h-17.109v-12.514l5.225-3.375h5.561
                C202.81,289.441,203.304,289.523,203.782,289.663z M206.914,257.658c1.514,1.055,1.886,3.139,0.831,4.651
                c-0.522,0.73-1.313,1.226-2.198,1.379c-0.496,0.083-1.006,0.063-1.494-0.063v-0.472c0.016-1.87-0.317-3.726-0.983-5.473
                C204.234,256.921,205.738,256.91,206.914,257.658z M188.973,252.899c3.089,0,6.015,1.391,7.965,3.789
                c-0.096-0.028-0.193-0.05-0.292-0.065c-0.985-0.139-1.956,0.336-2.453,1.195c-2.026,3.5-5.483,5.481-10.23,5.89
                c-1.758,0.14-3.525,0.082-5.271-0.175v-0.379C178.712,257.488,183.308,252.904,188.973,252.899z M178.693,268.463
                c1.149,0.14,2.306,0.211,3.464,0.21c0.662,0,1.367-0.025,2.076-0.08c4.798-0.382,8.708-2.084,11.591-4.98
                c0.887,1.311,2.021,2.435,3.339,3.309v4.901c0,5.693-4.677,10.502-10.235,10.502c-5.558,0-10.235-4.81-10.235-10.502V268.463z
                M170.139,295.775c0-3.434,2.655-6.354,6.089-6.354h5.5l4.91,3.34v12.549h-16.499V295.775z"/>
            <path fill="#92c83e" d="M193.761,209.736l11.42,0.075l-0.928,15.738c-0.057,0.971,0.467,1.883,1.334,2.323
                c0.868,0.44,1.915,0.324,2.664-0.296l21.241-17.567l13.333,0.078l20.933,12.634c0.781,0.471,1.76,0.469,2.539-0.007
                c0.775-0.464,1.226-1.326,1.162-2.229l-0.741-10.499h9.254c5.751,0,10.571-4.734,10.571-10.483v-18.909
                c0-5.75-4.82-10.326-10.571-10.326h-17.759c-1.842-3.111-5.184-5.023-8.799-5.035l-5.994-0.078l-49.315-0.342
                c-0.031,0-0.062-0.007-0.092-0.007c-5.729-0.013-10.39,4.604-10.432,10.332v0.003l-0.172,24.082
                C183.372,204.981,188.001,209.685,193.761,209.736z M259.576,199.776l0.177-24.031c0.005-0.197-0.001-0.394-0.017-0.59h16.236
                c3.056,0,5.683,2.383,5.683,5.438v18.909c0,3.055-2.627,5.595-5.683,5.595h-11.876c-0.675-0.014-1.323,0.259-1.788,0.748
                c-0.462,0.49-0.699,1.153-0.649,1.826l0.595,8.436l-10.468-6.32c4.556-1.199,7.746-5.299,7.79-10.009V199.776z M188.478,175.18
                c0.013-1.471,0.608-2.875,1.658-3.905c1.049-1.03,2.464-1.602,3.934-1.587l49.315,0.331l5.988,0.052
                c3.06,0.029,5.516,2.53,5.492,5.588l-0.175,24.014c-0.035,3.029-2.518,5.457-5.546,5.426h-0.047l-20.463-0.051
                c-0.577,0.008-1.133,0.218-1.571,0.594l-17.598,14.573l0.747-12.693c0.04-0.668-0.198-1.323-0.656-1.812
                c-0.458-0.488-1.098-0.766-1.768-0.77l-13.992-0.092c-3.06-0.029-5.517-2.528-5.496-5.588L188.478,175.18z"/>
            <path fill="#92c83e" d="M196.194,179.442l27.935,0.296h0.03c1.332,0.017,2.426-1.049,2.444-2.381
                c0.016-1.351-1.065-2.46-2.415-2.477l-27.934-0.336h-0.031c-1.352-0.008-2.455,1.081-2.463,2.435
                C193.751,178.332,194.841,179.434,196.194,179.442L196.194,179.442z"/>
            <path fill="#92c83e" d="M196.208,188.608l49.319,0.296h0.018c0.642,0.007,1.26-0.24,1.72-0.69c0.458-0.449,0.72-1.063,0.724-1.705
                c0.011-1.351-1.075-2.454-2.427-2.465l-49.321-0.334h-0.017c-1.352-0.004-2.452,1.089-2.457,2.44
                C193.762,187.503,194.854,188.604,196.208,188.608z"/>
            <path fill="#92c83e" d="M196.208,197.774l49.319,0.295h0.018c0.642,0.007,1.26-0.239,1.72-0.689c0.458-0.448,0.72-1.062,0.724-1.704
                c0.011-1.351-1.075-2.454-2.427-2.465l-49.321-0.334h-0.017c-1.352-0.005-2.452,1.088-2.457,2.44
                C193.762,196.668,194.854,197.769,196.208,197.774z"/>
        </svg>
    );

    class MYSExhibitorsSlider extends Component {
        constructor() {
            super(...arguments);
            this.state = {
                bxSliderObj: {},
                bxinit: false,
                taxonomiesList: [],
                taxonomies: [],
                taxonomiesObj: {},
                termsObj: {},
                filterTermsObj: {},
                isDisable: false,
            };

            this.initSlider = this.initSlider.bind(this);
        }

        componentWillMount() {
            const { taxonomies } = this.props.attributes;

            // Fetch all taxonomies
            wp.apiFetch({ path: '/wp/v2/taxonomies' }).then((taxonomies) => {
                this.setState({ taxonomiesObj: taxonomies });
                this.filterTaxonomy();
            });

            // Fetch all terms
            wp.apiFetch({ path: '/nab_api/request/all_terms' }).then((terms) => {
                this.setState({ termsObj: terms, filterTermsObj: terms, taxonomies: taxonomies });
            });

        }

        filterTaxonomy() {
            const { postType } = this.props.attributes;
            let postTaxonomiesOptions = [],
                taxonomies = this.state.taxonomiesObj,
                taxonomyKey = Object.keys(taxonomies);

            taxonomyKey.forEach(function (key) {
                if (postType === taxonomies[key].types[0]) {
                    postTaxonomiesOptions.push({ label: __(taxonomies[key].name), value: __(taxonomies[key].slug) });
                }
            });
            this.setState({ taxonomiesList: postTaxonomiesOptions });
        }

        filterTerms(value, taxonomy) {
            let filterTerms = {};
            this.state.taxonomies.map((tax) => {
                if (taxonomy === tax) {
                    filterTerms[tax] = this.state.termsObj[tax].filter(term => -1 < term.name.toLowerCase().indexOf(value.toLowerCase()));
                } else {
                    filterTerms[tax] = this.state.termsObj[tax];
                }

            });
            this.setState({ filterTermsObj: filterTerms });
        }

        componentDidMount() {
            this.setState({ bxinit: true });
        }

        componentDidUpdate() {
            const { clientId, attributes: { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, imgWidth, sliderActive, slideMargin } } = this.props;
            if (sliderActive) {
                if (this.state.bxinit) {
                    setTimeout(() => this.initSlider(), 500);
                    this.setState({ bxinit: false });
                } else {
                    if (0 < jQuery(`#block-${clientId} .nab-dynamic-slider`).length && this.state.bxSliderObj && undefined !== this.state.bxSliderObj.reloadSlider ) {
                        this.state.bxSliderObj.reloadSlider(
                            {
                                minSlides: minSlides,
                                maxSlides: minSlides,
                                moveSlides: 1,
                                slideMargin: slideMargin,
                                slideWidth: slideWidth,
                                imgWidth: imgWidth,
                                auto: autoplay,
                                infiniteLoop: infiniteLoop,
                                pager: pager,
                                controls: controls,
                                speed: sliderSpeed,
                                mode: 'horizontal'
                            }
                        );
                    }
                }
            }
        }

        initSlider() {
            const { clientId } = this.props;
            if (0 < jQuery(`#block-${clientId} .nab-dynamic-slider`).length) {
                const { minSlides, autoplay, infiniteLoop, pager, controls, sliderSpeed, slideWidth, slideMargin } = this.props.attributes;
                const sliderObj = jQuery(`#block-${clientId} .nab-dynamic-slider`).bxSlider({ minSlides: minSlides, maxSlides: minSlides, slideMargin: slideMargin, moveSlides: 1, slideWidth: slideWidth, auto: autoplay, infiniteLoop: infiniteLoop, pager: pager, controls: controls, speed: sliderSpeed, mode: 'horizontal' });
                this.setState({ bxSliderObj: sliderObj, bxinit: false, isDisable: false });
            } else {
                this.setState({ bxinit: true });
            }
        }
        isEmpty(obj) {
            let key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) {
                    return false;
                }
            }
            return true;
        }
        render() {

            const { attributes, setAttributes } = this.props;
            const {
                itemToFetch,
                listingPage,
                minSlides,
                autoplay,
                infiniteLoop,
                pager,
                controls,
                sliderSpeed,
                sliderActive,
                postType,
                taxonomies,
                terms,
                slideWidth,
                imgWidth,
                orderBy,
                slideMargin,
                arrowIcons,
                taxonomyRelation,
                withThumbnail,
                displayLogo,
                displayName,
                displayBooth,
                displaySummary,
                displayPlannerLink,
            } = attributes;

            var names = [
                { name: sliderArrow1, classnames: 'slider-arrow-1' },
                { name: sliderArrow2, classnames: 'slider-arrow-2' },
                { name: sliderArrow3, classnames: 'slider-arrow-3' },
                { name: sliderArrow4, classnames: 'slider-arrow-4' },
                { name: sliderArrow5, classnames: 'slider-arrow-5' },
                { name: sliderArrow6, classnames: 'slider-arrow-6' },
                { name: sliderArrow7, classnames: 'slider-arrow-7' },
                { name: sliderArrow8, classnames: 'slider-arrow-8' }
            ];

            let isCheckedTerms = {};
            if (! this.isEmpty(terms) && terms.constructor !== Object) {
                isCheckedTerms = JSON.parse(terms);
            }

            let input = <div className="inspector-field inspector-field-Numberofitems ">
                <label className="inspector-mb-0">Number of items</label>
                <RangeControl
                    value={itemToFetch}
                    min={1}
                    max={100}
                    onChange={(item) => { setAttributes({ itemToFetch: parseInt(item) }); this.setState({ bxinit: true, isDisable: true }); }}
                />

            </div>;

            if (this.state.isDisable && sliderActive && ! isNaN( itemToFetch )) {
                input = <Disabled>{input}</Disabled>;
            }

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Data Settings ')} initialOpen={true} className="range-setting">
                            <ToggleControl
                                label={__('Browse Page Format')}
                                checked={listingPage}
                                onChange={() => setAttributes({ listingPage: ! listingPage, sliderActive: false, orderBy: 'date', withThumbnail: false }) }
                            />
                            {input}
                            { ! listingPage &&
                            <Fragment>
                                <ToggleControl
                                    label={__('Only show with logo')}
                                    checked={withThumbnail}
                                    onChange={() => { setAttributes({ withThumbnail: ! withThumbnail }); this.setState({ bxinit: true }); } }
                                />
                                <SelectControl
                                    label={__('Order by')}
                                    value={orderBy}
                                    options={[
                                        { label: __('Alphabetical'), value: 'title' },
                                        { label: __('Newest to Oldest'), value: 'date' },
                                        { label: __('Menu Order'), value: 'menu_order' },
                                        { label: __('Random'), value: 'rand' },
                                    ]}
                                    onChange={(value) => { setAttributes({ orderBy: value }); this.setState({ bxinit: true }); }}
                                />
                                <ToggleControl
                                    label={__('Taxonomy Relation (AND)')}
                                    checked={taxonomyRelation}
                                    onChange={() => { setAttributes({ taxonomyRelation: ! taxonomyRelation }); this.setState({ bxinit: true }); }}
                                />

                                {0 < this.state.taxonomiesList.length &&

                                <Fragment>

                                    <label>{__('Select Taxonomy')}</label>
                                    <div className="fix-height-select">

                                        {this.state.taxonomiesList.map((taxonomy, index) => (

                                            <Fragment key={index}>

                                                <CheckboxControl checked={-1 < taxonomies.indexOf(taxonomy.value)} label={taxonomy.label} name="taxonomy[]" value={taxonomy.value} onChange={(isChecked) => {

                                                    let index,
                                                        tempTaxonomies = [...taxonomies],
                                                        tempTerms = terms;

                                                    if (isChecked) {
                                                        tempTaxonomies.push(taxonomy.value);
                                                    } else {
                                                        index = tempTaxonomies.indexOf(taxonomy.value);
                                                        tempTaxonomies.splice(index, 1);
                                                        if (! this.isEmpty(tempTerms)) {
                                                            tempTerms = JSON.parse(tempTerms);
                                                            delete tempTerms[taxonomy.value];
                                                            tempTerms = JSON.stringify(tempTerms);
                                                        }
                                                    }
                                                    if ( tempTerms.constructor === Object ) {
                                                        tempTerms = JSON.stringify(tempTerms);
                                                    }
                                                    this.props.setAttributes({ terms: tempTerms, taxonomies: tempTaxonomies });
                                                    this.setState({ taxonomies: tempTaxonomies, bxinit: true });
                                                }
                                                }
                                                />

                                            </Fragment>

                                        ))
                                        }
                                    </div>

                                </Fragment>
                                }
                                {0 < this.state.taxonomies.length &&

                                <Fragment>

                                    {
                                        this.state.taxonomies.map((taxonomy, index) => (

                                            undefined !== this.state.filterTermsObj[taxonomy] &&

                                            <div key={index}>
                                                <label>{__(taxonomy)}</label>

                                                {7 < this.state.termsObj[taxonomy].length &&
                                                <TextControl
                                                    type="string"
                                                    name={taxonomy}
                                                    onChange={value => this.filterTerms(value, taxonomy)}
                                                />
                                                }

                                                <div className="fix-height-select">

                                                    {this.state.filterTermsObj[taxonomy].map((term, index) => (

                                                        <Fragment key={index}>

                                                            <CheckboxControl checked={isCheckedTerms[taxonomy] !== undefined && -1 < isCheckedTerms[taxonomy].indexOf(term.slug)} label={term.name} name={`${taxonomy}[]`} value={term.slug} onChange={(isChecked) => {

                                                                let index,
                                                                    tempTerms = terms;
                                                                if (! this.isEmpty(tempTerms)) {
                                                                    tempTerms = JSON.parse(tempTerms);
                                                                }
                                                                if (isChecked) {
                                                                    if (tempTerms[taxonomy] === undefined) {
                                                                        tempTerms[taxonomy] = [term.slug];
                                                                    } else {
                                                                        tempTerms[taxonomy].push(term.slug);
                                                                    }
                                                                } else {
                                                                    index = tempTerms[taxonomy].indexOf(term.slug);
                                                                    tempTerms[taxonomy].splice(index, 1);
                                                                }

                                                                tempTerms = JSON.stringify(tempTerms);
                                                                this.props.setAttributes({ terms: tempTerms });
                                                                this.setState({ bxinit: true });
                                                            }
                                                            }
                                                            />
                                                        </Fragment>
                                                    ))
                                                    }
                                                </div>
                                            </div>
                                        ))
                                    }
                                </Fragment>
                                }
                            </Fragment>
                            }
                        </PanelBody>
                        <PanelBody title={__('Display Settings')} initialOpen={false} className="range-setting">
                          <ToggleControl
                            label={__('Logo')}
                            checked={displayLogo}
                            onChange={() => { setAttributes({ displayLogo: ! displayLogo }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Exhibitor Name')}
                            checked={displayName}
                            onChange={() => { setAttributes({ displayName: ! displayName }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Booth Number')}
                            checked={displayBooth}
                            onChange={() => { setAttributes({ displayBooth: ! displayBooth }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Summary')}
                            checked={displaySummary}
                            onChange={() => { setAttributes({ displaySummary: ! displaySummary }); this.setState({ bxinit: true }); } }
                          />
                          <ToggleControl
                            label={__('Show View in Planner Buttons')}
                            checked={displayPlannerLink}
                            onChange={() => { setAttributes({ displayPlannerLink: ! displayPlannerLink }); this.setState({ bxinit: true }); } }
                          />
                        </PanelBody>

                        { ! listingPage &&

                        <PanelBody title={__('Slider Settings ')} initialOpen={false} className="range-setting">
                            <ToggleControl
                                label={__('Slider On/Off')}
                                checked={sliderActive}
                                onChange={() => { setAttributes({ sliderActive: ! sliderActive}); this.setState({ bxinit: ! sliderActive }); } }
                            />
                            { sliderActive &&
                            <Fragment>
                                <ToggleControl
                                    label={__('Pager')}
                                    checked={pager}
                                    onChange={() => setAttributes({ pager: ! pager })}
                                />
                                <ToggleControl
                                    label={__('Controls')}
                                    checked={controls}
                                    onChange={() => setAttributes({ controls: ! controls })}
                                />
                                <ToggleControl
                                    label={__('Autoplay')}
                                    checked={autoplay}
                                    onChange={() => setAttributes({ autoplay: ! autoplay })}
                                />
                                <ToggleControl
                                    label={__('Infinite Loop')}
                                    checked={infiniteLoop}
                                    onChange={() => setAttributes({ infiniteLoop: ! infiniteLoop })}
                                />
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Speed</label>
                                    <RangeControl
                                        value={sliderSpeed}
                                        min={100}
                                        max={1000}
                                        step={1}
                                        onChange={(speed) => setAttributes({ sliderSpeed: parseInt(speed) })}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Items to Display</label>
                                    <RangeControl
                                        value={minSlides}
                                        min={1}
                                        max={10}
                                        step={1}
                                        onChange={(slide) => setAttributes({ minSlides: parseInt(slide) })}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Width</label>
                                    <RangeControl
                                        value={slideWidth}
                                        min={50}
                                        max={1000}
                                        step={1}
                                        onChange={(width) => setAttributes({ slideWidth: parseInt(width) })}
                                    />
                                </div>
                                <div className="inspector-field inspector-field-fontsize ">
                                    <label className="inspector-mb-0">Slide Margin</label>
                                    <RangeControl
                                        value={slideMargin}
                                        min={0}
                                        max={100}
                                        step={1}
                                        onChange={(width) => setAttributes({ slideMargin: parseInt(width) })}
                                    />
                                </div>
                            </Fragment>
                            }
                        </PanelBody>
                        }

                        <PanelBody title={__('Image Setting')} initialOpen={false} className="range-setting">
                            <div className="inspector-field inspector-field-fontsize ">
                                <label className="inspector-mb-0">Image Width</label>
                                <RangeControl
                                    value={imgWidth}
                                    min={50}
                                    max={1000}
                                    step={1}
                                    onChange={(width) => { setAttributes({ imgWidth: parseInt(width) }); this.setState({ bxinit: true }); }}
                                />
                            </div>
                        </PanelBody>

                        { ! listingPage && sliderActive && controls &&
                            <Fragment>
                                {controls &&
                                <PanelBody title={__('Slider Arrow')} initialOpen={false} className="range-setting">
                                    <ul className="slider-arrow-main">
                                        {names.map((item, index) => (
                                            < Fragment key={index}>
                                                <li
                                                    className={`${item.classnames} ${arrowIcons === item.classnames ? 'active' : ''}`}
                                                    key={index}
                                                    onClick={e => {
                                                        setAttributes({arrowIcons: item.classnames});
                                                        this.setState({bxinit: true});
                                                    }}
                                                >{item.name}</li>
                                            </Fragment>
                                        ))
                                        }
                                    </ul>
                                </PanelBody>
                                }
                            </Fragment>
                        }
                    </InspectorControls>
                    <ServerSideRender
                        block="mys/exhibitors-slider"
                        attributes={{ itemToFetch: itemToFetch, postType: postType, taxonomies: taxonomies, terms: terms, sliderActive: sliderActive, orderBy: orderBy, arrowIcons: arrowIcons, taxonomyRelation: taxonomyRelation, listingPage: listingPage, withThumbnail: withThumbnail, displayLogo: displayLogo, displayName: displayName, displayBooth: displayBooth, displaySummary: displaySummary, displayPlannerLink: displayPlannerLink, imgWidth: imgWidth }}
                    />
                </Fragment >
            );
        }
    }
    const blockAttrs = {
        itemToFetch: {
            type: 'number',
            default: 10
        },
        listingPage: {
            type: 'boolean',
            default: false
        },
        minSlides: {
            type: 'number',
            default: 4
        },
        autoplay: {
            type: 'boolean',
            default: false
        },
        infiniteLoop: {
            type: 'boolean',
            default: true
        },
        pager: {
            type: 'boolean',
            default: false
        },
        controls: {
            type: 'boolean',
            default: true
        },
        sliderSpeed: {
            type: 'number',
            default: 500
        },
        sliderActive: {
            type: 'boolean',
            default: true
        },
        postType: {
            type: 'string',
            default: 'exhibitors'
        },
        taxonomies: {
            type: 'array',
            default: []
        },
        terms: {
            type: 'string',
            default: {}
        },
        slideWidth: {
            type: 'number',
            default: 400
        },
        imgWidth: {
            type: 'number',
            default: 135
        },
        orderBy: {
            type: 'string',
            default: 'date'
        },
        slideMargin: {
            type: 'number',
            default: 30
        },
        arrowIcons: {
            type: 'string',
            default: 'slider-arrow-1'
        },
        taxonomyRelation: {
            type: 'boolean',
            default: false,
        },
        withThumbnail: {
            type: 'boolean',
            default: false
        },
        displayLogo: {
          type: 'boolean',
          default: true
        },
        displayName: {
          type: 'boolean',
          default: true
        },
        displayBooth: {
          type: 'boolean',
          default: true
        },
        displaySummary: {
          type: 'boolean',
          default: true
        },
        displayPlannerLink: {
          type: 'boolean',
          default: false
        }

    };
    registerBlockType('mys/exhibitors-slider', {
        title: __('Exhibitors Slider'),
        icon: { src: exhibitorSliderBlockIcon },
        category: 'mysgb',
        keywords: [__('exhibitors'), __('slider')],
        attributes: blockAttrs,
        edit: MYSExhibitorsSlider,
        save() {
            return null;
        },
    });

})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
