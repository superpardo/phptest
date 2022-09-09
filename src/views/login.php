<html>
    <?php include_once 'parts/header.php'; ?>
    <body>
    	<main>
    		<?php include_once 'parts/title.php'; ?>
    		<div class="container text-center">
    			<form action="index.php" method="POST">
    				<input type="hidden" id="q" name="q" value="login" />
    				<input type="hidden" id="action" name="action" value="login" />
    				<input class="mb" type="text" id="username" name="username" placeholder="Username" />
    				<?php if( isset( $errors['username'] ) ): ?>
    				<div class="error mb"><?=$errors['username']?></div>
    				<?php endif; ?>
    				<input class="mb" type="password" id="password" name="password" placeholder="Password" />
    				<?php if( isset( $errors['password'] ) ): ?>
    				<div class="error mb"><?=$errors['password']?></div>
    				<?php endif; ?>
    				<input type="submit" class="btn" value="Login" />
    			</form>
    			<a href="/index.php?q=register">Don't have an account?</a>
    		</div>
    	</main>
    	<?php include_once 'parts/footer.php'; ?>
    </body>
</html>