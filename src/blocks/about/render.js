var classnames = require('classnames');
const { registerBlockType} = wp.blocks;
const { InnerBlocks, RichText } = wp.blockEditor;

import {CreateInnerImage} from '../shared/multi-images.js';

const renderGrid = props => {

const { attributes: { imgID, imgURL, imgAlt, reverseOrder, background, quote, name },
className, setAttributes, isSelected } = props;


    return (
        <section className={ classnames('pe-about_wrapper',className) }>
            <div className={classnames('row', 'no-gutters', reverseOrder ? 'flex-row-reverse' : '')}>
                <div className={classnames('col-12 col-lg-4 image-column', `bg-${background}`)}>
                    <div className="container quote-wrapper">
                    <RichText.Content tagName="p" value={ quote } className="quote"/>
                    <RichText.Content tagName="p" value={ name } className="name"/>
                    </div>
                    <CreateInnerImage {...props }/>
                </div>
                <div className={'col-12 col-lg-8 grid-content-wrapper color-dark'}>
                    <div className={classnames('container grid-content')}>
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
            
        </section>
    );
}

export {renderGrid};