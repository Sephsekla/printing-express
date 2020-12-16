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
        return <p>Test</p>;
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

        let imgURL = imgArray[i].url, imgAlt = imgArray[i].alt;


       

        images.push(   

            <div className={'image-wrapper'} style={{backgroundImage: `url(${ imgURL })`}}>
                <RenderSingleImage {...imgArray[i]}/>
            <picture>
            <source srcset={ `${imgURL}.webp` } type="image/webp"/>
            <source srcset={ imgURL } type={imgURL.endsWith(".jpg") || imgURL.endsWith(".jpeg") ? "image/jpeg" : "image/png"}/>
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