<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
    }

    public function index()
    {
        $data['title'] = 'Product';
        $data['content'] = 'v_product';
        $data['products'] = $this->db->get('products')->result_array();

        $this->load->view('base', $data);
    }

    public function add_cart()
    {
        $data['title'] = 'Product';
        $data['content'] = 'v_show';

        $id = $this->input->post('id');
        $data = $this->db->get_where('products', ['id' => $id])->row_array();

        $data = array(
            'id'      => $data['id'],
            'qty'     => 1,
            'price'   => $data['price'],
            'name'    => $data['nama_product'],
        );

        $this->cart->insert($data);
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('products', ['id' => $id])->row_array();

        echo json_encode($data);
    }

    public function add_save()
    {
        $cart = $this->cart->contents();

        $cek_transaksi = $this->db->query("SELECT * from transaksi order by id desc")->row_array();
        foreach ($cart as $key => $value) {
            $data = $this->db->get_where('products', ['id' => $value['id']])->row_array();

            if (count($cek_transaksi) > 0) {
                $document_number = str_pad($cek_transaksi['document_number'] + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $document_number = str_pad(1, 3, '0', STR_PAD_LEFT);
            }

            $transaksi = [
                'document_code' => 'TRX',
                'document_number' => $document_number,
                'product_code' => $data['code_product'],
                'price' => $value['price'],
                'qty' => $value['qty'],
                'unit' => $data['Unit'],
                'subtotal' => $value['subtotal'],
                'currency' => $data['Currency'],
                'user' => $this->session->userdata('username'),
            ];

            $insert = $this->db->insert('transaksi', $transaksi);
        }

        if ($insert) {
            echo json_encode(true);
            $this->cart->destroy();
        } else {
            echo json_encode(false);
        }
    }

    public function delete()
    {
        $this->session->sess_destroy();
    }
}