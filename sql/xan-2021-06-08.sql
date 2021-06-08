ALTER TABLE Users ADD TwoFactorViaPhone2FA varchar(3) DEFAULT 'Yes' AFTER TwoFactorExpiresTS;
UPDATE Users SET TwoFactorViaPhone2FA='Yes';

ALTER TABLE Users ADD TwoFactorViaEmail varchar(3) DEFAULT 'Yes' AFTER TwoFactorViaPhone2FA;
UPDATE Users SET TwoFactorViaEmail='Yes';