$(document).ready(function() {
	$("#post").click(function() {
		var contents = $("#postContent");

		if(contents.val().length == 0) {
			alert("Musite zadat text!");
		} else {
			contents.attr("disabled", "disabled");
			$.post("/wall/post", { text: contents.val() } , function() {
				contents.val("");
			});
		}
	})
});