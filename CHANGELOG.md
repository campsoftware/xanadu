# Xanadu Change Log

2021-05-13-16-39-14
- Added a clickable link to the 2FA SMS and Email messages that will open a new tab to complete the Login. Works similar to the Registration One Time Code.

2021-05-13-15-34-17
- Added setting the default timezone to UTC in init.php.
- Added a function for arrayValuesWrapWith and arrayValuesWrapWithBackticks. Using to wrapping Column Names with backticks. Moved array functions higher within functions_utility.php.
- Updated dbSQL_InsertOrUpdate to use arrayValuesWrapWithBackticks. Goal is to wrap all SQL Statement Column Names with backticks everywhere possible.

2021-05-13-14-38-07
- Renamed /sql/ files from sequential numbers to dates.
- Added /sql/xan-2021-05-13.sql to add columns for constants: APP_COUNTRY_CODE, TWITTER_SITE, TWITTER_AUTHOR.
- Changed ALTER TABLE commands to use AFTER to keep table column order.
- Changed init.php to use the database values for APP_COUNTRY_CODE, TWITTER_SITE, TWITTER_AUTHOR.

2021-05-13-12-57-31
- Added constants: APP_COUNTRY_CODE, APP_LOCALE, TWITTER_SITE, TWITTER_AUTHOR. Need to add to the Settings Database Record.
- Added properties to \xan\response to support optionally adding html meta tags via \xan\respone->metaSet();
- Added \xan\respone->metaSet(); to several pages.

2021-05-11-15-09-05
- Updated Register Password Rating as a function in xan.js xanPasswordRating.
- Added User Change Password Rating using xan.js xanPasswordRating.

2021-05-11-14-10-04
- Added a simple Password Rating of Weak in red, Moderate in yellow, Strong in green.

2021-05-11-12-51-44
- Added a function dbSQL_InsertOrUpdate that creates a sql statement that will INSERT / ON DUPLICATE KEY UPDATE that will either Insert a record or Update a record if it already exists.
- Renamed a few functions to: dbSQL_InsertValuesQuestions, dbSearchTerm_SQL, dbSearchTerm_BindNamesA, dbSearchTerm_BindValuesA, dbQueryBuilder_DataType, dbQueryBuilder_FindFilter, and dbQueryOrderBy_DropdownItem.

2021-05-10-12-18-05
- Fixed an issue with quotes when displaying font icons during ajax calls.

2021-05-06-17-52-02
- Added Bootstrap Icons.
- Replaced iconFA function with fontIcon. Adds a tags parameter. Works with both Bootstrap Icons and FontAwesome.
- Planning to remove FontAwesome when to Bootstrap Icons collection is larger.
- Replaced all FontAwesome html with the equivalent fontIcon function. 
- Ranamed all "FA_" icon constant names to "FI_".
- Removed eleCard->renderListItemLink as it's now redundant.

2021-05-04-16-46-46
- Commented out XanDo javascript alert.
- Touched images and index.php.

2021-05-04-15-48-16
- Summary: Simplifying List Cards while adding options: Items Text, Items Image + Text, or a Table Row.
- Removed three functions from moduleMeta class and each subclass. Replaced with sharable moduleMeta functions.
- Added colMeta property widthForTable that defaults to empty string but can be overridden per Table Column Name.
- Added two new moduleMeta getList functions: getListItem is for text, getListItemWImage is for an image + text, and getListRow is for html tables at full page width with a default column width.
- Updated content-cards.php Lists for Contacts, Contact Picker ( image + text ), Settings-Users ( text ), and APIRequests ( html table ). It's now easy to change how Lists are displayed.

2021-05-01-18-08-00
- Added a link to the ChangeLog in the ReadMe.

2021-05-01-17-58-33
- Updated APIRequests getListItemRowHeader and getListItemRow functions to a single function getListRow as an option to getListItem.
- Updated APIRequests List Card Styles from mini/wide to items/rows.
- Updated APIRequests List Card Styles to also set the Card Width.

2021-05-01-17-06-03
- Updated APIRequests to have an option to have Mini or Wide List.

2021-05-01-16-58-12
- Updated APIRequests 100% Wide List Table to use Column Labels rather than Column Names.

2021-05-01-16-29-11
- Fixed usages of NameModule, NamePlural, and NameSingular.

2021-05-01-16-04-10
- Added, for Admins, a APIRequests Module with a 100% Wide List Table and Sticky Header Row. Left most Column has a Button with the Row Index to view Details in Cards below the list.

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
- Added /sql/xan-2021-03-02.sql which creates the starting tables and sample data.
- Added /sql/xan-2021-04-21.sql which adds Settings columns AppLangCode = 'en' and AppTimezoneID = 'America/New_York'.
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
