<?php
function genUserXML($fullName, $pass) {

	$xml = 	"<?xml version='1.1' encoding='UTF-8'?>" . "\n" .
			'<user>' . "\n" .
			'  <fullName>' . $fullName . '</fullName>' . "\n" .
			'  <properties>' . "\n" .
			'    <jenkins.security.ApiTokenProperty>' . "\n" .
			'      <tokenStore>' . "\n" .
			'        <tokenList/>' . "\n" .
			'      </tokenStore>' . "\n" .
			'    </jenkins.security.ApiTokenProperty>' . "\n" .
			'    <hudson.model.MyViewsProperty>' . "\n" .
			'      <views>' . "\n" .
			'        <hudson.model.AllView>' . "\n" .
			'          <owner class="hudson.model.MyViewsProperty" reference="../../.."/>' . "\n" .
			'          <name>all</name>' . "\n" .
			'          <filterExecutors>false</filterExecutors>' . "\n" .
			'          <filterQueue>false</filterQueue>' . "\n" .
			'          <properties class="hudson.model.View$PropertyList"/>' . "\n" .
			'        </hudson.model.AllView>' . "\n" .
			'      </views>' . "\n" .
			'    </hudson.model.MyViewsProperty>' . "\n" .
			'    <hudson.model.PaneStatusProperties>' . "\n" .
			'      <collapsed/>' . "\n" .
			'    </hudson.model.PaneStatusProperties>' . "\n" .
			'    <hudson.search.UserSearchProperty>' . "\n" .
			'      <insensitiveSearch>true</insensitiveSearch>' . "\n" .
			'    </hudson.search.UserSearchProperty>' . "\n" .
			'    <hudson.security.HudsonPrivateSecurityRealm_-Details>' . "\n" .
			'      <passwordHash>' . $pass . '</passwordHash>' . "\n" .
			'    </hudson.security.HudsonPrivateSecurityRealm_-Details>' . "\n" .
			'    <jenkins.security.LastGrantedAuthoritiesProperty>' . "\n" .
			'      <roles>' . "\n" .
			'        <string>authenticated</string>' . "\n" .
			'      </roles>' . "\n" .
			'      <timestamp>1540323431204</timestamp>' . "\n" .
			'    </jenkins.security.LastGrantedAuthoritiesProperty>' . "\n" .
			'  </properties>' . "\n" .
			'</user>';

	return $xml;
}