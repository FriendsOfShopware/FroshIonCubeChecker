Ext.define('Shopware.apps.IoncubeChecker.store.Plugin', {
    extend: 'Ext.data.Store',
    remoteFilter: true,
    autoLoad : false,
    model : 'Shopware.apps.IoncubeChecker.model.Plugin',
    pageSize: 20,
    proxy: {
        type: 'ajax',
        url: '{url controller="IonCubeChecker" action="list"}',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        }
    }
});