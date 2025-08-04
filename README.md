# FAAN Foundation Website - Architecture Summary

## Overview
The FAAN Foundation website is built with Laravel 12 and deployed at `preview.faanecuador.org`. It supports bilingual content (English/Spanish) with dynamic routing, form submissions, and comprehensive data tracking.

## Routing Structure

### Language Management
- **Route**: `/set-language/{locale}`
- **Method**: GET
- **Purpose**: Switches site language between English ('en') and Spanish ('es')
- **Implementation**: Sets session locale and redirects back to previous page
- **Middleware**: None (direct route)

### API Routes (Prefix: `/api`)
All API routes are handled by `FaanDataController`:

1. **Navigation Data**
   - `/api/navigation` - Get basic navigation structure
   - `/api/navigation/{language}` - Get navigation with language-specific names

2. **Analytics & Data**
   - `/api/submitted-data/stats` - Get form submission statistics
   - `/api/submitted-data/recent/{limit?}` - Get recent submissions (default limit: 10)
   - `/api/analytics/count` - Get analytics record count

### Main Application Routes
All main routes use the `SetLocale` middleware for language detection:

1. **Homepage**
   - **Route**: `/`
   - **Method**: GET
   - **Controller**: `PageController@home`
   - **Purpose**: Displays homepage with dynamic content

2. **Form Submission Routes**
   - **Contact Form**: `POST /contact` → `PageController@submitContact`
   - **Donation Forms**: `POST /donations` → `PageController@submitDonation`

3. **Dynamic Page Route**
   - **Route**: `/{path}` (catch-all)
   - **Method**: GET
   - **Controller**: `PageController@show`
   - **Purpose**: Handles all dynamic page routing based on content structure

4. **Development/Testing Routes**
   - `/recaptcha-test` - reCAPTCHA testing interface

## Controllers

### PageController (Primary Controller)
**Location**: `app/Http/Controllers/PageController.php`

**Key Methods**:

1. **show($path)** - Dynamic page display
   - Handles all page routing based on content structure
   - Loads content sections from `resources/content/`
   - Manages navigation and language-specific content

2. **home()** - Homepage handler
   - Special handling for homepage content
   - Navigation processing with language support

3. **submitContact(Request $request)** - Contact form submission
   - **Validation**: name, email, subject, message, reCAPTCHA
   - **reCAPTCHA Action**: 'contact_submit' (threshold: 0.5)
   - **Database**: Stores in `submitted_data` table as type 'contacts'
   - **Email**: Sends via SendGrid to administrators
   - **Response**: Success message with redirect back

4. **submitDonation(Request $request)** - Donation form submission
   - Handles both regular donations and legacy giving
   - **Regular Donation Validation**: name, email, donation_amount, donation_type, consent, reCAPTCHA
   - **Legacy Giving Validation**: name, phone, doc_num, email, address, donation_type, donation_info, consent, reCAPTCHA
   - **reCAPTCHA Actions**: 'donation_submit' or 'legacy_giving_submit' (threshold: 0.5)
   - **Database**: Stores as 'donations' or 'legacy_giving' type
   - **Email**: Sends detailed information via SendGrid
   - **Response**: Success message with optional donation modal display

### FaanDataController (API Controller)
**Location**: `app/Http/Controllers/FaanDataController.php`

**Purpose**: Provides API endpoints for navigation, statistics, and data retrieval
**Key Methods**:
- `getNavigation()` - Navigation structure
- `getNavigationByLanguage($language)` - Language-specific navigation
- `getSubmittedDataStats()` - Form submission statistics
- `getRecentSubmissions($limit)` - Recent form submissions
- `getAnalyticsCount()` - Analytics data count

## Pages with Forms

### 1. Contact Us Pages
**Routes**: `/contact-us`, `/contact-us-page`, `/contáctanos`
**Form Location**: Both `ContactUs.blade.php` and `ContactUsPage.blade.php`
**Form Action**: `POST /contact` (`contact.submit`)
**Controller Method**: `PageController@submitContact`

**Form Fields**:
- Name (required)
- Email (required)
- Subject (required)
- Message (required)
- reCAPTCHA v3 (hidden, action: 'contact_submit')

### 2. Donations Page
**Routes**: `/donations`, `/donaciones`
**Form Location**: `DonationsPage.blade.php`
**Form Action**: `POST /donations` (`donations.submit`)
**Controller Method**: `PageController@submitDonation`

**Form Fields**:
- Name (required)
- Email (required)
- Donation Amount (required, numeric, minimum: $0.01)
- Donation Type (required): 'credit', 'transfer', or 'pickup'
- Consent checkbox (required)
- reCAPTCHA v3 (hidden, action: 'donation_submit')

**Post-Submission**: Shows donation modal with instructions based on selected type:
- **Credit**: PayPal payment instructions with QR codes
- **Transfer**: Ecuadorian bank transfer information
- **Pickup**: Volunteer coordination information

### 3. Legacy Giving Page
**Routes**: `/legacy-giving`, `/donaciones-testamentarias`
**Form Location**: `LegacyGiving.blade.php`
**Form Action**: `POST /donations` (`donations.submit`)
**Controller Method**: `PageController@submitDonation` (with type='legacy_giving')

**Form Fields**:
- Legal Name (required)
- Phone (required)
- Document Number (required)
- Email (required)
- Address (required)
- Special Instructions (optional)
- Recognition Checkbox (optional)
- Donation Type (required): 'fixed', 'percentage', or 'specific'
- Donation Information (required, varies by type)
- Consent checkbox (required)
- reCAPTCHA v3 (hidden, action: 'legacy_giving_submit')

## Form Processing Architecture

### Validation
- All forms use Laravel's built-in validation
- reCAPTCHA v3 validation with custom `RecaptchaV3Rule`
- Field-specific validation rules with multilingual error messages

### Data Storage
- **Database Model**: `SubmittedData`
- **Table**: `submitted_data`
- **Storage Format**: JSON in `rec` column
- **Tracking**: Unique ID generation with `uniqid()`
- **Metadata**: IP address, user agent, timestamp tracking

### Email Notifications
- **Service**: `SendGridService` (`app/Services/SendGridService.php`)
- **Recipients**: 
  - Production: `info@FAANecuador.org`
  - Development: `castoware@gmail.com`
- **Features**:
  - HTML formatted emails
  - Reply-to donor email for easy response
  - Tracking ID inclusion
  - Email response logging

### Security Features
- **reCAPTCHA v3**: All forms protected with action-specific verification
- **CSRF Protection**: Laravel CSRF tokens on all forms
- **Input Sanitization**: Laravel validation and sanitization
- **Data Encryption**: Sensitive data stored as JSON in database

## Content Management

### Content Structure
- **Location**: `resources/content/{language}/{page}/sections/`
- **Format**: HTML files with dynamic content
- **Languages**: English (`en`) and Spanish (`es`)
- **Dynamic Loading**: Content loaded based on URL and language

### Supported Placeholders
- `{{language}}` - Replaced with current locale in external URLs
- Content sections loaded dynamically per page

## Middleware

### SetLocale Middleware
- **Purpose**: Automatically detects and sets application locale
- **Applied to**: All main application routes (not API routes)
- **Detection**: Based on URL segments, session, or browser preferences
- **Fallback**: English ('en') as default

## Database Models

### SubmittedData Model
- **Purpose**: Stores all form submissions
- **Types**: 'contacts', 'donations', 'legacy_giving'
- **Key Fields**:
  - `type` - Form type identifier
  - `_id` - Unique tracking ID
  - `rec` - JSON data storage
  - `send_response` - Email sending response log

### Navigation Model
- **Purpose**: Manages site navigation structure
- **Features**: Hierarchical structure with parent-child relationships
- **Language Support**: Separate name fields for English and Spanish

## Environment Configuration

### Production Settings
- **Domain**: `preview.faanecuador.org`
- **reCAPTCHA**: v3 with domain-specific keys
- **Email**: SendGrid SMTP with production credentials
- **Database**: MariaDB with encrypted sensitive data

### Key Environment Variables
- `RECAPTCHA_V3_SITE_KEY` / `RECAPTCHA_V3_SECRET_KEY`
- `SENDGRID_API_KEY`
- `MAIL_FROM_ADDRESS` / `MAIL_FROM_NAME`
- Database connection settings

## Deployment Notes

### Production Considerations
- All forms functional with proper validation
- reCAPTCHA v3 working correctly on subdomain
- SendGrid email delivery operational
- News banner with cookie-based persistence
- Comprehensive logging and error handling

### Maintenance
- Form submissions logged to Laravel logs
- Email responses tracked in database
- Error handling with user-friendly multilingual messages
- Input preservation on validation errors

### Deployment
The site is currently deployed on my Hostinger server. I have two deployment methods I use. 

My preference is to log into the Hostinger server via SSH, clone the github repo, manually upload the .env.production file, then edit it on the server if necessary and rename it to .env, then run the "deploy-hostinger" script in composer.json

However, sometimes that's not feasible for one reason or another, so I upload everything except the node_modules & vendor directories via FTP, upload the .env.production file & edit on the server if necessary and rename it to .env, then I run the "deploy-hostinger" script.

One thing to note is that if anything in the javascript changes, you have to run `npm run build` in the project root prior to uploading or pulling from git because the Hostinger server doesn't have npm installed.

When using the git method, after the initial deployment, I just push any changes I make to the git repo, then log in via SSH and run a git pull on the server.

> #### Full Disclosure:
> This site was originally written with a vanilla PHP backend and a Quasar/Vue3 frontend.
>
> In 2025, I started working with Laravel. I still use Quasar/Vue3, but I opted to use Blade templates for this project because they're easier to maintain.
>
> Rather than deal with the tedium of converting it all by hand, I used VS Code's Copilot and had it do all the heavy lifting with some guidance and tweaks from me along the way to keep it on track and improve the user experience where I could.
>
> So, if you see anything in this code that looks odd or generic, it's because it was ~90% AI generated. I'm quite satisfied with the results, but I want any future developers who work on this to understand why things might seem odd in places. I likely would have made different choices about how to handle some aspects of the site, but I'm not going to try to "fix" something that works.
>
> You can see the summary of the conversion process in /SESSION_SUMMARY.md, which is where I had Copilot track its progress so I could easily resume when I had to take a break from the process (especially if I had to shut down VS Code), and I found that having that file there helped keep Copilot on track throughout the process.

