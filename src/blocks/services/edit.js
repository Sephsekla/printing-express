var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks, MediaUpload, Editable, InspectorControls, BlockControls, withColors, PanelColorSettings, getColorClassName, RichText} = wp.blockEditor;
const {  Toolbar,
    Button,
    Tooltip,
    PanelBody,
    PanelRow,
    FormToggle,
    ColorPalette } = wp.components;

const {Fragment} = wp.element;



/**
 * Edit grid
 */
const editServices = withColors('background')(( props ) => {

    const {className, setAttributes, isSelected} = props;




    const { title } = props.attributes;
    
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;



        return <section className="bg-blue color-white pe-services_wrapper">
                <div className="container">
                <RichText
                tagName="h2" // The tag here is the element output and editable in the admin
                className={ 'title' }
                value={ title } // Any existing content, either from the database or an attribute default
                formattingControls={ [ ] } // Allow the content to be made bold or italic, but do not allow other formatting options
                onChange={ ( title ) => setAttributes( { title } ) } // Store updated content as a block attribute
                placeholder={ 'title' } // Display this text before any content has been added by the user
                />
                </div>
              </section>
})

export {editServices};