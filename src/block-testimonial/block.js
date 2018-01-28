/**
 * BLOCK: Atomic Toolbox Testimonial
 */

import classnames from 'classnames';
import icons from './icons';

//  Import CSS
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; 
const { 
	registerBlockType,
	Editable,
	AlignmentToolbar,
	BlockControls,
	BlockAlignmentToolbar,
	MediaUploadButton,
	MediaUpload,
	ImagePlaceHolder,
} = wp.blocks;

const {
	IconButton,
	Button,
	Tooltip,
} = wp.components;

// Register the block
registerBlockType( 'atomic/atomic-toolbox-testimonial', {
	title: __( 'Atomic - Testimonial', 'atomic' ),
	icon: 'format-quote',
	category: 'common',
	keywords: [
		__( 'atomic-toolbox — CGB Block' ),
		__( 'CGB Example' ),
		__( 'create-guten-block' ),
	],
	attributes: {
		testimonialName: {
			type: 'string',
			selector: '.testimonial-name',
		},
		testimonialTitle: {
			type: 'string',
			selector: '.testimonial-title',
		},
		testimonialText: {
			type: 'array',
			selector: '.testimonial-text',
			source: 'children',
		},
		width: {
			type: 'string',
		},
		alignment: {
			type: 'string',
		},
		imgURL: {
			type: 'string',
			source: 'attribute',
			attribute: 'src',
			selector: 'img',
		},
		imgID: {
			type: 'number',
		},
		imgAlt: {
			type: 'string',
			source: 'attribute',
			attribute: 'alt',
			selector: 'img',
		}
	},

	getEditWrapperProps( attributes ) {
		const { width } = attributes;
		if ( 'wide' === width || 'full' === width ) {
			return { 'data-align': width };
		}
	},

	edit: function( props ) {
		// Change the text alignment
		const onChangeAlignment = value =>  {
			props.setAttributes( { alignment: value } );
		};

		// Change the alignment width
		const onChangeAlignmentWidth = value =>  {
			props.setAttributes( { width: value } );
		};

		// Populate the mobile image
		const onSelectImage = img => {
			props.setAttributes( {
				imgID: img.id,
				imgURL: img.url,
				imgAlt: img.alt,
			} );
		};
	
		// Remove the mobile image
		const onRemoveImage = () => {
			props.setAttributes({
				imgID: null,
				imgURL: null,
				imgAlt: null,
			});
		};

		// Construct block classes
		const blockClasses = classnames(
			props.className,
			{ 'has-avatar': props.attributes.imgURL }
		);

		return [
			!! props.focus && (
				<BlockControls key="controls">
					<BlockAlignmentToolbar
						value={ props.attributes.alignment }
						onChange={ onChangeAlignmentWidth }
					/>
				</BlockControls>
			),
			<div className={ blockClasses }>
				<Editable
					tagName="div"
					multiline="p"
					placeholder={ __( 'Add testimonial text...' ) }
					value={ props.attributes.testimonialText }
					className='testimonial-text'
					style={ {
						textAlign: props.attributes.alignment,
					} }
					onChange={ ( value ) => props.setAttributes( { testimonialText: value } ) }
				/>

				<div class="testimonial-info">
					<div class="testimonial-avatar-wrap">
						{ ! props.attributes.imgID ? (
							[
								<div class="testimonial-image-wrap">
									<MediaUploadButton
										buttonProps={ {
											className: 'change-image'
										} }
										onSelect={ onSelectImage }
										type="image"
										value={ props.attributes.imgID }
									>
										{ icons.upload }
									</MediaUploadButton>
								</div>
							]
						) : (
							[
								<div class="testimonial-image-wrap">
									<MediaUploadButton
										buttonProps={ {
											className: 'change-image'
										} }
										onSelect={ onSelectImage }
										type="image"
										value={ props.attributes.imgID }
									>
										{ icons.upload }
									</MediaUploadButton>

									<img
										class="testimonial-avatar"
										src={ props.attributes.imgURL }
										alt={ props.attributes.imgAlt }
									/>
								</div>
							]
						)}
					</div>

					<Editable
						tagName="h2"
						placeholder={ __( 'Add name...' ) }
						value={ props.attributes.testimonialName }
						className='testimonial-name'
						style={ {
							textAlign: props.attributes.alignment,
						} }
						onChange={ ( value ) => props.setAttributes( { testimonialName: value } ) }
					/>
					
					<Editable
						tagName="small"
						placeholder={ __( 'Add title...' ) }
						value={ props.attributes.testimonialTitle }
						className='testimonial-title'
						style={ {
							textAlign: props.attributes.alignment,
						} }
						onChange={ ( value ) => props.setAttributes( { testimonialTitle: value } ) }
					/>
				</div>
			</div>
		];
	},

	// Save the attributes and markup
	save: function( props ) {
		return (
			<div className={ classnames(
				props.className,
				{ 'has-avatar': props.attributes.imgURL }
			  ) }
			  >
				<div class="testimonial-text">{ props.attributes.testimonialText }</div>
				
				<div class="testimonial-info">
					<div class="testimonial-avatar-wrap">
						<img
							class="testimonial-avatar"
							src={ props.attributes.imgURL }
							alt={ props.attributes.imgAlt }
						/>
					</div>

					<h2 class="testimonial-name">{ props.attributes.testimonialName }</h2>
					<small class="testimonial-title">{ props.attributes.testimonialTitle }</small>
				</div>
			</div>
		);
	},
} );
