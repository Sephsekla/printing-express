// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid } from './about/edit.js';
import { renderGrid } from './about/render.js';


 
export default registerBlockType( 'printing/about', {

    title: 'Printing Express - About',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'printing-express',
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
        background: {
            type: "string",
            default: "blue"
        },
        customBackground: {
            type: "string"
        },

        imgArray: {
            type: "array",
            default: [],
        },
        quote: {
            type: "string",
            default: "Your quote here..."
        
        },
        name: {
            type: "string",
            default: "Your name here..."
        
        },

    },
            
    getEditWrapperProps( attributes ) {
            return { 'data-align': 'full' };
    },
    // ...
 
    edit: editGrid,
 
    save: renderGrid,
} );