// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

import { editGrid } from './about/edit.js';
import { renderGrid } from './about/render.js';


 
export default registerBlockType( 'printing/services', {

    title: 'Printing Express - Services',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'printing-express',
    supports: { align: ["full"], default: 'full' },

    attributes: {
       
        background: {
            type: "string",
            default: "blue"
        },
        customBackground: {
            type: "string"
        },

    },
            
    getEditWrapperProps( attributes ) {
            return { 'data-align': 'full' };
    },
    // ...
 
   // edit: editGrid,

   edit: () => {
       return <section className="bg-blue color-white pe-services_wrapper">
                <div className="container">
                    <p>Hello</p>
                </div>
              </section>
       
   },

   save: () => {
    return <section className="bg-blue color-white pe-services_wrapper">
                <div className="container">
                    <p>Hello</p>
                </div>
              </section>
       
    
}
 
   // save: renderGrid,
} );