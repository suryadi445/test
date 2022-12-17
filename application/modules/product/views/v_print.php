<?php
$this->load->helper('app');
$data = $this->db->query("SELECT * from transaksi group by document_number")->result_array();

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Transaksi</th>
            <th scope="col">User</th>
            <th scope="col">Total</th>
            <th scope="col">Date</th>
            <th scope="col">Item</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $value) { ?>
        <tr>
            <th><?= $key + 1; ?></th>
            <td><?= $value['document_code'] . '-' . $value['document_number'] ?></td>
            <td><?= $value['user'] ?></td>
            <td><?= get_total($value['document_number']) ?></td>
            <td><?= date($value['created_at']) ?></td>
            <td>
                <?= get_product($value['document_number']) ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>