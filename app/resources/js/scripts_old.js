$(document).ready(function() {
    $('#btn_loader').click(function() {
        var button = document.getElementById('btn_loader');
        button.innerHTML = "Cargando...";
    })
    $('#new-account').submit(function() {
        form('new-account', 'new-account', 'result', 'Crear cuenta');
        return false;
    })
    $('#login-account').submit(function() {
        form('login-account', 'login', 'result', 'Iniciar Sesión');
        return false;
    })
    $("#its_free").change(function(){
        var op = $("#its_free option:selected").val();
        if  (op == 'no') {
            document.getElementById('content-price').className = 'show';
        } else if (op == 'yes') {
            document.getElementById('content-price').className = 'hidden';
        }
    });
    $('#new-event').submit(function() {
        form('new-event', 'new-event', 'result', 'Crear evento');
        return false;
    })
    $('#change_pic_btn').click(function() {
        change_pp('form_change_pic', 'btn-change', 'loader_menu', 'Cambiar');
        return false;
    })
    $('#change_pic_btn_acc').click(function() {
        change_pp('form_change_pic_acc', 'btn-change-acc', 'loader-acc', 'Cambiar');
        return false;
    })
    $('#btn-see-event').click(function() {
        see_events();
    })
    $('#btn-follow').click(function() {
        var btn_follow = getID('btn-follow').className;
        var follower_id = $('#btn-follow').attr('follower-id');
        if (btn_follow == 'unfollow') {
            getID('btn-follow').innerHTML = '<i class="fas fa-check"></i> Siguiendo';
            getID('btn-follow').className = 'follow';
            follow(follower_id);
        } else if (btn_follow == 'follow') {
            getID('btn-follow').innerHTML = '<i class="fas fa-plus"></i> Seguir';
            getID('btn-follow').className = 'unfollow';
            follow(follower_id);
        }
        return false;
    })
    $('#new-comment').submit(function() {
        var text = getID('comment').value.trim();
        var username = $('#new-comment').attr('username');
        var total_comments = Number(getID('tc').value) + Number(1);
        form('new-comment', 'new_comment&o=account', 'result', 'Comentar');
        if (text.length > 0) {
            getID('content-comments').innerHTML += '<div class="px-1 py-1 m-b-4 d-flex"> <div class="pp _50 m-r-3" style="background: url(' + get_profile_pic() + ');"></div> <div class="d-grid"> <div class="d-flex m-b-3"> <a class="m-r-2 normal-color" href="' + siteurl() + '/account/' + username + '">' + username + '</a> <p style="font-size: 13px;">Ahora</p> </div> <p>' + text + '</p> </div> </div>';
            getID('new-comment').reset();
            getID('total_comments').innerHTML = total_comments;
            getID('tc').value = total_comments;
            $('#content-comments').scrollTop($('#content-comments').prop('scrollHeight'));
        }
        return false;
    })
    $('#upd_location').submit(function() {
        update_user_location('upd_location', 'res_form', 'loader', 'Cambiar');
        return false;
    })
    $('#publisher-box').submit(function() {
        var form = new FormData(document.getElementById('publisher-box'));
        document.getElementById('btn-post-loader').innerHTML = '<i class="spinner fas fa-spinner"></i> Espera';
        $('#btn-post-loader').attr('disabled', 'disabled');
        form.append("CustomField", "This is some extra data");
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: site_url() + '?f=new-post',
            data: form,
            processData: false,
            contentType: false,
            success: function(n){
                if (n.status == 200) {
                    getID('publisher-box').reset();
                    getID('preview_img').className = "hidden";
                } else if (n.status == 204) {
                    
                }
                getID('btn-post-loader').innerHTML = "Publicar";
                $('#btn-post-loader').removeAttr('disabled');
            }
        })
        return false;
    })
    var text = $('textarea');
    text.on('change drop keydown cut paste', function() {
        text.height('auto');
        text.height(text.prop('scrollHeight'));
    });
})