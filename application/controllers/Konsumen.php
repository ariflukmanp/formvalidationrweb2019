<?php
class Konsumen extends CI_Controller{
	function __construct(){
        parent::__construct();
        $this->load->model('m_matakuliah');
        $this->load->model('m_konsumen');
        $this->load->library('form_validation');
        $this->load->library('excel');
	}
	function index(){
        $data['konsumen'] = $this->m_konsumen->tampil_konsumen();
        $this->load->view("konsumen/v_tampil_konsumen", $data);
    }

    function tambah_barang(){
        $this->load->view('konsumen/v_tambah_barang');
    }

    function simpan_barang(){
        $this->form_validation->set_rules('xnama', 'Nama Barang', 'required|xss_clean|alpha');
        if($this->form_validation->run() != false){
            $nama = $this->input->post('xnama');
            $harga = $this->input->post('xharga');
            $jumlah = $this->input->post('xjumlah');
            $this->m_konsumen->simpan_barang($nama, $harga, $jumlah);
            redirect('konsumen');
        }else{
            echo "gagal";
        }

    }

    function edit_barang($idbarang){
        $data['barang'] = $this->m_konsumen->edit_barang($idbarang);
        $this->load->view('konsumen/v_edit_barang', $data);
    }

    function update_barang(){
        $nama = $this->input->post('xnama');
        $harga = $this->input->post('xharga');
        $jumlah = $this->input->post('xjumlah');
        $id = $this->input->post('xid');
        $this->m_konsumen->update_barang($nama, $harga, $jumlah, $id);
        redirect('konsumen');
    }

    function hapus_barang($id){
        $this->m_konsumen->hapus_barang($id);
        redirect('konsumen');
    }
    
}