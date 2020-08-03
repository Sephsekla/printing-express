const { registerBlockType} = wp.blocks;
const { InnerBlocks, MediaUpload, Editable } = wp.blockEditor;
const { Button } = wp.components;

const editGrid = ( { attributes: { imgID, imgURL, imgAlt },
    className, setAttributes, isSelected } ) => {

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

    return (
        <div className={ `pe-grid_wrapper ${className}` }>
            <div className={'row no-gutters'}>
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
                <div className={'col-12 col-lg-6'}>
                    <div className={'container split-lg-container grid-content'}>
                        <InnerBlocks />
                    </div>
                </div>
            </div>
            
        </div>
    );
}

export {editGrid};