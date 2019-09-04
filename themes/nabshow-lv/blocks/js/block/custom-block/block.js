import times from 'lodash/times';
import map from 'lodash/map';
import memoize from 'memize';
import classnames from 'classnames';
import icons from './icons';
import Inspector from './inspector';

(function (wpI18n, wpBlocks, wpEditor, wpComponents, wpElement) {
    const { __ } = wpI18n;
    const { registerBlockType } = wpBlocks;
    const { Fragment, Component } = wpElement;
    const { InnerBlocks, RichText } = wpEditor;
    const { Placeholder, ButtonGroup, Tooltip, Button } = wpComponents;

    const allAttributes = {
        columns: {
            type: 'number'
        },
        colLayout: {
            type: 'string'
        },
        someValue: {
            type: 'string'
        },
        backgroundImage: {
            type: 'string',
            default: ''
        },
        backgroundColor: {
            type: 'string',
            default: ''
        },
        backgroundSize: {
            type: 'boolean',
            default: false,
        },
        backgroundPosition: {
            type: 'string',
            default: '',
        },
        backgroundAttachment: {
            type: 'boolean',
            default: false,
        },
        borderStyle: {
            type: 'string',
            default: '',
        },
        borderWidth: {
            type: 'number',
        },
        borderColor: {
            type: 'string',
        },
        borderRadius: {
            type: 'number',
        },
        topBorderStyle: {
            type: 'string',
            default: ''
        },
        topBorderWidth: {
            type: 'number',
        },
        topBorderColor: {
            type: 'string',
        },
        topBorderRadius: {
            type: 'number',
        },
        bottomBorderStyle: {
            type: 'string',
            default: ''
        },
        bottomBorderWidth: {
            type: 'number',
        },
        bottomBorderColor: {
            type: 'string',
        },
        bottomBorderRadius: {
            type: 'number',
        },
        rightBorderStyle: {
            type: 'string',
            default: ''
        },
        rightBorderWidth: {
            type: 'number',
        },
        rightBorderColor: {
            type: 'string',
        },
        rightBorderRadius: {
            type: 'number',
        },
        leftBorderStyle: {
            type: 'string',
            default: ''
        },
        leftBorderWidth: {
            type: 'number',
        },
        leftBorderColor: {
            type: 'string',
        },
        leftBorderRadius: {
            type: 'number',
        },
        textAlign: {
            type: 'string',
            default: ''
        },
        width: {
            type: 'string',
            default: ''
        },
        height: {
            type: 'string',
            default: ''
        },
        opacity: {
            type: 'number',
            default: 0
        },
        overlayColor: {
            type: 'string',
        },
        paddingTop: {
            type: 'string',
            default: ''
        },
        paddingRight: {
            type: 'string',
            default: ''
        },
        paddingBottom: {
            type: 'string',
            default: ''
        },
        paddingLeft: {
            type: 'string',
            default: ''
        },
        marginTop: {
            type: 'string',
            default: ''
        },
        marginRight: {
            type: 'string',
            default: ''
        },
        marginBottom: {
            type: 'string',
            default: ''

        },
        marginLeft: {
            type: 'string',
            default: ''
        },
        gradientRange1: {
            type: 'number',
            default: 0
        },
        gradientRange2: {
            type: 'number',
            default: 0
        },
        gradientRange3: {
            type: 'number',
            default: 0
        },
        color1: {
            type: 'string',
            default: '#fff'
        },
        color2: {
            type: 'string',
            default: '#fff'
        },
        color3: {
            type: 'string',
            default: '#fff'
        },
        gradientType: {
            type: 'string',
            default: ''
        },
        ToggleInserter: {
            type: 'boolean',
            default: false
        },
        vAlign: {
            type: 'string',
            default: 'center',
        },
        hAlign: {
            type: 'string',
            default: 'center',
        },
        layout: {
            type: 'string',
            default: ''
        },
        showTitle: {
            type: 'boolean',
            default: true
        },
        clientID: {
            type: 'string',
        }
    };

    /* Set allowed blocks and media. */
    const ALLOWED_BLOCKS = ['nab/nab-column'];

    /* Get the column template. */
    const getLayoutTemplate = memoize((columns) => {
        const colCounts = times(columns, () => ['nab/nab-column']);
        const headBlock = [['nab/nab-heading']];
        let combine = headBlock.concat(colCounts);
        return combine;
    });


    /**
     * Register advanced columns block InnerBlocks.
     */
    registerBlockType('nab/nab-custom', {
        title: __('Nab Custom Block'),
        description: __('Add a pre-defined custom layout.'),
        icon: 'editor-table',
        category: 'nabshow',
        keywords: [__('custom'), __('gutenberg'), __('nab')],
        attributes: allAttributes,
        edit: (props) => {
            const { attributes, setAttributes, className, clientId } = props;
            const { columns, colLayout, backgroundImage, backgroundColor, backgroundSize, backgroundPosition, backgroundAttachment, borderStyle, borderWidth, borderColor, borderRadius, textAlign, width, height, opacity, overlayColor, paddingTop, paddingRight, paddingBottom, paddingLeft, marginTop, marginRight, marginBottom, marginLeft, gradientRange1, gradientRange2, gradientRange3, color1, color2, color3, gradientType, topBorderStyle, topBorderWidth, topBorderColor, topBorderRadius, bottomBorderStyle, bottomBorderWidth, bottomBorderColor, bottomBorderRadius, rightBorderStyle, rightBorderWidth, rightBorderColor, rightBorderRadius, leftBorderStyle, leftBorderWidth, leftBorderColor, leftBorderRadius, elementID, hAlign, vAlign, layout, ToggleInserter, clientID, showTitle } = attributes;
            const columnOptions = [
                {
                    name: __('1 Column'),
                    key: 'one-column',
                    columns: 1,
                    icon: icons.oneEqual
                },
                {
                    name: __('2 Columns'),
                    key: 'two-column',
                    columns: 2,
                    icon: icons.twoEqual
                },
                {
                    name: __('2 Columns - 75/25'),
                    key: 'nab-2-col-wideleft',
                    columns: 2,
                    icon: icons.twoLeftWide
                },
                {
                    name: __('2 Columns - 25/75'),
                    key: 'nab-2-col-wideright',
                    columns: 2,
                    icon: icons.twoRightWide
                },
                {
                    name: __('3 Columns'),
                    key: 'three-column',
                    columns: 3,
                    icon: icons.threeEqual
                },
            ];


            setAttributes({ clientID: clientId });

            const classes = classnames(
                className,
                layout && `has-${layout}`,
                colLayout && `block-${colLayout}`,
                vAlign && `vblock-${vAlign}`,
                hAlign && `hblock-${hAlign}`,
                showTitle && 'has-block-title',
                width && 'has-custom-width',
                {
                    'has-background-size': backgroundSize,
                    'has-background-attachment': backgroundAttachment,
                    'has-background-opacity': 0 !== opacity,

                },
                opacityRatioToClass(opacity)
            );
            const style = {};
            backgroundImage && (style.backgroundImage = `url(${backgroundImage})`);
            backgroundColor && (style.backgroundColor = backgroundColor);
            backgroundPosition && (style.backgroundPosition = backgroundPosition);
            textAlign && (style.textAlign = textAlign);
            width && (style.width = width + '%');
            height && (style.height = height + 'px');
            overlayColor && (style.backgroundColor = overlayColor);
            paddingTop && (style.paddingTop = paddingTop + 'px');
            paddingRight && (style.paddingRight = paddingRight + 'px');
            paddingBottom && (style.paddingBottom = paddingBottom + 'px');
            paddingLeft && (style.paddingLeft = paddingLeft + 'px');
            marginTop && (style.marginTop = marginTop + 'px');
            marginRight && (style.marginRight = marginRight + 'px');
            marginBottom && (style.marginBottom = marginBottom + 'px');
            marginLeft && (style.marginLeft = marginLeft + 'px');
            (gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3)) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');
            marginTop && (style.marginTop = marginTop + 'px');

            if (borderStyle) {
                style.borderStyle = borderStyle;
                if (borderWidth) {
                    style.borderWidth = borderWidth + 'px';
                }
                if (borderColor) {
                    style.borderColor = borderColor;
                }
                if (borderRadius) {
                    style.borderRadius = borderRadius;
                }
            } else {
                if (topBorderStyle) {
                    style.borderTopStyle = topBorderStyle;
                    if (topBorderWidth) {
                        style.borderTopWidth = topBorderWidth + 'px';
                    }
                    if (topBorderColor) {
                        style.borderTopColor = topBorderColor;
                    }
                    if (topBorderRadius) {
                        style.borderTopLeftRadius = topBorderRadius;
                    }
                }
                if (bottomBorderStyle) {
                    style.borderBottomStyle = bottomBorderStyle;
                    if (bottomBorderWidth) {
                        style.borderBottomWidth = bottomBorderWidth + 'px';
                    }
                    if (bottomBorderColor) {
                        style.borderBottomColor = bottomBorderColor;
                    }
                    if (bottomBorderRadius) {
                        style.borderBottomRightRadius = bottomBorderRadius;
                    }
                }
                if (rightBorderStyle) {
                    style.borderRightStyle = rightBorderStyle;
                    if (rightBorderWidth) {
                        style.borderRightWidth = rightBorderWidth + 'px';
                    }
                    if (rightBorderColor) {
                        style.borderRightColor = rightBorderColor;
                    }
                    if (rightBorderRadius) {
                        style.borderTopRightRadius = rightBorderRadius;
                    }
                }
                if (leftBorderStyle) {
                    style.borderLeftStyle = leftBorderStyle;
                    if (leftBorderWidth) {
                        style.borderLeftWidth = leftBorderWidth + 'px';
                    }
                    if (leftBorderColor) {
                        style.borderLeftColor = leftBorderColor;
                    }
                    if (leftBorderRadius) {
                        style.borderBottomLeftRadius = leftBorderRadius;
                    }
                }
            }

            /* Show the layout placeholder. */
            if (! colLayout) {
                return [
                    <Placeholder
                        key="placeholder"
                        icon="editor-table"
                        label={columns ? __('Column Layout', 'atomic-blocks') : __('Column Number', 'atomic-blocks')}
                        instructions={columns ? __('Select a layout for this column.', 'atomic-blocks') : __('Select the number of columns for this layout.', 'atomic-blocks')}
                        className={'nab-column-selector-placeholder'}
                    >
                        {! columns &&
                            <ButtonGroup
                                aria-label={__('Select Row Columns', 'atomic-blocks')}
                                className="nab-column-selector-group"
                            >
                                {map(columnOptions, ({ name, key, icon, columns }) => (
                                    <Tooltip text={name} key={key}>
                                        <div className="nab-column-selector">
                                            <Button
                                                className="nab-column-selector-button"
                                                isSmall
                                                onClick={() => { setAttributes({ columns: columns, colLayout: key }); }}
                                            >
                                                {icon}
                                            </Button>
                                        </div>
                                    </Tooltip>
                                ))}
                            </ButtonGroup>
                        }
                    </Placeholder>
                ];
            }


            return [
                <Fragment>
                    <Inspector {...{ attributes, setAttributes, getLayoutTemplate }} />
                    <div id={elementID} className={`custom-box ${classes} ${ToggleInserter ? 'nab-inserter-on' : 'nab-inserter-off'}`} style={style}>
                        <div className="custom-box-container">
                            <div className="row custom-box-row" >
                                <InnerBlocks
                                    template={getLayoutTemplate(columns)}
                                    templateLock="all"
                                    allowedBlocks={ALLOWED_BLOCKS}
                                />
                            </div>
                        </div>
                    </div>
                </Fragment>
            ];
        },
        save: (props) => {
            const { attributes, className } = props;
            const { columns, colLayout, backgroundImage, backgroundColor, backgroundSize, backgroundPosition, backgroundAttachment, borderStyle, borderWidth, borderColor, borderRadius, textAlign, width, height, opacity, overlayColor, paddingTop, paddingRight, paddingBottom, paddingLeft, marginTop, marginRight, marginBottom, marginLeft, gradientRange1, gradientRange2, gradientRange3, color1, color2, color3, gradientType, topBorderStyle, topBorderWidth, topBorderColor, topBorderRadius, bottomBorderStyle, bottomBorderWidth, bottomBorderColor, bottomBorderRadius, rightBorderStyle, rightBorderWidth, rightBorderColor, rightBorderRadius, leftBorderStyle, leftBorderWidth, leftBorderColor, leftBorderRadius, elementID, hAlign, vAlign, layout, ToggleInserter, blockTitle, showTitle } = attributes;
            const classes = classnames(
                className,
                layout && `has-${layout}`,
                colLayout && `block-${colLayout}`,
                vAlign && `vblock-${vAlign}`,
                hAlign && `hblock-${hAlign}`,
                showTitle && 'has-block-title',
                width && 'has-custom-width',
                {
                    'has-background-size': backgroundSize,
                    'has-background-attachment': backgroundAttachment,
                    'has-background-opacity': 0 !== opacity,

                },
                opacityRatioToClass(opacity)
            );

            const style = {};
            backgroundImage && (style.backgroundImage = `url(${backgroundImage})`);
            backgroundColor && (style.backgroundColor = backgroundColor);
            backgroundPosition && (style.backgroundPosition = backgroundPosition);
            textAlign && (style.textAlign = textAlign);
            width && (style.width = width + '%');
            height && (style.height = height + 'px');
            overlayColor && (style.backgroundColor = overlayColor);
            paddingTop && (style.paddingTop = paddingTop + 'px');
            paddingRight && (style.paddingRight = paddingRight + 'px');
            paddingBottom && (style.paddingBottom = paddingBottom + 'px');
            paddingLeft && (style.paddingLeft = paddingLeft + 'px');
            marginTop && (style.marginTop = marginTop + 'px');
            marginRight && (style.marginRight = marginRight + 'px');
            marginBottom && (style.marginBottom = marginBottom + 'px');
            marginLeft && (style.marginLeft = marginLeft + 'px');
            (gradientType && ('#fff' !== color1 || '#fff' !== color2 || '#fff' !== color3)) && (style.background = 'linear-gradient(' + gradientType + ', ' + color1 + ' ' + gradientRange1 + '%, ' + color2 + ' ' + gradientRange2 + '%, ' + color3 + ' ' + gradientRange3 + '%)');
            marginTop && (style.marginTop = marginTop + 'px');

            if (borderStyle) {
                style.borderStyle = borderStyle;
                if (borderWidth) {
                    style.borderWidth = borderWidth + 'px';
                }
                if (borderColor) {
                    style.borderColor = borderColor;
                }
                if (borderRadius) {
                    style.borderRadius = borderRadius;
                }
            } else {
                if (topBorderStyle) {
                    style.borderTopStyle = topBorderStyle;
                    if (topBorderWidth) {
                        style.borderTopWidth = topBorderWidth + 'px';
                    }
                    if (topBorderColor) {
                        style.borderTopColor = topBorderColor;
                    }
                    if (topBorderRadius) {
                        style.borderTopLeftRadius = topBorderRadius;
                    }
                }
                if (bottomBorderStyle) {
                    style.borderBottomStyle = bottomBorderStyle;
                    if (bottomBorderWidth) {
                        style.borderBottomWidth = bottomBorderWidth + 'px';
                    }
                    if (bottomBorderColor) {
                        style.borderBottomColor = bottomBorderColor;
                    }
                    if (bottomBorderRadius) {
                        style.borderBottomRightRadius = bottomBorderRadius;
                    }
                }
                if (rightBorderStyle) {
                    style.borderRightStyle = rightBorderStyle;
                    if (rightBorderWidth) {
                        style.borderRightWidth = rightBorderWidth + 'px';
                    }
                    if (rightBorderColor) {
                        style.borderRightColor = rightBorderColor;
                    }
                    if (rightBorderRadius) {
                        style.borderTopRightRadius = rightBorderRadius;
                    }
                }
                if (leftBorderStyle) {
                    style.borderLeftStyle = leftBorderStyle;
                    if (leftBorderWidth) {
                        style.borderLeftWidth = leftBorderWidth + 'px';
                    }
                    if (leftBorderColor) {
                        style.borderLeftColor = leftBorderColor;
                    }
                    if (leftBorderRadius) {
                        style.borderBottomLeftRadius = leftBorderRadius;
                    }
                }
            }

            return (
                <div id={elementID} className={`custom-box ${classes}`} style={style}>
                    <div className="custom-box-container">
                        <div className="row custom-box-row" >
                            <InnerBlocks.Content />
                        </div>
                    </div>
                </div>
            );
        }
    });

    registerBlockType('nab/nab-column', {
        title: __('Nab Column'),
        description: __('Nab Column creates column wise layout'),
        icon: 'editor-table',
        category: 'nabshow',
        parent: ['nab/custom'],
        attributes: allAttributes,
        edit: (props) => {

            const { attributes, setAttributes, className, clientId } = props;

            return (
                <Fragment>

                    <div className={'custom-content-box '}>
                        <div className="content-inner">
                            <InnerBlocks
                                templateLock={false}
                            />
                        </div>
                    </div>
                </Fragment>
            );
        },
        save: (props) => {

            const { attributes, setAttributes, className, clientId } = props;

            return (
                <Fragment>
                    <div className={'custom-content-box '}>
                        <div className="content-inner">
                            <InnerBlocks.Content />
                        </div>
                    </div>
                </Fragment >
            );
        }
    });

})(wp.i18n, wp.blocks, wp.editor, wp.components, wp.element);

function opacityRatioToClass(ratio) {
    return (0 === ratio) ?
        null :
        'has-background-opacity-' + (10 * Math.round(ratio / 10));
}