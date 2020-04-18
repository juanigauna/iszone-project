setInterval(function() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var n = JSON.parse(this.responseText);
            if (n.actual_page == "home" && n.new_post == true) {
                var content_post = document.getElementById('content-posts').innerHTML;
                for (var i = n.np.length - 1; i >= 0; i--) {
                    if (!document.querySelector('#post_' + n.np[i])) {
                        ajax({
                            type: 'POST',
                            url: site_url() + '?f=get_last_posts&post_id=' + n.np[i],
                            success: function (res) {
                                document.getElementById('content-posts').innerHTML = res;
                                document.getElementById('content-posts').innerHTML += content_post;
                            }
                        })
                    }
                }
            }
            if (n.new_notification == true) {
                var audio = new Audio(siteurl() + '/app/resources/mp3/like.mp3');
                audio.play();
                document.getElementById('not_num').className = 'alert-not';
                document.getElementById('not_num').innerHTML = n.total_nots;
                if (n.actual_page == "notifications") {
                    var content_not = document.getElementById('content-nots').innerHTML;
                    for (var i = n.nn.length - 1; i >= 0; i--) {
                        if (!document.querySelector('#not_' + n.nn[i])) {
                            ajax({
                                type: 'POST',
                                url: site_url() + '?f=get_last_nots&not_id=' + n.nn[i],
                                success: function (res) {
                                    document.getElementById('content-nots').innerHTML = res;
                                    document.getElementById('content-nots').innerHTML += content_not;
                                }
                            })
                        }
                    }
                }
            }
        }
    }
    xhttp.open('POST', site_url() + '?f=data', true);
    xhttp.send();
}, 2000)