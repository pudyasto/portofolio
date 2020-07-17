<?php
$attributes = ['id' => 'form-submit', 'name' => 'form-submit'];
echo form_open($submit, $attributes);
?>
<input type="hidden" class="form-control" name="id" id="id" placeholder="Full Name" value="<?= (isset($row['id'])) ? $row['id'] : ''; ?>">
<h6 class="heading-small text-muted mb-4">Product Data</h6>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="institute">Institute</label>
            <input type="text" class="form-control" name="institute" id="institute" placeholder="Institute" value="<?= (isset($row['institute'])) ? $row['institute'] : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="graduate">Graduate</label>
            <input type="text" class="form-control" name="graduate" id="graduate" placeholder="Graduate" value="<?= (isset($row['graduate'])) ? $row['graduate'] : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="date_start">Date Start</label>
            <input type="text" class="form-control calendar" name="date_start" id="date_start" placeholder="Date Start" value="<?= (isset($row['date_start'])) ? dateconvert($row['date_start']) : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="form-control-label" for="date_finish">Date Finish</label>
                    <input type="text" class="form-control calendar" name="date_finish" id="date_finish" placeholder="Date Finish" value="<?= (isset($row['date_finish'])) ? dateconvert($row['date_finish']) : ''; ?>">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check mt-5">
                    <input type="checkbox" class="form-check-input" id="present" name="present" value="present" <?= (!isset($row['date_finish']) || ($row['date_finish'] == null)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="present">Present</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea rows="3" class="form-control" name="description" id="description" placeholder="Description ..." required><?= (isset($row['description'])) ? $row['description'] : ''; ?></textarea>
        </div>
    </div>
</div>
<div class="text-right">
    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
</div>
<?= form_close(); ?>
<script src="/assets/argon/js/education-form.js?v=1.0"></script>