<?php
	
/**
 *@license
 *Copyright (c) 2019 Cisco and/or its affiliates.
 *
 *This software is licensed to you under the terms of the Cisco Sample
 *Code License, Version 1.1 (the "License"). You may obtain a copy of the
 *License at
 *
 *			   https://developer.cisco.com/docs/licenses
 *
 *All use of the material herein must be in accordance with the terms of
 *the License. All rights not expressly granted by the License are
 *reserved. Unless required by applicable law or agreed to separately in
 *writing, software distributed under the License is distributed on an "AS
 *IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 *or implied.
 */
	

	
$htmlbody = <<<HTML
<script>
		$.ajax({
			url: "ajax/getmodule.php",
			
			data: {
				module: 'portals'
			},
			type: "POST",
			dataType: "html",
			success: function (data) {
				$('#mainContent').html(data);
			},
			error: function (xhr, status) {
				$('#mainContent').html("<h6 class=\"text-center\"><span class=\"text-danger\">Error Loading Selection:</span>  Verify the installation/configuration and/or contact your system administrator!</h6>");
			},
			complete: function (xhr, status) {
				//$('#showresults').slideDown('slow')
			}
		});
</script>
HTML;

	if($sanitizedInput['portalName'] != "" && isset($_POST['sponsorGroups']) && isset($_POST['sponsorPortalType'])){
		if(is_array($_POST['sponsorGroups'])){
			
			$ipskISEDB->updateSponsorPortal($sanitizedInput['id'], $sanitizedInput['portalName'], $sanitizedInput['description'], $sanitizedInput['sponsorPortalType'], $sanitizedInput['hostname'], $sanitizedInput['tcpPort'], $sanitizedInput['authDirectory'], $_SESSION['logonSID']);
			
			$temp = $_POST['sponsorGroups'];
			$sanitizedSponsorGroups = filter_var_array($temp,FILTER_VALIDATE_INT);
				
			$ipskISEDB->updateSponsorGroupPortalMapping($sanitizedSponsorGroups, $sanitizedInput['id'], $_SESSION['logonSID']);
			
		}
	}

	print $htmlbody;
?>