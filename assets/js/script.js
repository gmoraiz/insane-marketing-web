$(document).ready(function (e) {
    
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
            console.log(err);
            Materialize.toast(err.responseJSON.msg, 4000);
        })
    }));
    
});

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
                .fail((data) => reject(data));
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
                .fail((data) => reject(data));
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
    