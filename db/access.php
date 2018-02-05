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
 * Capability definitions for the newmodule module
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. and its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'mod/appstream:addinstance' => array(
        'riskbitmask' => RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

    'mod/appstream:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'guest' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        )
    ),

    'mod/appstream:submit' => array(
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW
        )
    ),
);
