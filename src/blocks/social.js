// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid, editGridWithHOC} from './social/edit.js';
import { renderGrid } from './social/render.js';


 
export default registerBlockType( 'printing/social', {

    title: 'Printing Express - social Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'printing-express',
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
 
    edit: editGridWithHOC,
 
    save: renderGrid,
} );