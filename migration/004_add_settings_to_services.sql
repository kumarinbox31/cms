-- Migration to add a dedicated settings column to the services tables
-- This ensures we don't truncate the desc column when saving large JSON payloads

ALTER TABLE `ab_services` ADD COLUMN `settings` LONGTEXT NULL AFTER `desc`;

-- Fix any corrupted truncated JSON from the previous attempt in the desc column
UPDATE `ab_services` SET `desc` = 'formio' WHERE `desc` LIKE '{"type":"formio"%';
