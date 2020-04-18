<div class="m-b-4" style="border: 1px solid #f1f1f1; padding: 10px 15px;">
    <form id="publisher-box" class="d-grid m-b-4" enctype="multipart/form-data">
        <div class="d-flex m-b-4">
            <div class="pp _45 m-r-5" style="background: url('<?php echo get_profile_pic($n['user']['id']) ?>');"></div>
            <textarea id="pb" class="m-r-3" name="text" style="width: 100%; font-size: 16px; border: none; padding: 0;" placeholder="Comparte algo, <?php echo $n['user']['username'] ?>."></textarea>
            <label id="lb-pm" class="normal-color text-bold" style="font-size: 20px;" for="post_img"><i class="fas fa-camera"></i></label>
            <input type="file" id="post_img" name="img[]" accept="image/*" multiple hidden>
        </div>
        <div class="d-flex m-b-4">
            <a id="location_pp" class="btn-op-post m-r-3" style="font-size: 14px;" onclick="location_post();"><i class="fas fa-map-marker"></i> Ubicación</a>
            <a id="secret_pp" class="btn-op-post" style="font-size: 14px;" onclick="secret_post();"><i class="fas fa-user-secret"></i> Secreto</a>
        </div>
        <input id="location_post" type="number" name="location_post" value="0" hidden>
        <input id="secret_post" type="number" name="secret_post" value="0" hidden>
        <div class="hidden" id="preview_img" style="overflow-x: auto;"></div>
        <div class="d-flex">
            <button id="btn-post-loader">Publicar</button>
        </div>
    </form>
</div>
<script type="text/javascript">
function readImage_post(input) {
    if (input.files && input.files[0]) {
        getID('preview_img').innerHTML = ''
        getID('preview_img').className = "d-flex m-b-4";
        var id = Number(0);
        for (var i = input.files.length - 1; i >= 0; i--) {
            id++;
            getID('preview_img').innerHTML += '<div id="img_' + id + '" class="m-l-2 prp _120" style="background: url(' + URL.createObjectURL(input.files[i]) + ')"><p class="white-color" onclick="delete_img(' + id + ', ' + i + ');">X</p></div>';
        }
    }
}
function delete_img (img_id, i) {
	getID('img_' + img_id).remove();
    var formData = new FormData(getID('publisher-box'));
    formData.delete(getID('post_img').files[i]);
}
function location_post() {
    var option = getID('location_post').value;
    if (option == 0) {
        getID('location_pp').innerHTML = '<i class="fas fa-map-marker-alt"></i> Ubicación';
        getID('location_pp').className = "btn-op-post m-r-3 page-color ";
        document.querySelector('#location_post').setAttribute('value', '1');
    } else if (option == 1) {
        getID('location_pp').innerHTML = '<i class="fas fa-map-marker"></i> Ubicación';
        getID('location_pp').className = "btn-op-post m-r-3";
        document.querySelector('#location_post').setAttribute('value', '0');
    }
}
function secret_post() {
    var option = getID('secret_post').value;
    getID('publisher-box').reset();
    getID('preview_img').innerHTML = '';
    if (option == 0) {
        getID('secret_pp').innerHTML = '<i class="fas fa-user-secret"></i> Secreto';
        getID('secret_pp').className = "btn-op-post page-color ";
        getID('location_pp').className = "hidden";
        document.querySelector('#location_post').setAttribute('value', '0');
        getID('lb-pm').className = "hidden";
        document.querySelector('#pb').setAttribute('placeholder', '¿Cuál es tu secreto?');
        document.querySelector('#secret_post').setAttribute('value', '1');
    } else if (option == 1) {
        getID('secret_pp').innerHTML = '<i class="fas fa-user-secret"></i> Secreto';
        getID('secret_pp').className = "btn-op-post";
        getID('location_pp').className = "btn-op-post m-r-3";
        document.querySelector('#location_post').setsetAttributeibute('value', '0');
        getID('lb-pm').className = "normal-color text-bold";
        document.querySelector('#pb').setAttribute('placeholder', 'Comparte algo, <?php echo $n['user']['username'] ?>.');
        document.querySelector('#secret_post').setAttribute('value', '0');
    }
}
</script>