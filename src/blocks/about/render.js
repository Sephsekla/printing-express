var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks } = wp.blockEditor;

import {CreateInnerImage} from '../shared/multi-images.js';

const renderGrid = props => {

const { attributes: { imgID, imgURL, imgAlt, reverseOrder, background },
className, setAttributes, isSelected } = props;


    return (
        <section className={ classnames('pe-about_wrapper',className) }>
            <div className={classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
                <div className={classnames('col-12 col-lg-4 image-column', `bg-${background}`)}>
                    <CreateInnerImage {...props }/>
                </div>
                <div className={'col-12 col-lg-8 grid-content-wrapper color-dark'}>
                    <div className={classnames('container split-lg-container grid-content', reverseOrder ? 'left' : 'right')}>
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
            
        </section>
    );
}

export {renderGrid};