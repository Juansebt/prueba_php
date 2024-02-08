<div class="container d-flex justify-content-center">
    <div class="row" id="cardProduct">
    </div>
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
<?php include_once "./views/footer.php" ?>
<script>
    async function modalUpdate(id) {
        let url = `./controllers/producto/producto.readid.php?idProducto=${id}`;

        const response = await axios.get(url);

        if (response.status === 200) {
            // console.log(response.data);
            document.getElementById("txtProducto").value = response.data[0].nombreProducto;
            localStorage.idProductoSave = response.data[0].idProducto;
        }
    }

    async function viewProductos() {
        let url = './controllers/producto/producto.read.php';

        const response = await axios.get(url);

        if (response.status === 200) {
            console.log(response.data);
            let card = "";

            if (response.data.length >= 1) {
                response.data.forEach((producto) => {
                    // Ajustar el tamaño de las imagenes
                    card += `<div class="col-4 mt-5">
                        <div class="card" style="width: 18rem;">
                            <img src="${producto.imagenProducto}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">${producto.nombreProducto}</h5>
                                <p class="card-text">Tipo: ${producto.nombreTipoProducto}</p>
                                <p class="card-text">Precio: $${producto.precioProducto}</p>
                                <p class="card-text">Fabricación: ${producto.fechaFabricacionProducto}</p>
                                <div class="d-grid gap-2">
                                <button type="button" onclick="modalUpdate(${producto.idProducto})" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalRecordVenta" style="font-size: 14px; border-radius: 20px;">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>`
                });
            } else {
                card += `<td colspan="8" class="pt-4">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div class="mx-2">
                            No hay registro de productos!
                        </div>
                    </div>
                </td>`
            }
            
            document.getElementById("cardProduct").innerHTML = card;
        }
    }

    async function getClientesModal() {
        let url = './controllers/cliente/cliente.read.php';

        const response = await axios.get(url);

        if (response.status === 200) {
            // console.log(response.data);
            let selectOptions = "";

            if (response.data.length >= 1) {
                selectOptions += `<option selected disabled>Selecciona un cliente...</option>`
                response.data.forEach((cliente) => {
                    selectOptions += `<option value="${cliente.idCliente}">${cliente.nombreCliente}</option>`
                });
            } else {
                selectOptions += `<option selected disabled>No hay clientes registrados</option>`
            }

            document.getElementById("cbCliente").innerHTML = selectOptions;
        }
    }

    viewProductos()
    getClientesModal()
</script>

</html>