<?php include_once "./header.php" ?>
<h1 class="text-center m-4">Ventas</h1>
<div class="py-4 mx-2 card">
    <table class="table table-striped-columns table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Código</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Tipo de producto</th>
                <th class="text-center">Fabrica</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Venta</th>
                <th class="text-center">Observación</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody id="tblVentas">
        </tbody>
    </table>
</div>
<!-- Modal update -->
<div>
    <div class="modal fade" id="modalEditVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditVentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditVentaLabel">Editar datos de la venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-2">
                <form id="frmEditVenta" class="was-validated">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtProductoNew" class="form-label">Producto</label>
                        </div>
                        <div class="col-9" id="campoProducto">
                            <input type="text" name="txtProductoNew" id="txtProductoNew" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="cbClienteNew" class="form-label">Cliente</label>
                        </div>
                        <div class="col-9">
                            <select name="cbClienteNew" id="cbClienteNew" class="form-select" aria-label="Default select example" required></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtCantidadNew" class="form-label">Cantidad</label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="txtCantidadNew" id="txtCantidadNew" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="txtObservacionNew" class="form-label">Observación</label>
                        </div>
                        <div class="col-9">
                            <textarea name="txtObservacionNew" id="txtObservacionNew" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="button" onclick="actualizarRegistroVenta()" class="btn btn-outline-success">Actualizar</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal delte -->
<div class="modal fade" id="modalDeleteVenta" tabindex="-1" aria-labelledby="modalDeleteVentaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-center" id="textDelete"></h4>
        <p class="text-center" id="subText"></p>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" onclick="eliminarRegistroVenta()" class="btn btn-outline-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "./footer.php" ?>
<script src="./assets/js/venta.js"></script>

</html>