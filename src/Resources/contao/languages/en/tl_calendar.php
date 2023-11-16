<?php

declare(strict_types=1);

/*
 * This file is part of cgoit\contao-calendar-ical-php8-bundle for Contao Open Source CMS.
 *
 * @copyright  Copyright (c) 2023, cgoIT
 * @author     cgoIT <https://cgo-it.de>
 * @license    LGPL-3.0-or-later
 */

$GLOBALS['TL_LANG']['tl_calendar']['ical_alias'] = ['iCal alias', 'Here you can enter a unique filename (without extension). The iCal subscription file will be auto-generated in the root directory of your Contao installation, e.g. as <em>name.ics</em>.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_prefix'] = ['Title prefix', 'Here you can enter a prefix that will be added to every event title in the iCal subscription.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_description'] = ['iCal description', 'Please enter a short description of the calendar.'];
$GLOBALS['TL_LANG']['tl_calendar']['make_ical'] = ['Generate iCal subscription', 'Generate an iCal subscription file from the calendar.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_source'] = ['iCal web source', 'Create a calendar from an iCal web source.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_url'] = ['iCal URL', 'Please enter the URL to the iCal .ics file.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_proxy'] = ['Proxy', 'Please specify the CURL proxy if you use Contao behind a proxy.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_bnpw'] = ['Username:Password', 'Please enter username:password for CURL proxy.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_port'] = ['Port', 'Please enter the CURL proxy port.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_filter_event_title'] = ['Filter event title', 'Please enter a string to be filtered in the title of the event.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_pattern_event_title'] = ['Pattern event title', 'Please enter a string to search for in the title of the event - see: preg_replace.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_replacement_event_title'] = ['Replacement event title', 'Please enter a string to replace in the title of the event - see: preg_replace.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_cache'] = ['Calendar cache in seconds', 'Please enter the minimum number of seconds to cache the calender data. The calendar data will be rebuilt from the iCal source when the cache time is up.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_timezone'] = ['Timezone', 'Please select a timezone that should be used if the calendar doesn\'t contain a timezone.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_start'] = ['Start date', 'Please enter the start date of the calendar. If you do not enter a date, the actual date will be taken as start date.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_end'] = ['End date', 'Please enter the end date of the calendar. If you do not enter a date, the date in one year will be taken as end date.'];
$GLOBALS['TL_LANG']['tl_calendar']['ical_legend'] = 'iCal settings';
