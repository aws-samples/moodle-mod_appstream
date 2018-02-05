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
 * Define all the restore steps that will be used by the restore_newmodule_activity_task
 *
 * The AppStream Plugin does not support backup and recovery. It is disabled in lib.php.
 *
 * @package    mod_appstream
 * @copyright  2018 Amazon.com, Inc. and its affiliates. All Rights Reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 
 */

class restore_appstream_activity_structure_step extends restore_activity_structure_step {

    /**
     * Defines structure of path elements to be processed during the restore
     *
     * @return array of {@link restore_path_element}
     */
    protected function define_structure() {

        $paths = array();
        $paths[] = new restore_path_element('appstream', '/activity/appstream');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process the given restore path element data
     *
     * @param array $data parsed element data
     */
    protected function process_appstream($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        if (empty($data->timecreated)) {
            $data->timecreated = time();
        }

        if (empty($data->timemodified)) {
            $data->timemodified = time();
        }

        if ($data->grade < 0) {
            // Scale found, get mapping.
            $data->grade = -($this->get_mappingid('scale', abs($data->grade)));
        }

        // Create the appstream instance.
        $newitemid = $DB->insert_record('appstream', $data);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Post-execution actions
     */
    protected function after_execute() {
        // Add appstream related files, no need to match by itemname (just internally handled context).
        $this->add_related_files('mod_appstream', 'intro', null);
    }
}
