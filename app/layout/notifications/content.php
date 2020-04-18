<div class="mx-1 m-t-8">
	<div class="d-flex m-b-5">
		<h3 class="m-r-5">Notificaciones</h3>
		<a id="btn_read-all" onclick="read_all();" href="#read-all" style="font-size: 13px;">Marcar todo como leído</a>
	</div>
	<div id="content-nots"><p class="page-color"><i class="spinner fad fa-spinner-third"></i> Cargando</p></div>
</div>
<script type="text/javascript">
	setTimeout(function() {
		ajax({
			type: 'POST',
			url: site_url() + '?f=load_nots',
			success: function(res) {
				document.querySelector('#content-nots').innerHTML = res;
			}
		})
	}, 2000)
</script>