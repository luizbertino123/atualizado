    
<?php $this->load->view('restrita/layout/navbar'); ?>

<?php $this->load->view('restrita/layout/sidebar'); ?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-block">                            
                            <h4><?php echo $titulo; ?></h4>
                            <a class="bnt bnt-primary float-right" href="<?php echo base_url('restrita/usuarios/core'); ?>">Cadastrar</a>
                        </div>
                        <div class="card-body">

                            <?php if ($message = $this->session->flashdata('sucesso')): ?>

                                <div class="alert alert-sucess alert-dismissible show fade">
                                    <div class="alert-icon"><i class="far fa-check-circle fa-lg"></i></div>
                                    <div class="alert-body">
                                        <div class="alert-title">Perfeito!</div>
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?php echo $message; ?>
                                    </div>
                                </div>

                            <?php endif; ?>  

                            <?php if ($message = $this->session->flashdata('erro')): ?>

                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                    <div class="alert-body">
                                        <div class="alert-title">Atenção</div>
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        <?php echo $message; ?>
                                    </div>
                                </div>

                            <?php endif; ?>                                                   

                            <div class="table-responsive">
                                <table class="table table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nome completo</th>
                                            <th>E-mail</th>
                                            <th>Perfil acesso</th
                                            <th>Status</th>
                                            <th class="nosort">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <tr>                                          

                                                <td><?php echo $usuario->id; ?></td>
                                                <td><?php echo $usuario->first_name . '' . $usuario->last_name; ?></td>
                                                <td><?php echo $usuario->email; ?></td>  
                                                <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Cliente'); ?></td>
                                                <td><?php echo ($usuario->active == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>'); ?></td>

                                                <td>
                                                    <a href="<?php echo base_url('restrita/usuarios/core/' . $usuario->id); ?>" class="btn btn-icon btn-primary mr-2"><i class="far fa-edit"></i></a>
                                                    <a href="<?php echo base_url('restrita/usuarios/delete/' . $usuario->id); ?>" class="btn btn-icon btn-danger delete" data-confirm="Tem certeza da exclusão?"><i class="fas fa-times"></i></a>
                                                <td>                                                  


                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>

</div>

