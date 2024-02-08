async function listVentas() {
    let url = '../controllers/venta/venta.record.php';

    const response = await axios.get(url);

    if (response.status === 200) {
        // console.log(response.data);

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
                    <td class="text-center">${venta.totalVenta.toLocaleString('es-CO')}</td>
                    <td class="text-center">${venta.observacionVenta}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-outline-warning" style="font-size: 12px; border-radius: 20px">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger" style="font-size: 12px; border-radius: 20px">
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