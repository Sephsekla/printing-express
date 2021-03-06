// Using ESNext syntax

const { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } = wp.editPost;
const { registerPlugin } = wp.plugins;
const {TextControl, SelectControl} = wp.components;
const {widthState} = wp.compose;
const { withColors, PanelColorSettings, getColorClassName, getColorObjectByColorValue} = wp.blockEditor;
const {withSelect, withDispatch} = wp.data;

const mapSelectToProps = ( select ) => {
   
       return {printingBanner: select( 'core/editor' )
            .getEditedPostAttribute( 'meta' )
            [ 'printing_banner' ],
            colorPalette: wp.data.select( "core/editor" ).getEditorSettings().colors
        
        }
}

const mapPropsToDispatch = ( dispatch ) => {
   
    return {
        setMetaFieldValue: function( value, valueClass ) {
            dispatch( 'core/editor' ).editPost(
                { meta: { printing_banner: value } }
            );
            dispatch( 'core/editor' ).editPost(
                { meta: { printing_banner_class: valueClass } }
            );
        }
    }
}


const MetaBlockField = (props) => {

    const {printingBanner, setMetaFieldValue, colorPalette} = props;

    console.log(props);
  
    return <PanelColorSettings
          title={"Color Settings"}
          colorSettings={[
            {
               // colors: colorSamples,
              value: printingBanner,
              onChange: (value)=> {
                  const colorObject = getColorObjectByColorValue(colorPalette,value);
                  setMetaFieldValue(value, colorObject.slug)
                },
              label: "Banner Color"
            }
          ]}
        />

    
        };
 
const Component = (props) => {

    console.log(props);

    return <PluginDocumentSettingPanel
    name="custom-panel"
    title="Custom Panel"
    className="custom-panel"
>
    <MetaBlockField {...props}/>
</PluginDocumentSettingPanel>
};

const ComponentWithSelect = withSelect(mapSelectToProps)(Component);

const ComponentWithDispatch = withDispatch(mapPropsToDispatch)(ComponentWithSelect);
 
registerPlugin( 'printing-banner', {
    //icon: 'admin-post',
    render: ComponentWithDispatch,
} );