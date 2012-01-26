Ext.define('kateglo.modules.entry.panels.Antonym', {
    extend:'Ext.panel.Panel',
    title:'Antonym',
    layout:'border',
    initComponent:function () {
        Ext.apply(this, {
            items:[
                new kateglo.modules.entry.forms.MeaningComboBox({
                    store:new Ext.data.Store({
                        model:'kateglo.models.Meaning',
                        pageSize:10000000,
                        proxy:{
                            type:'rest',
                            url:'/cpanel/cari/antonim/' + this.recordResult.id,
                            noCache:false,
                            headers:{
                                Accept:'application/json'
                            },
                            reader:{
                                type:'json',
                                totalProperty:'numFound'
                            }
                        }
                    })
                }),
                new kateglo.modules.entry.grids.Relation({
                    recordResult:this.recordResult.antonyms
                })
            ]
        });
        this.callParent(arguments);
    }

});
