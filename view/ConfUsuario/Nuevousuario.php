



<div id="modalusunuevo" class="modal fade bd-example-modal-lg"
					 tabindex="-1"
					 role="dialog"
					 aria-labelledby="myLargeModalLabel"
					 aria-hidden="true">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
									<i class="font-icon-close-2"></i>
								</button>
								<h4 class="modal-title" id="mdtitulo"></h4>
							</div>

                            <form method="post" id="form_usuario">
							<div class="modal-body">
                                    <input type="hidden" id="idusuario" name="id_usuario">

                                    <div class="form-group">
                                        <label class="form-label" for="nombre_usuario">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"placeholder="Ingrese Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="apellido_usuario">Apellido</label>
                                        <input type="text" class="form-control" id="apellido_usuario" name="apellido_usuario" placeholder="Ingrese Apellido" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="usuario_correo">Correo Login</label>
                                        <input type="email" class="form-control" id="usuario_correo" name="usuario_correo" placeholder="Ingrese correo para el Login" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="usuario_password">Password</label>
                                        <input type="password" class="form-control" id="usuario_password" name="usuario_password" placeholder="Ingrese Password" required>
                                    </div>
                                    <label class="form-label" for="id_rol" name="rol_usuario" required>Rol Usuario</label>
                                    <select class="select2" id="rol_usuario" name="id_rol">                                    
                                        <option value="1">Usuario</option>
                                        <option value="2">Soporte</option>
                                        <option value="3">Administrador</option>
                                        <option value="4">Alimentación</option>
                                     </select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
								<button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar Usuario</button>
							</div>
                            </form>
						</div>
					</div>
				</div>

