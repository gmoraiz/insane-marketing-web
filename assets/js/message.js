$(".delete-message").click(function(e){
    let id = $(this).attr('data-id');
    $("#delete-dialog .yes").click(function(){
        AJAXRequester('DELETE', 'message/'+id, null, null, 'wrapper').then(res => {
            if(res.data){
                $('a[data-id="'+id+'"]').parent().remove();
            }
            Materialize.toast(res.msg);
        }).catch(err => {
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    })
});


$(window).scroll(function(e){
    if(endPage() && !stopIncrease){
        AJAXRequester('GET', 'message?pagination='+pagination, null, null, 'pagination').then(res => {
            if(res){
                $('#list ul').append(res);
                nextPage();
            }else
                stopPage();
        }).catch(err => console.log('Error on message pagination', err));
    }
});

$('#dayMonth').mask('00/00');

$('#type').change(function(){
    switch($(this).val()){
        case 'MONTHLY':
            $('#pickDate').addClass('hide');
            $('#pickWeek').addClass('hide');
            $('#pickDayMonth').addClass('hide');
            $('#pickDay').removeClass('hide');
            break;
        case 'ANUALLY':
            $('#pickDate').addClass('hide');
            $('#pickWeek').addClass('hide');
            $('#pickDay').addClass('hide');
            $('#pickDayMonth').removeClass('hide');
            break;
        case 'WEEKLY':
            $('#pickDate').addClass('hide');
            $('#pickWeek').removeClass('hide');
            $('#pickDay').addClass('hide');
            $('#pickDayMonth').addClass('hide');
            break;
        case 'SPECIFIC':
            $('#pickDate').removeClass('hide');
            $('#pickWeek').addClass('hide');
            $('#pickDay').addClass('hide');
            $('#pickDayMonth').addClass('hide');
            break;
        default:
            $('#pickDate').addClass('hide');
            $('#pickWeek').addClass('hide');
            $('#pickDay').addClass('hide');
            $('#pickDayMonth').addClass('hide');
    }
});