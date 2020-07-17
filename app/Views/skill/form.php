<?php
$attributes = ['id' => 'form-submit', 'name' => 'form-submit'];
echo form_open($submit, $attributes);
?>
<input type="hidden" class="form-control" name="id" id="id" placeholder="Full Name" value="<?= (isset($row['id'])) ? $row['id'] : ''; ?>">
<h6 class="heading-small text-muted mb-4">Product Data</h6>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="name">Skill Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Skill Name" value="<?= (isset($row['name'])) ? $row['name'] : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="percent">Skill Point</label>
            <input type="number" class="form-control" name="percent" id="percent" min="0" max="100" placeholder="Skill Point" value="<?= (isset($row['percent'])) ? $row['percent'] : ''; ?>" required>
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
<script src="/assets/argon/js/skill-form.js?v=1.0"></script>