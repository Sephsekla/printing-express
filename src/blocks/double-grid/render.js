var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

const renderGrid = ( { attributes: { background },
    className, setAttributes, isSelected } ) => {
    return (
        <div className={ classnames('pe-grid_wrapper',className, `bg-${background}`) }>
            <div className={classnames('row', 'no-gutters')}>
                <InnerBlocks.content/>
            </div>
            
        </div>
    );
}

export {renderGrid};