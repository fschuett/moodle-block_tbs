<?php

// This file is part of the TBS block for Moodle
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
global $PAGE, $DB, $USER, $OUTPUT;
include "config.inc.php";
include "functions.php";
require_once('tbs_auth.php');
include "tbs_sql.php";

$day = optional_param('day', 0, PARAM_INT);
$month = optional_param('month', 0, PARAM_INT);
$year = optional_param('year', 0, PARAM_INT);
$area = optional_param('area', 0, PARAM_INT);
$period = optional_param('period', 0, PARAM_INT);
$hour = optional_param('hour', 0, PARAM_INT);
$minute = optional_param('minute', 0, PARAM_INT);
$durationraw = optional_param('duration', 0, PARAM_RAW);
$dur_units = optional_param('dur_units', 'periods', PARAM_TEXT);
$create_by = optional_param('create_by', '', PARAM_TEXT);
$name = optional_param('name', '', PARAM_TEXT);
$description = optional_param('description', '', PARAM_TEXT);
$id = optional_param('id', 0, PARAM_INT);
$rep_type = optional_param('rep_type', 0, PARAM_INT);
$rep_end_month = optional_param('rep_end_month', 0, PARAM_INT);
$rep_end_day = optional_param('rep_end_day', 0, PARAM_INT);
$rep_end_year = optional_param('rep_end_year', 0, PARAM_INT);
$rep_num_weeks = optional_param('rep_num_weeks', 0, PARAM_INT);
$rep_opt = optional_param('rep_opt', '', PARAM_SEQUENCE);
$rep_enddate = optional_param('rep_enddate', 0, PARAM_INT);
$forcebook = optional_param('forcebook', false, PARAM_BOOL);
$edit_type = optional_param('edit_type', '', PARAM_TEXT);
$type = optional_param('type', '', PARAM_TEXT);
$all_day = optional_param('all_day', false, PARAM_BOOL);
$ampm = optional_param('ampm', null, PARAM_TEXT);
// Deal with the 'array' params differently, depending on installed Moodle version
$rep_day = optional_param_array('rep_day', null, PARAM_RAW);
$rooms = optional_param_array('rooms', array(), PARAM_INT);
$doublebook = optional_param('doublebook', 0, PARAM_INT);
$roomchange = optional_param('roomchange', false, PARAM_BOOL);

define('TBS_ERR_DOUBLEBOOK', 1);
define('TBS_ERR_TOOMANY', 2);

//If we dont know the right date then make it up
if (($day == 0) or ($month == 0) or ($year == 0)) {
    $day = date("d");
    $month = date("m");
    $year = date("Y");
}

if (!$area) {
    $area = get_default_area();
}

//TODO - put in some proper params for this (low priority)
$PAGE->set_url(new moodle_url('/blocks/tbs/web/edit_entry_handler.php'));
require_login();

if (!getAuthorised(1)) {
    showAccessDenied($day, $month, $year, $area);
    exit;
}

$context = context_system::instance();

$roomadmin = false;
$editunconfirmed = has_capability('block/tbs:edittbsunconfirmed', $context, null, false);
if (!getWritable($create_by, getUserName())) {
    if ($editunconfirmed) {
        foreach ($rooms as $key => $room) {
            $adminemail = $DB->get_field('block_tbs_room', 'room_admin_email', array('id' => $room));
            if ($adminemail == $USER->email) {
                $roomadmin = true;
            } else {
                unset($rooms[$key]);
            }
        }
    }

    if (!$roomadmin) {
        showAccessDenied($day, $month, $year, $area);
        exit;
    }
}

// Make sure that confirmed bookings can't be made by non-room admins
if (authGetUserLevel(getUserName()) < 2 && $editunconfirmed) {
    foreach ($rooms as $room) {
        $adminemail = $DB->get_field('block_tbs_room', 'room_admin_email', array('id' => $room));
        if ($adminemail != $USER->email) {
            $type = 'U';
            break;
        }
    }
}

require_sesskey();

$name = trim($name);
if ($name == '') {
    print_header_tbs($day, $month, $year, $area);
    echo('<h1>'.get_string('invalid_booking', 'block_tbs').'<h1>');
    echo get_string('must_set_name', 'block_tbs');
    echo $OUTPUT->footer();
    exit;
}

$description = trim($description);
if ($description == '') {
    print_header_tbs($day, $month, $year, $area);
    echo('<h1>'.get_string('invalid_booking', 'block_tbs').'<h1>');
    echo get_string('must_set_description', 'block_tbs');
    echo $OUTPUT->footer();
    exit;
}

if (!check_max_advance_days($day, $month, $year)) {
    print_header_tbs($day, $month, $year, $area);
    echo('<h1>'.get_string('invalid_booking', 'block_tbs').'<h1>');
    echo get_string('toofaradvance', 'block_tbs', $max_advance_days);
    echo $OUTPUT->footer();
    exit;
}

$roomdetails = $DB->get_records_list('block_tbs_room', 'id', $rooms);
foreach ($roomdetails as $room) {
    if (!allowed_to_book($USER, $room)) {
        // TODO: Should admin users be allowed to override this?
        print_header_tbs($day, $month, $year, $area);
        echo('<h1>'.get_string('invalid_booking', 'block_tbs').'<h1>');
        echo get_string('notallowedbook', 'block_tbs', $max_advance_days);
        echo $OUTPUT->footer();
    }
}

// Support locales where ',' is used as the decimal point
$durationparts = explode(':', $durationraw, 2);
if ($dur_units == 'hours' && count($durationparts) == 2) {
    $duration = (float)intval($durationparts[0]) + ((float)intval($durationparts[1]) / 60.0);
} else {
    $duration = unformat_float($durationraw);
}

if ($enable_periods) {
    $resolution = 60;
    $hour = 12;
    $minute = $period;
    $max_periods = count($periods);
    if ($dur_units == "periods" && ($minute + $duration) > $max_periods) {
        $duration = (24 * 60 * floor($duration / $max_periods)) + ($duration % $max_periods);
    }
    if ($dur_units == "days" && $minute == 0) {
        $dur_units = "periods";
        $duration = $max_periods + ($duration - 1) * 60 * 24;
    }
}

// Units start in seconds
$units = 1.0;

switch ($dur_units) {
    case "years":
        $units *= 52;
    case "weeks":
        $units *= 7;
    case "days":
        $units *= 24;
    case "hours":
        $units *= 60;
    case "periods":
    case "minutes":
        $units *= 60;
    case "seconds":
        break;
}

// Units are now in "$dur_units" numbers of seconds

if ($all_day) {
    if ($enable_periods) {
        $starttime = mktime(12, 0, 0, $month, $day, $year);
        $endtime = mktime(12, $max_periods, 0, $month, $day, $year);
    } else {
        $starttime = mktime($morningstarts, 0, 0, $month, $day, $year);
        $end_minutes = $eveningends_minutes + $morningstarts_minutes;
        ($eveningends_minutes > 59) ? $end_minutes += 60 : '';
        $endtime = mktime($eveningends, $end_minutes, 0, $month, $day, $year);
    }
} else {
    if (!$twentyfourhour_format) {
        if (!is_null($ampm) && ($ampm == "pm") && ($hour < 12)) {
            $hour += 12;
        }
        if (!is_null($ampm) && ($ampm == "am") && ($hour > 11)) {
            $hour -= 12;
        }
    }

    $starttime = mktime($hour, $minute, 0, $month, $day, $year);
    $endtime = mktime($hour, $minute, 0, $month, $day, $year) + ($units * $duration);

    // Round up the duration to the next whole resolution unit.
    // If they asked for 0 minutes, push that up to 1 resolution unit.
    $diff = $endtime - $starttime;
    if (($tmp = $diff % $resolution) != 0 || $diff == 0) {
        $endtime += $resolution - $tmp;
    }

    $endtime += cross_dst($starttime, $endtime);
}

if (isset($rep_type) && isset($rep_end_month) && isset($rep_end_day) && isset($rep_end_year)) {
    // Get the repeat entry settings
    $rep_enddate = mktime($hour, $minute, 0, $rep_end_month, $rep_end_day, $rep_end_year);
} else {
    $rep_type = 0;
}

if (!isset($rep_day)) {
    $rep_day = array();
}

// For weekly repeat(2), build string of weekdays to repeat on:
$rep_opt = "";
if (($rep_type == 2) || ($rep_type == 6)) {
    for ($i = 0; $i < 7; $i++) {
        $rep_opt .= empty($rep_day[$i]) ? "0" : "1";
    }
}

// Expand a series into a list of start times:
if ($rep_type != 0) {
    $reps = tbsGetRepeatEntryList($starttime, isset($rep_enddate) ? $rep_enddate : 0,
                                   $rep_type, $rep_opt, $max_rep_entrys, $rep_num_weeks);
}

// When checking for overlaps, for Edit (not New), ignore this entry and series:
$repeat_id = 0;
if ($id > 0) {
    $ignore_id = $id;
    $repeat_id = $DB->get_field('block_tbs_entry', 'repeat_id', array('id' => $id));
    if ($repeat_id < 0) {
        $repeat_id = 0;
    }
} else {
    $ignore_id = 0;
}

// Acquire mutex to lock out others trying to book the same slot(s).
//if (!sql_mutex_lock("$tbl_entry"))
//fatal_error(1, get_string('failed_to_acquire','block_tbs'));

// Check for any schedule conflicts in each room we're going to try and
// book in
$err = "";
$errtype = 0;
$forcemoveoutput = '';
// Calculate all_day start-/endtime for clash detection
function get_allday_starttime($enable_periods = false, $month = null, $day = null, $year = null){
    if ($enable_periods) {
	return mktime(12, 0, 0, $month, $day, $year);
    } else {
	return mktime($morningstarts, 0, 0, $month, $day, $year);
    }
}

function get_allday_endtime($enable_periods = false, $month = null, $day = null, $year = null){
    if ($enable_periods) {
	return mktime(12, $max_periods, 0, $month, $day, $year);
    } else {
	$end_minutes = $eveningends_minutes + $morningstarts_minutes;
	($eveningends_minutes > 59) ? $end_minutes += 60 : '';
	return mktime($eveningends, $end_minutes, 0, $month, $day, $year);
    }
}

$ad_starttime = get_allday_starttime($enable_periods, $month, $day, $year);
$ad_endtime = get_allday_endtime($enable_periods, $month, $day, $year);

// Calculate all_week start-/endtime for clash detection (capacity checking)
function get_allweek_starttime($enable_periods = false, $month = null, $day = null, $year = null){
    if ($enable_periods) {
	$time =  mktime(12, 0, 0, $month, $day, $year);
	if (($weekday = (date("w", $time) - $weekstarts + 7) % 7) > 0) {
	    $time -= $weekday * 86400;
	}
	return $time;
    } else {
	$time = mktime($morningstarts, 0, 0, $month, $day, $year);
	if (($weekday = (date("w", $time) - $weekstarts + 7) % 7) > 0) {
	    $time -= $weekday * 86400;
	}
	return $time;
    }
}

function get_allweek_endtime($enable_periods = false, $month = null, $day = null, $year = null){
    if ($enable_periods) {
	return mktime(12, $max_periods, 0, $month, $day + 6, $year);
    } else {
	$end_minutes = $eveningends_minutes + $morningstarts_minutes;
	($eveningends_minutes > 59) ? $end_minutes += 60 : '';
	return mktime($eveningends, $end_minutes, 0, $month, $day + 6, $year);
    }
}
$aw_starttime = get_allweek_starttime($enable_periods, $month, $day, $year);
$aw_endtime = get_allweek_endtime($enable_periods, date("m",$aw_starttime), date("d", $aw_starttime), date("y", $aw_starttime));

foreach ($rooms as $room_id) {
    if ($rep_type != 0 && !empty($reps)) {
        if (count($reps) < $max_rep_entrys) {
            for ($i = 0; $i < count($reps); $i++) {
		// first check for day clashes
                // calculate diff each time and correct where events
                // cross DST
                $diff = $ad_endtime - $ad_starttime;
                $diff += cross_dst($reps[$i], $reps[$i] + $diff);
                $tmp = tbsCheckFree($room_id, $reps[$i], $reps[$i] + $diff, $ignore_id, $repeat_id);
                if (!empty($tmp)) {
                    $err = $err.$tmp;
                    $errtype = TBS_ERR_DOUBLEBOOK;
                } else {
		    // no day clashes - check for week clashes (only for type E or I)
            	    // calculate diff each time and correct where events
            	    // cross DST
            	    $diff = $aw_endtime - $aw_starttime;
		    $aw_reps_i = get_allweek_starttime($enable_periods, date("m",$reps[$i]), date("d",$reps[$i]), date("y",$reps[$i]));
            	    $diff += cross_dst($aw_reps_i, $aw_reps_i + $diff);
		    if( empty($type) or $type == 'E' or $type == 'I' ){
            		$tmp = tbsCheckCapacity($room_id, $aw_reps_i, $aw_reps_i + $diff, $ignore_id, $repeat_id);
			if (!empty($tmp)) {
			    $err = $err.$tmp;
			    $errtype = TBS_TOO_MANY;
			}
		    }
		}
            }
        } else {
            $err .= get_string('too_may_entrys', 'block_tbs')."<P>";
            $errtype = TBS_ERR_TOOMANY;
            $hide_title = 1;
        }
    } else {
        if (has_capability("block/tbs:forcebook", $context) and $forcebook) {
            require_once "force_book.php";
            $forcemoveoutput .= tbsForceMove($room_id, $ad_starttime, $ad_endtime, $name, $id);
            //do this so that it thinks no clashes were found
            $tmp = '';
        } else if ($doublebook and has_capability('block/tbs:doublebook', $context)) {
            $sql = 'SELECT entry.id AS entryid,
                entry.name as entryname,
                entry.create_by,
                room.room_name,
                entry.start_time
              FROM {block_tbs_entry} as entry
                join {block_tbs_room} as room on entry.room_id = room.id
             WHERE room.id = ?
             AND ((entry.start_time >= ? AND entry.end_time < ?)
             OR (entry.start_time < ? AND entry.end_time> ?)
             OR (entry.start_time < ? AND entry.end_time>= ?))';

            $clashingbookings = $DB->get_records_sql($sql, array(
                $room_id, $ad_starttime, $ad_endtime, $ad_starttime, $ad_starttime, $ad_endtime, $ad_endtime
            ));
            foreach ($clashingbookings as $clashingbooking) {
                $oldbookinguser = $DB->get_record('user', array('username' => $clashingbooking->create_by));
                $langvars->user = $USER->firstname.' '.$USER->lastname;
                $langvars->room = $clashingbooking->room_name;
                $langvars->time = to_hr_time($clashingbooking->start_time);
                $langvars->date = userdate($clashingbooking->start_time, '%A %d/%m/%Y');
                $langvars->oldbooking = $clashingbooking->entryname;
                $langvars->newbooking = $name;
                $langvars->admin = $tbs_admin.' ('.$tbs_admin_email.')';

                // Send emails to user with existing booking
                if (!email_to_user($oldbookinguser, $USER, get_string('doublebookesubject', 'block_tbs'), get_string('doublebookebody', 'block_tbs', $langvars))) {
                    email_to_user($DB->get_record('user', array('email' => $tbs_admin_email)), $USER, get_string('doublebookefailsubject', 'block_tbs'), get_string('doublebookefailbody', 'block_tbs', $oldbookinguser->username).get_string('doublebookebody', 'block_tbs', $langvars));
                }
            }
        } else {
            // If the user hasn't confirmed they want to double book, check the room is free and capacity (only type E or I).
	    if( !empty($type) and ( $type == 'E' or $type == 'I' ) ){
		$capacity_err .= tbsCheckCapacity($room_id, $aw_starttime, $aw_endtime - 1, $ignore_id, 0);
	    }
	    if( !empty($capacity_err) ){
		$err .= $capacity_err;
	    } else {
        	$err .= tbsCheckFree($room_id, $ad_starttime, $ad_endtime - 1, $ignore_id, 0);
	    }
        }
    }

} // end foreach rooms

if (empty($err)) {
    foreach ($rooms as $room_id) {
        if ($edit_type == "series") {
            $rep_details = tbsCreateRepeatingEntrys($starttime, $endtime, $rep_type, $rep_enddate, $rep_opt,
                                                     $room_id, $create_by, $name, $type, $description,
                                                     isset($rep_num_weeks) ? $rep_num_weeks : 0, $roomchange, $id);
            $new_id = $rep_details->id;

            $enddate = null;
            if ($rep_details->created && $rep_details->created < $rep_details->requested) {
                $forcemoveoutput .= get_string('notallcreated', 'block_tbs', $rep_details);
                $enddate = $rep_details->lasttime;
            }

            $sql = "SELECT r.id, r.room_name, r.area_id, a.area_name ";
            $sql .= "FROM {block_tbs_room} r, {block_tbs_area} a ";
            $sql .= "WHERE r.id=? AND r.area_id = a.id";
            $dbroom = $DB->get_record_sql($sql, array($room_id), MUST_EXIST);
            $room_name = $dbroom->room_name;
            $area_name = $dbroom->area_name;

            //Add to moodle logs
            $params = array(
                'objectid' => $new_id,
                'other' => array('name' => $name, 'room' => $room_name),
            );
            $event = \block_tbs\event\booking_created::create($params);
            $event->trigger();
            // Send a mail to the Administrator
            if (MAIL_ADMIN_ON_BOOKINGS or MAIL_AREA_ADMIN_ON_BOOKINGS or MAIL_ROOM_ADMIN_ON_BOOKINGS or MAIL_BOOKER) {
                // Send a mail only if this a new entry, or if this is an
                // edited entry but we have to send mail on every change,
                // and if tbsCreateRepeatingEntrys is successful
                if (((($id > 0) && MAIL_ADMIN_ALL) or ($id == 0)) && (0 != $new_id)) {
                    // If this is a modified entry then call
                    // getPreviousEntryData to prepare entry comparison.
                    if ($id > 0) {
                        $mail_previous = getPreviousEntryData($id, $rep_details->repeating);
                    }
                    $result = notifyAdminOnBooking(($id == 0), $new_id, $enddate);
                }
            }
        } else {
            // Mark changed entry in a series with entry_type 2:
            if ($repeat_id > 0) {
                $entry_type = 2;
            } else {
                $entry_type = 0;
            }

            // Create / update the entry:
            $new_id = tbsCreateSingleEntry($starttime, $endtime, $entry_type, $repeat_id, $room_id,
                                            $create_by, $name, $type, $description, $id, $roomchange);

            $sql = "SELECT r.id, r.room_name, r.area_id, a.area_name ";
            $sql .= "FROM {block_tbs_room} r, {block_tbs_area} a ";
            $sql .= "WHERE r.id=? AND r.area_id = a.id";
            $dbroom = $DB->get_record_sql($sql, array($room_id), MUST_EXIST);
            $room_name = $dbroom->room_name;
            $area_name = $dbroom->area_name;

            //Add to moodle logs
            $params = array(
                'objectid' => $new_id,
                'other' => array('name' => $name, 'room' => $room_name),
            );
            $event = \block_tbs\event\booking_updated::create($params);
            $event->trigger();
            // Send a mail to the Administrator
            if (MAIL_ADMIN_ON_BOOKINGS or MAIL_AREA_ADMIN_ON_BOOKINGS or MAIL_ROOM_ADMIN_ON_BOOKINGS or MAIL_BOOKER) {
                // Send a mail only if this a new entry, or if this is an
                // edited entry but we have to send mail on every change,
                // and if tbsCreateRepeatingEntrys is successful
                if (((($id > 0) && MAIL_ADMIN_ALL) or ($id == 0)) && (0 != $new_id)) {
                    // If this is a modified entry then call
                    // getPreviousEntryData to prepare entry comparison.
                    if ($id > 0) {
                        $mail_previous = getPreviousEntryData($id, 0);
                    }
                    $result = notifyAdminOnBooking(($id == 0), $new_id);
                }
            }
        }
    } // end foreach $rooms

    //    sql_mutex_unlock("$tbl_entry");

    $area = tbsGetRoomArea($room_id);

    // Now its all done go back to the day view
    $dayurl = new moodle_url('/blocks/tbs/web/day.php', array('year' => $year, 'month' => $month, 'day' => $day, 'area' => $area));
    redirect($dayurl, $forcemoveoutput, 20);
    exit;
}

// The room was not free.

if (strlen($err)) {
    print_header_tbs($day, $month, $year, $area);

    echo "<H2>".get_string('sched_conflict', 'block_tbs')."</H2>";
    if (!isset($hide_title)) {
        echo get_string('conflict', 'block_tbs');
        echo "<UL>";
    }

    echo $err;
    if (has_capability('block/tbs:doublebook', $context) && $errtype == TBS_ERR_DOUBLEBOOK) {
        $thisurl = new moodle_url('/blocks/tbs/web/edit_entry_handler.php');
        echo '<form method="post" action="'.$thisurl.'">';
        echo '<input type="hidden" name="name" value="'.$name.'" />';
        echo '<input type="hidden" name="description" value="'.$description.'" />';
        echo '<input type="hidden" name="day" value="'.$day.'" />';
        echo '<input type="hidden" name="month" value="'.$month.'" />';
        echo '<input type="hidden" name="year" value="'.$year.'" />';
        echo '<input type="hidden" name="area" value="'.$area.'" />';
        echo '<input type="hidden" name="create_by" value="'.$create_by.'" />';
        echo '<input type="hidden" name="id" value="'.$id.'" />';
        echo '<input type="hidden" name="rep_type" value="'.$rep_type.'" />';
        echo '<input type="hidden" name="rep_end_month" value="'.$rep_end_month.'" />';
        echo '<input type="hidden" name="rep_end_day" value="'.$rep_end_day.'" />';
        echo '<input type="hidden" name="rep_end_year" value="'.$rep_end_year.'" />';
        echo '<input type="hidden" name="rep_num_weeks" value="'.$rep_num_weeks.'" />';
        foreach ($rep_day as $day) {
            echo '<input type="hidden" name="rep_day[]" value="'.$day.'" />';
        }
        echo '<input type="hidden" name="rep_opt" value="'.$rep_opt.'" />';
        echo '<input type="hidden" name="rep_enddate" value="'.$rep_enddate.'" />';
        echo '<input type="hidden" name="hour" value="'.$hour.'" />';
        echo '<input type="hidden" name="minute" value="'.$minute.'" />';
        echo '<input type="hidden" name="period" value="'.$period.'" />';
        echo '<input type="hidden" name="duration" value="'.$duration.'" />';
        echo '<input type="hidden" name="dur_units" value="'.$dur_units.'" />';
        echo '<input type="hidden" name="type" value="'.$type.'" />';
        foreach ($rooms as $room) {
            echo '<input type="hidden" name="rooms[]" value="'.$room.'" />';
        }
        echo '<input type="hidden" name="doublebook" value="1" />';
        echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
        echo '<input type="submit" name="submit" value="'.get_string('idontcare', 'block_tbs').'" />';
        echo '</form>';
    }

    if (!isset($hide_title)) {
        echo "</UL>";
    }
}

$returl = new moodle_url('/blocks/tbs/web/index.php');
echo "<a href=\"$returl\">".get_string('returncal', 'block_tbs')."</a><p>";

include "trailer.php";
