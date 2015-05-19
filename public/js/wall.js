$(document).ready(function() {
	$("#post").click(function() {
		var contents = $("#postContent");

		if(contents.val().length == 0) {
			alert("Musite zadat text!");
		} else {
			contents.prop("disabled", true);
			$.post("/wall/post", { text: contents.val() } , function() {
				contents.val("");
				contents.prop("disabled", false);
			});
		}
	});

	$(document).on("keypress", ".reply_input", function(e) {
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

	function loadNewPosts() {

		var firstPost = $(".post").first();

		var lastPostId = firstPost.attr("data-id");
		$.get("/wall/posts", {last: lastPostId}, function(body) {
			body = body.reverse();

			for(var i in body) {
				var contents = body[i];

				var currentPost = $(firstPost).clone();
				currentPost.find(".author").text(contents['author']);
				currentPost.find(".time").text(contents['postedAt']);
				console.log(currentPost.find(".text").text());
				console.log("loaded > " + contents['text']);
				currentPost.find(".text").text(contents['text']);
				console.log(currentPost.find(".text").text());
				currentPost.find('.replies').remove();
				currentPost.attr('data-id', contents['id']);
				currentPost.find('.reply_input').attr('data-parent', contents['id']);
				firstPost.before(currentPost);
				firstPost.before("<div style='clear: both'></div>");
			}
		});

		setTimeout(loadNewPosts, 500);
	}

	setTimeout(loadNewPosts, 500);
});