<?php
$attributes = ['id' => 'form-submit', 'name' => 'form-submit'];
echo form_open_multipart($submit, $attributes);
?>
<h6 class="heading-small text-muted mb-4">User information</h6>
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="full_name">Full Name</label>
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?= (isset($profile['full_name'])) ? $profile['full_name'] : ''; ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="birth_date">Birth Date</label>
                <input type="text" class="form-control calendar" aria-label="birth-date" name="birth_date" id="birth_date" placeholder="Birth Date" value="<?= (isset($profile['birth_date'])) ? dateconvert($profile['birth_date']) : ''; ?>" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="birth_place">Birth Place</label>
                <input type="text" class="form-control" name="birth_place" id="birth_place" placeholder="Birth Place" value="<?= (isset($profile['birth_place'])) ? $profile['birth_place'] : ''; ?>" required>
            </div>
        </div>
    </div>

    <!-- Description -->
    <h6 class="heading-small text-muted mb-4">About me</h6>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="quotes">Quotes</label>
                <input type="text" class="form-control" name="quotes" id="quotes" placeholder="Quotes" value="<?= (isset($profile['quotes'])) ? $profile['quotes'] : ''; ?>" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">About Me</label>
                <textarea rows="3" class="form-control" name="about_me" id="about_me" placeholder="A few words about you ..." required><?= (isset($profile['about_me'])) ? $profile['about_me'] : ''; ?></textarea>
            </div>
        </div>
    </div>

    <hr class="my-4">
    <!-- Address -->
    <h6 class="heading-small text-muted mb-4">Contact information</h6>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Address</label>
                    <textarea rows="3" class="form-control" name="address" id="address" placeholder="Address" required><?= (isset($profile['address'])) ? $profile['address'] : ''; ?></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?= (isset($profile['city'])) ? $profile['city'] : ''; ?>" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="phone">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?= (isset($profile['phone'])) ? $profile['phone'] : ''; ?>" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= (isset($profile['email'])) ? $profile['email'] : ''; ?>" required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin" value="<?= (isset($profile['linkedin'])) ? $profile['linkedin'] : ''; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="Instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" value="<?= (isset($profile['instagram'])) ? $profile['instagram'] : ''; ?>">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="<?= (isset($profile['facebook'])) ? $profile['facebook'] : ''; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" value="<?= (isset($profile['twitter'])) ? $profile['twitter'] : ''; ?>">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="photo">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?= (isset($profile['photo'])) ? $profile['photo'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-right">
    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
</div>
<?= form_close(); ?>
<script src="/assets/argon/js/profile-form.js?v=1.0"></script>