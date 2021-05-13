ALTER TABLE Settings ADD AppLangCode varchar(2) AFTER AppEmailFrom;
UPDATE Settings SET AppLangCode='en';

ALTER TABLE Settings ADD AppTimezoneID varchar(255) AFTER AppLangCode;
UPDATE Settings SET AppTimezoneID='America/New_York';
