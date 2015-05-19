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
	});

	$(".reply_input").keypress(function(e) {
		if(e.which == 13) {
			var inp = $(this);
			var contents = inp.val();

			if(contents.length == 0) {
				alert("Musite zadat text!");
			} else {
				inp.prop("disabled", true);

				$.post("/wall/reply", { text: contents, parent: inp.attr('data-parent') } , function() {
					inp.val("");
					inp.prop("disabled", false);
				});
			}
		}
	});
});