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

const {useSelect, withSelect} = wp.data;

const {compose, createHigherOrderComponent} = wp.compose;

const CharityImage  = withSelect( ( select, props) => {
    const {featured_media} =  props;
    return {
       media: select( 'core').getMedia( featured_media )

    };
} )( ( { media } ) => {
    if ( ! media ) {
        return 'Loading...';
    }



return[console.log(media.media_details.mime_type),console.log(media),<p><img src={media.media_details.sizes.medium.source_url} width={media.media_details.sizes.medium.width} height={media.media_details.sizes.medium.height} /></p>]; 
}

)



const editGrid = ( props ) => {
        

    const {className, setAttributes, isSelected} = props;





    const { reverseOrder } = props.attributes;
    
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;



        const toggleReverse = () => setAttributes( { reverseOrder: ! reverseOrder } );
        

 

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
                <div className={'col-12 col-lg-6 grid-charity-wrapper'}>
                <div className={classnames('container split-lg-container grid-content color-dark bg-white', !reverseOrder ? 'left' : 'right')}>
                    <h2>Follow Us</h2>
                        <p>Social Icons go here</p>
                    </div>

                </div>
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={classnames('container split-lg-container grid-content', reverseOrder ? 'left' : 'right')}>
                        <h2>Latest News</h2>
                        <p>Social feed goes here</p>
                    </div>
                </div>
            </div>
            
        </section>
    ];

};


const editGridWithHOC = withColors('background')(editGrid);





export {editGrid, editGridWithHOC};