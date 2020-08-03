// import { registerBlockType } from '@wordpress/blocks';
// import { InnerBlocks } from '@wordpress/block-editor';

const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

 
export default registerBlockType( 'printing/grid', {

    title: 'Printing Express - Grid',
    description: 'An example of how to use the Inspector component for a block.',
    category: 'common',
            
    // ...
 
    edit: ( { className } ) => {
        return (
            <div className={ `pe-grid_wrapper ${className}` }>
                <div className={'row no-gutters'}>
                    <div className={'col-12 col-lg-6'}>
                    </div>
                    <div className={'col-12 col-lg-6'}>
                        <div className={'container split-lg-container'}>
                            <InnerBlocks />
                        </div>
                    </div>
                </div>
                
            </div>
        );
    },
 
    save: ( { className } ) => {
        return (
            <div className={ `pe-grid_wrapper ${className}` }>
                <div className={'row no-gutters'}>
                    <div className={'col-12 col-lg-6'}>
                    </div>
                    <div className={'col-12 col-lg-6'}>
                        <div className={'container split-lg-container'}>
                            <InnerBlocks.Content />
                        </div>
                    </div>
                </div>
                
            </div>
        );
    },
} );