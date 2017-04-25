<div id="page-wrapper">
 <div class="container-fluid">
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Departamentos
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Inicio</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Departamentos
                            </li>
                        </ol>
                    </div>
                </div>
   <div class="row">
      <div class="col-md-2">
        <a href="#" class='btn btn-success' data-toggle='modal' data-target='#myModalproveedor'>Agregar Departamentos</a>

      </div>
   
          <div class="col-md-3 col-md-offset-4">
    <select name="buscando" id ="buscando" class="form-control" >
        <option value="cod_depto">Codigo Departamento</option>
        <option value="nombre_depto">Nombre Departamento</option>
       
        </select>

      </div>
      <div class="col-md-3 ">
        <div class="form-group has-feedback has-feedback-left">

            <input type="text" class="form-control" name="busqueda" placeholder="Buscar algo" />
            <i class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
        
      </div>
      
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4>Lista de Departamentos</h4>
          </div>
          <div id="tbproveedor" class="panel-body table-responsive">
            
            <p>
              <strong>Mostrar por : </strong>
              <select name="cantidad" id="cantidad">
                <option value="10">10</option>
                <option value="20">20</option>
              </select>
            </p>
            <table id="tbclientes" name="tbclientes" class="table table-striped  table-hover ">
              <thead>
                <tr class="success">
                  <th>Codigos Departamentos</th>
                  <th>Nombres Departamentos</th>
                   <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="text-center paginacion ">
              
            </div>
          </div>
        </div>
      </div>
    </div>




     <!-- modal empieza aca -->
   <!-- Modal -->
<div class="modal fade" id="myModalproveedor" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  Ingresar proveedor
                </h4>
            </div>
            <div class="alert alert-danger" id="msg-error" style="text-align:left;">
                  <strong>¡Importante!</strong> Corregir los siguientes errores.
                  <div class="list-errors"></div>
              </div>
            <!-- Modal Body -->
            <div class="modal-body" >
                
                      <form  id="departamentoGuardar" role="form" action= "<?= base_url()?>control_proveedor/guardar " method="POST" >
                         <br>
                         <br>
                            <div class="form-group">
                               <label>Codigo Departamento</label>
                                <input class="form-control" id="codigo" name="codigo" placeholder="Ingrese Codigo depto " onblur="validarCodigo();" maxlength="10" >
                                  <p class="text-errors" id="msgerrorut"></p>
                            </div>

                            <div class="form-group">
                                <label>Nombre Departamento</label>
                            <input class="form-control" id="nombre" name="nombre"  placeholder="Ingrese Nombre" onkeypress="" ">
                            </div>
            <div class="modal-footer">
                <button type="button" id="cerrando" name="cerrando" class="btn btn-lg  btn-danger"
                        data-dismiss="modal">
                            Cerrar
                </button>
                <button type="submit" id="cerrarmodal" name="cerrarmodal" class="btn btn-lg  btn-success" >
                    Guardar
                </button>
            </div>
                        </form>

                
            </div>
            
        </div>
    </div>
</div>



<div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  Editar usuario
                </h4>
            </div>
             <div class="alert alert-danger" id="msg-error2" style="text-align:left;">
                  <strong>¡Importante!</strong> Corregir los siguientes errores.
                  <div class="list-errors"></div>
              </div>
            <!-- Modal Body -->
            <div class="modal-body" >
                
                      <form  id="usuarioEditar" role="form" action= "<?= base_url()?>man_usuarios/actualizar" method="POST" >
                         <br>
                         <br>
                            <div class="form-group">
                               <label>Rut</label>
                                <input class="form-control" id="selecrut" name="selecrut" placeholder="Ingrese Rut  Ejemplo 11111111-1" readonly  >
                            </div>

                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" id="selecnombre" name="selecnombre"  placeholder="Ingrese Nombre" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="form-group">
                                <label>Razon Social</label>
                             <input class="form-control" id="selecrazon" name="selecrazon"  placeholder="Ingrese su razon social">
                            </div>

                             <div class="form-group">
                                <label>Direccion</label>
                             <input  class="form-control" id="selecdireccion" name="selecdireccion"  placeholder="Ingrese su direccion" ">
                            </div>

                            <div class="form-group">
                            <label>Telefono</label>
                             <input class="form-control" id="selectelefono" name="selectelefono"  placeholder="Ingrese su telefono">
                            </div>

                            <div class="form-group">
                            <label>Correo</label>
                             <input class="form-control" id="seleccorreo" name="seleccorreo"  placeholder="Ingrese su correo">
                            </div>
                           
            <div class="modal-footer">
                <button type="button" class="btn btn-lg  btn-danger"
                        data-dismiss="modal">
                            Cerrar
                </button>
                <button type="submit" id="actualizaron" name="atualizaron" class="btn btn-lg  btn-success" >
                    Actualizar
                </button>
            </div>
                        </form>

                
            </div>
            
        </div>
    </div>
</div>