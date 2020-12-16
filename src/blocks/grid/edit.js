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

const {useSelect, withSelect} = wp.data;



/**
 * Edit grid
 */
const editGrid = withColors('background')(( props ) => {

    return useSelect( select => {

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
                    imageValue => {
                        const media = select( 'core').getMedia( imageValue.id );

                        console.log(media);
                        
                        return {
                        url: media && media.media_details.sizes.medium ? media.media_details.sizes.medium.source_url : imageValue.url,
                        id: imageValue.id,
                        alt: imageValue.alt
                    }}
                )
            } )

            


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


        <section className={ classnames('pe-grid_wrapper',className, `bg-${props.attributes.background}`) }>
            <div className={ classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
               
                { ! imgArray.length ? (
                <div className={'col-12 col-lg-6 image-column'}>
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
                </div>

                    ) : (

                        <div className={'col-12 col-lg-6 image-column'}>  

                        

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

            
                    </div>
                    )}

                
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={classnames('container split-lg-container grid-content', reverseOrder ? 'left' : 'right')}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </section>
    ];

})
})

export {editGrid};