/**
 * BLOCK: Atomic Toolbox Testimonial List
 */

import classnames from 'classnames';
import PostList from './post-list';

//  Import CSS
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; 
const { 
	registerBlockType,
} = wp.blocks;

// Register the block
registerBlockType( 'atomic/atomic-toolbox-testimonial-list', {
	title: __( 'Atomic - Testimonial List', 'atomic' ),
	icon: 'format-quote',
	category: 'common',
	keywords: [
		__( 'atomic-toolbox — CGB Block' ),
		__( 'CGB Example' ),
		__( 'create-guten-block' ),
	],

	edit: props => {
		return (
			<PostList
			className={props.className}
			/>
		);
	},

	save: props => {
		// Rendered via PHP
		return null
	},
});
