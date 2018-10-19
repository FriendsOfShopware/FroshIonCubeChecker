Ext.define('Shopware.apps.IoncubeChecker', {
    extend: 'Enlight.app.SubApplication',
    name: 'Shopware.apps.IoncubeChecker',
    bulkLoad: true,
    loadPath: '{url action=load}',

    controllers: ['Main'],
    models: ['Plugin'],
    stores: ['Plugin'],
    views: ['Window', 'List'],

    launch: function() {
        var mainController = this.getController('Main');

        return mainController.mainWindow;
    }
});
