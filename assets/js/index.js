$("#phone").autocomplete({
    classes: {
        "ui-autocomplete": "own-autocomplete"
    },
    source: function (request, response){
        $.ajax({
            url: "by_phone/" + request.term,
            dataType: "json",
            success: response,
            error: function (){
                response([]);
            }
        })
    },
    minLength: 2,
    select: function(event, ui) {
        $('#user-selected-card').slideDown(1000);
        $('#user-search-input').slideUp(300);
        $('#userName').text(ui.item.name);
        $('#userEmail').text(ui.item.email);
        $('#userPhone').text(ui.item.phone);
        $('#userAddress').text(ui.item.address);
        $('#userBirth').text(ui.item.birth);
        $('#user').val(ui.item.id);
    }
}).autocomplete( "instance" )._renderItem = function(ul,item){
    return $("<li>")
        .append("<div><b>" + item.name + "</b><br>" + item.phone + "</div>")
        .appendTo(ul);
};

$('#undo-user').click(function(){
    $('#user-search-input').slideDown(1000);
    $('#user-selected-card').slideUp(300);
});

$(window).scroll(function(e){
    if(endPage() && !stopIncrease){
        AJAXRequester('GET', '?pagination='+pagination, null, null, 'pagination').then(res => {
            if(res){
                $('#list ul').append(res);
                nextPage();
            }else
                stopPage();
        }).catch(err => console.log('Error on message pagination', err));
    }
});