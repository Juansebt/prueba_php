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
<?php include_once "./footer.php" ?>
<script src="./assets/js/venta.js"></script>

</html>