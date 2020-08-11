const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

export default registerBlockType( 'printing/inner', {

    title: 'Printing Express - Inner',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
 
    edit: ( props ) => {
        return(<InnerBlocks/>);
    },
 
    save: ( props ) => {
        return(<InnerBlocks.content/>);
    },
} );