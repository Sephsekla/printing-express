// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType, InnerBlocks } = wp.blocks;
 
export default registerBlockType( 'printing/grid', {

    title: 'Printing Express - Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
            
    // ...
 
    edit: ( { className } ) => {
        return (
            <div className={ className }>
                <InnerBlocks />
            </div>
        );
    },
 
    save: ( { className } ) => {
        return (
            <div className={ className }>
                <InnerBlocks.Content />
            </div>
        );
    },
} );