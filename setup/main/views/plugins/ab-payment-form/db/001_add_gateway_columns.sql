/*
|--------------------------------------------------------------------------
| Migration: 001_add_gateway_columns.sql
|--------------------------------------------------------------------------
| Purpose:
|   Add non-breaking gateway-specific columns to ab_payment_data.
|
| Notes:
|   - Purely additive migration.
|   - Existing status enum is NOT modified.
|   - Safe for existing Razorpay implementation.
|--------------------------------------------------------------------------
*/

ALTER TABLE `ab_payment_data`
ADD COLUMN `gateway` VARCHAR(50) NULL AFTER `status`,
ADD COLUMN `gateway_order_id` VARCHAR(100) NULL AFTER `gateway`,
ADD COLUMN `gateway_payment_id` VARCHAR(100) NULL AFTER `gateway_order_id`,
ADD COLUMN `currency` VARCHAR(10) NULL AFTER `gateway_payment_id`,
ADD COLUMN `payment_method` VARCHAR(50) NULL AFTER `currency`,
ADD COLUMN `response_json` LONGTEXT NULL AFTER `payment_method`,
ADD COLUMN `webhook_response` LONGTEXT NULL AFTER `response_json`,
ADD COLUMN `gateway_status` VARCHAR(50) NULL AFTER `webhook_response`,
ADD COLUMN `verified_at` TIMESTAMP NULL DEFAULT NULL AFTER `gateway_status`,
ADD COLUMN `completed_at` TIMESTAMP NULL DEFAULT NULL AFTER `verified_at`,
ADD COLUMN `failure_reason` TEXT NULL AFTER `completed_at`,
ADD COLUMN `reference_no` VARCHAR(100) NULL AFTER `failure_reason`;
