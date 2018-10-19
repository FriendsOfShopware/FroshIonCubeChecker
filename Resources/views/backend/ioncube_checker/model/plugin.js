Ext.define('Shopware.apps.IoncubeChecker.model.Plugin', {
    extend : 'Ext.data.Model',
    fields : [
        'name',
        'label',
        'version',
        'author',
        'status',
        'schema',
        'path',
    ],
    proxy: {
        type : 'ajax',
        reader : {
            type : 'json',
            root : 'data',
            totalProperty: 'totalCount'
        }
    }
});