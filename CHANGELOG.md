# Xanadu Change Log

2021-05-01-15-06-37
- Removed AutoLogout HTML Meta Refresh tag and replaced with a Javascript function that can push the Logout time out after AJAX calls.

2021-04-29-16-33-46
- Updated Stats Sessions to first look in ini_get( 'session.save_path' ) and then /tmp/. If no sessions found, now shows "$sessionsPath: /var/lib/php/sessions/ does not seem to be accessible."
- Changed the Stats Card order to show Sessions above Process Pools.

2021-04-29-15-31-29
- Added Stats Versions for OS, PHP, and wkHTMLtoPDF. Added section dividers.
- Fixed Processes values that were off by one row.

2021-04-29-14-36-51
- Updated references to GET and POST parameters for ID within comments.
- Fixed the missing $ for 'mmUsersT->NameSingular'.

2021-04-29-13-54-22
- Updated references to GET and POST parameters for ID to use metaModule property NameTableParam.
- Fixed case on api-process-queued Semaphore Error Messages.

2021-04-28-20-11-42
- Added functions-utility.php function paramDecodeQuotes to decode just quotes.
- Update eleSearchBarListDB to remove an extra parameter.
- Fixed eleSearchBarListDB Simple Query and Query Builder as both stopped working.
- Fixed eleSearchBarListDB so Table Keys and Mod Columns would not appear in Query Builder.
- Added metaModule property NameTableParam used for GET and POST params.
- Updated mmCheckout.php as it was missed.

2021-04-27-13-01-06
- Updated page-resp.php to make UTF-8 be capitalized.
- Update API calls to follow redirects.

2021-04-25-16-16-44
- Added API Handling. Can process immediately or queue!

2021-04-22-17-08-26
- Added a xanDo javascript alert function.
- Touched images, index.php, loading.php, and router.php for OCD reasons.

2021-04-22-17-02-04
- Updated Home Location button to use backticks for Javascript quotes. Will be using backticks more!

2021-04-22-15-42-07
- Added example code for hourofDay function.
- Added /sql/xan-00001.sql which creates the starting tables and sample data.
- Added /sql/xan-00002.sql which adds Settings columns AppLangCode = 'en' and AppTimezoneID = 'America/New_York'.
- Added in init.php constants for AppLangCode and AppTimezoneID to be loaded from Settings.

2021-04-22-14-21-34
- Added hourOfDayFunction( $timezoneID ) function. Used to prevent or permit running code at specified hours.

2021-04-20-18-52-51
- Renamed Array Variable to fix naming standard.

2021-04-20-18-44-47
- Removed all references to Tenant Table, Primary Keys, and SQL Statements.

2021-04-20-15-29-03
- Added function strAsciiSum used for PHP Semaphores.

2021-04-13-12-07-24
- Fixed the Stripe include after inserting the incorrect script.
- Fixed formatting of PHP Auto Logout Meta tag, PHP XSS Header, and PHP Stripe script include.

2021-04-12-18-20-41
- Updated Stripe to include its javascript on request rather than all the time.

2021-04-12-15-08-40
- Updated the init file loader to use HTTP_HOST instead of SERVER_NAME to load 'init_DOMAIN.php'.
- Updated the init file loader to use __DIR__ instead of dirname( __FILE__ ). Both are equivalant.
- Updated upload.php to use permissions 775 instead of 777 when creating directories.

2021-04-11-16-41-05
- Moved the directories logs|brief|bucket to files/DOMAIN/logs|brief|bucket to separate between instances.
- Updated Bucket Upload to use the new folder structure.

2021-04-10-17-15-30
- Updated XSS to use a Header rather than a Meta tag as Headers work with 'frame-ancestors'.
- Updated the database settings from a hardcoded 'init_private.php' to look for a file based on the domain name like 'init_xanadu.xanweb.app.php'. A basic text 404 message is shown if the domain doesn't match an existing file.

2021-04-07-10-24-21
- Updated Darkly css to comment out Google Font 'Lato' to prevent XSS notfications when Google Fonts is not approved. Darkly is for Dark Mode and from https://bootswatch.com

2021-04-06-17-35-18
- Update Reload and XSS formatting.

2021-04-06-13-08-08
- Disabled Google Fonts from XSS after news from the EFF: https://twitter.com/EFF/status/1378813625960427521
- Updated the Session Updated and Expires timestamps comment.

2021-04-06-12-40-26
- Disabled Google Fonts after news from the EFF: https://twitter.com/EFF/status/1378813625960427521

2021-04-01-16-45-40
- Updated XSS Content-Security-Policy frame-ancestors to none.
- Updated the mobile / narrow window hamburger menu to appear correctly appear in light and dark mode.
- Updated xanLocationGet err.code = 2 message to help Mac Safari users enable Locations Services permissions.

2021-03-31-16-50-10
- Updated xanDo and xanDoSave so xanMessage to show an icon immediately and when done, a success or error messages is shown. On success, the icon and message fades out. Now uses a table for formatting.
- Added sendSMSDebug function and constant for APP_SMS_TO_DEBUG. Moved the debug constants to init_private.php. Needed this to find a pesky error.
- Added Logging PHP errors to a file in the logs folder.
- Error fixed. Icon constants FA_SORT_ASC and FA_SORT_DESC were missing.
- Added Session values for Path and Info in router.php.

2021-03-29-18-23-26
- Contacts: Fixed Table Row incrementer.
- Contacts: Fixed missing ": " in NameUpdate.
- Encoded the $aloe_request->path_get() and $aloe_request->path_components_get().
- Updated xanMessage for xanDo and xanDoSave with larger icons and fix spacing in the javascript console.
- Updated Users nameUpdate to use NameFull.

2021-03-29-17-14-52
- Replaced $tableRowIndex++ with ++$tableRowIndex to increment inline.

2021-03-29-16-58-56
- Added a preceding backslash before all usages of xan.

2021-03-29-16-51-17
- Moved xan.js from /include to /xan.

2021-03-29-16-28-15
- Replaced usages of $_POST with $aloe_request->post.
- Replaced usages of \xan\valuePOST with \xan\paramEncode.
- Removed the functions \xan\valuePOST and \xan\valueGET.

2021-03-29-12-40-45
- Updated paramEncode to accept a value or an array.
- Fixed XSS Error regarding frame-ancestors by adding the site url.