<form id="publisher_reply_<?php echo $n['comment']['id'] ?>" class="d-flex" onsubmit="reply_comment(<?php echo $n['comment']['id'] ?>, <?php echo $n['comment']['user_id'] ?>); return false;">
	<div class="pp _35 m-r-3" style="background: url(<?php echo get_profile_pic($id) ?>);"></div>
	<input id="reply_text_<?php echo $n['comment']['id'] ?>" style="width: 100%;" type="text" name="text" autocomplete="off" placeholder="Escribe tu respuesta...">
</form>