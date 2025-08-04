# FAAN Database Migrations & Seeders

This directory contains Laravel migrations and seeders generated from the FAAN SQL database dump (excluding the users table as requested).

**Laravel Version**: Laravel 12 - API-only configuration  
**Routing**: All routes are configured as API routes with automatic `/api` prefix

## Tables Included

### 1. Analytics
- **Purpose**: Stores analytics data with heartbeat tracking
- **Key Fields**: `last_heartbeat`, `data` (JSON), `anonymous_id`, `_id`
- **Model**: `App\Models\Analytics`

### 2. Navigation
- **Purpose**: Bilingual navigation menu structure for the FAAN website
- **Key Fields**: `name_en`, `name_es`, `path`, `component_name`, `sort_order`, `parent_id`
- **Model**: `App\Models\Navigation`
- **Features**: Hierarchical structure with parent-child relationships

### 3. Submitted Data
- **Purpose**: Stores encrypted form submissions (donations, contacts, legacy giving)
- **Key Fields**: `type`, `_id`, `rec` (encrypted data), `send_response`
- **Model**: `App\Models\SubmittedData`
- **Data Types**: donations, contacts, legacy_giving

## Installation

1. **Run the migrations**:
   ```bash
   php artisan migrate
   ```

2. **Run the seeders**:
   ```bash
   php artisan db:seed --class=AnalyticsSeeder
   php artisan db:seed --class=NavigationSeeder
   php artisan db:seed --class=SubmittedDataSeeder
   ```

   Or run all seeders at once:
   ```bash
   php artisan db:seed
   ```

3. **Test the API endpoints**:
   ```bash
   # Test navigation endpoint
   curl http://faan-main.test/api/navigation
   
   # Test bilingual navigation
   curl http://faan-main.test/api/navigation/es
   
   # Test statistics
   curl http://faan-main.test/api/submitted-data/stats
   
   # Test recent submissions
   curl http://faan-main.test/api/submitted-data/recent/5
   
   # Test analytics count
   curl http://faan-main.test/api/analytics/count
   ```

## API Endpoints

The following API endpoints are available for accessing the FAAN data:

- `GET /api/navigation` - Get navigation menu structure
- `GET /api/navigation/{language}` - Get navigation in specific language (en/es)
- `GET /api/submitted-data/stats` - Get submission statistics
- `GET /api/submitted-data/recent/{limit?}` - Get recent submissions (without sensitive data)
- `GET /api/analytics/count` - Get analytics record count

## Model Features

### Navigation Model
- **Relationships**: Parent-child hierarchy
- **Scopes**: `visible()`, `ordered()`, `topLevel()`
- **Multilingual**: Supports English and Spanish

### SubmittedData Model
- **Scopes**: `donations()`, `contacts()`, `legacyGiving()`
- **Methods**: `hasResponse()`, `wasSuccessful()`
- **Security**: Encrypted data handling

### Analytics Model
- **JSON Casting**: Automatic data field JSON casting
- **Tracking**: Heartbeat and anonymous ID tracking

## Important Notes

### Laravel 12 Configuration
- **API-Only**: Configured for API-only responses (no web views)
- **Routing**: Uses `api` routing configuration in `bootstrap/app.php`
- **No Kernel**: Laravel 12+ structure without traditional Kernel.php
- **Automatic Prefix**: All routes automatically get `/api` prefix
- **Development Environment**: Running on Laravel Herd at `http://faan-main.test`

### Security Considerations
- The `submitted_data` table contains encrypted sensitive information
- The seeder includes all actual encrypted data from the original database (safe since encrypted)
- Production data should be handled with appropriate encryption/decryption

### Data Migration from Original SQL
- Navigation data is fully migrated with all original records
- Analytics table structure is ready but contains no data (was empty in original)
- SubmittedData seeder contains all actual encrypted records from the original database

### Customization
The SubmittedDataSeeder now includes all actual encrypted data from the original database. Since the data is encrypted, it's safe to include and requires proper decryption keys to be useful in your application.

## Laravel Features Used
- **Eloquent Models** with relationships and scopes
- **Database Migrations** with proper column types and indexes
- **Seeders** with timestamp management
- **JSON Casting** for data fields
- **API Controllers** with resource formatting

## File Structure
```
database/
├── migrations/
│   ├── 2025_08_01_100001_create_analytics_table.php
│   ├── 2025_08_01_100002_create_navigation_table.php
│   └── 2025_08_01_100003_create_submitted_data_table.php
├── seeders/
│   ├── AnalyticsSeeder.php
│   ├── NavigationSeeder.php
│   ├── SubmittedDataSeeder.php
│   └── DatabaseSeeder.php
app/
├── Models/
│   ├── Analytics.php
│   ├── Navigation.php
│   └── SubmittedData.php
└── Http/Controllers/
    └── FaanDataController.php
```
