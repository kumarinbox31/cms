# Database Migrations

This folder contains all database migrations related to the modern payment gateway architecture.

## Migration Order

001_add_gateway_columns.sql

## Rollback

001_add_gateway_columns_rollback.sql

## Rules

- Never modify an existing migration after it has been committed.
- Create a new migration for every database change.
- Migrations must be additive whenever possible.
- Existing production schema must never be modified destructively.
- Rollback scripts are for emergency use only and should not be executed if production data exists in the new columns.
