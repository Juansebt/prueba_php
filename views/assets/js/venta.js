var id; //variable global para guardar el el id de la venta

/**
 * Función para obtener los clientes registrados
 * seleccionar el cliente que tiene registro de dicha venta y seleccionarlo
 * @param id - id del cliente
 */
async function getClienteVenta(id) {
    let url = `../controllers/cliente/cliente.read.php`;

    const response = await axios.get(url);

    if (response.status === 200) {
        let selectOptions = "";

        if (response.data.length >= 1) {
            response.data.forEach((cliente) => {
                if (cliente.idCliente === id) {
                    selectOptions += `<option value="${cliente.idCliente}" selected>${cliente.nombreCliente}</option>`
                } else {
                    selectOptions += `<option value="${cliente.idCliente}">${cliente.nombreCliente}</option>`
                }
            });
        } else {
            selectOptions += `<option selected disabled>No hay clientes registrados</option>`
        }

        document.getElementById("cbClienteNew").innerHTML = selectOptions;
    }
}

/**
 * Función para consultar los datos de una venta de acuerdo a su id
 * para luego mostrarlos en los inputs de la modal,
 * se guarda en el localStorage el id de la venta y el id del producto
 * @param id - id de la venta
 */
async function modalUpdate(id) {
    let url = `../controllers/venta/venta.readid.php?idVenta=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        document.getElementById("txtProductoNew").value = response.data[0].nombreProducto;
        document.getElementById("txtCantidadNew").value = response.data[0].cantidadProductoVenta;
        document.getElementById("txtObservacionNew").value = response.data[0].observacionVenta;

        localStorage.idVentaSave = response.data[0].idVenta;
        localStorage.idProductoSave = response.data[0].idProducto;

        await getClienteVenta(response.data[0].idCliente);
    }
}

/**
 * Función para guardar el id de la venta de manera global
 * y mostrar los textos de la ventana modal para eliminar el registro de la venta
 * @param id - id de la venta
 */
function modalDelete(id) {
    this.id = id;
    document.getElementById("textDelete").innerHTML = '¿Estas seguro de eliminar este registro?'
    document.getElementById("subText").innerHTML = '¡Esta acción es irreversible!'
}

/**
 * Función para listar y mostrar en una tabla los registros de las ventas
 */
async function listVentas() {
    let url = '../controllers/venta/venta.record.php';

    const response = await axios.get(url);

    if (response.status === 200) {

        let tabla = "";

        if (response.data.length >= 1) {
            response.data.forEach((venta, index) => {
                tabla += `<tr>
                    <th class="text-center">${index + 1}</th>
                    <td class="text-center">${venta.codigoProducto}</td>
                    <td class="text-center">${venta.nombreProducto}</td>
                    <td class="text-center">${venta.nombreTipoProducto}</td>
                    <td class="text-center">${venta.nombreFabrica}</td>
                    <td class="text-center">${venta.nombreCliente}</td>
                    <td class="text-center">$${venta.totalVenta.toLocaleString('es-CO')}</td>
                    <td class="text-center">${venta.observacionVenta}</td>
                    <td class="text-center">
                        <a href="#" onclick="modalUpdate(${venta.idVenta})" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditVenta" style="font-size: 12px; border-radius: 20px">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" onclick="modalDelete(${venta.idVenta})" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteVenta" style="font-size: 12px; border-radius: 20px">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>`
            });
        } else {
            tabla += `<td colspan="9" class="pt-4">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="mx-2">
                        No hay registro de ventas!
                    </div>
                </div>
            </td>`
        }
        
        document.getElementById("tblVentas").innerHTML = tabla;
    }
}

listVentas();

/**
 * Función para consultar el precio de un producto de acuerdo a su id
 * @param id - id del producto
 * @returns - precio del producto
 */
async function getPriceProducto(id) {
    let url = `../controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        return response.data[0].precioProducto
    }
}

/**
 * Función para actualizar el registro de una venta
 * @returns - null
 */
async function actualizarRegistroVenta() {
    let url = `../controllers/venta/venta.update.php`

    const idProducto = localStorage.getItem("idProductoSave");
    const idVenta = localStorage.getItem("idVentaSave");

    const idCliente = document.getElementById("cbClienteNew").value;
    const cantidadProducto = document.getElementById("txtCantidadNew").value;
    const observacionVenta = document.getElementById("txtObservacionNew").value;

    if (!idCliente) {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.error('Se requiere que seleccione un cliente.', 'Error!');
        return
    }

    if (!cantidadProducto) {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        }
        toastr.error('Se requiere que ingrese la cantidad de productos.', 'Error!');
        return
    }

    const precioProducto = await getPriceProducto(idProducto);
    const totalVenta = cantidadProducto * precioProducto

    let data = `producto=${idProducto}&cliente=${idCliente}&cantidad=${cantidadProducto}&totalVenta=${totalVenta}&observacionVenta=${observacionVenta}&idVenta=${idVenta}`;
    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    };

    axios.post(url, data, options)
    .then((response) => {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        };
        toastr.info(response.data, 'Great!');
        setTimeout(() => {
            location.href ="./ventas.php"
        }, 800);
    })
    .catch((error) => {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        };
        toastr.error(error, 'Error!');
    });
}

/**
 * Función para eliminar el registro de una venta
 */
async function eliminarRegistroVenta() {
    let url = `../controllers/venta/venta.delete.php?idVenta=${this.id}`

    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    };

    axios.delete(url, options)
    .then((response) => {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        };
        toastr.info(response.data, 'Great!');
        setTimeout(() => {
            location.href ="./ventas.php"
        }, 500);
    })
    .catch((error) => {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
        };
        toastr.error(error, 'Error!');
    });

}