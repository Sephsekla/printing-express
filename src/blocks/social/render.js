var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

const renderGrid = ( { attributes: { reverseOrder, background },
    className, setAttributes, isSelected } ) => {
    return <InnerBlocks.Content />;
 
}

export {renderGrid};