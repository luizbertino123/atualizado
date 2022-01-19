    
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
                            <a class="bnt bnt-primary float-right" href="<?php echo base_url('restrita/categorias/core'); ?>">Cadastrar</a>
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
                                            <th>Nome da categoria</th>
                                            <th>Meta link da categoria</th>
                                            <th>Data de criação</th>                                            
                                            <th>Ativa</th
                                            <th>Status</th>
                                            <th class="nosort">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <tr>                                          

                                                <td><?php echo $categoria->categoria_id; ?></td>
                                                <td><?php echo $categoria->categoria_nome; ?></td>
                                                <td><i data-feather="link-2" class="text-info"></i>&nbsp;<?php echo $categoria->categoria_meta_link; ?></td>  
                                                <td><?php echo formata_data_banco_com_hora($categoria->categoria_data_criacao); ?></td>
                                                <td><?php echo ($categoria->categoria_ativa == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>'); ?></td>

                                                <td>
                                                    <a href="<?php echo base_url('restrita/categorias/core/' . $categoria->categoria_id); ?>" class="btn btn-icon btn-primary mr-2"><i class="far fa-edit"></i></a>
                                                    <a href="<?php echo base_url('restrita/categorias/delete/' . $categoria->categoria_id); ?>" class="btn btn-icon btn-danger delete" data-confirm="Tem certeza da exclusão da categoria?"><i class="fas fa-times"></i></a>
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

