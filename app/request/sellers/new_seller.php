<?php

if(!isset($this->post['seller_name'])){
    return null;
}

$this->post['seller_name'] = $this->post['seller_name'] ?? '';
$this->post['seller_password'] = $this->post['seller_password'] ?? '';
$this->post['seller_schema'] = $this->post['seller_schema'] ?? [];
$this->post['seller_status'] = $this->post['seller_status'] ?? '';

$rule = [
    'seller_name'=>'required|min-char:3|max-char:20|unique:sellers',
    'seller_password'=>'required|min-char:6|max-char:16',
    'seller_schema'=>'required',
    'seller_status'=>'required|bool'
];

$message = [
    'seller_name'=>[
        'required'=>'Seller name is required',
        'min-char'=>'Seller name must be at least 3 characters',
        'max-char'=>'Seller name must be at most 16 characters',
        'unique'=>'Seller name is already taken'
    ],
    'seller_password'=>[
        'required'=>'Seller password is required',
        'min-char'=>'Seller password must be at least 6 characters',
        'max-char'=>'Seller password must be at most 16 characters'
    ],
    'seller_schema'=>[
        'required'=>'Seller schema is required'
    ],
    'seller_status'=>[
        'required'=>'Seller status is required',
        'bool'=>'Seller status must be a boolean'
    ]  
];

if($this->validate($rule, $this->post, $message)){

    foreach ($this->post['seller_schema'] as $key => $value) {
        if(empty($value)){
            unset($this->post['seller_schema'][$key]);
        }
    }
    
    $values = [
        'seller_name'=>$this->post['seller_name'],
        'seller_password'=>md5($this->post['seller_password']),
        'seller_schema'=>$this->json_encode($this->post['seller_schema']),
        'seller_token'=>$this->generateToken(14),
        'seller_status'=>$this->post['seller_status'],
        'created_at'=>$this->timestamp
    ];

    $this->insert('sellers', $values);
} 