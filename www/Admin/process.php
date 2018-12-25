<?php

return json_encode($_POST);

//generate_key_string();

function generate_key_string() {
 
    $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $segment_chars = 5;
    $num_segments = 4;
    $key_string = '';
 
    for ($i = 0; $i < $num_segments; $i++) {
 
        $segment = '';
 
        for ($j = 0; $j < $segment_chars; $j++) {
                $segment .= $tokens[rand(0, 35)];
        }
 
        $key_string .= $segment;
 
        if ($i < ($num_segments - 1)) {
                $key_string .= '-';
        }
 
    }
 
    return $key_string;
 
}


/*
Nodejs
Installation
npm install licensekey

Create a License Key
var licenseKey = require('licensekey');

var userInfo = {company:"wavecoders.ca",street:"123 licenseKey ave", city:"city/town", state:"State/Province", zip:"postal/zip"}
var userLicense = {info:userInfo, prodCode:"LEN100120", appVersion:"1.5", osType:'IOS8'}
 
try{
    var license = licenseKey.createLicense(licenseData)
    console.log(license);
}catch(err){
    console.log(err);
}*/