<?php
function search_results($info) {
    //$count = (isset($info["count"])) ? $info["count"] : 0;
    $results = array();
    
    foreach ($info as $inf) {
        if (is_array($inf)) {
            foreach ($inf as $key => $in) {
                if ((@count($inf[$key]) - 1) > 0) {
                    if (is_array($in)) {
                        unset($inf[$key]["count"]);
                    }
                    $temp_result[$key] = $inf[$key];
                }
            }
            $temp_result["dn"] = @explode(',', $inf["dn"]);
            array_push($results, $temp_result);
        }
    }
    /*$count = count($results, 0);
    if($count == 1){
        $results = array_shift($results);
    }*/
    return $results;
}
?>
<?php

// LDAP variables
$ldaphost = "10.227.196.10";  // your ldap servers //ldap://brandixlk.org
$ldapport = 389;   // your ldap server's port number

// Connecting to LDAP
//$ldapconn = ldap_connect($ldaphost, $ldapport)or die("Could not connect to $ldaphost");
$ldapconn = ldap_connect($ldaphost)or die("Could not connect to $ldaphost");

// using ldap bind
$ldaprdn  = 'kasunv@brandix.com';     // ldap rdn or dn
$ldappass = 'Brdx@9000';  // associated password

if ($ldapconn) {

    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...";
    } else {
        echo "LDAP bind failed...";
    }

}

//example path for searching
//$search = ldap_search($ldapconn, "cn=Example Staff,ou=Groups,ou=Staff,ou=Domain Objects,dc=example,dc=ca", "(cn=*)");

var_dump($ldapconn);

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

$attributes=array('cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto');

$search = ldap_search($ldapconn, "DC=brandixlk,DC=org", "(mail=kasun*)", $attributes);
//$search = ldap_search($ldapconn, "OU=Users,OU=BLIW,OU=BLI,OU=Brandix Users,DC=brandixlk,DC=org", "(cn=kasun vimarshana)", $attributes); // worked
//$search = ldap_search($ldapconn, "OU=Users,OU=BLIW,OU=BLI,OU=Brandix Users,DC=brandixlk,DC=org", "(cn=kasun vimarshana)");

echo "<h2>" .ldap_count_entries($ldapconn, $search). "</h2>";

$info = ldap_get_entries($ldapconn, $search);
echo "<pre>";
    /*for($i=0; $i<$info["count"]; $i++){
        print_r(search_results($info[$i]));
        echo ($info[$i]["company"][0]);
    }*/
    print_r(search_results($info));
echo "</pre>";

/*<img src="data:image/jpeg;base64,<?php echo base64_encode($imageString); ?>"/>*/
/*
$tempFile = tempnam(sys_get_temp_dir(), 'image');
file_put_contents($tempFile, $imageString);
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = explode(';', $finfo->file($tempFile));
echo '<img src="data:' . $mime[0] . ';base64,' . base64_encode($imageString) . '"/>';
*/
/*
else if (isset($entry['thumbnailphoto'])) {
    $entry['thumbnailphoto'][0] = "data:image/jpeg;base64," . base64_encode($entry['thumbnailphoto'][0]);
}
*/



?>