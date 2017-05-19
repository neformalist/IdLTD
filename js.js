$('#exampleModal').on('show.bs.modal', function (event) {
    var object = $(event.relatedTarget);
    var row = object.parent().siblings();
    var modal = $(this);
    modal.find('#ID').val(object.data('id'));
    modal.find('#name').val($(row[1]).html());
    modal.find('#price').val($(row[3]).html());
    modal.find('#category').val($(row[2]).attr('data-id'));
});

$('#update').on('click', function () {
    var modal = $('#exampleModal');
    var id = modal.find('#ID').val();
    var name = modal.find('#name').val();
    var price = modal.find('#price').val();
    var cat = modal.find('#category').val();

    if(!$.isNumeric(price) || price < 1) return false;

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: { id: id, name: name, price: price, cat: cat, action: 1 }
    }).done(function (response) {
        modal.find('form')[0].reset();
        modal.modal('hide');
        if(response){
            response = $.parseJSON(response);
            $('.table-body').children().each(function (index, value) {
                if($(value).data('id') == id){
                    var td = $(value).children();
                    $(td[1]).html(response.name);
                    $(td[2]).html(response.category);
                    $(td[2]).attr('data-id', response.category_id);
                    $(td[3]).html(response.price);
                }
            })
        }
    });
});

$('#create').on('click', function () {
    var modal = $('#CreateModal');
    var name = modal.find('#name-create').val();
    var price = modal.find('#price-create').val();
    var cat = modal.find('#category-create').val();

    if(!$.isNumeric(price) || price < 1) return false;

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {name: name, price: price, cat: cat, action: 2 }
    }).done(function (response) {
        modal.find('form')[0].reset();
        modal.modal('hide');
        if(response){
            response = $.parseJSON(response);
            var html = '<tr data-id = "'+response.id+'"><td>'+response.id+'</td><td>'+response.name+'</td><td data-id="'+response.category_id+'">'+response.category+'</td><td>'+response.price+'</td><td><span data-toggle="modal" data-target="#exampleModal" data-id = "'+response.id+'" class="glyphicon glyphicon-pencil pointer"></span></td><td><span data-toggle="modal" data-target="#DeleteModal" data-id = "'+response.id+'" class="glyphicon glyphicon-trash pointer"></span></td></tr>'
            $('.table-body').append(html);
        }
    });
});

$('#DeleteModal').on('show.bs.modal', function (event) {
    var object = $(event.relatedTarget);
    var modal = $(this);
    modal.find('#ID-delete').val(object.data('id'));
});

$('#delete').on('click', function () {
    var modal = $('#DeleteModal');
    var id = modal.find('#ID-delete').val();

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: { id: id, action: 0 }
    }).done(function (response) {
        modal.find('form')[0].reset();
        modal.modal('hide');
        if(response){
            $('.table-body').children().each(function (index, value) {
                if($(value).data('id') == id){
                    $(value).remove();
                }
            })
        }
    });
});
