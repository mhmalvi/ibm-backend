# IBM Backend

A Laravel-based backend service for PDF processing and email delivery. This application handles PDF merging, document generation, and automated email dispatch for agent and applicant communications.

## Features

- **PDF Merging** — Combine multiple PDF documents into a single file using FPDI/FPDF
- **PDF Generation** — Create PDF documents from templates via DomPDF
- **Image Processing** — Image manipulation with Intervention Image
- **Agent Emails** — Automated email dispatch to agents with PDF attachments
- **Applicant Emails** — Application-related email notifications
- **Mail Templates** — Blade-based email templates for agents and applicants

## Tech Stack

- **Framework:** Laravel 10 (PHP 8.1+)
- **PDF Merge:** setasign/fpdi + setasign/fpdf
- **PDF Generation:** barryvdh/laravel-dompdf
- **Image Processing:** Intervention Image (Laravel)
- **API:** Laravel Sanctum
- **Database:** MySQL

## Getting Started

```bash
# Clone the repository
git clone https://github.com/mhmalvi/ibm-backend.git
cd ibm-backend

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Configure mail settings in .env

# Run migrations
php artisan migrate

# Start the development server
php artisan serve
```

## Project Structure

```
app/
├── Http/Controllers/
│   └── PdfMergeController.php      # PDF merging and processing
└── Mail/
    ├── AgentPDFMail.php            # Agent email with PDF attachment
    └── PdfMergedMail.php           # Merged PDF delivery email
resources/views/
├── agentMail.blade.php             # Agent email template
├── apply.blade.php                 # Application template
└── mail.blade.php                  # General mail template
```

## License

MIT
