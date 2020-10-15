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


/**
 * 
 * @param {*} props 
 * 
 * Create inner image loop
 */
const CreateInnerImage = props => {

    console.log('PROPS: '.props);

    const {isSelected} = props;

    const {imgArray} = props.attributes;

    let images = [];

    for (let i = 0; i < imgArray.length; i++) {

        const imgURL = imgArray[i].url, imgAlt = imgArray[i].alt;


        images.push(   

            <div className={'image-wrapper'} style={{backgroundImage: `url(${ imgURL })`}}>
            <picture>
            <source srcset={ `${imgURL}.webp` } type={imgURL.endsWith(".jpg") || imgURL.endsWith(".jpeg") ? "image/jpeg" : "image/png"}/>
            <source srcset={ imgURL } type="image/webp"/>
            <img
                src={ imgURL }
                alt={ imgAlt }
            />
            </picture>
        
        
        
        </div>)
      }

    return (

    <div className = "image-wrapper-outer">

        {images}


    </div>

    )



}


export {CreateInnerImage};