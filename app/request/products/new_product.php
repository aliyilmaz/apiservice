<?php

if(!isset($this->post['product_create'])){
    return null;
}

$this->post['seller_id'] = $this->post['seller_id'] ?? [];
$this->post['seller_id'] = (!is_array($this->post['seller_id'])) ? [$this->post['seller_id']] : $this->post['seller_id'];
$this->post['product_type'] = $this->post['product_type'] ?? '';
$this->post['product_type'] = in_array($this->post['product_type'], ['count', 'nocount']) ? $this->post['product_type'] : '';
$this->post['product_code'] = $this->post['product_code'] ?? '';
$this->post['product_name'] = $this->post['product_name'] ?? '';
$this->post['product_lang'] = $this->post['product_lang'] ?? '';
$this->post['product_description'] = $this->post['product_description'] ?? '';
$this->post['product_quantity'] = $this->post['product_quantity'] ?? '';
$this->post['product_tax'] = $this->post['product_tax'] ?? '';
$this->post['product_price'] = $this->post['product_price'] ?? '';
$this->post['product_discount_price'] = $this->post['product_discount_price'] ?? '';
$this->post['product_status'] = (bool)$this->post['product_status'] ?? '';

$rule = [
    'seller_id'=>'required',
    'product_type'=>'required',
    'product_code'=>'required|unique:products',
    'product_name'=>'required|unique:products',
    'product_description'=>'required',
    'product_lang'=>'required|languages',
    'product_currency'=>'required|currencies',
    'product_quantity'=>'required|numeric',
    'product_tax'=>'required|numeric',
    'product_price'=>'required',
    'product_discount_price'=>'required',
    'product_status'=>'required|bool'
];

$message = [
    'product_name'=>[
        'required'=>'Product name is required',
        'unique'=>'Product name is already taken'
    ],
    'product_description'=>[
        'required'=>'Product description is required'
    ],
    'product_lang'=>[
        'required'=>'Product language is required',
        'languages'=>'Product language is not valid'
    ],
    'product_currency'=>[
        'required'=>'Product currency is required',
        'currencies'=>'Product currency is not valid'
    ],
    'seller_id'=>[
        'required'=>'Seller is required',
        'available'=>'Seller is not available'
    ],
    'product_type'=>[
        'required'=>'Product type is required'
    ],
    'product_code'=>[
        'required'=>'Product code is required',
        'unique'=>'Product code is already taken'
    ],
    'product_quantity'=>[
        'required'=>'Product quantity is required',
        'numeric'=>'Product quantity must be numeric'
    ],
    'product_tax'=>[
        'required'=>'Product tax is required',
        'numeric'=>'Product tax must be numeric'
    ],
    'product_price'=>[
        'required'=>'Product price is required'
    ],
    'product_discount_price'=>[
        'required'=>'Product discount price is required'
    ],
    'product_status'=>[
        'required'=>'Product status is required',
        'bool'=>'Product status must be boolean'
    ]
];

foreach ($this->post['seller_id'] as $seller_id) {
    if(!$this->do_have('sellers', $seller_id)){
        $this->errors['seller_id']['available'] = $message['seller_id']['available'];
    }
}

if($this->validate($rule, $this->post, $message) AND empty($this->errors)){

    foreach ($this->post['seller_id'] as $seller_id) {
        $values = [
            'seller_id'=>$seller_id,
            'product_type'=>$this->post['product_type'],
            'product_code'=>$this->post['product_code'],
            'product_name'=>$this->post['product_name'],
            'product_description'=>$this->post['product_description'],
            'product_lang'=>$this->post['product_lang'],
            'product_currency'=>$this->post['product_currency'],
            'product_quantity'=>$this->post['product_quantity'],
            'product_tax'=>$this->post['product_tax'],
            'product_price'=>$this->post['product_price'],
            'product_discount_price'=>$this->post['product_discount_price'],
            'product_status'=>$this->post['product_status'],
            'created_at'=>$this->timestamp,
        ];
    
        $this->insert('products', $values);
    }
    
}