<?php
/**
 * Class DnsSubdominio
 * @author Alejandro Sanchez[AP] (FKGG<3)
 * @Info Esta clase Anade un subdominio DDNS a Scala-soft.com.ve
 *
 */


class DnsSubdominio
{
    public $EMPNAME;
    public $domain;
public function SetSubdomain(){

    $host = 'scala-soft.com.ve';
    $user = 'scalasof';
    $hash = 'BVV5HYJX9UA1X58KYZ2NI96Y3WPXV8TE';
    $query ="https://scala-soft.com.ve:2083/cpsess5718635918/execute/DynamicDNS/create?domain=$this->domain&description=$this->EMPNAME";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $header[0] = 'Authorization: cpanel  '.$user.':'.preg_replace("'(\r|\n)'", '', $hash);

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);

    $result = curl_exec($curl);
    return ($result);

    curl_close($curl);



//BVV5HYJX9UA1X58KYZ2NI96Y3WPXV8TE
}



}