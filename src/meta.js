// Using ESNext syntax

const { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } = wp.editPost;
const { registerPlugin } = wp.plugins;
//const { more } = wp.icons;
 
const Component = () => (
    <PluginDocumentSettingPanel
    name="custom-panel"
    title="Custom Panel"
    className="custom-panel"
>
    Custom Panel Contents
</PluginDocumentSettingPanel>
);
 
registerPlugin( 'printing-banner', {
    //icon: 'admin-post',
    render: Component,
} );