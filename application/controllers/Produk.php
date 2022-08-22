<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'produk/index.html';
            $config['first_url'] = base_url() . 'produk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Produk_model->total_rows($q);
        $produk = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('produk/produk_list', $data);
        
		$this->template->load('template','produk/produk_list',$data);
    }

    public function read($id) 
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idProduk' => $row->idProduk,
		'idKategori' => $row->idKategori,
		'idMerek' => $row->idMerek,
		'namaProduk' => $row->namaProduk,
		'Harga' => $row->Harga,
		'Stock' => $row->Stock,
		'Foto' => $row->Foto,
		'Deskripsi' => $row->Deskripsi,
		'Status' => $row->Status,
	    );
            // $this->load->view('produk/produk_read', $data);
            $this->template->load('template','produk/produk_read',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
	    'idProduk' => set_value('idProduk'),
	    'idKategori' => set_value('idKategori'),
	    'idMerek' => set_value('idMerek'),
	    'namaProduk' => set_value('namaProduk'),
	    'Harga' => set_value('Harga'),
	    'Stock' => set_value('Stock'),
	    'Foto' => set_value('Foto'),
	    'Deskripsi' => set_value('Deskripsi'),
	    'Status' => set_value('Status'),
	);
        // $this->load->view('produk/produk_form', $data);
        $this->template->load('template','produk/produk_form',$data);

    }
    
    public function upload() 
    {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
 
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload('profile_pic')) 
        {
            $error = array('error' => $this->upload->display_errors());
 
            $this->load->view('imageupload_form', $error);
        } 
        else 
        {
            $data = array('image_metadata' => $this->upload->data());
 
            $this->load->view('imageupload_success', $data);
        }
    }

    public function create_action() 
    {
        // $this->_rules();
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 200000;
        $this->load->library('upload', $config);
        // var_dump($_POST);
        // var_dump($this->upload->do_upload('Foto')['file_name']);

 
 
        
        if (!$this->upload->do_upload('Foto')) 
        {
            $error = array('error' => $this->upload->display_errors());
            // var_dump($error);
            $foto = 'user.png';
            // $this->load->view('imageupload_form', $error);
        } 
        else 
        {
            $data = array('image_metadata' => $this->upload->data());
            // var_dump($data);
            $foto = $data['image_metadata']['file_name'];
            // var_dump($foto);
            // $this->load->view('imageupload_success', $data);
        }
        
        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
		'idKategori' => $this->input->post('idKategori',TRUE),
		'idMerek' => $this->input->post('idMerek',TRUE),
		'namaProduk' => $this->input->post('namaProduk',TRUE),
		'Harga' => $this->input->post('Harga',TRUE),
		'Stock' => $this->input->post('Stock',TRUE),
		'Foto' => $foto,
		'Deskripsi' => $this->input->post('Deskripsi',TRUE),
		'Status' => $this->input->post('Status',TRUE),
	    );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk'));
        // }
    }
    
    public function update($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
		'idProduk' => set_value('idProduk', $row->idProduk),
		'idKategori' => set_value('idKategori', $row->idKategori),
		'idMerek' => set_value('idMerek', $row->idMerek),
		'namaProduk' => set_value('namaProduk', $row->namaProduk),
		'Harga' => set_value('Harga', $row->Harga),
		'Stock' => set_value('Stock', $row->Stock),
		'Foto' => set_value('Foto', $row->Foto),
		'Deskripsi' => set_value('Deskripsi', $row->Deskripsi),
		'Status' => set_value('Status', $row->Status),
	    );
            $this->load->view('produk/produk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idProduk', TRUE));
        } else {
            $data = array(
		'idKategori' => $this->input->post('idKategori',TRUE),
		'idMerek' => $this->input->post('idMerek',TRUE),
		'namaProduk' => $this->input->post('namaProduk',TRUE),
		'Harga' => $this->input->post('Harga',TRUE),
		'Stock' => $this->input->post('Stock',TRUE),
		'Foto' => $this->input->post('Foto',TRUE),
		'Deskripsi' => $this->input->post('Deskripsi',TRUE),
		'Status' => $this->input->post('Status',TRUE),
	    );

            $this->Produk_model->update($this->input->post('idProduk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idKategori', 'idkategori', 'trim|required');
	$this->form_validation->set_rules('idMerek', 'idmerek', 'trim|required');
	$this->form_validation->set_rules('namaProduk', 'namaproduk', 'trim|required');
	$this->form_validation->set_rules('Harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('Stock', 'stock', 'trim|required');
	// $this->form_validation->set_rules('Foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('Deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('Status', 'status', 'trim|required');

	$this->form_validation->set_rules('idProduk', 'idProduk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "produk.xls";
        $judul = "produk";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "IdKategori");
	xlsWriteLabel($tablehead, $kolomhead++, "IdMerek");
	xlsWriteLabel($tablehead, $kolomhead++, "NamaProduk");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Stock");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Produk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idKategori);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idMerek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->namaProduk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->Stock);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Foto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Deskripsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=produk.doc");

        $data = array(
            'produk_data' => $this->Produk_model->get_all(),
            'start' => 0
        );
        
        // $this->load->view('produk/produk_doc',$data);
        $this->template->load('template','produk/produk_doc',$data);

    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-08-22 14:28:03 */
/* http://harviacode.com */