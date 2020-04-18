<div id="content-comments-<?php echo $n['post']['id'] ?>" class="<?php if ($view == 'comment') { ?>show<?php } else { ?>hidden<?php } ?>" status="<?php if ($view == 'comment') { ?>loaded<?php } else { ?>notLoad<?php } ?>">
    <?php if ($n['logged_in'] == true) { ?>
        <form id="publisher_comment_<?php echo $n['post']['id'] ?>" onsubmit="post_comment(<?php echo $n['post']['id'] ?>, <?php echo $n['post']['user_id'] ?>); return false;" class="d-flex m-b-4">
            <div class="pp _45 m-r-2" style="background: url(<?php echo get_profile_pic($id) ?>);"></div>
            <input id="info_<?php echo $n['post']['id'] ?>" username="<?php echo get_username($id) ?>" hidden>
            <input class="m-r-2" style="width: 100%" type="text" id="comment_text_<?php echo $n['post']['id'] ?>" name="text" placeholder="Escribe un comentario..." autocomplete="off">
            <button id="btn-comment-<?php echo $n['post']['id'] ?>"><i class="fas fa-chevron-right"></i></button>
        </form>
    <?php } ?>
    <div id="load_comments_<?php echo $n['post']['id'] ?>">
        <?php
        if ($view == 'comment') {
            $n['comment'] = fetch_array("SELECT * FROM comments WHERE id = '$comment_id'");
            include 'app/layout/comments/content.php';
        }
        ?>
    </div>
</div>
<?php if (isset($_GET['comments_real_time']) && $_GET['comments_real_time'] == true) { ?>
    <script type="text/javascript">
        setInterval(function () {
            var content = document.querySelector('#load_comments_<?php echo $n['post']['id'] ?>').innerHTML;
            ajax({
                dataType: 'json',
                type: 'POST',
                url: site_url() + '?f=comments_real_time&post_id=<?php echo $n['post']['id'] ?>',
                success: function (n) {
                    if (n.new_comment == true) {
                        for (var i = n.comment_id.length - 1; i >= 0; i--) {
                            if (!document.querySelector('#comment_' + n.comment_id[i])) {
                                ajax({
                                    type: 'POST',
                                    url: site_url() + '?f=get_last_comments&comment_id=' + n.comment_id[i],
                                    success: function (res) {
                                        document.querySelector('#load_comments_<?php echo $n['post']['id'] ?>').innerHTML = res;
                                        document.querySelector('#load_comments_<?php echo $n['post']['id'] ?>').innerHTML += content;
                                    }
                                })
                            }
                        }
                    }
                }
            })    
        }, 2000)
    </script>
<?php } ?>