<?php
$attributes = ['id' => 'form-submit', 'name' => 'form-submit'];
echo form_open_multipart($submit, $attributes);
?>
<input type="hidden" class="form-control" name="id" id="id" placeholder="Full Name" value="<?= (isset($row['id'])) ? $row['id'] : ''; ?>">
<h6 class="heading-small text-muted mb-4">Product Data</h6>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="category">Category</label>
            <input type="text" class="form-control" name="category" id="category" placeholder="Category" value="<?= (isset($row['category'])) ? $row['category'] : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="<?= (isset($row['name'])) ? $row['name'] : ''; ?>" required>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label">Product Description</label>
            <textarea rows="3" class="form-control" name="description" id="description" placeholder="Product Description ..." required><?= (isset($row['description'])) ? $row['description'] : ''; ?></textarea>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image" placeholder="image" value="<?= (isset($row['image'])) ? $row['image'] : ''; ?>" <?= (isset($row['id'])) ? '' : 'required'; ?>>
        </div>
    </div>
</div>
<div class="text-right">
    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
</div>
<?= form_close(); ?>
<script src="/assets/argon/js/product-form.js?v=1.0"></script>