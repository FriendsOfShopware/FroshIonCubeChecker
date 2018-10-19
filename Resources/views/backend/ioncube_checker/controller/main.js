Ext.define('Shopware.apps.IoncubeChecker.controller.Main', {
    extend: 'Ext.app.Controller',
    mainWindow: null,

    init: function() {
        var me = this;
        me.getStore('Plugin').load({
            scope: this,
            callback: function() {
                me.mainWindow = me.getView('Window').create({
                    store: me.getStore('Plugin')
                });
            }
        });

        me.callParent(arguments);
    }
});