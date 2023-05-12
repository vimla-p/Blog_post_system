<?php


function uniqueImage($img){
    $i=($img)->getClientOriginalName();
    return now().$i;
}