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




 
        let background = props.background;
        let customBackground = props.attributes.customBackground;
        let setBackground = props.setBackground;


    

    return [
        <InspectorControls>
            
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
            <div className={ classnames('row', 'no-gutters')}>
               <InnerBlocks allowedBlocks={['printing/inner' ]}
	        template={ [['printing/inner',{}], ['printing/inner',{}]]}
	        templateLock="insert"/>
            </div>
            
        </div>
    ];
})

export {editGrid};