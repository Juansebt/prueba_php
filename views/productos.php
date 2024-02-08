<?php include_once "./header.php" ?>
<h1 class="text-center m-4">Productos</h1>
<div class="py-4 mx-5 card">
    <table class="table table-striped-columns table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Código</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Fecha de fabricación</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody id="tblProductos">
        </tbody>
    </table>
</div>
<!-- Modal -->
<div>
    <div class="modal fade" id="modalRecordVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRecordVentaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalRecordVentaLabel">Asignación de venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-2">
                <form id="frmVenta">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtProducto" class="form-label">Productos</label>
                        </div>
                        <div class="col-9" id="campoProducto">
                            <input type="text" name="txtProducto" id="txtProducto" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="cbCliente" class="form-label">Cliente</label>
                        </div>
                        <div class="col-9">
                            <select name="cbCliente" id="cbCliente" class="form-select" aria-label="Default select example">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="txtCantidad" class="form-label">Cantidad</label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="txtCantidad" id="txtCantidad" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="inputPassword5" class="form-label">Observación</label>
                        </div>
                        <div class="col-9">
                            <textarea name="txtObservacion" id="txtObservacion" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "./footer.php" ?>
<script src="./assets/js/producto.js"></script>

</html>