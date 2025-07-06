<h2>Crear Propietario</h2>
<form action="<?= base_url('/propietario/guardar') ?>" method="post">
  <label>Documento</label>
  <input name="num_doc" required>
  <label>Nombre</label>
  <input name="nombre_pro">
  <label>Apellido</label>
  <input name="apellido_pro">
  <label>Dirección</label>
  <input name="direccion_pro">
  <label>Teléfono</label>
  <input name="telefono_pro">
  <label>Correo</label>
  <input name="correo_pro">
  <button type="submit">Guardar</button>
</form>
