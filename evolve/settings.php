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
 * @package   theme_evolve
 * @copyright 2020 Lewis Carr
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingevolve', get_string('configtitle', 'theme_evolve'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_evolve_general', get_string('generalsettings', 'theme_evolve'));

    // Replicate the preset setting from boost.
    $name = 'theme_evolve/preset';
    $title = get_string('preset', 'theme_evolve');
    $description = get_string('preset_desc', 'theme_evolve');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_evolve', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_evolve/presetfiles';
    $title = get_string('presetfiles','theme_evolve');
    $description = get_string('presetfiles_desc', 'theme_evolve');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);
  
  
    // Wordpress header URL.
    $name = 'theme_evolve/wordpressheader';
    $title = get_string('wordpressheader', 'theme_evolve');
    $description = get_string('wordpressheader_desc', 'theme_evolve');
    $default = 'https://kpush.co.uk/external-header/';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
  
  // Wordpress footer URL.
    $name = 'theme_evolve/wordpressfooter';
    $title = get_string('wordpressfooter', 'theme_evolve');
    $description = get_string('wordpressfooter', 'theme_evolve');
    $default = 'https://kpush.co.uk/external-footer/';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_evolve/brandcolor';
    $title = get_string('brandcolor', 'theme_evolve');
    $description = get_string('brandcolor_desc', 'theme_evolve');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    // Each page is a tab - the second is the "Backgrounds" tab.
    $page = new admin_settingpage('theme_evolve_backgrounds', get_string('backgrounds', 'theme_evolve'));

    // Default background setting.
    // We use variables for readability.
    $name = 'theme_evolve/defaultbackgroundimage';
    $title = get_string('defaultbackgroundimage', 'theme_evolve');
    $description = get_string('defaultbackgroundimage_desc', 'theme_evolve');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'defaultbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_evolve_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Login page background setting.
    // We use variables for readability.
    $name = 'theme_evolve/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_evolve');
    $description = get_string('loginbackgroundimage_desc', 'theme_evolve');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_evolve_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Frontpage page background setting.
    // We use variables for readability.
    $name = 'theme_evolve/frontpagebackgroundimage';
    $title = get_string('frontpagebackgroundimage', 'theme_evolve');
    $description = get_string('frontpagebackgroundimage_desc', 'theme_evolve');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagebackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_evolve_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Dashboard page background setting.
    // We use variables for readability.
    $name = 'theme_evolve/dashboardbackgroundimage';
    $title = get_string('dashboardbackgroundimage', 'theme_evolve');
    $description = get_string('dashboardbackgroundimage_desc', 'theme_evolve');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'dashboardbackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_evolve_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // In course page background setting.
    // We use variables for readability.
    $name = 'theme_evolve/incoursebackgroundimage';
    $title = get_string('incoursebackgroundimage', 'theme_evolve');
    $description = get_string('incoursebackgroundimage_desc', 'theme_evolve');
    // This creates the new setting.
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'incoursebackgroundimage');
    // This function will copy the image into the data_root location it can be served from.
    $setting->set_updatedcallback('theme_evolve_update_settings_images');
    // We always have to add the setting to a page for it to have any effect.
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_evolve_advanced', get_string('advancedsettings', 'theme_evolve'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_evolve/scsspre',
        get_string('rawscsspre', 'theme_evolve'), get_string('rawscsspre_desc', 'theme_evolve'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_configtextarea('theme_evolve/scss', get_string('rawscss', 'theme_evolve'),
        get_string('rawscss_desc', 'theme_evolve'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
