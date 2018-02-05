<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
 
/**
 * This is the students interface.
 *
 * This page either redirects the student to AppStream or displays a link 
 * that the student can click to get to AppstreamClient depending on how 
 * the teacher has configured the redirect option.
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // ... appstream instance ID - it should be named as the first character of the module.

if ($id) {
    $cm         = get_coursemodule_from_id('appstream', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $appstream  = $DB->get_record('appstream', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $appstream  = $DB->get_record('appstream', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $appstream->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('appstream', $appstream->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_appstream\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $appstream);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/appstream/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($appstream->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_cacheable(false);

//////////////////////////////////////////////////////
///////////BEGIN: Get the AppStream URL //////////////
//////////////////////////////////////////////////////

//Load the AWS PHP SDK
require 'aws.phar';
use Aws\Appstream\AppstreamClient;

//A Streaming URL is a presigned URL that launches AppStream. First we create a client and then request a URL.
//We need to build the client in stages because some params are optional or are provided from the environment.
$clientParams = ['version' => '2016-12-01'];
//The PHP SDK does not support reading the region from ~/.aws/config so it is required
$clientParams['region'] = $appstream->region;
//If not supplied the credentials will be read from ~/.aws/credentials or the EC2 instance profile
if(strlen($appstream->accesskey) > 0) $clientParams['credentials'] = ['key' => $appstream->accesskey, 'secret' => $appstream->secretkey ];
//Now we have enough information to create an AppStream client
$client = new AppstreamClient($clientParams);

//Now we can request the streaming URL from the client. The first three params are required. 
$URLParams = [
    'FleetName' => $appstream->fleetname,
    'StackName' => $appstream->stackname,
    'UserId' => $USER->username
];
//The Application Id and Session Context are optional 
if(strlen($appstream->applicationid) > 0) $URLParams['ApplicationId'] = $appstream->applicationid;
if(strlen($appstream->sessioncontext) > 0) $URLParams['SessionContext'] = $appstream->sessioncontext;
//Now we can make the API call to AppStream
$result = $client->createStreamingURL($URLParams);
//And finally get the URL
$url = $result['StreamingURL'];

//////////////////////////////////////////////////////
/////////////END: Get the AppStream URL///////////////
//////////////////////////////////////////////////////

//Include a redirect header so the user does not see the activity page if requested.
//This is optional and configurable. Typicaly the teacher would display the description
//on the course page and skip the activity page, or suppress the description on the  
//course page and show it on the activity page. This is configrable. In addition,
//we want to always show the activity page if the teacher is editing the page.
if ($appstream->redirect && !strpos(get_local_referer(false), 'modedit.php')) {
    redirect($url);  //TODO: Use Javascript to open in another tab
}

echo $OUTPUT->header();

if ($appstream->intro) {
    echo $OUTPUT->box(format_module_intro('appstream', $appstream, $cm->id), 'generalbox mod_introbox', 'appstreamintro');
}

//write the link returned from createStreamingURL
echo '<p align="center"><a target="_tab" href="'.$url.'">'.get_string('clickhere', 'mod_appstream').'</a></p>';

// Finish the page.
echo $OUTPUT->footer();
