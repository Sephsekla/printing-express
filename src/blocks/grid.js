// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid } from './grid/edit.js';
import { renderGrid } from './grid/render.js';


 
export default registerBlockType( 'printing/grid', {

    title: 'Printing Express - Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
    supports: { align: ["full"], default: 'full' },

    attributes: {
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
        },
        reverseOrder: {
            type: 'boolean',
            default: false,
        },
    },
            
    getEditWrapperProps( attributes ) {
            return { 'data-align': 'full' };
    },
    // ...
 
    edit: editGrid,
 
    save: renderGrid,
} );