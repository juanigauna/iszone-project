if (document.querySelector('#new-account')) {
    document.querySelector('#new-account').addEventListener('submit', function (e) {
        form('new-account', 'new-account', 'result');
        e.preventDefault();
    })
}
if (document.querySelector('#login-account')) {
    document.querySelector('#login-account').addEventListener('submit', function (e) {
        var form = new FormData(document.querySelector('#login-account'));
        var button = document.querySelector('#loader').innerHTML;
        document.querySelector('#loader').innerHTML = '<i class="spinner fas fa-spinner"></i> Espera...';
        ajax({
            dataType: 'json',
            type: 'POST',
            url: site_url() + '?f=login',
            data: form,
            success: function (n) {
                if (n.status == 200) {
                    document.querySelector('#loader').innerHTML = button;
                    location.href = siteurl();
                } else if (n.status == 204) {
                    document.querySelector('#loader').innerHTML = button;
                    document.querySelector('#result').innerHTML = "Tu usuario o contraseña es incorrecto.";
                }
            }
        })
        e.preventDefault();
    })
}
if (document.querySelector('#change_pic_btn')) {
    document.querySelector('#change_pic_btn').addEventListener('click', function(e) {
        change_pp('form_change_pic', 'btn-change', 'loader_menu');
        e.preventDefault();
    })
}
if (document.querySelector('#change_pic_btn_acc')) {
    document.querySelector('#change_pic_btn_acc').addEventListener('click', function(e) {
        change_pp('form_change_pic_acc', 'btn-change-acc', 'loader-acc');
        e.preventDefault(e);
    })
}
if (document.querySelector('#btn-follow')) {
    document.querySelector('#btn-follow').addEventListener('click', function(e) {
        var btn_follow = document.querySelector('#btn-follow').className;
        var follower_id = document.querySelector('#btn-follow').getAttribute('follower-id');
        if (btn_follow == 'unfollow') {
            document.querySelector('#btn-follow').innerHTML = '<i class="fas fa-check"></i> Siguiendo';
            document.querySelector('#btn-follow').className = 'follow';
            follow(follower_id);
        } else if (btn_follow == 'follow') {
            document.querySelector('#btn-follow').innerHTML = '<i class="fas fa-plus"></i> Seguir';
            document.querySelector('#btn-follow').className = 'unfollow';
            follow(follower_id);
        }
        e.preventDefault();
    })
}
if (document.querySelector('#new-comment')) {
    document.querySelector('#new-comment').addEventListener('submit', function(e) {
        var form = new FormData(this);
        var text = document.querySelector('#comment').value.trim();
        var total_comments = Number(document.querySelector('#tc').value) + Number(1);
        var content = document.querySelector('#content-comments').innerHTML;
        if (text.length > 0) {
            document.querySelector('#btn_comment').innerHTML = '<i class="spinner fas fa-spinner"></i>';
            ajax({
                type: 'POST',
                url: site_url() + '?f=new_comment&o=account',
                data: form,
                success: function (res) {
                    document.querySelector('#content-comments').innerHTML += res;
                    document.querySelector('#btn_comment').innerHTML = '<i class="fas fa-chevron-right"></i>';
                    document.querySelector('#content-comments').scrollTo(0, document.querySelector('#content-comments').scrollHeight);
                }
            })
            document.querySelector('#new-comment').reset();
            document.querySelector('#total_comments').innerHTML = total_comments;
            document.querySelector('#tc').value = total_comments;
        }
        e.preventDefault(e);
    })
}
if (document.querySelector('#upd_location')) {
    document.querySelector('#upd_location').addEventListener('submit', function(e) {
        update_user_location('upd_location', 'res_form', 'loader');
        e.preventDefault();
    })
}
if (document.querySelector('#publisher-box')) {
    document.querySelector('#publisher-box').addEventListener('submit', function(e) {
        var form = new FormData(this);
        document.querySelector('#btn-post-loader').innerHTML = '<i class="spinner fad fa-spinner-third"></i> Espera';
        document.querySelector('#btn-post-loader').setAttribute('disabled', 'disabled');
        form.append("CustomField", "This is some extra data");
        formFiles.forEach(function(key){
             form.append("img[]", key.file);
        });
        ajax({
            dataType: 'json',
            type: 'POST',
            url: site_url() + '?f=new-post',
            data: form,
            success: function (n) {
                if (n.status == 200) {
                    document.querySelector('#publisher-box').reset();
                    document.querySelector('#preview_img').className = "hidden";
                    document.querySelector('textarea').style = '';
                    document.querySelector('#preview_img').innerHTML = "";
                    formFiles = [], formImgId = 0;
                }
                document.querySelector('#btn-post-loader').innerHTML = "Publicar";
                document.querySelector('#btn-post-loader').removeAttribute('disabled');
            }
        })
        e.preventDefault();
    })
}
if (document.querySelector('textarea')) {
    document.querySelector('textarea').addEventListener('click', function (e) {
        this.style = 'height: auto';
        this.style = 'height:' + this.scrollHeight + 'px';
        window.scrollTo(0, this.scrollHeight);
    })
    document.querySelector('textarea').addEventListener('keyup', function (e) {
        this.style = 'height: auto';
        this.style = 'height:' + this.scrollHeight + 'px';
        window.scrollTo(0, this.scrollHeight);
    })
}
if (document.querySelector('#edit-account')) {
    document.querySelector('#edit-account').addEventListener('submit', function (e) {
        var button = document.querySelector('#loader').innerHTML;
        var form = new FormData(this);
        document.querySelector('#loader').innerHTML = '<i class="spinner fad fa-spinner-third"></i> Espera';
        document.querySelector('#loader').setAttribute('disabled', 'disabled');
        ajax({
            dataType: 'json',
            type: 'POST',
            url: site_url() + '?f=edit-account',
            data: form,
            success: function (n) {
                if (n.status == 200) {
                    document.querySelector('#result').className = 'alert';
                    document.querySelector('#result').innerHTML = n.message;
                    setTimeout(function () {
                        document.querySelector('#result').className = 'hidden-alert';
                    }, 1500)
                }
                document.querySelector('#loader').innerHTML = button;
                document.querySelector('#loader').removeAttribute('disabled');
            }
        })
        e.preventDefault();
    })
}