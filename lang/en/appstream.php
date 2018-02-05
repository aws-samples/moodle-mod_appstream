<?php
//Copyright 2018 Amazon.com, Inc. and its affiliates. All Rights Reserved.
//
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 3
// of the License.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <https://www.gnu.org/licenses/gpl-3.0.html>.
 
/**
 * English strings for newmodule
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. and its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 
 */

defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'Amazon AppStream';
$string['modulenameplural'] = 'Amazon AppStream';
$string['modulename_help'] = 'Amazon AppStream 2.0 is a fully managed, secure application streaming service that allows you to stream desktop applications from AWS to any device running a web browser, without rewriting them. Amazon AppStream 2.0 can provide users instant-on access to the applications they need, with a responsive, fluid user experience on the device of their choice.';

//TODO: Find these strings in the UI and make sure they are logical
$string['appstream:addinstance'] = 'Add a new Amazon AppStream Application.';
$string['appstream:submit'] = 'Submit Amazon Appstream Application';
$string['appstream:view'] = 'View Amazon AppStream Application';
$string['appstreamfieldset'] = 'Custom example fieldset';
$string['appstreamname'] = 'Amazon AppStream name';
$string['appstreamname_help'] = 'This is the content of the help tooltip associated with the appstreamname field. Markdown syntax is supported.';
$string['appstream'] = 'appstream';
$string['pluginadministration'] = 'appstream administration';
$string['pluginname'] = 'appstream';

//This is the text the student sees when they open the activity. It appears under the activity description.
$string['clickhere'] = 'Click here to launch Amazon AppStream';

///////////////////////////////////
//BEGIN: Fields in the admin form//
///////////////////////////////////

$string['streamingurl'] = 'Streaming URL';

$string['region'] = 'Region';
$string['region_help'] = 'The AWS region where AppStream is hosted. For example us-east-1.';
$string['region_link'] = 'https://docs.aws.amazon.com/aws-sdk-php/v2/guide/configuration.html#specify-region';

$string['accesskey'] = 'Access Key';
$string['accesskey_help'] = 'The AWS Access Key used to authenticate with Amazon AppStream. If you leave this field blank, the plugin will attempt to retrieve credentials as described in the linked SDK documentation.';
$string['accesskey_link'] = 'https://docs.aws.amazon.com/aws-sdk-php/v2/guide/credentials.html#credential-profiles';

$string['secretkey'] = 'Secret Key';
$string['secretkey_help'] = 'The AWS Secret Key used to authenticate with Amazon AppStream. If you leave this field blank, the plugin will attempt to retrieve credentials as described in the linked SDK documentation.';
$string['secretkey_link'] = 'https://docs.aws.amazon.com/aws-sdk-php/v2/guide/credentials.html#credential-profiles';

$string['fleetname'] = 'Fleet Name';
$string['fleetname_help'] = 'The name of the Amazon AppStream fleet.';
$string['fleetname_link'] = 'https://docs.aws.amazon.com/appstream2/latest/APIReference/API_CreateStreamingURL.html';

$string['stackname'] = 'Stack Name';
$string['stackname_help'] = 'The name of the Amazon AppStream stack.';
$string['stackname_link'] = 'https://docs.aws.amazon.com/appstream2/latest/APIReference/API_CreateStreamingURL.html';

$string['applicationid'] = 'Application Id';
$string['applicationid_help'] = 'The name of the application to launch after the session starts. This is the name that you specified as Name in the Image Assistant. If omitted, AppStream will present the user a list of available Applications.';
$string['applicationid_link'] = 'https://docs.aws.amazon.com/appstream2/latest/APIReference/API_CreateStreamingURL.html';

$string['sessioncontext'] = 'Session Context';
$string['sessioncontext_help'] = 'The session context.';
$string['sessioncontext_link'] = 'https://docs.aws.amazon.com/appstream2/latest/APIReference/API_CreateStreamingURL.html';

$string['redirect'] = 'Redirect on Click';
$string['redirect_help'] = 'When checked, the user will be redirected directly to Amazon AppStream without viewing the activity page.';

/////////////////////////////////
//END: Fields in the admin form//
/////////////////////////////////
