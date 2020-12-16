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

       
        const {url, id, alt} = props;

        const media = useSelect(select => select( 'core').getMedia( id ));

        if(!media){
            return 'Loading...'
        }
        else{

            const thumbnail =  media.media_details.sizes.medium ? media.media_details.sizes.medium.source_url : url;

        return <div className={'image-wrapper'} style={{backgroundImage: `url(${ thumbnail })`}}>
        
    <picture>
    <source srcset={ `${thumbnail}.webp` } type="image/webp"/>
    <source srcset={ thumbnail } type={thumbnail.endsWith(".jpg") || thumbnail.endsWith(".jpeg") ? "image/jpeg" : "image/png"}/>
    <img
        src={ thumbnail }
        alt={ alt }
    />
    </picture>



</div>

        }


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