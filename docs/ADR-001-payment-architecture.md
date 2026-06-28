# ADR-001: Payment Gateway Evolution Architecture

## Status
Accepted

## Context
The CMS currently supports payments via the `ab-payment-form` plugin. The implementation for Razorpay is heavily coupled to procedural files (`hooks.php`, `createOrderApi.php`, `verifyPaymentApi.php`) and inline JavaScript. PayU is only partially implemented and its webhooks are incomplete. There is a business requirement to integrate Stripe, Swipe, and fully operationalize PayU without breaking existing Razorpay transactions.

A standard "Rewrite Strategy" was considered but rejected due to the risk of breaking existing CMS customers who rely heavily on the current Razorpay implementation.

## Decisions

### 1. Evolution Strategy Over Rewrite
We have decided to adopt an **Evolution Strategy**. The legacy Razorpay flow will remain 100% untouched. New gateways (Stripe, Swipe, PayU) will be built on a new modern architecture (`PaymentManager`, `GatewayFactory`, etc.) that operates in parallel to the old one.
**Reason:** This guarantees backward compatibility and prevents regressions in live production environments.

### 2. Gateway-Driven Routing
We rejected a global "Use New Payment Engine" toggle in favor of gateway-driven routing. 
**Reason:** If the routing is based on the selected gateway, existing Razorpay checkouts are guaranteed never to hit the new code paths. This is safer than a global switch.

### 3. Database: Unchanged `status` Enum
The `ab_payment_data` table's `status` enum (`pending`, `success`, `failed`) will remain strictly unchanged. All new granular states (e.g., `AUTHORIZED`, `PROCESSING`, `REFUNDED`) will be stored in a new nullable `gateway_status` column.
**Reason:** Modifying the original `status` enum risks breaking existing administrative reports, filters, queries, and plugin integrations that expect only the original three states.

### 4. Interface Segregation for Gateways
We chose a minimal `PaymentGatewayInterface` supplemented by capability interfaces (e.g., `RefundableGatewayInterface`, `CaptureGatewayInterface`) instead of a massive god-interface.
**Reason:** Not all gateways support manual capture, refunds, or cancellations. Enforcing methods that throw "Not Supported" exceptions violates the Interface Segregation Principle.

### 5. Thin TransactionService
A `TransactionService` will handle all database persistence logic, while the `PaymentManager` handles pure orchestration.
**Reason:** Separating API orchestration from database querying prevents the `PaymentManager` from becoming a monolithic god-class and enables easier unit testing.

## Consequences
- **Positive:** Zero risk to current Razorpay transactions.
- **Positive:** A robust, modern framework is established for all future gateways.
- **Negative:** We will temporarily maintain two payment architectures (the procedural legacy one and the modern object-oriented one) until a future migration phase officially retires the legacy system.
