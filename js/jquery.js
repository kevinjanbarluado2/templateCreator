function copyToClipboard(element) {
    var $temp = $("<textarea>");
    var brRegex = /<br\s*[\/]?>/gi;
    $("body").append($temp);
    $temp.val($(element).html().replace(brRegex, "\r\n")).select();
    document.execCommand("copy");
    $temp.remove();
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}



$(document).ready(function () {

    let token = JSON.parse(getCookie('it'));

    const url = $('[name="url"]').val();
    $('.list-group-item').on('click', function (e) {
        e.preventDefault();
        let action = $(this).data('target');
        $.ajax({
            url: `${url}includes/api/templateApi.php`,
            data: { 'action': action, 'token': token },
            type: 'get',
            dataType: 'json',
            success: function (e) {
                switch (action) {
                    case 'it':
                        $.each(e.token,function(x,y) {
                            // console.log(x,y);
                            setTimeout(()=>{
                                $(`[name="${x}"]`).val(y);

                            },0);
                           
                        })
                    case 'admin1':
                       $('[name="itname"]').on('change',function() {
                        alert('sample');
                       })
                
                        break;
                    default:
                        break;

                }



                $('#showHere').html(e.html);
            }

        })
    });

    $('#showHere').on('click', '#generateIT', function () {
        $('form').submit(function (e) {
            e.preventDefault();
            let form = $('form').serializeArray();



            let data = {};
            $.each(form, function (x, y) {
                data[y['name']] = y['value'];
            });

            setCookie('it', JSON.stringify(data), 36500);
            $.ajax({
                type: 'get',
                url: `${url}includes/api/templateApi.php`,
                data: { 'action': 'generateIT', 'data': data },
                dataType: 'json',
                success: function (e) {
                    $('.previewIT').html(e.html);
                }
            });

        });
    });

    $('#showHere').on('click', '#generateAdmin1', function () {
  

        $('form').submit(function (e) {
            e.preventDefault();
            let form = $('form').serializeArray();

            let data = {};
            $.each(form, function (x, y) {
                data[y['name']] = y['value'];
            });
            $.ajax({
                type: 'get',
                url: `${url}includes/api/templateApi.php`,
                data: { 'action': 'generateAdmin1', 'data': data },
                dataType: 'json',
                success: function (e) {
                    $('.previewAdmin1').html(e.html);
                }
            });

        });
    });






})