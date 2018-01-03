var paginationIncrease = 10;  //number pages to increase in each pagination request.
var pagination = paginationIncrease; //Here i increment because the first page is renderized on get.
var stopIncrease = false;  //When pagination to return empty, this variable will be true.

$(document).ready(function (e) {
    init();
    steps();
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
    
    //Date
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: true,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        format: 'dd-mm-yyyy',
        closeOnSelect: true
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
                    data: data,
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
        }
}

function load(type){
    switch(type){
        case 'wrapper':
            $('.loading-wrapper').css('display', 'flex');
            break;
        case 'pagination':
            $('.loading-pagination').css('display', 'block');
            stopPage();
            break;
        default:
    }
}

function hide(type){
    switch(type){
        case 'wrapper':
            $('.loading-wrapper').fadeOut();
            break;
        case 'pagination':
            $('.loading-pagination').fadeOut();
            startPage();
            break;
        default:
    }
}

// TO PAGINATION

function stopPage(){
    stopIncrease = true;
}

function startPage(){
    stopIncrease = false;
}

function nextPage(){
    pagination+= paginationIncrease; //Case success, increase to next request.
}

function endPage(){
    return $(window).scrollTop() + $(window).height() == $(document).height();
}
    