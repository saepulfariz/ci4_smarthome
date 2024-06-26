<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container" style="margin-top: 80px;margin-bottom: 120px;">
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-3">
                <div class="col-md-2">
                    <form action="<?= base_url('histories'); ?>" method="GET">
                        <select class="form-select" name="periode" onchange="this.form.submit()">>
                            <option value="1" selected>-- periode --</option>
                            <option value="1" <?= ($periode == 1) ? 'selected' : ''; ?>>Hari ini</option>
                            <option value="3" <?= ($periode == 3) ? 'selected' : ''; ?>>3 Hari</option>
                            <option value="7" <?= ($periode == 7) ? 'selected' : ''; ?>>7 Hari</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <canvas id="lampChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('lampChart').getContext('2d');
    const chartData = <?= json_encode($chartData); ?>;

    const lampChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Total Data <?= $periode; ?> Dalam Hari',
                data: chartData.total,
                backgroundColor: '#405ff3',
                borderColor: '#405ff3',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection('content') ?>