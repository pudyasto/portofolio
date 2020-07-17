<?= $this->extend('Views/template-admin/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="mb-2">

                    <button type="button" data-toggle="modal" data-title="Add Data" data-post-id="" data-action-url="product/formAdd" data-target="#form-modal" class="btn btn-sm btn-primary">Add New</button>
                    <button class="btn btn-sm btn-secondary btn-refresh">Refersh</button>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush tableGeneral">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 100px;">Images</th>
                            <th style="width: 150px;">Category</th>
                            <th style="width: 250px;">Name</th>
                            <th>Description</th>
                            <th style="width: 80px;"><i class="ni ni-settings-gear-65"></i></th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>ID</th>
                        </tr>
                    </tfoot>
                    <tbody class="list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('ext-js') ?>
<link rel="stylesheet" href="/assets/argon/js/components/dataTables/datatables.min.css" type="text/css">
<script src="/assets/argon/js/components/dataTables/datatables.min.js"></script>
<script src="/assets/argon/js/product.js?v=1.0"></script>
<?= $this->endSection() ?>