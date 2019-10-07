<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/21
 * Time: 21:20
 */

namespace App\Handlers;


class FileHelpHandler
{

    /**
     * 加密
     * @param $file 文件
     * @param $destination 保存路徑
     * @param $passphrase 密碼
     */
    public static function encrypt_file($file, $destination, $passphrase){
        $handle = fopen($file, "rb") or die("could not open the file");
        $contents = fread($handle,filesize($file));
        fclose($handle);
        $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
        $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
        $opts = array('iv'=>$iv, 'key'=>$key);
        $fp = fopen($destination,'wb') or die("Could not opn file for writing");
        stream_filter_append($fp, 'mcrypt.tripledes',STREAM_FILTER_WRITE, $opts);
        fwrite($fp, $contents) or die('Could not write to file');
        fclose($fp);
    }

    /**
     * 解密
     * @param $file
     * @param $passphrase
     * @return bool|resource
     */
    public static function decrypt_file($file,$passphrase){
        $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
        $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
        $opts = array('iv'=>$iv, 'key'=>$key);
        $fp = fopen($file,'rb');
        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
        return $fp;
    }
}
