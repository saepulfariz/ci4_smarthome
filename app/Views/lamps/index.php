<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container" style="margin-top: 120px;">
    <div class="row">
        <?php foreach ($lamps as $lamp) : ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm rounded-2">
                    <div class="card-header <?= ($lamp['status'] == 1 ? 'bg-success' : 'bg-danger'); ?> text-white" id="headerlamp-<?= $lamp['id']; ?>">
                        <h5 class="mb-0 text-uppercase"><?= $lamp['name']; ?></h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?= base_url(); ?><?= ($lamp['status'] == 1 ? 'images/on.png' : 'images/off.png'); ?>" class="mt-3" width="80" id="lamp-<?= $lamp['id']; ?>">
                        <div class="mt-4">
                            <div class="form-check form-switch">
                                <input onclick="updateLamp(this)" class="form-check-input status-<?= $lamp['id']; ?>" type="checkbox" role="switch" id="<?= $lamp['id']; ?>" <?= ($lamp['status'] == 1 ? 'checked' : 'bg-danger'); ?>>
                                <label class="form-check-label ms-3 mt-1" for="<?= $lamp['id']; ?>">
                                    <h4>
                                        <span class="@if ($lamp->status == 1) text-success @else text-danger @endif" id="lampStatus-<?= $lamp['id']; ?>">
                                            <?= ($lamp['status'] == 1 ? 'ON' : 'OFF'); ?>
                                        </span>
                                    </h4>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center bg-body-tertiary justify-content-center border-0 shadow-sm rounded-2 d-none" id="loader-<?= $lamp['id']; ?>">
                        <div class="spinner-border" role="status" style="width: 3rem; height: 3rem;">
                        </div>
                        <div class="mt-2">
                            <strong>Mohon Tunggu...</strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    function updateLamp(payload) {

        //define token
        let token = $("meta[name='csrf-token']").attr("content");

        //show loading
        $(`#loader-${payload.id}`).removeClass('d-none');
        $.ajax({
            type: "POST",
            dataType: 'json', // json
            url: `/lamps/${payload.id}`,
            data: {
                // "_token": token,
                "<?= csrf_token(); ?>": token,
            },
            success: function(response) {

                setTimeout(function() {
                    console.log(response.data.status);

                    //show success message
                    toastr.success(response.message, 'BERHASIL!');
                    var id = response.data.id;

                    if (response.data.status == 1) {
                        // $(`#lamp-${response.data.id}`).attr('src', `images/on.png`);
                        $(`#lamp-` + id).attr('src', `<?= base_url(); ?>images/on.png`);
                        $(`#headerlamp-` + id).removeClass('bg-danger').addClass(
                            'bg-success');
                        $(`#lampStatus-` + id).text('ON').addClass('text-success')
                            .removeClass('text-danger');
                        $(`.status-` + id).val(0);
                    } else {
                        $(`#lamp-` + id).attr('src', `<?= base_url(); ?>images/off.png`);
                        $(`#headerlamp-` + id).removeClass('bg-success').addClass(
                            'bg-danger');
                        $(`#lampStatus-` + id).text('OFF').addClass('text-danger')
                            .removeClass('text-success');
                        $(`.status-` + id).val(1);
                    }

                    //hide loading
                    $(`#loader-${payload.id}`).addClass('d-none');

                }, 1000);
            },
            error: function() {
                alert('Internal Server Error');
            }
        });
    }
</script>
<?= $this->endSection('content') ?>