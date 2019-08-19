import Popup from './components/popup';
import { SelectBlock } from '../icons';

/****   For Select Block***/
(function (wpI18n, wpBlocks) {
	const { __ } = wpI18n;
	const { registerBlockType } = wpBlocks;

	registerBlockType('rgblocks/select-block', {
		title: __('Select RGBlocks'),
		icon: SelectBlock,
		description: __('Provides Reusable blocks with new layout.'),
		category: 'common',
		keywords: [__('Select RGBlocks'), __('gutenberg'), __('RGBlocks')],
		attributes: {
			content: {
				type: 'string',
				default: ''
			}
		},
		edit(props) {
			const { attributes: { content }, setAttributes } = props;
			return (
				<div className="select_block">
					<Popup data={props} />
					<div className="result">{content}</div>
				</div>
			);
		},
		save() {
			return null;
		}
	});
})(wp.i18n, wp.blocks);
