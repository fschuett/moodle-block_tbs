<?php

// This file is part of the MRBS block for Moodle
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

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
global $USER;

$messagelang = new stdClass();
$messagelang->user = $USER->firstname.' '.$USER->lastname;
if (empty($description)) {
    $messagelang->description = $name;
} else {
    $messagelang->description = $description;
}
$messagelang->room = $room_name;
$messagelang->datetime = $start_date;
$url = new moodle_url('/blocks/mrbs/web/edit_entry.php', array('instance' => $instance_id, 'id' => $id));
$messagelang->href = $url->out();

$message = "$USER->firstname $USER->lastname requests that you move $description from room $room_name, $start_date. Please contact them to discuss this.\n\n[Give a reason]";

$context = context_block::instance($instance_id);

if (has_capability('block/mrbs:editmrbs', $context) or has_capability('block/mrbs:administermrbs', $context)) {
    echo '<br><br><a href=# onClick="requestVacate.style.visibility=\'visible\';">'.get_string('requestvacate', 'block_mrbs').'</a>';
    echo '<form id="editing" method="post" action="request_vacate_send.php">';
    echo '<div id="request_vacate">';
    echo '<input type="hidden" name="id" value="'.$booking->userid.'" />';
    echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
    echo $OUTPUT->print_textarea('message', 'edit-message', get_string('requestvacatemessage_html', 'block_mrbs', $messagelang), 15, 350);
    echo '<input type="hidden" name="format" value="'.FORMAT_HTML.'" />';
    echo '<input type="hidden" name="format" value="'.FORMAT_MOODLE.'" />';
    echo '<br /><input type="submit" value="'.get_string('sendmessage', 'message').'" />';
    echo '</div>';
    echo '</form>';
    echo '<SCRIPT LANGUAGE="JavaScript">
        requestVacate=document.getElementById(\'request_vacate\');
        requestVacate.style.visibility=\'hidden\';
        </SCRIPT>';
}
