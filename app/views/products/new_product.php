<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Product</title>
    <?php $this->addLayer('app/views/header');?>
    <?php $this->addLayer('app/request/products/new_product');?>
</head>
<body>
    <?php $this->addLayer('app/views/navbar');?>
    <div class="container">
        <form action="new" method="post">
            <?=$_SESSION['csrf']['input'];?>
            <input type="hidden" name="department" value="product">
            <div class="row border-bottom py-2">
                <div class="col-lg-12">
                    <h2 class="mt-4">New Product 
                        <button class="btn btn-primary btn-sm" name="product_create" type="submit">Create</button>
                        <?php
                        if(isset($this->post['product_create'])){

                            if(empty($this->errors)) {
                                echo '<strong style="font-size:12px;">Created.</strong>';
                                $this->redirect($this->page_back, 1);
                            }
                        }
                        ?>
                    </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=$this->base_url;?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="page/products">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Product</li>
                        </ol>
                    </nav>
                </div>
         
                <div class="row m-0 p-0 mb-1">
                    <?php
                    $columns = $this->columnList('products');
                    ?>
                    <div class="col-lg-3">
                        <!-- <h5 class="border-bottom mt-4">INFORMATION</h5> -->
                        <div class="form-group">
                            <label for="product_name">Product Name: *</label>
                            <input class="form-control" type="text" name="product_name">
                        </div>
                        <div class="form-group">
                            <label for="product_code">Product Code: *</label>
                            <input class="form-control" type="text" name="product_code">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Product Description: *</label>
                            <textarea class="form-control" name="product_description" id="product_description" cols="30" rows="10"></textarea>
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="seller_id">Seller: *</label>
                                    <select class="form-select" name="seller_id[]" size="13" id="seller_id" multiple aria-label="multiple select example">
                                        <?php foreach($this->samantha('sellers', null, ['id', 'seller_name']) as $row) { ?>
                                            <option value="<?=$row['id'];?>"><?=$row['seller_name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_type">Product Type: *</label>
                                    <select class="form-select" name="product_type" id="product_type">
                                        <option value="">Select</option>
                                        <option value="count">Count</option>
                                        <option value="nocount">No Count</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_tax">Product Tax: *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" aria-describedby="basic-addon2" name="product_tax">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_quantity">Product Quantity: *</label>
                                    <input class="form-control" type="number" name="product_quantity">
                                </div>
                                <div class="form-group">
                                    <label for="product_currency">Product Currency: *</label>
                                    <select class="form-select" name="product_currency" id="product_currency">
                                        <option value="">Select</option>
                                        <?php foreach($this->currencies() as $key => $currency) { ?>
                                        <option value="<?=$key;?>"><?=$key;?> (<?=$currency;?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>                              
                                <div class="form-group">
                                    <label for="product_lang">Product Lang: *</label>
                                    <select class="form-select" name="product_lang" id="product_lang">
                                        <option value="">Select</option>
                                        <?php foreach($this->languages() as $key => $lang) { ?>
                                        <option value="<?=$key;?>"><?=$lang['name'];?> (<?=$lang['nativeName'];?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="product_discount_price">Product Discount Price: *</label>
                                    <input class="form-control" type="text" name="product_discount_price">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price: *</label>
                                    <input class="form-control" type="text" name="product_price">
                                </div>
                                
                                <div class="form-group">
                                    <label for="product_status">Product Status: *</label>
                                    <select class="form-select" name="product_status" id="product_status">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mt-2">
                            <?php
                            if(isset($this->post['product_create'])){

                                if(!empty($this->errors)) {
                                    foreach ($this->errors as $errors) {
                                        foreach ($errors as $key => $error) {
                                            echo '<strong style="font-size:10px; color:red;">* '.$error.'.</strong><br>';
                                        }
                                    }
                                    $this->redirect($this->page_back, 5);
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>

    </div>
</body>
</html>