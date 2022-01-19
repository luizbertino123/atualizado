<?php

defined('BASEPATH') OR exit('ação não permitida');

class Categorias extends CI_Controller {

    public function _construct() {
        parent::_construct();

        if (!$this->ion_auth->logged_in()) {

            redirect('restrita/login');
        }
    }

    public function index() {


        $data = array(
            'titulo' => 'Categorias cadastradas',
            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js'
            ),
            'categorias' => $this->core_model->get_all('categorias'),
        );

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/categorias/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_id = NULL) {

        $categoria_id = (int) $categoria_id;

        if (!$categoria_id) {

            //Cadastrar

            $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                    'categoria_nome',
                    'categoria_ativa',
                        ), $this->input->post()
                );

                //Definindo o metalink
                $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

                $data = html_escape($data);

                $this->core_model->insert('categorias', $data);
                redirect('restrita/categorias');
            } else {

                //Erro de validação 

                $data = array(
                    'titulo' => 'Cadastrar categoria',
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/categorias/core');
                $this->load->view('restrita/layout/footer');
            }
        } else {

            if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {

                $this->session->set_flashdata('erro', 'Essa categoria não foi encontrada');
                redirect('restrita/categorias');
            } else {

                //Editando...

                $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');

                if ($this->form_validation->run()) {


                    if ($this->input->post('categoria_ativa') == 0) {

                        $data = elements(
                                array(
                            'categoria_nome',
                            'categoria_ativa',
                            'categoria_pai_id',
                                ), $this->input->post()
                        );


                        //Definindo o metalink
                        $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

                        $data = html_escape($data);

                        $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
                        redirect('restrita/categorias');
                    } else {

                        //Erro de validação 

                        $data = array(
                            'titulo' => 'Editar categoria',
                            'categoria' => $categoria,
                            'master' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
                        );

                        //echo '<pre>';
                        //print_r($data['categoria']);
                        //exit();

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/categorias/core');
                        $this->load->view('restrita/layout/footer');
                    }
                }
            }
        }
    }
}    