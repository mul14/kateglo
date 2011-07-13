Ext.define('kateglo.modules.entry.forms.Equivalent', {
    extend: 'Ext.form.Panel',
    region: 'south',
    split: true,
    collapsible: true,
    hideCollapseTool: true,
    listeners: {
    },
    initComponent: function() {
        Ext.apply(this, {
            items: [
                new Ext.form.field.ComboBox({
                    margin: '20 10 10 20',
                    labelAlign: 'top',
                    name: 'Foreign',
                    displayField: 'foreign',
                    valueField: 'id',
                    fieldLabel: 'Equivalent',
                    anchor: '100%',
                    listConfig: {
                        getInnerTpl: function() {
                            return '<div>' +
                                    '<i>[{language.language}]</i>' +
                                    ' {foreign}' +
                                    '</div>';
                        }
                    },
                    store: new kateglo.stores.Foreign()
                }),
                new kateglo.utils.BoxSelect({
                    margin: '20 10 10 20',
                    labelAlign: 'top',
                    name: 'disciplines',
                    displayField: 'name',
                    valueField: 'id',
                    fieldLabel: 'Disiplin',
                    anchor: '100%',
                    hideTrigger: true,
                    store: new kateglo.stores.Discipline()
                })

            ]
        });
        this.callParent(arguments);
    }

});