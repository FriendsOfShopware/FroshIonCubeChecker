Ext.define('Shopware.apps.IoncubeChecker.view.Window', {
    extend: 'Enlight.app.Window',
    title: 'IonCube Checker',
    alias: 'widget.ioncube-checker-window',
    border: false,
    autoShow: true,
    height: 400,
    width: 900,
    layout: 'fit',

    initComponent: function() {
        var me = this;
        me.items = [
            {
                xtype: 'ioncube-checker-list',
                store: me.store,
                flex: 1
            }
        ];

        me.callParent(arguments);
    }
});
