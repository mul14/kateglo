Ext.define('kateglo.modules.entry.grids.Relation', {
    extend: 'Ext.grid.Panel',
    region: 'center',
    split: true,
    border: false,
    anchor: '100%',
    plugins: [
        {
            ptype: 'rowexpander',
            rowBodyTpl : [
                '<p><b>Definisi:</b> ' +
                '<ul class="rowexpander">' +
                '<tpl for="definitions"><li>{.}</li></tpl>' +
                '</ul>' +
                '</p>'
            ]
        }
    ],
    constructor: function() {
        this.columns = [
            {
                text : 'Id',
                width: 30,
                sortable: true,
                align: 'right',
                dataIndex: 'id'
            },
            {
                text : 'Entri',
                flex: 1,
                sortable: true,
                dataIndex: 'entry'
            },
            {
                text : 'Definisi',
                flex: 1,
                sortable: true,
                dataIndex: 'definition'
            },
            {
                xtype: 'actioncolumn',
                width: 25,
                items: [
                    {
                        iconCls   : 'cpanel_sprite cpanel_delete',
                        text: 'Delete',
                        scope: this,
                        tooltip: 'Delete Entry',
                        handler: function(grid, rowIndex, colIndex) {
                            grid.store.removeAt(rowIndex);
                        }
                    }
                ]
            }
        ];
        this.callParent(arguments);
    },
    initComponent: function() {
        Ext.apply(this, {
            store: new Ext.data.Store({
                model: 'kateglo.models.Meaning'
            }),
            listeners: {
                beforerender: function(component) {
                    var data = new Array();
                    for (var i = 0; i < component.recordResult.length; i++) {
                        var meaning = new Object();
                        meaning.id = component.recordResult[i].id;
                        meaning.entryId = component.recordResult[i].meaning.entry.id;
                        meaning.entry = component.recordResult[i].meaning.entry.entry;
                        meaning.definition = component.recordResult[i].meaning.definitions[0].definition;

                        var definitions = new Array();
                        for (var j = 0; j < component.recordResult[i].meaning.definitions.length; j++) {
                            definitions.push(component.recordResult[i].meaning.definitions[j].definition);
                        }
                        meaning.definitions = definitions;

                        data.push(meaning);
                    }
                    component.getStore().loadData(data, false);
                }
            }
        });
        this.callParent(arguments);
    }
})