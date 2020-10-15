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

import {CreateInnerImage} from '../shared/multi-images.js';


/**
 * Edit grid
 */
const editGrid = withColors('background')(( props ) => {

    const {className, setAttributes, isSelected} = props;




    const { imgID, imgURL, imgAlt, reverseOrder, imgArray, quote, name } = props.attributes;
    
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;



        const toggleReverse = () => setAttributes( { reverseOrder: ! reverseOrder } );


        const onSelectImage = img => {



            setAttributes( {
            /*   imgID: img.id,
                imgURL: img.url,
                imgAlt: img.alt, */

                imgArray: img.map(
                    imageValue => ({
                        url: imageValue.url,
                        id: imageValue.id,
                        alt: imageValue.alt
                    })
                )
            } );


        };
        const onRemoveImage = () => {
            setAttributes({
                imgID: null,
                imgURL: null,
                imgAlt: null,
                imgArray: {}
            });
        }



    return [
        <InspectorControls>
             <PanelBody
                        title={ 'About' }
                    >
                        <PanelRow>
                            <label
                                htmlFor="reverse-form-toggle"
                            >
                                { 'Reverse Order' }
                            </label>
                            <FormToggle
                                id="reverse-form-toggle"
                                label={ 'Reverse Order' }
                                checked={ reverseOrder }
                                onChange={ toggleReverse }
                                
                            />
                        </PanelRow>
                       

                    </PanelBody>
                    <PanelColorSettings
          title={"Color Settings"}
          colorSettings={[
            {
               // colors: colorSamples,
              value: background.value,
              onChange: setBackground,
              label: "Background Color"
            }
          ]}
        />
        </InspectorControls>,


        <section className={ classnames('pe-about_wrapper',className) }>
            <div className={ classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
               
               
                <div className={classnames('col-12 col-lg-4 image-column', `bg-${props.attributes.background}`)}>
                    <div className="container quote-wrapper">
                    <RichText
                tagName="p" // The tag here is the element output and editable in the admin
                className={ 'quote' }
                value={ quote } // Any existing content, either from the database or an attribute default
                formattingControls={ [ ] } // Allow the content to be made bold or italic, but do not allow other formatting options
                onChange={ ( quote ) => setAttributes( { quote } ) } // Store updated content as a block attribute
                placeholder={ 'Quote...' } // Display this text before any content has been added by the user
            />
                         <RichText
                tagName="p" // The tag here is the element output and editable in the admin
                className={ 'name' }
                value={ name } // Any existing content, either from the database or an attribute default
                formattingControls={ [ ] } // Allow the content to be made bold or italic, but do not allow other formatting options
                onChange={ ( name ) => setAttributes( { name } ) } // Store updated content as a block attribute
                placeholder={ 'Name...' } // Display this text before any content has been added by the user
            />
                    </div>
                    { ! imgArray.length ? (
               
                    <MediaUpload
                        onSelect={ onSelectImage }
                        multiple="true"
                        type="image"
                        render={ ( { open } ) => (
                            <Button
                                className={ "button button-large" }
                                onClick={ open }
                            >Upload Image
                            </Button>
                        ) }
                    >
                    </MediaUpload>


                    ) : (

                        
                        <Fragment>

                        <CreateInnerImage {...props }/>

                        {isSelected ? (

                                <MediaUpload
                                onSelect={ onSelectImage }
                                multiple="true"
                                type="image"
                                value={ imgArray.map(
                                    image => image.id
                                ) }
                                render={ ( { open } ) => (
                                    <Button
                                        className={ "button button-large" }
                                        onClick={ open }
                                    >Edit Images
                                    </Button>
                                ) }
                                >
                                </MediaUpload>
                    
                            ) : null} 

                    </Fragment>

                        

                    

                    )}
                </div>


                
                <div className={'col-12 col-lg-8 grid-content-wrapper color-dark'}>
                    <div className={classnames('container grid-content')}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </section>
    ];
})

export {editGrid};