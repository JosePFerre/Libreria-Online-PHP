<style>
	html,body{
		background-image: url(img/fondo.jpg);
		background-attachment: fixed;
	}
	
</style>
<?php
$tituloPagina="Regístrate en nuestra web";
$pagina="registro";
include('inc/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
				<form role="form" method="POST">
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Nombre de Usuario">
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Contraseña">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Repetir Contraseña">
							</div>
						</div>
					</div>
					
					<input type="submit" name="register" value="Register" class="btn btn-primary btn-block">
	
				</form>
			</div>
		</div>
	</div>
</div>

<?php include('inc/footer.php'); ?>
   