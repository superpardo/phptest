<html>
    <?php include_once 'parts/header.php'; ?>
    <body>
    	<main>
    		<?php include_once 'parts/title.php'; ?>
    		<div class="container text-center">
    			<form action="index.php" method="POST">
    				<input type="hidden" id="q" name="q" value="register" />
    				<input type="hidden" id="action" name="action" value="register" />
    				<input class="mb" type="text" id="username" name="username" placeholder="Username" value="<?=$username?>" required />
    				<?php if( isset( $errors['username'] ) ): ?>
    				<div class="error mb"><?=$errors['username']?></div>
    				<?php endif; ?>
    				<input class="mb" type="email" id="email" name="email" placeholder="E-mail" value="<?=$email?>" required />
    				<?php if( isset( $errors['email'] ) ): ?>
    				<div class="error mb"><?=$errors['email']?></div>
    				<?php endif; ?>
    				<input class="mb" type="tel" id="phone" name="phone" placeholder="Phone number" value="<?=$phone?>" required />
    				<?php if( isset( $errors['phone'] ) ): ?>
    				<div class="error mb"><?=$errors['phone']?></div>
    				<?php endif; ?>
    				<input class="mb" type="password" id="password" name="password" placeholder="Password" value="<?=$password?>" required />
    				<?php if( isset( $errors['password'] ) ): ?>
    				<div class="error mb"><?=$errors['password']?></div>
    				<?php endif; ?>
    				<input type="submit" class="btn" value="Register" />
    			</form>
    		</div>
    	</main>
    	<?php include_once 'parts/footer.php'; ?>
    </body>
</html>