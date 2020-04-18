<p class="text-bold m-b-4">Comentarios</p>
<div class="d-flex m-b-4">
    <input class="m-r-2" style="width: 100%" type="text" name="comment" placeholder="Escribe un comentario...">
    <button><i class="fas fa-chevron-right"></i></button>
</div>
<div id="load-comments_<?php echo $n['event']['id'] ?>">
	<button onclick="load_comments();">Cargar</button>
</div>
<script type="text/javascript">
	function load_comments() {
		$.ajax({
			type: 'POST',
			url: site_url() + '?f=load_comments&o=event&event_id=' + <?php echo $n['event']['id'] ?>,
			success: function(result) {
				getID('load-comments_<?php echo $n['event']['id'] ?>').innerHTML = result;
			}
		})
	}
</script>