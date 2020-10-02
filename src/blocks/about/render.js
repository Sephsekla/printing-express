var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

import {CreateInnerImage} from '../shared/multi-images.js';

const renderGrid = props => {

const { attributes: { imgID, imgURL, imgAlt, reverseOrder, background },
className, setAttributes, isSelected } = props;


    return (
        <section className={ classnames('pe-about_wrapper',className) }>

        <div className={ classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>

            

            
           
          

                    <div className={classnames('col-12 col-lg-4',`bg-${props.attributes.background}`)}>  
                    <p>Test goes here</p>
                    <div className="image-column">

                    

                    <CreateInnerImage {...props }/>



                        </div>
                </div>
       

            
            <div className={'col-12 col-lg-8 grid-content-wrapper'}>
                    <InnerBlocks.content />
            </div>
        </div>
        
    </section>

    );
}

export {renderGrid};