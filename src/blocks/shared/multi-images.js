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

    const RenderSingleImage = props => {

        console.log(props);
        
        const {url, id, alt} = props;

        return <div className={'image-wrapper'} style={{backgroundImage: `url(${ url })`}}>
        
    <picture>
    <source srcset={ `${url}.webp` } type="image/webp"/>
    <source srcset={ url } type={url.endsWith(".jpg") || url.endsWith(".jpeg") ? "image/jpeg" : "image/png"}/>
    <img
        src={ url }
        alt={ alt }
    />
    </picture>



</div>


    }

/**
 * 
 * @param {*} props 
 * 
 * Create inner image loop
 */
const CreateInnerImage = props => {


    const {isSelected} = props;

    const {imgArray} = props.attributes;
        

    return (

    <div className = "image-wrapper-outer">

        {imgArray.map(img => <RenderSingleImage {...img}/>)}


    </div>

    )



}


export {CreateInnerImage};