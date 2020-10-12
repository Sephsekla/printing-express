// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls, RichText } = wp.blockEditor;



 
export default registerBlockType( 'printing/services-inner', {

    title: 'Printing Express - Services (Inner)',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'printing-express',
    parent: ['printing/services'],
    supports: { },

    attributes: {
       

        title: {
            type: "string",
            default: "Your title here..."
        
        },

    },
            
    getEditWrapperProps( attributes ) {
            //return { 'data-align': 'full' };
    },
    // ...
 
   // edit: editGrid,

   edit: (props) => {

    const {title} = props.attributes;

    return <div className="service">
                    <p>{title}</p>
                </div>
             
       
    
},

   save: (props) => {

    const {title} = props.attributes;

    return <div className="service col-12 service-column">
                    <p>{title}</p>
                </div>
             
       
    
}
 
   // save: renderGrid,
} );