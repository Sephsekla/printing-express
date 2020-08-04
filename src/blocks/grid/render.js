var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

const renderGrid = ( { attributes: { imgID, imgURL, imgAlt },
    className, setAttributes, isSelected } ) => {
    return (
        <div className={ classnames('pe-grid_wrapper',className) }>
            <div className={'row no-gutters'}>
                <div className={'col-12 col-lg-6'}>
                    <div className={'image-wrapper'} style={{backgroundImage: `url(${ imgURL })`}}>
                        <picture>
                        <img
                            src={ imgURL }
                            alt={ imgAlt }
                        />
                        </picture>
                    </div>
                </div>
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={'container split-lg-container grid-content'}>
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
            
        </div>
    );
}

export {renderGrid};