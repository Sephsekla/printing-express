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

function __($input,$a){
return $input;
}


const editGrid = withColors('background')(( props ) => {

    const {className, setAttributes, isSelected} = props;




    const { imgID, imgURL, imgAlt, reverseOrder } = props.attributes;
    
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;

        console.log(background);
        console.log(props.attributes);

        const toggleReverse = () => setAttributes( { reverseOrder: ! reverseOrder } );
        

        const onSelectImage = img => {
            setAttributes( {
                imgID: img.id,
                imgURL: img.url,
                imgAlt: img.alt,
            } );
        };
        const onRemoveImage = () => {
            setAttributes({
                imgID: null,
                imgURL: null,
                imgAlt: null,
            });
        }

    return [
        <InspectorControls>
             <PanelBody
                        title={ __( 'Grid Layout', 'jsforwpblocks' ) }
                    >
                        <PanelRow>
                            <label
                                htmlFor="reverse-form-toggle"
                            >
                                { __( 'Reverse Order', 'jsforwpblocks' ) }
                            </label>
                            <FormToggle
                                id="reverse-form-toggle"
                                label={ __( 'Reverse Order', 'jsforwpblocks' ) }
                                checked={ reverseOrder }
                                onChange={ toggleReverse }
                                
                            />
                        </PanelRow>
                       

                    </PanelBody>
                    <PanelColorSettings
          title={__("Color Settings", "jsforwpblocks")}
          colorSettings={[
            {
               // colors: colorSamples,
              value: background.value,
              onChange: setBackground,
              label: __("Background Color")
            }
          ]}
        />
        </InspectorControls>,


        <div className={ classnames('pe-grid_wrapper',className, `bg-${props.attributes.background}`) }>
            <div className={ classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
                <div className={'col-12 col-lg-6 image-column'}>
                { ! imgID ? (

                    <MediaUpload
                        onSelect={ onSelectImage }
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

                    ) : (

                    <div className={'image-wrapper'} style={{backgroundImage: `url(${ imgURL })`}}>
                        <picture>
                        <img
                            src={ imgURL }
                            alt={ imgAlt }
                        />
                        </picture>

                        { isSelected ? (

                            <Button
                                className="remove-image"
                                onClick={ onRemoveImage }
                            >
                            Remove Image
                            </Button>

                        ) : null }

                    </div>
                    )}

                </div>
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={classnames('container split-lg-container grid-content', reverseOrder ? 'left' : 'right')}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </div>
    ];
})

export {editGrid};