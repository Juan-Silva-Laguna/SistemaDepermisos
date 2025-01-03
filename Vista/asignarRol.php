<?php include('header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                
                <div class="card card-signin my-5">
                    <div class="text-center">
                        <br>
                        <h3>Asiganar Roles a Usuarios</h3>
                    </div>                   
                    <div class="card-body">
                        <form class="form-signin row"  autocomplete="off">
                            <input type="hidden" id="idRolUser">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <label class="font-weight-bold">Usuarios</label>
                                    <input type="text" class="form-control text-center" placeholder="Seleccione un usuario" autofocus id="usuario" list="usuarios">
                                    <datalist id="usuarios">
                                    </datalist>
                                    <br>  
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <label class="font-weight-bold">Roles</label>
                                    <input type="text" class="form-control text-center" placeholder="Seleccione un Rol" id="rol" list="roles">
                                    <datalist id="roles">
                                    </datalist>
                                    <br> 
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnGuardar" type="submit">Asiganar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-info btn-block text-uppercase" id="btnActualizar" type="submit">Modificar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-danger btn-block text-uppercase" id="btnEliminar" type="submit">Quitar</button><br>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnBuscar" type="submit">Filtrar</button><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">                
                <div class="card card-signin">                
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Usuario</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpoTabla">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <?php include('footer.php'); ?>
    <script src="Ajax/roluser.js"></script>
