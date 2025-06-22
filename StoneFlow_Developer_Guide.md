# StoneFlow Plugin Developer Guide

## Overview

StoneFlow is a custom-built WordPress plugin designed to manage client onboarding, service delivery, and AI-powered assistant support through a user-friendly admin dashboard. It includes modular components for clients, admins, services, and an AI assistant (S.T.O.N.E.).

## Plugin Structure

```
stoneflow-plugin/
│
├── core/                          # Core plugin functionality
│   ├── stoneflow.php              # Main plugin file (entry point)
│   ├── init.php                   # Initialization and hooks
│   └── menu.php                   # Admin menu and navigation setup
│
├── modules/
│   ├── client/
│   │   ├── client-manager.php     # Admin panel to manage clients
│   │   ├── client-profile.php     # Detailed profile view
│   │   └── client-helpers.php     # Helper functions
│   │
│   ├── admin/
│   │   ├── admin-notes.php        # Admin note-taking features
│   │   ├── dashboard-widgets.php  # Custom widgets and alerts
│   │
│   ├── services/
│   │   ├── service-manager.php    # Queue and service handling
│   │   ├── service-view.php       # Detail pages for services
│   │   └── addons.php             # Add-on features like Rush Priority
│   │
│   ├── stone/
│   │   ├── ai-assistant.php       # Core AI interaction
│   │   ├── discovery-flow.php     # 3-stage conversational onboarding
│   │   ├── recommend-services.php # Service suggestions based on answers
│   │   └── stoneflow-commands.php # Backend integration commands
│
├── templates/
│   ├── profile-view.php           # Client profile frontend
│   └── dashboard.php              # Admin dashboard UI
│
├── assets/
│   ├── css/                       # Stylesheets
│   ├── js/                        # JavaScript for interactivity
│   └── images/                    # Icons, logos, etc.
│
├── readme.md
└── stoneflow.sql                 # SQL setup for tables
```

## Panels and Features

### Admin Dashboard
- View key statistics
- Track queued services
- Quick links to all panels

### Client Manager
- Add, edit, delete clients
- View full client profile
- Add internal notes

### Client Profile Panel
Displays and allows editing of:
- Name, email, phone, billing info
- Business details (name, address, FB/website)
- Discovery answers and preferences
- Time zone and local time

### Services Manager
- List and manage service queue
- Status tracking (queued, in progress, completed)
- File uploads and downloads
- Add-ons like “Jump The Queue”

### S.T.O.N.E. (AI Assistant)
- Conversational 3-stage onboarding
- Gathers all relevant data
- Saves data to correct fields
- Suggests services with links to purchase
- Services added to queue upon PayPal payment confirmation

## Workflow

1. Client registers on site
2. S.T.O.N.E. begins onboarding:
   - Stage 1: Contact Info
   - Stage 2: Goals and Services Needed
   - Stage 3: Preferences, Budget, Timeline
3. Info is saved and visible in Admin Profile view
4. AI suggests relevant services
5. Client can purchase services
6. Payment confirmation adds task to queue
7. Admin delivers service and uploads final files

## Payment & Automation

- PayPal integration for service purchases
- Rush Priority add-on available at checkout
- Status automation for queue management

## Future Additions

- Smart Client Dashboard (progress tracker, next steps)
- Internal knowledge base (for admin + AI)
- Notification system
- Analytics and service reporting

---

**Maintainer**: Danni Stone  
**Repository**: [github.com/dannistoneca/stoneflow-plugin](https://github.com/dannistoneca/stoneflow-plugin)