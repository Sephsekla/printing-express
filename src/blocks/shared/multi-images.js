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

    let images = [];

    for (let i = 0; i < imgArray.length; i++) {

        

       

        images.push(   
        <RenderSingleImage {...imgArray[i]}/>
            )

        }
        

    return (

    <div className = "image-wrapper-outer">

        {images}


    </div>

    )



}


export {CreateInnerImage};