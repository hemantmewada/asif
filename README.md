# Secure View-Only Document Portal (Laravel)

This repository is now a **Laravel project scaffold** (including `composer.json`) for a secure view-only document portal.

## Roles

- **Uploader**: uploads `pdf`, `docx`, `pptx`, `txt`, `xlsx`.
- **Viewer**: can open browser previews only.

## Security model

- Originals are stored only on a private disk (`storage/app/private-documents`).
- No raw storage URLs are exposed to users.
- Viewer endpoint streams inline previews (`Content-Disposition: inline`).
- Office docs (`docx`, `pptx`, `xlsx`) are converted server-side to PDF using headless LibreOffice (`soffice`).

## Quick start

1. Install dependencies:
   ```bash
   composer install
   ```
2. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
4. Start the app:
   ```bash
   php artisan serve
   ```

## Demo users

- `uploader@example.com` / `password`
- `viewer@example.com` / `password`

## Important runtime dependency

Install LibreOffice on the server to support Office-to-PDF preview conversion.
