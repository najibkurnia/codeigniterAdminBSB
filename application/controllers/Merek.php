<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Merek extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Merek_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'merek/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'merek/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'merek/index.html';
            $config['first_url'] = base_url() . 'merek/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Merek_model->total_rows($q);
        $merek = $this->Merek_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'merek_data' => $merek,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('merek/merek_list', $data);
        $this->template->load('template','merek/merek_list',$data);

    }

    public function read($id) 
    {
        $row = $this->Merek_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idMerek' => $row->idMerek,
		'namaMerek' => $row->namaMerek,
	    );
            $this->load->view('merek/merek_read', $data);
            $this->template->load('template','merek/merek_form',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('merek'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('merek/create_action'),
	    'idMerek' => set_value('idMerek'),
	    'namaMerek' => set_value('namaMerek'),
	);
        // $this->load->view('merek/merek_form', $data);
           $this->template->load('template','merek/merek_form',$data);

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'namaMerek' => $this->input->post('namaMerek',TRUE),
	    );

            $this->Merek_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('merek'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Merek_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('merek/update_action'),
		'idMerek' => set_value('idMerek', $row->idMerek),
		'namaMerek' => set_value('namaMerek', $row->namaMerek),
	    );
            // $this->load->view('merek/merek_form', $data);
            $this->template->load('template','merek/merek_form',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('merek'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idMerek', TRUE));
        } else {
            $data = array(
		'namaMerek' => $this->input->post('namaMerek',TRUE),
	    );

            $this->Merek_model->update($this->input->post('idMerek', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('merek'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Merek_model->get_by_id($id);

        if ($row) {
            $this->Merek_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('merek'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('merek'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('namaMerek', 'namamerek', 'trim|required');

	$this->form_validation->set_rules('idMerek', 'idMerek', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "merek.xls";
        $judul = "merek";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NamaMerek");

	foreach ($this->Merek_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->namaMerek);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=merek.doc");

        $data = array(
            'merek_data' => $this->Merek_model->get_all(),
            'start' => 0
        );
        
        // $this->load->view('merek/merek_doc',$data);
        $this->template->load('template','merek/merek_doc',$data);
    }

}

/* End of file Merek.php */
/* Location: ./application/controllers/Merek.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-08-22 14:28:02 */
/* http://harviacode.com */