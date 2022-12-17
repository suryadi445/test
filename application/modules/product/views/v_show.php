<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

    <tr>
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
    </tr>

    <?php $i = 1; ?>

    <?php if (!empty($this->cart->contents())) { ?>
    <?php foreach ($this->cart->contents() as $items) : ?>

    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>

    <tr>
        <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
        </td>
        <td>
            <?php echo $items['name']; ?>

            <?php if ($this->cart->has_options($items['rowid']) == TRUE) : ?>

            <p>
                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) : ?>

                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                <?php endforeach; ?>
            </p>

            <?php endif; ?>

        </td>
        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
    </tr>

    <?php $i++; ?>

    <?php endforeach; ?>
    <?php } else { ?>

    <div class="alert alert-warning" role="alert">
        Keranjang Belanja Anda Masih Kosong
    </div>

    <?php } ?>

    <tr>
        <td class="right"><strong>Total</strong></td>
        <td colspan="2"> </td>
        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
    </tr>

</table>
<?php if (!empty($this->cart->contents())) { ?>
<div class="row justify-content-center">
    <a href="<?= base_url() ?>confirm_payment" class="col-md-2 btn btn-info btn_confirm">Confirm</a>
</div>
<?php } ?>


<script>
$(document).ready(function() {
    $(document).on('click', '.btn_confirm', function(e) {
        e.preventDefault()
        let link = $(this).attr('href')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>product/add_save",
                    success: function(response) {
                        if (response == 'true') {
                            Swal.fire(
                                'Success',
                                'Daftar belanja anda berhasil dibuat',
                                'success'
                            )

                            window.setTimeout(function() {
                                window.location.reload();
                            }, 10000);

                        } else {
                            Swal.fire(
                                'Gagal',
                                'Daftar belanja anda gagal dibuat',
                                'warning'
                            )
                        }
                    }
                });
            }
        })
    })
})
</script>