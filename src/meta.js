// Using ESNext syntax

const { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } = wp.editPost;
const { registerPlugin } = wp.plugins;
const {TextControl, SelectControl} = wp.components;
const {widthState} = wp.compose;

const MetaBlockField = () => (
    <SelectControl label="Banner Border" value="blue"
    onChange={(value)=> {console.log(value)}} 
    options = {[
        {label: 'Blue', value: 'blue'},
        {label: 'Yellow', value: 'yellow'},
    ]}
    />
);
 
const Component = () => (
    <PluginDocumentSettingPanel
    name="custom-panel"
    title="Custom Panel"
    className="custom-panel"
>
    <MetaBlockField/>
</PluginDocumentSettingPanel>
);
 
registerPlugin( 'printing-banner', {
    //icon: 'admin-post',
    render: Component,
} );