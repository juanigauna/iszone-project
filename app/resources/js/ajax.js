function ajax(n) {
	var xhr = new XMLHttpRequest();
	function encodeData(data) {
		url = "";
		for (var prop in data) {
			url += prop + '=' + encodeURIComponent(data[prop]) + '&';
			return url.substring(0, url.length - 1);
		}
	}
	var data = encodeData(n.data);
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