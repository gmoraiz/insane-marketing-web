$(".delete-reward").click(function(e){
    let id = $(this).attr('data-id');
    $("#delete-dialog .yes").click(function(){
        AJAXRequester('DELETE', 'reward/'+id, null, null, 'wrapper').then(res => {
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
        AJAXRequester('GET', 'reward?pagination='+pagination, null, null, 'pagination').then(res => {
            if(res){
                $('#list ul').append(res);
                nextPage();
            }else
                stopPage();
        }).catch(err => console.log('Error on reward pagination', err));
    }
});