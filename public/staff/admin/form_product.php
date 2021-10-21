<?php
if (!isset($product)) {
    redirect_to('products.php');
}
?>

<div class="form-group">
    <label for="exampleInputPassword1">Product Name</label>
    <input type="text" class="form-control" value="<?php echo $product->productName; ?>" name="product[productName]"
        placeholder="*Your Product Name (Min:12Chars)" required>
</div>


<div class="form-group">
    <label for="sl2mul">Product Category</label>
    <select class="select2-multiple form-control" name="productCategory[]" multiple="multiple" id="sl2mul">
        <option disabled="disabled">Select A Category</option>
        <?php foreach ($product->productCategory as $cat) {
            echo  $category = "<option value={$cat->id}>" . $cat->categoryName . "</option>";
        } ?>
    </select>
</div>


<div class="form-group">
    <label for="tarea">Product Description</label>
    <textarea class="form-control" id="tarea" name="product[productDesc]" rows="2"
        required><?php echo $product->productDesc; ?></textarea>
</div>



<div class="form-group">
    <div class="custom-file">
        <input type="file" name="productThumb[]" class="custom-file-input" id="unlst" multiple required>
        <label class="custom-file-label" for="unlst">Choose file</label>
    </div>
</div>

<div class="input-group mb-3">
    <div class="w-50"><label for="ppr">Product Price
            (FRW)</label>
    </div>
    <div class="input-group-prepend">
        <span class="input-group-text">Frw</span>
    </div>
    <input type="text" id="ppr" name="product[productPrice]" value="<?php echo $product->productPrice; ?>"
        class="form-control" aria-label="Amount (to the nearest Rwandan)" placeholder="*Price in Rwf" required>
    <div class="input-group-append">
        <span class="input-group-text">.00</span>
    </div>
</div>

<label>Product Unlimited</label>
<div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
    <label class="custom-control-label" for="customSwitch1"> *Is Unlimited</label>
</div>



<button type="submit" class="btn btn-primary">Submit</button>