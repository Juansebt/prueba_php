<div class="container d-flex justify-content-center">
    <div class="row" id="cardProduct">
    </div>
</div>
<!-- Modal -->
<div>
    <div class="modal fade" id="modalRecordVentaInicio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRecordVentaInicioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalRecordVentaInicioLabel">Asignación de venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-2">
                <form id="frmVentaI" class="was-validated">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtProductoI" class="form-label">Producto</label>
                        </div>
                        <div class="col-9" id="campoProducto">
                            <input type="text" name="txtProductoI" id="txtProductoI" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="cbClienteI" class="form-label">Cliente</label>
                        </div>
                        <div class="col-9">
                            <select name="cbClienteI" id="cbClienteI" class="form-select" aria-label="Default select example" required></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtCantidadI" class="form-label">Cantidad</label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="txtCantidadI" id="txtCantidadI" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="txtObservacionI" class="form-label">Observación</label>
                        </div>
                        <div class="col-9">
                            <textarea name="txtObservacionI" id="txtObservacionI" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="button" onclick="registrarVentaI()" class="btn btn-outline-primary">Guardar</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "./views/footer.php" ?>
<script src="./views/assets/js/app.js"></script>

</html>