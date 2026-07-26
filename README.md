# DeshiBazaar.com

**Current Version:** `v0.2.0`  
**Release Date:** 2026-07-26  
**Status:** Project Initialization

## Overview

DeshiBazaar.com is a Laos-focused digital marketplace for South Asian expatriate communities, initially serving Bangladeshi, Indian, and Pakistani customers in Laos. The platform will bring together halal-friendly and familiar grocery shopping, direct WhatsApp-assisted ordering, and remittance / currency-exchange inquiries.

> Initial service area: Vientiane, Laos. Expansion to other Lao provinces can be enabled later.

## Core Modules

1. **E-commerce Store**
   - Fresh meats: beef, mutton, and chicken
   - Spices, semai, sugar, and essential dry-food groceries
   - Product catalogue, category browsing, cart, checkout/order workflow, and delivery/pickup management

2. **Remittance / Money Exchange Inquiry**
   - LAK-to-BDT, LAK-to-INR, and LAK-to-PKR indicative exchange-rate calculator
   - Direct, WhatsApp-routed money-transfer and exchange inquiries
   - Rate source, refresh timestamp, and compliance disclaimer support

3. **WhatsApp Integration**
   - Context-aware click-to-chat links for orders, product questions, and remittance inquiries
   - Pre-filled messages containing relevant order/inquiry information

4. **Administration**
   - Secure dashboard for catalogue, pricing, inventory, orders, delivery settings, exchange-rate settings, WhatsApp routing, and site configuration
   - Application version displayed in the administration dashboard and public footer

## Proposed Technical Architecture

- **Backend / Web framework:** Laravel (current stable LTS-compatible release), PHP 8.3+
- **UI:** Blade + Livewire + Alpine.js, Tailwind CSS
- **Admin panel:** Filament (Laravel-native administration framework)
- **Database:** MySQL 8 / MariaDB 10.6+
- **Cache / queues (production):** Redis, Laravel Queue workers
- **Assets:** Vite production build
- **Authentication & authorization:** Laravel authentication with role/permission controls
- **Testing:** PHPUnit/Pest, Laravel feature tests, browser smoke tests where appropriate
- **Deployment target:** Linux VPS or cPanel-compatible PHP hosting
- **CI/CD:** GitHub Actions, GitHub Releases, production ZIP artifacts

## Project Structure (Planned)

```text
DeshiBazaar.com/
├── app/
│   ├── Domain/                 # Business modules and domain services
│   │   ├── Catalog/
│   │   ├── Orders/
│   │   ├── Remittance/
│   │   └── WhatsApp/
│   ├── Filament/               # Admin resources, pages, widgets
│   ├── Http/                   # Controllers, middleware, requests
│   ├── Jobs/                   # Background jobs
│   ├── Models/                 # Eloquent models
│   └── Services/               # Integrations and application services
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── docs/                       # Architecture, deployment, API and operational docs
├── public/                     # Web root and compiled public assets
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                  # Storefront, checkout and email views
├── routes/
│   ├── web.php
│   └── console.php
├── scripts/                    # Release, packaging and deployment helper scripts
├── storage/
├── tests/
├── .github/workflows/          # CI and release workflows
├── README.md
└── VERSION                     # Canonical application version
```

## Initial Data Model (Planned)

| Area | Principal tables |
|---|---|
| Identity & administration | `users`, `roles`, `permissions`, `model_has_roles`, `settings`, `activity_logs` |
| Catalogue | `categories`, `products`, `product_images`, `product_variants`, `inventory_movements` |
| Shopping & orders | `carts`, `cart_items`, `orders`, `order_items`, `order_status_histories`, `delivery_zones`, `delivery_slots` |
| Customers | `customers`, `addresses` |
| Payments | `payment_methods`, `payment_records` (initially order/payment-status tracking; gateways can be added later) |
| Exchange/remittance | `exchange_rates`, `rate_sources`, `remittance_inquiries`, `remittance_inquiry_events` |
| WhatsApp | `whatsapp_routing_rules`, `whatsapp_interactions` |
| Content/configuration | `pages`, `banners`, `site_settings` |

All monetary fields will use fixed-precision decimal values, never floating-point values. Personal data and inquiry records will use least-privilege access controls and auditable administration actions.

## Versioning Policy

DeshiBazaar.com follows **Semantic Versioning** (`MAJOR.MINOR.PATCH`):

- **PATCH** — bug fixes, security fixes, and minor UI refinements (for example, `v0.1.1`)
- **MINOR** — backward-compatible new features or modules (for example, `v0.2.0`)
- **MAJOR** — incompatible architectural or product changes (for example, `v1.0.0`)

The canonical version will be stored in `VERSION` and surfaced in both the public footer and Admin Dashboard. Each release updates this README with its version, release date, and changelog.

## Release & Packaging Policy

Every release will:

1. Validate the requested SemVer tag.
2. Update the canonical version, visible application version, and this README.
3. Run quality checks and production asset compilation.
4. Create a production deployment ZIP containing application source, compiled assets, Composer production dependencies, and deployment documentation.
5. Exclude development-only files and dependencies, including `node_modules`, test suites, local environment files, caches, logs, and repository metadata.
6. Commit release metadata, create and push a signed/annotated Git tag, and publish a GitHub Release with the ZIP attached.

Secrets such as `.env`, API credentials, WhatsApp credentials, and database credentials will **never** be packaged or committed. A safe `.env.example` will be included instead.

## Changelog

### v0.2.0 — 2026-07-26
**Repository Foundation & Automated Release Setup**

- Added Git repository ignore rules tailored for Laravel, PHP tooling, Node assets, runtime files, and local release archives.
- Added canonical `VERSION` tracking and Laravel configuration helper for displaying the application version.
- Added tag-triggered GitHub Actions release pipeline for production dependency installation, asset compilation, ZIP bundling, and GitHub Release publishing.
- Added a reusable production packaging script that excludes development dependencies, tests, secrets, Git metadata, and runtime-generated files.

### v0.1.0 — 2026-07-26
**Project Initialization**

- Established DeshiBazaar.com product scope for South Asian expats in Laos.
- Defined planned e-commerce, exchange/remittance inquiry, WhatsApp, and administration modules.
- Defined the initial Laravel-based architecture and data-model outline.
- Established Semantic Versioning, release packaging, and GitHub Release workflow requirements.

## Development Status

No functional application code has been generated in this initialization release. Development proceeds only in approved, small sequential steps.

## License

Proprietary — all rights reserved unless a future project decision specifies otherwise.
