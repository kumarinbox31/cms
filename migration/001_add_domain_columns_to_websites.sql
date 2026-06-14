ALTER TABLE `ab_websites`
ADD COLUMN `domain_type` ENUM('domain', 'subdomain') NOT NULL DEFAULT 'domain' AFTER `domain`,
ADD COLUMN `cpanel_account` VARCHAR(100) NULL AFTER `domain_type`,
ADD COLUMN `addon_status` VARCHAR(50) NOT NULL DEFAULT 'Missing' AFTER `cpanel_account`,
ADD COLUMN `dns_status` VARCHAR(50) NOT NULL DEFAULT 'Pending' AFTER `addon_status`,
ADD COLUMN `last_checked` DATETIME NULL AFTER `dns_status`,
ADD COLUMN `last_error` TEXT NULL AFTER `last_checked`,
ADD COLUMN `health_score` INT(3) NOT NULL DEFAULT 0 AFTER `last_error`;
