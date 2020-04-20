function ajax(n) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (n.dataType == 'json') {
				var res = JSON.parse(xhr.responseText);
			} else {
				var res = xhr.responseText;
			}
			n.success && n.success(res);
		}
	}
	xhr.open(n.type, n.url, true);
	xhr.send(n.data);
}
function getID(element_id) {
	return document.getElementById(element_id);
}
function event(element, event) {
	var element = document.querySelector(element);
	if (element) {
		return element.addEventListener(event);
	}
}
function form(form_id, f_o, result) {
	var form = new FormData(document.getElementById(form_id));
	var button = document.querySelector('#loader').innerHTML;
	document.querySelector('#loader').innerHTML = '<i class="spinner fad fa-spinner-third"></i> Espera...';
	document.querySelector('#loader').setAttribute('disabled', 'disabled');
	form.append("CustomField", "This is some extra data");
	ajax({
		type: 'POST',
		url: site_url() + '?f=' + f_o,
		data: form,
		success: function(res){
			document.querySelector('#' + result).innerHTML = res;
			document.querySelector('#loader').innerHTML = button;
			document.querySelector('#loader').removeAttribute('disabled');
		}
	})
	return false;
}
function change_pp(form_id, result, loader) {
	var form = new FormData(document.getElementById(form_id));
	var button = document.querySelector('#' + loader).innerHTML;
	document.querySelector('#' + loader).innerHTML = '<i class="spinner fad fa-spinner-third"></i> Espera...';
	document.querySelector('#' + loader).setAttribute('disabled', 'disabled');
	form.append("CustomField", "This is some extra data");
	ajax({
		type: 'POST',
		url: site_url() + '?f=change_pic',
		data: form,
		success: function(res){
			var res = getID(result).className;
			if (res == 'm-t-2 text-center') {
				getID(result).className = 'm-t-2 text-center hidden';
			}
			document.querySelector('#' + loader).innerHTML = button;
			document.querySelector('#' + loader).removeAttribute('disabled');
		}
	})
	return false;
}
function menu_post(post_id) {
	var menu_post = document.getElementById('menu_post_' + post_id).className;
    if (menu_post == "hidden") {
    	document.getElementById('menu_post_' + post_id).className = "show";
    } else if (menu_post == "show") {
    	document.getElementById('menu_post_' + post_id).className = "hidden";
    }
}
function delete_post(post_id) {
	getID('d-btn_' + post_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i> Borrando';
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=delete_post&post_id=' + post_id,
		success: function(n){
			if (n.status == true) {
				getID('post_' + post_id).remove();
			} else {
				getID('d-btn_' + post_id).innerHTML = '<i class="fas fa-trash"></i> Borrar';
			}
		}
	})
}
function like(post_id, to_id) {
    var audio = new Audio(siteurl() + '/app/resources/mp3/notification-1.mp3');
    audio.play();
	var element = getID('like_post_' + post_id).className;
	var number = getID('tln_' + post_id).value;	
	if (element == 'btn-action-post m-r-2') {
		var like = Number(number) + Number(1);	
		document.getElementById('icon_' + post_id).className = 'fas fa-heart m-r-2';
		document.getElementById('like_post_' + post_id).className = 'btn-action-post m-r-2 liked';
		getID('tl_' + post_id).innerHTML = like;
		getID('tln_' + post_id).value = like;
		ajax({
			type: 'POST',
			url: site_url() + '?f=like&post_id=' + post_id + '&to_id=' + to_id,
		})
	} else if (element == 'btn-action-post m-r-2 liked') {
		var dislike = Number(number) - Number(1);
		document.getElementById('icon_' + post_id).className = 'far fa-heart m-r-2';
		document.getElementById('like_post_' + post_id).className = 'btn-action-post m-r-2';
		getID('tl_' + post_id).innerHTML = dislike;
		getID('tln_' + post_id).value = dislike;
		ajax({
			type: 'POST',
			url: site_url() + '?f=like&post_id=' + post_id + '&to_id=' + to_id,
		})
	}
}
function like_comment(comment_id, to_id) {
    var audio = new Audio(siteurl() + '/app/resources/mp3/notification-1.mp3');
    audio.play();
	var element = getID('like_comment_' + comment_id).className;
	//var number = getID('tln_' + comment_id).value;	
	if (element == '') {
		//var like = Number(number) + Number(1);	
		document.getElementById('iconc_' + comment_id).className = 'fas fa-heart';
		document.querySelector('#like_comment_' + comment_id).setAttribute('class', 'liked');
		//getID('tl_' + comment_id).innerHTML = like;
		//getID('tln_' + comment_id).value = like;
		/*ajax({
			type: 'POST',
			url: site_url() + '?f=like&comment_id=' + comment_id + '&to_id=' + to_id,
		})*/
	} else if (element == 'liked') {
		//var dislike = Number(number) - Number(1);
		document.getElementById('iconc_' + comment_id).className = 'far fa-heart';
		document.querySelector('#like_comment_' + comment_id).removeAttribute('class');
		//getID('tl_' + comment_id).innerHTML = dislike;
		//getID('tln_' + comment_id).value = dislike;
		/*ajax({
			type: 'POST',
			url: site_url() + '?f=like&comment_id=' + comment_id + '&to_id=' + to_id,
		})*/
	}
}
function follow(follower_id) {
	ajax({
		type: 'POST',
		url: site_url() + '?f=follow&follower_id=' + follower_id,
	})
}
function menu() {
    var menu = getID('menu').className;
    if (menu == 'menu-nav p-fixed hidden-menu') {
        getID('menu').className = 'menu-nav p-fixed show-menu';
        getID('bg-menu').className = 'bg-menu p-fixed show';
    } else if (menu == 'menu-nav p-fixed show-menu') {
        getID('menu').className = 'menu-nav p-fixed hidden-menu';
        getID('bg-menu').className = 'bg-menu p-fixed hidden-bg-menu';
    }
}
function menu_location() {
    var menu = getID('menu-loc').className;
    if (menu == 'menu-loc p-fixed hidden-menu-right') {
        getID('menu-loc').className = 'menu-loc p-fixed show-menu-right';
    } else if (menu == 'menu-loc p-fixed show-menu-right') {
        getID('menu-loc').className = 'menu-loc p-fixed hidden-menu-right';
    }
}
function logout() {
	ajax({
		type: 'POST',
		url: site_url() + '?f=logout',
		success: function(res) {
			location.href=siteurl();
		}
	})
}
function update_location() {
	getID('update_location').innerHTML = '<i class="spinner fad fa-spinner-third"></i> Actualizando';
	ajax({
		type: 'POST',
		url: site_url() + '?f=update_location',
		success: function(res) {
			location.href=siteurl();
		}
	})
}
function search_location(id) {
    let timeout;
    getID('result_' + id).innerHTML = "<i class='spinner fad fa-spinner-third'></i> Buscando...";
    if (getID('city_' + id).value.trim().length > 0 || getID('region_' + id).value.trim().length > 0 || getID('country_' + id).value.trim().length > 0) {
        getID('result_' + id).className = 'm-b-4 show';
	    clearTimeout(timeout);
	    timeout = setTimeout(() => {
	        ajax({
	            type: 'POST',
	            url: site_url() + '?f=search_location&city=' + getID('city_' + id).value + '&region=' + getID('region_' + id).value + '&country=' + getID('country_' + id).value,
	            success: function(res) {
	                getID('result_' + id).innerHTML = res;
	            }
	        })
	        clearTimeout(timeout)
	    }, 1000)
    } else {
        getID('result_' + id).className = 'm-b-4 hidden';
    }
}
function updateLocation(location_id) {
	getID('update_loc_' + location_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i> Actualizando';
	ajax({
		type: 'POST',
		url: site_url() + '?f=updateLocation&location_id=' + location_id,
		success: function(res) {
			location.href=siteurl();
		}
	})
}
function update_user_location(form_id, result, loader) {
	var form = new FormData(document.getElementById(form_id));
	var button = document.querySelector('#' + loader).innerHTML;
	document.querySelector('#' + loader).innerHTML = '<i class="spinner fad fa-spinner-third"></i> Espera...';
	document.querySelector('#' + loader).setAttribute('disabled', 'disabled');
	form.append("CustomField", "This is some extra data");
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=update_user_location',
		data: form,
		success: function(n){
			if (n == 200) {
				location.href=siteurl();
			} else {
				document.querySelector('#' + result).innerHTML = "Introduce una ubicación que exista.";
			}
		}
	})
	return false;
}
function read_all() {
	getID('btn_read-all').innerHTML = '<i class="spinner fad fa-spinner-third"></i> Cargando';
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=read_all',
		success: function (n) {
			if (n.status == true) {
				getID('not_num').innerHTML = '';
				getID('not_num').className = 'hidden';
				for (var i = n.not_id.length - 1; i >= 0; i--) {
					if (document.querySelector('#not_' + n.not_id[i])) {
						document.querySelector('#not_' + n.not_id[i]).setAttribute('style', 'background: #fff');
					}
				}
				getID('btn_read-all').innerHTML = 'Marcar todo como leído';
			}
		}
	})
}
function post_comment(post_id, to_id) {
    var text = getID('comment_text_' + post_id).value.trim();
    var username = document.querySelector('#info_' + post_id).getAttribute('username');
    var content = getID('load_comments_' + post_id).innerHTML;
    var form = new FormData(getID('publisher_comment_' + post_id));
    if (text.length > 0) {
    	document.querySelector('#btn-comment-' + post_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i>';
	    ajax({
	        type: 'POST',
	        url: site_url() + '?f=new_comment&o=post&post_id=' + post_id + '&to_id=' + to_id,
	        data: form,
	        success: function (res) {
				getID('load_comments_' + post_id).innerHTML = res;
        		getID('load_comments_' + post_id).innerHTML += content;
        		document.querySelector('#btn-comment-' + post_id).innerHTML = '<i class="fas fa-chevron-right"></i>';
	        }
	    })
        getID('publisher_comment_' + post_id).reset();
    }
}
function reply_comment(comment_id, to_id) {
    var text = getID('reply_text_' + comment_id).value.trim();
    var content = getID('load_replies_' + comment_id).innerHTML;
    var form = new FormData(getID('publisher_reply_' + comment_id));
    if (text.length > 0) {
    	//document.querySelector('#btn-comment-' + comment_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i>';
	    ajax({
	        type: 'POST',
	        url: site_url() + '?f=new_reply&comment_id=' + comment_id + '&to_id=' + to_id,
	        data: form,
	        success: function (res) {
				getID('load_replies_' + comment_id).innerHTML = res;
        		getID('load_replies_' + comment_id).innerHTML += content;
        		//document.querySelector('#btn-comment-' + comment_id).innerHTML = '<i class="fas fa-chevron-right"></i>';
	        }
	    })
        getID('publisher_reply_' + comment_id).reset();
    }
}
function show_comments(post_id) {
	var status = document.querySelector('#content-comments-' + post_id).getAttribute('status');
	var Class = getID('content-comments-' + post_id).className;
	if (status == "notLoad" && Class == 'hidden') {
		ajax({
			url: site_url() + '?f=load_comments&o=post&post_id=' + post_id,
			success: function(result) {
				getID('load_comments_' + post_id).innerHTML += result;
			}
		})
		document.querySelector('#content-comments-' + post_id).setAttribute('status', 'loaded');
		getID('content-comments-' + post_id).className = 'content-comments show';
	} else if (status == 'loaded' && Class == 'content-comments show') {
		getID('content-comments-' + post_id).className = 'hidden';
	} else if (status == 'loaded' && Class == 'hidden') {
		getID('content-comments-' + post_id).className = 'content-comments show';
	}
}
function reply(comment_id) {
	var status = document.querySelector('#load_replies_' + comment_id).getAttribute('status');
	var element = document.querySelector('#reply_comment_' + comment_id).className;
	if (element == 'hidden' && status == 'notLoad') {
		ajax({
			url: site_url() + '?f=load_replies&comment_id=' + comment_id,
			success: function(result) {
				getID('load_replies_' + comment_id).innerHTML += result;
			}
		})
		document.querySelector('#load_replies_' + comment_id).setAttribute('status', 'loaded');
		document.querySelector('#reply_comment_' + comment_id).className = 'show';
	} else if (element == 'show' && status == 'loaded') {
		document.querySelector('#reply_comment_' + comment_id).className = 'hidden';
	} else if (element == 'hidden' && status == 'loaded') {
		document.querySelector('#reply_comment_' + comment_id).className = 'show';
	}
}
function delete_comment(comment_id) {
	var button = document.querySelector('#btn_del_' + comment_id).innerHTML;
	document.querySelector('#btn_del_' + comment_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i>';
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=delete_comment&comment_id=' + comment_id,
		success: function (n) {
			if (n.status == 200) {
				document.querySelector('#comment_' + comment_id).remove();
			} else if (n.status == 204) {
				document.querySelector('#btn_del_' + comment_id).innerHTML = button;
			}
		}
	})
}
function delete_reply(reply_id) {
	var button = document.querySelector('#btn_del_' + reply_id).innerHTML;
	document.querySelector('#btn_del_' + reply_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i>';
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=delete_reply&reply_id=' + reply_id,
		success: function (n) {
			if (n.status == 200) {
				document.querySelector('#comment_' + reply_id).remove();
			} else if (n.status == 204) {
				document.querySelector('#btn_del_' + reply_id).innerHTML = button;
			}
		}
	})
}
function delete_(e_id, is) {
	var button = document.querySelector('#del_' + is + '_' + e_id).innerHTML;
	document.querySelector('#del_' + is + '_' + e_id).innerHTML = '<i class="spinner fad fa-spinner-third"></i>';
	ajax({
		dataType: 'json',
		type: 'POST',
		url: site_url() + '?f=delete&o='+ is +'&e_id=' + e_id,
		success: function (n) {
			if (n.status == 200) {
				document.querySelector('#' + is + '_' + e_id).remove();
			} else if (n.status == 204) {
				document.querySelector('#del_' + is + '_'+ e_id).innerHTML = button;
			}
		}
	})
}