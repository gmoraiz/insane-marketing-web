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
    if(!checkin_monitor_on){
        checkin_monitor();
    }
    $('#user-search-input').slideDown(1000);
    $('#user-selected-card').slideUp(300);
});

$(window).scroll(function(e){
    if(endPage() && !stopIncrease){
        AJAXRequester('GET', '?pagination='+pagination, null, null).then(res => {
            if(res){
                $('#list ul').append(res);
                nextPage();
            }else
                stopPage();
        }).catch(err => console.log('Error on message pagination', err));
    }
});

//LONG POLLING CHECKIN

var checkin_monitor_on = false;
var checkin_id = 0;

function checkin_monitor(){
    checkin_monitor_on = true;
    AJAXRequester('GET', 'checkin_monitor/'+checkin_id, null, null).then(res => {
        if(res){
            $('#user-selected-card').slideDown(1000);
            $('#user-search-input').slideUp(300);
            $('#userName').text(res.name);
            $('#userEmail').text(res.email);
            $('#userPhone').text(res.phone);
            $('#userAddress').text(res.address);
            $('#userBirth').text(res.birth);
            $('#user').val(res.id);
            checkin_id = res.checkin_id;
            checkin_monitor_on = false;
        }else{
            console.log("Timeout!");
        }
    }).catch(err => {
        setTimeout(checkin_monitor(), 1000);
        console.log('Error on Check-in monitor', err)
    });
}

checkin_monitor();