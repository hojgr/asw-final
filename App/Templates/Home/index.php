<div class="center">

	<?php if($user !== null): ?>
		<div class="post-write">
			<button id="post" class="chamoiseeBtn generalBtn">Odeslat</button>
			<textarea id="postContent" placeholder="Prispevek"></textarea>
		</div>
	<?php endif; ?>

	<div style="clear: both"></div>

	<?php foreach($posts as $post): ?>
		<div class="post" data-id="{@post->id}">
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
						<?php foreach($post->replies as $reply): ?>
							<div class="reply">
								<div class="reply_heading">{@reply->author} ({@reply->postedAt})</div>
								<div class="reply_text">{@reply->text}</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if($user !== null): ?>
				<div class="write_reply">
					<input class="reply_input" data-parent="{@post->id}" type="text" placeholder="Napiste reakci" />
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div style="clear: both"></div>
	<?php endforeach; ?>
</div>