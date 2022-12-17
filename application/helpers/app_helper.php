<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_product')) {
    function get_product($code_product)
    {
        $ci = &get_instance();

        $data = $ci->db->query("SELECT a.*, b.nama_product from transaksi a inner join products b on a.product_code = b.code_product where a.document_number = '$code_product'")->result_array();

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '- ' . $value['nama_product'] . ' (' . $value['qty'] . ' ' . $value['unit'] . ')' . '<br>';
        }

        return $result;
    }
}

if (!function_exists('get_total')) {
    function get_total($code_product)
    {
        $ci = &get_instance();

        $data = $ci->db->query("SELECT * from transaksi where document_number = '$code_product'")->result_array();

        $result = 0;
        foreach ($data as $key => $value) {
            $result += $value['subtotal'];
        }

        return 'Rp. ' . number_format($result);
    }
}