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

const {withSelect} = wp.data;

const {compose, createHigherOrderComponent} = wp.compose;

function __($input,$a){
return $input;
}

const DynamicContent = withSelect( ( select ) => {
    return {
        posts: select( 'core' ).getEntityRecords( 'postType', 'charity-partners' ),
       // media: select( 'media' ).getEntityRecords( ),

    };
} )( ( { posts, className } ) => {
    if ( ! posts ) {
        return 'Loading...';
    }

    if ( posts && posts.length === 0 ) {
        return 'No charities found';
    }



    return (

        //console.log(media),

    <div className={'row'}>
        { posts.map( post => {
           const featuredImageId = post.featured_media;
           const featuredImage = wp.data.select( 'core').getMedia( featuredImageId );
           return[ console.log(post),
            <div className={'col-6 col-lg-4 charity-item'}>
            { post.title.rendered }
           </div> ]
        })}
    </div>);
} )


const editGrid = ( props ) => {
        

    const {className, setAttributes, isSelected} = props;





    const { reverseOrder } = props.attributes;
    
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;

        console.log(background);
        console.log(props.attributes);

        const toggleReverse = () => setAttributes( { reverseOrder: ! reverseOrder } );
        

 

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
                <div className={'col-12 col-lg-6 grid-charity-wrapper'}>
                <div className={classnames('container split-lg-container grid-content', !reverseOrder ? 'left' : 'right')}>
                        <DynamicContent {...props}/>
                    </div>

                </div>
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={classnames('container split-lg-container grid-content', reverseOrder ? 'left' : 'right')}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </div>
    ];

};


const editGridWithHOC = withColors('background')(editGrid);





export {editGrid, editGridWithHOC};