# Changelog

All notable database and architectural changes to the payment gateway will be documented in this file.

## [Unreleased] - 2026-06-28
### Added
- Migration `001_add_gateway_columns.sql`: Added nullable tracking columns (`gateway`, `gateway_order_id`, `gateway_payment_id`, `currency`, `payment_method`, `response_json`, `webhook_response`, `gateway_status`, `verified_at`, `completed_at`, `failure_reason`, `reference_no`) to `ab_payment_data` to support the multi-gateway architecture.
- Migration `001_add_gateway_columns_rollback.sql`: Safe rollback script to drop the newly added columns.
