<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Admin Page - Argon Dashboard</title>
    <?= $this->include('template-admin/css') ?>
</head>

<body>
    <!-- Sidenav -->
    <?= $this->include('template-admin/sidenav') ?>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <?= $this->include('template-admin/topnav') ?>
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Portofolio</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <?= $this->renderSection('content') ?>
            <!-- Footer -->
            <?= $this->include('template-admin/footer') ?>
        </div>

        <!-- Modal General start -->
        <div class="modal fade" id="form-modal" role="dialog" data-backdrop="static" aria-labelledby="form-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <h4 class="modal-title" id="form-modal-title" style="font-size: 18px;">Form Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="form-modal-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal General end -->
    </div>
    <script>
        var public_url = '<?= site_url(); ?>';
    </script>
    <?= $this->include('template-admin/js') ?>
    <?= $this->renderSection('ext-js') ?>
</body>

</html>