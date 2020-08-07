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

const editGrid = withColors('background')(( { attributes: { imgID, imgURL, imgAlt, reverseOrder, background, backgroundClass },
    className, setAttributes, isSelected } ) => {

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
                        title={ __( 'Grid styles', 'jsforwpblocks' ) }
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
                            <ColorPalette
                                value={background}
                                onChange={background => {
                                    console.log(background);
                                    setAttributes({ background });
                                            }}
                            />
                        </PanelRow>
                        <PanelColorSettings
          title={__("Color Settings", "jsforwpblocks")}
          colorSettings={[
            {
              value: background,
              onChange: selectedColor => {
                  console.log(selectedColor);
                setAttributes({ background: selectedColor });
                console.log(background);
                console.log(getColorClassName('color',selectedColor));
              },
              label: __("Background Color")
            }
          ]}
        />

                    </PanelBody>
        </InspectorControls>,


        <div className={ classnames('pe-grid_wrapper',className) }>
            <div className={ classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
                <div className={'col-12 col-lg-6'}>
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
                    <div className={'container split-lg-container grid-content'}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </div>
    ];
})

export {editGrid};