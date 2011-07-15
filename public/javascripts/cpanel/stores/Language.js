Ext.define("kateglo.stores.Language", {
    extend: 'Ext.data.Store',
    model: 'kateglo.models.Language',
    proxy: {
        type: 'rest',
        url : '/cpanel/static',
        noCache: false,
        headers: {
            Accept: 'application/json'
        },
        reader: {
            type: 'json',
            root: 'language'
        }
    }
});
