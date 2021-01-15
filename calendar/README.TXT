Version: 0.8.20080808

For first time installation, please refer to the installation section. For upgraders, please refer to the upgrade section.

------------
INTRODUCTION
------------
Calendarix is
- a powerful and easy to use calendar based on PHP and MySQL.
- developed under windows environment and tested with IE6.0 and Firefox 2.0 browser but should work on unix platforms too.

Its features include
- multiple calendar views in day, week, month and by categories.
- login for users to view calendar with login for administrators with special administration module.
- widely configurable in colors, font and functions.
- search through events for text.
- able to enter events with a repeat event feature.
- user auditing of event entries.
- quick navigation of calendar over days, weeks and months through drop-down quick selection boxes.
- approval of events can be enabled/disabled.

Language support is currently Arabic, Basque, Catalan, Chinese, Czech, Danish, Dutch, English, Finnish, French, Galician, German, Greek, Hungarian, Indonesian, Italian, Norwegian, Polish, Portuguese, Romanian, Russian, Slovenian, Spanish, Swedish, Turk and Valencian.  If you like this program and would not mind translating the contents, you can just add your translation files in the "cal_languages" folder. The menu items in the Admin Calendar can be translated in the menu_item.js file. Do let me know of your translations.

To use the calendar
- just follow the installation instructions in the section below.
- if you are required to login to view the public calendar, username:'test', password:'testing'.
- for login into the administration, username:'admin', password:'admin'.

-------------
INSTALLATION
-------------
* unzip the file
* Import the "create_cal.sql" in the "admin" folder into your mysqldatabase
  console : mysql -u username -p
	    create calendar; (if necessary change the name)
	    use calendar;
	    source create_cal.sql;
	    quit;
  phpMyAdmin : go to the database and import the sql file.	    

Open "cal_db.inc.php" and check the database references. 
* Check that the database name, database login name, password and host are correct. Make the necessary changes and save the file as "cal_db.inc.php".

Customize the calendar controls with the file "cal_config.inc.php" and the text and colors with the files "default.css", "default.color.php" and "default.menu.css" in the themes folder.

You can customise the login page for calendarix by editing the html files "callogin_top.html" and "callogin_bottom.html".

Change the theme for the calendar display by setting the $theme variable in the cal_config.inc.php file. eg. $theme = 'fire';

Be sure to allow access to the sub-directories under your calendarix path.


---------
UPGRADING
---------
This version shares the same database configuration as versions 0.5, 0.6, 0.7, 0.8. However, there have been many changes made on all the scripts and theme files. Therefore, all the scripts and theme files have to be replaced. If you have made changes on the theme files or created your own themes, you can do a comparison on the files and add the new attributes. The cal_db.inc.php file also needs to be replaced and reconfigured.

---------
MINI-CALENDAR
---------
A file "minical.php" is available for providing a mini-calendar to be embedded in website.  It uses overlib support to provide a summary of events in the mini-calendar.  To include the mini-calendar in a page, use the following code:
<?php include("minical.php"); ?>

However, note that the mini-calendar also relies on the files used by Calendarix so they are put in the same path.  Edit the include paths in "minical.php" if you wish to move the "minical.php" to another location.  

You may want to delete "minical.php" if you do not use it as it can be called by users directly to view the mini-calendar.

--------
LICENSE
--------
This application is free for you to use and modify. However, it should not be sold as a commercial product nor be part of a commercial product without first getting my permission.   

THIS SOFTWARE IS PROVIDED ''AS IS'' AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE CALENDARIX DEVELOPMENT TEAM OR ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

overLIB 4.21 (c) is written by Erik Bosrup and is used in Calendarix.  For more information about overLib and its licensing, please visit http://www.bosrup.com/web/overlib/.

------------------------------
Any bugs or feature request ?
------------------------------
mail to webmaster@calendarix.com
http://www.calendarix.com

You can also check out the forum at http://www.calendarix.com/forum

If you need someone to host this calendar for you, you can contact me too.
I am still working on improving and adding more features into this application.  


Copyright © 2002-2008 Vincent Hor
