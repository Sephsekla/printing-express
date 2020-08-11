var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

const renderGrid = ( { attributes: { background },
    className, setAttributes, isSelected } ) => {
    return (
        <div className={ classnames('pe-grid_wrapper',className, `bg-${background}`) }>
            <div className={classnames('row', 'no-gutters')}>
                <div className={'col-12 col-lg-6 image-column'}>
                    <div className={'image-wrapper'} >
                    <InnerBlocks.Content />
                    </div>
                </div>
                <div className={'col-12 col-lg-6 grid-content-wrapper'}>
                    <div className={classnames('container split-lg-container grid-content right')}>
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
            
        </div>
    );
}

export {renderGrid};