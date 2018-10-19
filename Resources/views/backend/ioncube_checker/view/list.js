Ext.define('Shopware.apps.IoncubeChecker.view.List', {
    extend: 'Ext.grid.Panel',
    border: false,
    alias: 'widget.ioncube-checker-list',
    region: 'center',
    autoScroll: true,

    initComponent: function () {
        var me = this;
        me.columns = me.getColumns();
        me.pagingbar = me.getPagingBar();
        me.dockedItems = [
            me.pagingbar
        ];
        me.callParent(arguments);
    },

    getColumns:function () {
        return [
            {
                header: 'Name',
                dataIndex: 'name',
                flex: 2
            },
            {
                header: 'Label',
                dataIndex: 'label',
                flex: 2
            },
            {
                header: 'Version',
                dataIndex: 'version',
                width: 60
            },
            {
                header: 'Author',
                dataIndex: 'author',
                flex: 3
            },
            {
                header: 'Status',
                dataIndex: 'status',
                width: 100
            },
            {
                header: 'Pfad',
                dataIndex: 'path',
                flex: 4
            }
        ];
    },

    getPagingBar: function () {
        var me = this;

        return Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock: 'bottom',
            displayInfo: true
        });
    }
});