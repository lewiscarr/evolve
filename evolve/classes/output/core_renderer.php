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
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_evolve
 * @copyright  2020 Lewis Carr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_evolve\output;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * Note: This class is required to avoid inheriting Boost's core_renderer,
 *       which removes the edit button required by Classic.
 *
 * @package    theme_evolve
 * @copyright  2020 Lewis Carr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \core_renderer {

  public function wordpressheader() {
        global $PAGE;
        $wordpressheader = '';
        $wordpressheader = file_get_contents($PAGE->theme->settings->wordpressheader);
  
    return $wordpressheader;
    }
  
   public function wordpressfooter() {
        global $PAGE;
        $wordpressfooter = '';
        $wordpressfooter = file_get_contents($PAGE->theme->settings->wordpressfooter);
  
    return $wordpressfooter;
    }
  
  
  public function myifadmin() {
 global $CFG;
    $myifadmin = '';
 
   if (is_siteadmin())
{
     $myifadmin = '<a href="'.$CFG->wwwroot.'/admin/search.php"><button>Site Admin</button></a>';
} 
     return $myifadmin;

}
  
  
}




