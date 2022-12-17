<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.steps@1.1.1/dist/jquery-steps.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery.steps@1.1.1/dist/jquery-steps.min.js"></script>

<div class="step-app" id="step">
    <ul class="step-steps">
        <li data-step-target="step1">Step 1</li>
        <li data-step-target="step2">Step 2</li>
        <li data-step-target="step3">Step 3</li>
    </ul>
    <div class="step-content">
        <div class="step-tab-panel" id="step1" data-step="step1">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h3 class="text-center">Halaman Product</h3>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php foreach ($products as $key => $product) : ?>
                    <div class="col-md-12">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/front/image/man.png') ?>" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="col-md-8">
                                            <a href="" class="btn_modal" data-id="<?= $product['id'] ?>">
                                                <h5 class="card-title"><?= $product['nama_product'] ?></h5>
                                            </a>

                                            <p><?= $product['Currency'] . ' ' . $product['price'] ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="<?= base_url('product/add_cart') ?>"
                                                data-id="<?= $product['id'] ?>" class="btn btn-info btn_buy">BUY</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="step-tab-panel" id="step2" data-step="step2">
            <?= $this->load->view('v_show') ?>
        </div>
        <div class="step-tab-panel" id="step3" data-step="step3">
            <?= $this->load->view('v_print') ?>
        </div>
    </div>
    <div class="step-footer">
        <button data-step-action="prev" class="step-btn">Previous</button>
        <button data-step-action="next" class="step-btn id_next">Next</button>
        <button data-step-action="finish" class="step-btn">Finish</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/front/image/man.png') ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <h2 id="merk"></h2>
                                <del>
                                    <h6 id="harga_asli"></h6>
                                </del>
                                <h6 id="harga_diskon"></h6>
                                <h6 id="dimensi"></h6>
                                <h6 id="satuan"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
$('#step').steps({
    onFinish: function() {
        alert('complete');
    }
});

$(document).ready(function() {
    $(document).on('click', '.btn_buy', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id')
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>product/add_cart",
            data: {
                id: id
            },
            success: function(response) {
                // console.log(response);
            }
        });

    });

    $('.id_next').click(function(e) {
        e.preventDefault();
        window.location.reload();

    });

    $(document).on('click', '.btn_modal', function(e) {
        e.preventDefault()
        id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>product/detail",
            data: {
                id: id
            },
            success: function(response) {
                var obj = $.parseJSON(response)
                let harga_diskon = obj.price * (obj.Discount / 100);

                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                // console.log(formatter.format(2500)); /* $2,500.00 */

                $('#merk').text(obj.nama_product)
                $('#harga_asli').text(formatter.format(obj.price))
                $('#harga_diskon').text(formatter.format(obj.price - harga_diskon))
                $('#dimensi').text(obj.Dimension)
                $('#satuan').text(obj.Unit)
            }
        });
        $('#modal_detail').modal('show');

    })
});
</script>