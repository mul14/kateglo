Ext.define('kateglo.modules.entry.forms.Synonym', {
    extend: 'Ext.form.Panel',
    title: 'Synonym',
    layout: 'border',
    tbar: [
        {
            text: 'Save',
            iconCls: 'cpanel_sprite cpanel_disk'
        }
    ],
    listeners: {
        beforerender: function(component) {
            var data = new Array();

            for (var i = 0; i < component.recordResult.length; i++) {
                var meaning = Array();
                meaning.push(component.recordResult[i].id);
                meaning.push(component.recordResult[i].meaning.entry.id);
                meaning.push(component.recordResult[i].meaning.entry.entry);
                meaning.push(component.recordResult[i].meaning.definitions[0].definition);

                var definitions = '<ul>';
                for (var j = 0; j < component.recordResult[i].meaning.definitions.length; j++) {
                    definitions += '<li>' + component.recordResult[i].meaning.definitions[j].definition + '</li>';
                }
                definitions += '</ul>';
                meaning.push(definitions);

                data.push(meaning);
            }

            var grid = new Ext.grid.Panel({
                region: 'center',
                split: true,
                border: false,
                store: new Ext.data.ArrayStore({
                    model: 'kateglo.models.Meaning',
                    data: data
                }),
                plugins: [
                    {
                        ptype: 'rowexpander',
                        rowBodyTpl : [
                            '<p><b>Entri:</b> {entry}</p><br>',
                            '<p><b>Definisi:</b> {definitions}</p>'
                        ]
                    }
                ],
                anchor: '100%',
                columns: [
                    {
                        text : 'Id',
                        width: 20,
                        sortable: true,
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
                    }
                ]
            });

            component.add(grid);
        }
    },
    initComponent: function() {
        Ext.apply(this, {
            items: [
                new Ext.form.Panel({
                    border: false,
                    split: true,
                    region: 'north',
                    collapsible: true,
                    hideCollapseTool: true,
                    items: [
                        new Ext.form.field.ComboBox({
                            margin: '20 10 10 20',
                            name: 'entry',
                            anchor: '100%',
                            store: new kateglo.stores.Entry()
                        })]
                })
            ]
        });
        this.callParent(arguments);
    }

});
