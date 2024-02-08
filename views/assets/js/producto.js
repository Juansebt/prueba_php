async function modalUpdate(id) {
    let url = `../controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        // console.log(response.data);
        document.getElementById("txtProducto").value = response.data[0].nombreProducto;
        localStorage.idProductoSave = response.data[0].idProducto;
    }
}

async function listProductos() {
    let url = '../controllers/producto/producto.read.php';

    const response = await axios.get(url);

    if (response.status === 200) {
        console.log(response.data);
        let tabla = "";

        if (response.data.length >= 1) {
            response.data.forEach((producto, index) => {
                tabla += `<tr>
                    <th class="text-center">${index + 1}</th>
                    <td class="text-center">${producto.nombreProducto}</td>
                    <td class="text-center">${producto.codigoProducto}</td>
                    <td class="text-center">$${producto.precioProducto.toLocaleString('es-CO')}</td>
                    <td class="text-center">${producto.nombreTipoProducto}</td>
                    <td class="text-center">${producto.fechaFabricacionProducto}</td>
                    <td class="text-center">
                        <button type="button" onclick="modalUpdate(${producto.idProducto})" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalRecordVenta" style="font-size: 14px; border-radius: 20px;">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </td>
                </tr>`
            });
        } else {
            tabla += `<td colspan="8" class="pt-4">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="mx-2">
                        No hay registro de productos!
                    </div>
                </div>
            </td>`
        }
        
        document.getElementById("tblProductos").innerHTML = tabla;
    }
}

async function getClientesModal() {
    let url = '../controllers/cliente/cliente.read.php';

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

listProductos();
getClientesModal();

// Finalizar
async function registrarVenta() {
    const nombreProducto = document.getElementById("txtProducto").value;
    const nombreCliente = document.getElementById("cbCliente").value;
    const cantidadProducto = document.getElementById("txtCantidad").value;
    const observacionVenta = document.getElementById("txtObservacion").value;
}