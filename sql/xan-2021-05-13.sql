ALTER TABLE Settings ADD AppCountryCode varchar(2) AFTER AppLangCode;
UPDATE Settings SET AppCountryCode='US';

ALTER TABLE Settings ADD TwitterSite text AFTER FormatDisplayTime;
UPDATE Settings SET TwitterSite='@CampSoftware';

ALTER TABLE Settings ADD TwitterAuthor text AFTER TwitterSite;
UPDATE Settings SET TwitterAuthor='@HalGumbert';