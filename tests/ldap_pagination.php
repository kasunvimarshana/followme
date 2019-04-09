<?php

// Example LDAP Pagination - http://www.marco-difeo.de

// We need to declare this at the outside of our do while loop!
$oPaginationCookie = "";
$oEntries = array();

// Loop for Pagination
do {
    // Set Pagination Cookie for LDAP Request
    ldap_control_paged_result($dn, 1000, true, $oPaginationCookie);

    // Search LDAP
    $ldapResult = @ldap_search($dn, $base, $searchstring, $properties, null, 1000);

    // Retrieve Paged Results
    $oLdapEntries = ldap_get_entries($this->oLDAPConnection, $ldapResult);

    // Retrieve Pagination Status (more results available?)
    // This function sets a value for $oPaginationCookie. We don't have to assign something!
    ldap_control_paged_result_response($this->oLDAPConnection, $ldapResult, $oPaginationCookie);

    // Example Code
    $oEntries = array_merge($oEntries,$oLdapEntries);

//Check if Paginationcookie has been emptied by ldap_control_paged_result_response. If yes, we have all results
}while( $oPaginationCookie !== null && $oPaginationCookie != "" );

// Do something else

?>