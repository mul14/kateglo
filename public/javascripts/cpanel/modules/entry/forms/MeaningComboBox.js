Ext.define('kateglo.modules.entry.forms.MeaningComboBox', {
    extend: 'Ext.form.Panel',
    initComponent: function() {
        Ext.apply(this, {
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
                    store: new kateglo.stores.Meaning(),
                    emptyText: 'Ketik yang dicari, pilih salah satu dari hasil yang ditampilkan, kemudian tekan enter',
                    listConfig: {
                        getInnerTpl: function() {
                            return '<div>' +
                                    '<b>{entry}</b>' +
                                    '<ul class="rowexpander">' +
                                    '<tpl for="definitions"><li>{.}</li></tpl>' +
                                    '</ul>' +
                                    '</div>';
                        }
                    },
                    listeners:{
                        scope: this,
                        select: function(field, value) {
                            field.up().up().getComponent(1).getStore().add(value);
                        }
                    }
                })
            ]
        });
        this.callParent(arguments);
    }

});
