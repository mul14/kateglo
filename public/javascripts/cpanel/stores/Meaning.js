Ext.define("kateglo.stores.Meaning", {
    extend: 'Ext.data.Store',
    model: 'kateglo.models.Meaning',
    pageSize: 10000000,
    proxy: {
        type: 'rest',
        url : '/cpanel/kamus/arti',
        noCache: false,
        headers: {
            Accept: 'application/json'
        },
        reader: {
            type: 'json',
            totalProperty: 'numFound'
        }
    }
});