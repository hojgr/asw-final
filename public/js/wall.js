var timeout = null;
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
				clearTimeout(timeout);
				loadContents();
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

				$.post("/wall/reply", { text: contents, parent: inp.attr('data-parent') } , function(body) {
					inp.val("");
					inp.prop("disabled", false);
					setTimeout(function() {
						clearTimeout(timeout);
						loadContents();
					}, 50);
				});
			}
		}
	});

	function textify(text) {
		text = text.replace(/(https?:\/\/[^\)\(\]\[ ]+)/, "<a href='$1'>$1</a>");

		return text;
	}

	function createReply(id, author, postedAt, text) {
		var contents = '';
		contents += '			<div class="reply" data-reply-id="' + id + '">';
		contents += '				<div class="reply_heading">' + author + '(' + postedAt + ')</div>';
		contents += '				<div class="reply_text">' + textify(text) + '</div>';
		contents += '			</div>';
		return contents;
	}

	function createPost(id, author, posted, text, replies) {

		var contents = '';
		contents += '<div class="post" data-id="' + id + '">';
		contents += '	<div class="user_info">';
		contents += '		<div class="avatar">';
		contents += '			<img src="http://i.imgur.com/EoBUlwq.png" />';
		contents += '		</div>';
		contents += '		<div class="additional">';
		contents += '			<span class="author">' + author + '</span>';
		contents += '			<span class="time">' + posted + '</span>';
		contents += '		</div>';
		contents += '	</div>';
		contents += '	<div class="post_contents">';
		contents += '		<div class="text">';
		contents += '			' + textify(text) + '';
		contents += '		</div>';
		contents += '		<div class="separator"></div>';
		contents += '		<div class="replies">';


		if(replies.length > 0) {
			for(var reply_index in replies) {
				var reply = replies[reply_index];
				contents += createReply(reply['id'], reply['author'], reply['postedAt'], reply['text']);
			}
		}
		contents += '		</div>';

		if(loggedIn) {
			contents += '		<div class="write_reply">';
			contents += '		<input class="reply_input" data-parent="' + id + '" type="text" placeholder="Napiste reakci" />';
			contents += '		</div>';
		}

		contents += '	</div>';
		contents += '</div>';

		contents += '<div style="clear: both"></div>';

		return contents;
	}

	function loadContents(initial) {
		if(initial !== true) {
			initial = false;
		}

		$.get("/wall/posts", function(data) {
			var total = '';
			for(var post_index in data) {
				var post = data[post_index];

				if(!initial) {
					if ($(".post[data-id=" + post['id'] + "]").length) {
						var cur_length = $(".post[data-id=" + post['id'] + "] .reply").length;
						if(cur_length != post['replies'].length) {
							console.log("old: " + cur_length-1);
							var app_posts = '';
							for(var i = cur_length ; i < post['replies'].length; i++) {
								var cur_post = post['replies'][i];
								app_posts += createReply(cur_post.id, cur_post.author, cur_post.postedAt, cur_post.text);
							}
							$(".post[data-id=" + post['id'] + "] .replies").append(app_posts);
						} else console.log("match");
					} else {
						$(".post_wrapper").prepend(createPost(post['id'], post['author'], post['postedAt'], post['text'], post['replies']));
					}
				} else {
					total += createPost(post['id'], post['author'], post['postedAt'], post['text'], post['replies']);
				}
			}
			if(total != "") {
				$('.post_wrapper').html(total);
			}
		});

		timeout = setTimeout(loadContents, 1000);
	}

	loadContents(true);
});