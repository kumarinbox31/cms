/*
|--------------------------------------------------------------------------
| Rollback: 001_add_gateway_columns_rollback.sql
|--------------------------------------------------------------------------
| WARNING:
| Execute only if no production data depends on these columns.
|--------------------------------------------------------------------------
*/

ALTER TABLE `ab_payment_data`
DROP COLUMN `reference_no`,
DROP COLUMN `failure_reason`,
DROP COLUMN `completed_at`,
DROP COLUMN `verified_at`,
DROP COLUMN `gateway_status`,
DROP COLUMN `webhook_response`,
DROP COLUMN `response_json`,
DROP COLUMN `payment_method`,
DROP COLUMN `currency`,
DROP COLUMN `gateway_payment_id`,
DROP COLUMN `gateway_order_id`,
DROP COLUMN `gateway`;
