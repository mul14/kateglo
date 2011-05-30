Ext.define('kateglo.utils.SearchField', {
    extend: 'Ext.form.field.Trigger',

    trigger1Cls: Ext.baseCSSPrefix + 'form-clear-trigger',

    trigger2Cls: Ext.baseCSSPrefix + 'form-search-trigger',

    hasSearch : false,
    paramName : 'query',

    initComponent: function() {
        this.callParent(arguments);
        this.on('specialkey', function(f, e) {
            if (e.getKey() == e.ENTER) {
                this.onTrigger2Click();
            }
        }, this);
    },

    afterRender: function() {
        this.callParent();
        this.triggerEl.item(0).setDisplayed('none');
    },

    onTrigger1Click : function() {
        Ext.getCmp('resultContainer').insert(0, Ext.getCmp('resultContainer').emptyResultText);
        var me = this,
                store = me.store,
                proxy = store.getProxy(),
                val;

        if (me.hasSearch) {
            me.setValue('');
            proxy.extraParams[me.paramName] = '';
            proxy.extraParams.start = 0;
            store.removeAll();
            me.hasSearch = false;
            me.triggerEl.item(0).setDisplayed('none');
            me.doComponentLayout();
        }
    }
    ,

    onTrigger2Click : function() {
        Ext.getCmp('resultContainer').insert(0, Ext.getCmp('resultContainer').showResultText);
        var me = this,
                store = me.store,
                proxy = store.getProxy(),
                value = me.getValue();

        if (value.length < 1) {
            me.onTrigger1Click();
            return;
        }
        proxy.extraParams[me.paramName] = value;
        proxy.extraParams.start = 0;
        store.load();
        me.hasSearch = true;
        me.triggerEl.item(0).setDisplayed('block');
        me.doComponentLayout();
    }
})
        ;