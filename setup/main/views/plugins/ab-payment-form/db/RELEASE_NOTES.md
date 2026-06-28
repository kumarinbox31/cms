# Release Notes

## Version 1.0 (Upcoming)

**Payment Gateway Evolution**

This release introduces a new, extensible parallel payment architecture designed to support Stripe, Swipe, and modernized PayU, while leaving the legacy Razorpay implementation 100% untouched to guarantee zero revenue disruption.

### Features
- **Multi-Gateway Support**: Adds support for Stripe and Swipe.
- **PayU Modernization**: Transitions PayU to a secure backend-hashing model.
- **Parallel Routing**: Introduces `PaymentManager` to handle all new gateway requests without interfering with legacy procedures.
- **Centralized Webhooks**: All new gateways route callbacks through a unified, idempotent webhook handler (`api/webhook.php`).

### Database Changes
Requires execution of `db/001_add_gateway_columns.sql`. The migration is purely additive and does not modify existing columns or the `status` enum.

### Deployment Instructions
Please see the Formal Engineering Verification & Sign-off Report for the comprehensive 10-step deployment pipeline, rollback procedures, and the mandatory Go/No-Go regression matrix.
