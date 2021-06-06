ALTER TABLE Settings ADD PhoneNumber text AFTER LogoutAutoSeconds;
UPDATE Settings SET PhoneNumber='407-282-5585';

ALTER TABLE Settings ADD EmailAddress text AFTER PhoneNumber;
UPDATE Settings SET EmailAddress='xanadu@campsoftware.com';

ALTER TABLE Settings ADD AddressStreet1 text AFTER EmailAddress;
UPDATE Settings SET AddressStreet1='530 E Central Blvd';

ALTER TABLE Settings ADD AddressStreet2 text AFTER AddressStreet1;
UPDATE Settings SET AddressStreet2='Unit 205';

ALTER TABLE Settings ADD AddressCity text AFTER AddressStreet2;
UPDATE Settings SET AddressCity='Orlando';

ALTER TABLE Settings ADD AddressState text AFTER AddressCity;
UPDATE Settings SET AddressState='FL';

ALTER TABLE Settings ADD AddressZip text AFTER AddressState;
UPDATE Settings SET AddressZip='32801';

ALTER TABLE Settings ADD AddressCounty text AFTER AddressZip;
UPDATE Settings SET AddressCounty='Orange';

ALTER TABLE Settings ADD AddressLatitude text AFTER AddressCounty;
UPDATE Settings SET AddressLatitude='28.5422';

ALTER TABLE Settings ADD AddressLongitude text AFTER AddressLatitude;
UPDATE Settings SET AddressLongitude='-81.3704';