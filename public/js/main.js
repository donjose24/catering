$(document).ready(function(){
    $('#searchbox').selectize({
        valueField: 'url',
        labelField: 'customer_name',
        searchField: ['customer_name'],
        maxOptions: 10,
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +escape(item.customer_name)+'</div>';
            }
        },
        optgroups: [
            {value: 'client', label: 'Clients'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['client'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: root+'/api/search',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    console.log(res);
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            console.log ("test");
            window.location = this.items[0];
        }
    });
});