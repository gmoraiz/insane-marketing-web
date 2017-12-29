$(document).ready(function (e) {
    init();
    steps();
    deletes();
});

function init(){
    $(".button-collapse").sideNav();
    $('.dynamic-form').hide();
    $('select').material_select();
    $('#delete-dialog').modal();

    //Open and close forms
    $('.dynamic-form-trigger').click(function(){
        if($('.dynamic-form').is(":visible")){
            $(this).text($(this).attr('text'));
            $(this).removeAttr('text');
            $('.dynamic-form').hide('slow');
        }else{
            $(this).attr('text', $(this).text());
            $(this).text('Close');
            $('.dynamic-form').show('fast');
        }
    });
    
    //To show selected layout in step 5.
    $('.layout-wrapper input[name=layout]').on('change', function(){
        Materialize.toast("Layout "+$('input[name=layout]:checked').val()+" selected.", 2000); 
    });
    
    //Money inputs
    $(".money-input").maskMoney({
        prefix: "£",
        decimal: ".",
        thousands: ","
    });
    
}

function steps(){
    $("#register-one").on('submit',(function(e){
        e.preventDefault();
        AJAXRequester('POST', 'register', new FormData(this), null, 'wrapper', true).then(res => {
            location.reload();
        }).catch(err => {
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    }));
    
    $("#register-two").on('submit',(function(e){
        e.preventDefault();
        AJAXRequester('POST', 'register', null, null, 'wrapper').then(res => {
            location.reload();
        }).catch(err => {
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    }));
    
    //step-3 doesn't use js. It's email confirm.
    
    $("#register-four").on('submit',(function(e){
        e.preventDefault();
        AJAXRequester('POST', 'register-login', new FormData(this), null, 'wrapper', true).then(res => {
            location.reload();
        }).catch(err => {
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    }));
    
    $("#register-five").on('submit',(function(e){
        e.preventDefault();
        AJAXRequester('POST', 'register-complete', new FormData(this), null, 'wrapper', true).then(res => {
            location.reload();
        }).catch(err => {
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    }));
    
}

function deletes(){
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
}

function AJAXRequester(method, url, data, headers = {}, typeload = null, formdata = false){
        if(formdata){
            return new Promise(function(resolve, reject){
                $.ajax({
                    type: method,
                    url: url,
                    headers: headers,
                    data: data,
                    contentType: false,
                    processData: false,
                    mimeType: false,
                    beforeSend: load(typeload),
                    complete: hide(typeload)
                })
                .done((data) => resolve(data))
                .fail((data) => {
                    if(data.responseJSON === undefined){
                        data.responseJSON = {};
                        data.responseJSON.msg = data.statusText;
                    }
                    return reject(data)
                });
            })
        }else{
            return new Promise(function(resolve, reject){
                $.ajax({
                    type: method,
                    url: url,
                    headers: headers,
                    data: data
                })
                .done((data) => resolve(data))
                .fail((data) => {
                    if(data.responseJSON === undefined){
                        data.responseJSON = {};
                        data.responseJSON.msg = data.statusText;
                    }
                    return reject(data)
                });
            })
        }
}

function load(type){
    switch(type){
        case 'wrapper':
            $('.loading-wrapper').css('display', 'flex');
            break;
        default:
    }
}

function hide(type){
    switch(type){
        case 'wrapper':
            $('.loading-wrapper').fadeOut();
            break;
        default:
    }
}
    