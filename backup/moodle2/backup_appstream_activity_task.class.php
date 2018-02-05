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
 * Defines backup_newmodule_activity_task class
 *
 * The AppStream Plugin does not support backup and recovery. It is disabled in lib.php.
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. and its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/appstream/backup/moodle2/backup_appstream_stepslib.php');

class backup_appstream_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the appstream.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_appstream_activity_structure_step('appstream_structure', 'appstream.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of appstreams.
        $search = '/('.$base.'\/mod\/appstream\/index.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@APPSTREAMINDEX*$2@$', $content);

        // Link to appstream view by moduleid.
        $search = '/('.$base.'\/mod\/appstream\/view.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@APPSTREAMVIEWBYID*$2@$', $content);

        return $content;
    }
}
