// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid } from './charity/edit.js';
import { renderGrid } from './charity/render.js';


 
export default registerBlockType( 'printing/charity', {

    title: 'Printing Express - Charity Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
    supports: { align: ["full"], default: 'full' },

    attributes: {
        reverseOrder: {
            type: 'boolean',
            default: false,
        },
        background: {
            type: "string",
            default: "blue"
        },
        customBackground: {
            type: "string"
        }

    },
            
    getEditWrapperProps( attributes ) {
            return { 'data-align': 'full' };
    },
    // ...
 
    edit: editGrid,
 
    save: renderGrid,
} );