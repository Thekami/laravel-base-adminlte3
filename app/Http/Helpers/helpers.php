<?php

    function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
    {
        $path = makeDirectory($location);
        if (!$path) throw new Exception('File could not been created.');

        if ($old) {
            removeFile($location . '/' . $old);
            removeFile($location . '/thumb_' . $old);
        }
        $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file);
        if ($size) {
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
        }
        $image->save($location . '/' . $filename);

        if ($thumb) {
            $thumb = explode('x', $thumb);
            Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
        }

        return $filename;
    }

    function uploadFile($file, $location, $size = null, $old = null){
        $path = makeDirectory($location);
        if (!$path) throw new Exception('File could not been created.');

        if ($old) {
            removeFile($location . '/' . $old);
        }

        $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
        $file->move($location,$filename);
        return $filename;
    }

    function makeDirectory($path)
    {
        if (file_exists($path)) return true;
        return mkdir($path, 0755, true);
    }

    function removeFile($path)
    {
        return file_exists($path) && is_file($path) ? @unlink($path) : false;
    }

    function getRandomString($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function getAmount($amount, $length = 2)
    {
        $amount = round($amount, $length);
        return $amount + 0;
    }
    function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false){
        $separator = '';
        if($separate){
            $separator = ',';
        }
        $printAmount = number_format($amount, $decimal, '.', $separator);
        if($exceptZeros){
        $exp = explode('.', $printAmount);
            if($exp[1]*1 == 0){
                $printAmount = $exp[0];
            }
        }
        return $printAmount;
    }
?>