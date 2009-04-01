=== Runescape User Stats ===
Contributors: Rakesh Muraharishetty
Info link: http://runescape-quest.info/wordpress
Tags: runescape, runescape stats, runescape user, user stats, stats
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 1.0

Display Runescape game stats for blog users

== Description ==
A very simple plugin to add runescape game stats on any page of the wordpress blog. This plugin allows blog owner to show th stats for any user on a page and post. This plugin also allows to display multiple runescape stats. you can visit the author website <a href="http://www.rakesh.ms/">Rakesh Muraharishetty</a> to view the authors game stats. Alternatively visit the plugin homepage <a href="http://runescape-quest.info/">Runescape Guide</a> for updates and discuss the stats plugin for future enhancements.

== Installation ==

Upload the runescape-user-stats.php into your plugin folder and activate it.

Display User stats and data:
$rs_stats = $rs_get_user_stats();
echo $rs_stats->attack; // Display Attack stats
echo $rs_stats->defence; // Display Defence Stats
echo $rs_stats->hitpoints; // Display Hitpoints Stats
echo $rs_stats->prayer; // Display Prayer Stats
echo $rs_stats->strength; // Display Strength Stats

Use it to display all the skills, rank, level and XP.