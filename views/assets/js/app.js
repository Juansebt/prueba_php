/**
 * Función para cargar el nombre del producto y guardar el id en el localStorage
 * @param id - id del producto
 */
async function modal(id) {
    let url = `./controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        document.getElementById("txtProductoI").value = response.data[0].nombreProducto;
        localStorage.idProductoSave = response.data[0].idProducto;
    }
}

/**
 * Función para listar los productos registrados,
 * se visualizan en cards (home)
 */
async function viewProductos() {
    let url = './controllers/producto/producto.read.php';

    const response = await axios.get(url);

    if (response.status === 200) {
        console.log(response.data);
        let card = "";

        if (response.data.length >= 1) {
            response.data.forEach((producto) => {
                card += `<div class="col-4 mt-5">
                    <div class="card" style="width: 18rem;">
                        <img src="${producto.imagenProducto}" class="card-img-top" alt="${producto.nombreProducto}" Style=" height: 286px; width: 286px;">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="font-size: 16px;">${producto.nombreProducto}</h5>
                            <p class="card-text" style="font-size: 12px;">Tipo: ${producto.nombreTipoProducto}</p>
                            <p class="card-text" style="font-size: 12px;">Precio: $${producto.precioProducto}</p>
                            <p class="card-text" style="font-size: 12px;">Fabricación: ${producto.fechaFabricacionProducto}</p>
                            <div class="d-grid gap-2">
                            <button type="button" onclick="modal(${producto.idProducto})" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalRecordVentaInicio" style="font-size: 14px; border-radius: 20px;">
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

/**
 * Función para obtener todos los clientes y mostrarlos en
 * la modal de registro de venta
 */
async function getClientesModal() {
    let url = './controllers/cliente/cliente.read.php';

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

        document.getElementById("cbClienteI").innerHTML = selectOptions;
    }
}

viewProductos()
getClientesModal()

/**
 * Función para obtener el precio del producto de acuerdo a su id
 * @param id - id del producto
 * @returns - int : precio del producto
 */
async function getPriceProducto(id) {
    let url = `./controllers/producto/producto.readid.php?idProducto=${id}`;

    const response = await axios.get(url);

    if (response.status === 200) {
        return response.data[0].precioProducto
    }
}

/**
 * Función para registrar las ventas (asignación de productos a clientes - home)
 * @returns - null
 */
async function registrarVentaI() {
    let url = './controllers/venta/venta.create.php';

    const idProducto = localStorage.getItem("idProductoSave");
    const idCliente = document.getElementById("cbClienteI").value;
    const cantidadProducto = document.getElementById("txtCantidadI").value;
    const observacionVenta = document.getElementById("txtObservacionI").value;

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
            location.href ="./views/ventas.php"
        }, 750);
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
 * Función para limpiar los campos del formulario de la modal - (home)
 */
function clearFormModal() {
    let formulario = document.getElementById("frmVentaI");

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