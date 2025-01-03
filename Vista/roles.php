<?php include('header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                
                <div class="card card-signin my-5">
                    <div class="text-center">
                        <br>
                        <h3>Roles</h3>
                    </div>                    
                    <div class="card-body">
                        <form class="form-signin row">
                            <input type="hidden" id="idRol">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <label class="font-weight-bold">Nombre del Rol</label>
                                    <input type="text" class="form-control text-center" id="rol" autofocus><br> 
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnGuardar" type="submit">Guardar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" id="btnActualizar" type="submit">Actualizar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnBuscar" type="submit">Consultar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-danger btn-block text-uppercase" id="btnEliminar" type="submit">Eliminar</button><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="card card-signin">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rol</th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container -->
    <?php include('footer.php'); ?>
    <script src="Ajax/roles.js"></script>
