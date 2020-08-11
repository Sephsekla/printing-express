const { registerBlockType} = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;

export default registerBlockType( 'printing/inner', {

    title: 'Printing Express - Inner',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
    parent: ['printing/double-grid'],
 
    edit: ( props ) => {
        return(<div className={'col-12 col-lg-6 grid-content-wrapper'}><InnerBlocks/></div>);
    },
 
    save: ( props ) => {
        return(<div className={'col-12 col-lg-6 grid-content-wrapper'}><InnerBlocks.content/></div>);
    },
} );