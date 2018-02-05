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
 * This is the teachers interface.
 *
 * Allows the teacher to configure the params for AppStream.
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_appstream_mod_form extends moodleform_mod {
    public function definition() {
        global $CFG;
        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are showed.
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('name'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        //$mform->addHelpButton('name', 'appstreamname', 'appstream');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // These are the fieds needed to create a streaming URL  
        $mform->addElement('header', 'streamingurl', get_string('streamingurl', 'appstream'));

        $mform->addElement('text', 'region', get_string('region', 'appstream'));
        $mform->addHelpButton('region', 'region', 'appstream');
	      $mform->addRule('region', null, 'required', null, 'client');

        $mform->addElement('text', 'accesskey', get_string('accesskey', 'appstream'));
        $mform->addHelpButton('accesskey', 'accesskey', 'appstream');

        $mform->addElement('text', 'secretkey', get_string('secretkey', 'appstream'));
        $mform->addHelpButton('secretkey', 'secretkey', 'appstream');

        $mform->addElement('text', 'fleetname', get_string('fleetname', 'appstream'));
        $mform->addHelpButton('fleetname', 'fleetname', 'appstream');
        $mform->addRule('fleetname', null, 'required', null, 'client');
        
        $mform->addElement('text', 'stackname', get_string('stackname', 'appstream'));
        $mform->addHelpButton('stackname', 'stackname', 'appstream');
        $mform->addRule('stackname', null, 'required', null, 'client');

        $mform->addElement('text', 'applicationid', get_string('applicationid', 'appstream'));
        $mform->addHelpButton('applicationid', 'applicationid', 'appstream');

        $mform->addElement('text', 'sessioncontext', get_string('sessioncontext', 'appstream'));
        $mform->addHelpButton('sessioncontext', 'sessioncontext', 'appstream');

        $mform->addElement('checkbox', 'redirect', get_string('redirect', 'appstream'));
        $mform->addHelpButton('redirect', 'redirect', 'appstream');

        // Add standard grading elements.
        $this->standard_grading_coursemodule_elements();

        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add standard buttons, common to all modules.
        $this->add_action_buttons();
    }
}
