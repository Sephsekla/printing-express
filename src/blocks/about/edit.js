var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks, MediaUpload, Editable, InspectorControls, BlockControls, withColors, PanelColorSettings, getColorClassName} = wp.blockEditor;
const {  Toolbar,
    Button,
    Tooltip,
    PanelBody,
    PanelRow,
    FormToggle,
    ColorPalette } = wp.components;

import {CreateInnerImage} from '../shared/multi-images.js';


/**
 * Edit grid
 */
const editGrid = withColors('background')(( props ) => {

    const {className, setAttributes, isSelected} = props;




    const { imgID, imgURL, imgAlt, reverseOrder, imgArray } = props.attributes;
    
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
                        title={ 'Grid Layout' }
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

                

                
               
                { ! imgArray.length ? (
                <div className={classnames('col-12 col-lg-4',`bg-${props.attributes.background}`)}>
                    <p>Test goes here</p>
                    <div className="image-column">
                    <MediaUpload
                        onSelect={ onSelectImage }
                        multiple="true"
                        type="image"
                        value={ imgID }
                        render={ ( { open } ) => (
                            <Button
                                className={ "button button-large" }
                                onClick={ open }
                            >Upload Image
                            </Button>
                        ) }
                    >
                    </MediaUpload>
                    </div>
                </div>

                    ) : (

                        <div className={classnames('col-12 col-lg-4',`bg-${props.attributes.background}`)}>  
                        <p>Test goes here</p>
                        <div className="image-column">

                        

                        <CreateInnerImage {...props }/>

                        {isSelected ? (

                            <Button
                                className="remove-image"
                                onClick={ onRemoveImage }
                            >
                            Remove Images
                            </Button>
                    
                            ) : null}

                            </div>
                    </div>
                    )}

                
                <div className={'col-12 col-lg-8 grid-content-wrapper'}>
                        <InnerBlocks />
                </div>
            </div>
            
        </section>
    ];
})

export {editGrid};