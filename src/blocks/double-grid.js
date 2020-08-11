// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid } from './double-grid/edit.js';
import { renderGrid } from './double-grid/render.js';


 
export default registerBlockType( 'printing/double-grid', {

    title: 'Printing Express - Double Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
    supports: { align: ["full"], default: 'full' },

    attributes: {
       
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