<?php

function cookieCheck(){
    if( cookie('cookieJm') === md5(cookie('userName').cookie('pwd').C('SALT')) ){
        return true;
    }else{
        return false;
    }
}