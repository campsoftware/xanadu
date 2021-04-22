ALTER TABLE Settings ADD AppLangCode varchar(2);
UPDATE Settings SET AppLangCode='en';

ALTER TABLE Settings ADD AppTimezoneID varchar(255);
UPDATE Settings SET AppTimezoneID='America/New_York';
