
<!-- Messages -->

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'completed'): ?>
  <strong> Registro completado </strong>

<?php   elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
  <strong> Registro fallido. Introduce bien los datos </strong> 
<?php endif; ?>

<!-- Delete Messages -->
<?php  Utils::deleteSession('register');  ?>

<h2>
  Registrarse
</h2>
<form
  action="<?=BASE_URL?>user/save"
  method="POST" 
>

  <label for="name"> Nombre </label>
  <input type="text" name="name" required/>
  
  <label for="lastname"> Apellidos </label>
  <input type="text" name="lastname" required/>

  <label for="email"> Email </label>
  <input type="email" name="email" required/>

  <label for="password"> Password </label>
  <input type="password" name="password" required/>

  <button> Enviar </button>

</form>