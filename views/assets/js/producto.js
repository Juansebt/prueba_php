/**
 * Función para cargar el nombre del producto y guardar el id en el localStorage
 * @param id - id del producto
 */
async function modal(id) {
    let url = `../controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        document.getElementById("txtProducto").value = response.data[0].nombreProducto;
        localStorage.idProductoSave = response.data[0].idProducto;
    }
}

/**
 * Función para listar los productos registrados,
 * se visualizan en una tabla
 */
async function listProductos() {
    let url = '../controllers/producto/producto.read.php';

    const response = await axios.get(url);

    if (response.status === 200) {
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
                        <button type="button" onclick="modal(${producto.idProducto})" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalRecordVenta" style="font-size: 14px; border-radius: 20px;">
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

/**
 * Función para obtener todos los clientes y mostrarlos en
 * la modal de registro de venta
 */
async function getClientesModal() {
    let url = '../controllers/cliente/cliente.read.php';

    const response = await axios.get(url);

    if (response.status === 200) {
        let selectOptions = "";

        if (response.data.length >= 1) {
            selectOptions += `<option value="" selected disabled>Selecciona un cliente...</option>`
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

/**
 * Función para obtener el precio del producto de acuerdo a su id
 * @param id - id del producto
 * @returns 
 */
async function getPriceProducto(id) {
    let url = `../controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        return response.data[0].precioProducto
    }
}

/**
 * Función para registrar las ventas (asignación de productos a clientes)
 * @returns - null
 */
async function registrarVenta() {
    let url = '../controllers/venta/venta.create.php';

    const idProducto = localStorage.getItem("idProductoSave");
    const idCliente = document.getElementById("cbCliente").value;
    const cantidadProducto = document.getElementById("txtCantidad").value;
    const observacionVenta = document.getElementById("txtObservacion").value;

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

    let data = `producto=${idProducto}&cliente=${idCliente}&cantidadProducto=${cantidadProducto}&totalVenta=${totalVenta}&observacionVenta=${observacionVenta}`;
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
        clearFormModal();
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
 * Función para limpiar los campos del formulario de la modal
 */
function clearFormModal() {
    let formulario = document.getElementById("frmVenta");

    for (let i = 0; i < formulario.elements.length; i++) {
        let elemento = formulario.elements[i];

        if (elemento.type === "text" || elemento.type === 'number') {
            elemento.value = ""; 
        } else if (elemento.tagName === "SELECT") {
            elemento.selectedIndex = 0;
        } else if (elemento.tagName === "TEXTAREA") {
            elemento.value = "";
        }
    }
}