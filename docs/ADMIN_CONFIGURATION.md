# Admin Configuration Reference

This document maps all configuration keys used by the Payment Gateway Evolution architecture. These keys are stored in the `ab_others` table and are configurable via the `admin/plugin/ab-payment-form?page=index` UI.

## General Settings
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `payment_default_gateway` | No | `pg-razorpay` | `hooks.php` | The gateway that is pre-selected on the frontend if the customer is allowed to choose, or the fallback gateway if not explicitly defined in the form. |
| `payment_allow_gateway_selection`| No | `No` | `hooks.php` | Determines whether the frontend displays the radio button gateway selector to the end-user. |
| `payment_logging` | No | `Yes` | `PaymentLogger` | Enables or disables transaction/webhook logging to the filesystem. |
| `payment_log_days` | No | `30` | `PaymentLogger` | The number of days logs should be retained before rotation/deletion. |

## Razorpay (Legacy)
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `pg-razorpay-val1` | Yes | `(empty)` | `hooks.php` | The legacy Razorpay Key ID. Used directly in checkout.js. |
| `pg-razorpay-val2` | Yes | `(empty)` | `createOrderApi.php` | The legacy Razorpay Secret Key. Used by legacy APIs. |

## Stripe
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `pg-stripe-enabled` | No | `(empty)` | `GatewayFactory` | Master toggle to enable Stripe as an available gateway. |
| `pg-stripe-environment` | Yes (if enabled) | `sandbox` | `StripeGateway` | `sandbox` or `production`. Validated against before payments. |
| `pg-stripe-public-key` | Yes (if enabled) | `(empty)` | `stripe.js` | The publishable key injected into the frontend. |
| `pg-stripe-secret-key` | Yes (if enabled) | `(empty)` | `StripeGateway` | The server-side secret key used to create checkout sessions. |
| `pg-stripe-webhook` | Yes (if enabled) | `(empty)` | `StripeGateway` | The webhook signing secret used to verify Stripe events. |

## Swipe
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `pg-swipe-enabled` | No | `(empty)` | `GatewayFactory` | Master toggle to enable Swipe as an available gateway. |
| `pg-swipe-environment` | Yes (if enabled) | `sandbox` | `SwipeGateway` | `sandbox` or `production`. |
| `pg-swipe-api-key` | Yes (if enabled) | `(empty)` | `SwipeGateway` | Merchant ID / API Key for Swipe. |
| `pg-swipe-secret` | Yes (if enabled) | `(empty)` | `SwipeGateway` | Secret key for Swipe API authentication. |
| `pg-swipe-webhook` | No | `(empty)` | `SwipeGateway` | Webhook secret (if applicable for Swipe architecture). |
| `pg-swipe-currency` | No | `INR` | `SwipeGateway` | Currency code used for Swipe transactions. |

## PayU (Legacy)
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `pg-payumoney-val1` | No | `(empty)` | `createPayUHash.php` | The legacy PayU Merchant Key. (Deprecated) |
| `pg-payumoney-val2` | No | `(empty)` | `createPayUHash.php` | The legacy PayU Salt. (Deprecated) |

## PayU (Modern)
| Key | Required | Default | Used By | Description |
| :--- | :--- | :--- | :--- | :--- |
| `pg-payu-enabled` | No | `(empty)` | `GatewayFactory` | Master toggle to enable Modern PayU. |
| `pg-payu-environment` | Yes (if enabled) | `sandbox` | `PayUGateway` | `sandbox` or `production`. Used to determine the `_payment` action URL. |
| `pg-payu-key` | Yes (if enabled) | `(empty)` | `PayUGateway` | Merchant Key used for hashing. |
| `pg-payu-salt` | Yes (if enabled) | `(empty)` | `PayUGateway` | Secret salt used for hashing and signature verification. |
