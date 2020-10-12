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
        icon: {
            type: "string",
            default: "icon"
        
        },


    },
            
    getEditWrapperProps( attributes ) {
            //return { 'data-align': 'full' };
    },
    // ...
 
   // edit: editGrid,

   edit: (props) => {

    const {title, icon} = props.attributes;

    const {className, setAttributes, isSelected} = props;

    return <div className="service">
                {isSelected ? 

                <RichText
                tagName="p" // The tag here is the element output and editable in the admin
                //className={ }
                value={ icon } // Any existing content, either from the database or an attribute default
                formattingControls={ [ ] } // Allow the content to be made bold or italic, but do not allow other formatting options
                onChange={ ( icon ) => setAttributes( { icon } ) } // Store updated content as a block attribute
                placeholder={ 'Your icon here...' } // Display this text before any content has been added by the user
                />

                :

                <img src={`${localize.themeUri}/dist/assets/icons/services/${icon}.svg`} /> }

                    <RichText
                tagName="p" // The tag here is the element output and editable in the admin
                //className={ }
                value={ title } // Any existing content, either from the database or an attribute default
                formattingControls={ [ ] } // Allow the content to be made bold or italic, but do not allow other formatting options
                onChange={ ( title ) => setAttributes( { title } ) } // Store updated content as a block attribute
                placeholder={ 'Your title here...' } // Display this text before any content has been added by the user
                />
                </div>
             
       
    
},

   save: (props) => {

    const {title, icon} = props.attributes;

    return <div className="service col-12 service-column">
           <img src={`${localize.themeUri}/dist/assets/icons/services/${icon}.svg`} />
                    <p>{title}</p>
                </div>
             
       
    
}
 
   // save: renderGrid,
} );