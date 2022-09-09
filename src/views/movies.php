<html>
    <?php include_once 'parts/header.php'; ?>
    <body>
    	<main>
    		<?php include_once 'parts/title.php'; ?>
    		<div class="container">
    		
				<?php if( isset( $errors['years'] ) ): ?>
				<div class="error"><?=$errors['years']?></div>
				<?php endif; ?>
    		
    			<div class="d-flex justify-end">
        			<form class="mr text-center" action="index.php" method="POST">
        				<input type="hidden" id="q" name="q" value="movies" />
        				<input type="hidden" id="action" name="action" value="update" />
        				<input class="mb" type="text" id="category" name="category" placeholder="Category" />
        				<input type="submit" class="btn" value="Update movies list" />    			
        			</form>
        			
        			<form action="index.php" method="POST">
        				<input type="hidden" id="q" name="q" value="login" />
        				<input type="hidden" id="action" name="action" value="logout" />
        				<input type="submit" class="btn" value="Logout" />
        			</form>
    			</div>

    			<div class="d-flex justify-end">
        			<form class="form-search" action="index.php" method="POST">
        				<input type="hidden" id="q" name="q" value="movies" />
        				<input type="hidden" id="action" name="action" value="search" />
        				<div>
        					<input class="mb" type="text" id="movie_title" name="movie_title" placeholder="Title" value="<?=$movie_title?>" />
        				</div>
    					<div>
    						<span class="strong">Range</span>
    						<input type="number" min="1900" max="2099" id="start" name="start" placeholder="YYYY" value="<?=$start?>" />
    						<input type="number" min="1900" max="2099" id="end" name="end" placeholder="YYYY" value="<?=$end?>" />
    					</div>
    					<div>
    						<span class="strong">Sort by</span>
        					<input type="radio" id="sort_title" name="sort" value="title" <?php if( $sort == 'title' ): ?>checked <?php endif; ?>/>
        					<label for="sort_title">Title</label>
        					<input type="radio" id="sort_date" name="sort" value="year" <?php if( $sort == 'year' ): ?>checked<?php endif; ?>>
        					<label for="sort_date">Year</label><br>
    					</div>
    					<div>
    						<span class="strong">Order by</span>
        					<input type="radio" id="desc" name="order" value="desc" <?php if( $order == 'desc' ): ?>checked <?php endif; ?>/>
        					<label for="desc">Desc</label>
        					<input type="radio" id="asc" name="order" value="asc" <?php if( $order == 'asc' ): ?>checked <?php endif; ?>>
        					<label for="asc">Asc</label><br>
    					</div>
    					<div>			
        					<input type="submit" class="btn" value="Search" />
        				</div>    			
        			</form>
    			</div>    		
    		
    			<?php if( $movies ): ?>
    			<table>
    				<thead>
    					<tr>
        					<th></th>
        					<th>Title</th>
        					<th>Year</th>
        					<th>Type</th>
    					</tr>
    				</thead>
    				<tbody>
    				<?php foreach( $movies AS $movie ): ?>
    					<tr>
    						<td><img src="<?=$movie->poster ?>" width="100" height="100" /></td>
    						<td><?=$movie->title ?></td>
    						<td><?=$movie->year ?></td>
    						<td><?=$movie->type ?></td>
    					</tr>
    				<?php endforeach; ?>
					</tbody>
    			</table>
    			<?php endif; ?>
    		</div>
    	</main>
    	<?php include_once 'parts/footer.php'; ?>
    </body>
</html>