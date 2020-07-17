<?= $this->extend('Views/template-admin/profile') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xl-4 order-xl-2">
        <div class="card card-profile">
            <img src="/assets/argon/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                            <img src="<?= photo_profile(); ?>" class="rounded-circle photo-profile">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                <span class="heading">22</span>
                                <span class="description">Friends</span>
                            </div>
                            <div>
                                <span class="heading">10</span>
                                <span class="description">Photos</span>
                            </div>
                            <div>
                                <span class="heading">89</span>
                                <span class="description">Comments</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h5 class="h3">
                        <span class="full_name"><?= (isset($profile['full_name'])) ? $profile['full_name'] : ''; ?></span>
                        <span class="font-weight-light birth_year">, <?= (isset($profile['birth_date'])) ? hitung_umur($profile['birth_date'], null, 'Y') : ''; ?></span>
                    </h5>
                    <div class="h5 font-weight-300 birth">
                        <?= (isset($profile['birth_place'])) ? $profile['birth_place'] : ''; ?>
                        <?= (isset($profile['birth_date'])) ? ',' . datetime_id($profile['birth_date']) : ''; ?>
                    </div>
                    <div class="h5 mt-4 phone">
                        Phone :
                        <?= (isset($profile['phone'])) ? $profile['phone'] : ''; ?>
                    </div>
                    <div class="email">
                        Email :
                        <?= (isset($profile['email'])) ? $profile['email'] : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Additional Information </h3>
                    </div>
                    <div class="col-4 text-right">
                        <button type="button" data-toggle="modal" data-title="Edit Data" data-post-id="" data-action-url="profile/form" data-target="#form-modal" class="btn btn-sm btn-primary">Edit Profile</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Social Media</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="linkedin">Linkedin</label>
                                <div id="linkedin" class="form-control linkedin"><?= (isset($profile['linkedin'])) ? $profile['linkedin'] : ''; ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="instagram">Instagram</label>
                                <div id="instagram" class="form-control instagram"><?= (isset($profile['instagram'])) ? $profile['instagram'] : ''; ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="facebook">Facebook</label>
                                <div id="facebook" class="form-control facebook"><?= (isset($profile['facebook'])) ? $profile['facebook'] : ''; ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="twitter">Twitter</label>
                                <div id="twitter" class="form-control twitter"><?= (isset($profile['twitter'])) ? $profile['twitter'] : ''; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Quotes</label>
                        <blockquote class="blockquote">
                            <p class="mb-0 quotes"><?= (isset($profile['quotes'])) ? $profile['quotes'] : ''; ?></p>
                            <footer class="blockquote-footer"><?= (isset($profile['full_name'])) ? $profile['full_name'] : ''; ?></footer>
                        </blockquote>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">About Me</label>
                        <blockquote class="blockquote">
                            <p class="mb-0 about_me"><?= (isset($profile['about_me'])) ? $profile['about_me'] : ''; ?></p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('ext-js') ?>
<script src="/assets/argon/js/profile.js?v=1.0"></script>
<?= $this->endSection() ?>