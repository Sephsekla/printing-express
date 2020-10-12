// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls, RichText } = wp.blockEditor;

import { editServices } from './services/edit.js';

import './services/inner.js';


 
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
        title: {
            type: "string",
            default: "Your title here..."
        
        },

    },
            
    getEditWrapperProps( attributes ) {
            return { 'data-align': 'full' };
    },
    // ...
 
   // edit: editGrid,

   edit: editServices,

   save: (props) => {

    const {title} = props.attributes;

    return <section className="bg-blue color-white pe-services_wrapper">
                <div className="container">
                    <h2>{title}</h2>
                    <div className="row justify-content-center">
                        <InnerBlocks.Content/>
                    </div>
                </div>
              </section>
       
    
}
 
   // save: renderGrid,
} );