<div class="center">

	<?php if($user !== null): ?>
		<div class="post-write">
			<button id="post" class="chamoiseeBtn generalBtn">Odeslat</button>
			<textarea id="postContent" placeholder="A post"></textarea>
		</div>
	<?php endif; ?>

	<div style="clear: both"></div>

	<?php foreach($posts as $post): ?>
		<div class="post">
			<div class="user_info">
				<div class="avatar">
					<img src="http://i.imgur.com/EoBUlwq.png" />
				</div>
				<div class="additional">
					<span class="author">{@post->author}</span>
					<span class="time">{@post->postedAt}</span>
				</div>
			</div>
			<div class="post_contents">
				<div class="text">
					{@post->text}
				</div>
				<div class="separator"></div>
				<?php if(count($post->replies) > 0): ?>
					<div class="replies">
						<div class="reply">
							<div class="reply_heading">James Bond (pred hodinou)</div>
							<div class="reply_text">Zajimave...</div>
						</div>
						<div class="reply">
							<div class="reply_heading">James Bond (pred hodinou)</div>
							<div class="reply_text">Zajimave...</div>
						</div>
						<div class="reply">
							<div class="reply_heading">James Bond (pred hodinou)</div>
							<div class="reply_text">Zajimave...</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="write_reply">
					<input class="reply_input" data-parent="{@post->id}" type="text" placeholder="Napiste reakci" />
				</div>
			</div>
		</div>

		<div style="clear: both"></div>
	<?php endforeach; ?>
</div>