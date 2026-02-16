# Secure View-Only Document Portal (Laravel)

This implementation provides a minimal Laravel structure for a secure document portal with two roles:

- **Uploader**: can upload `pdf`, `docx`, `pptx`, `txt`, `xlsx`.
- **Viewer**: can open browser previews only.

## Security model

- Files are stored on a private disk (`storage/app/private-documents`) and never exposed by URL.
- Viewer route streams inline preview response (`Content-Disposition: inline`).
- For Office documents (`docx`, `pptx`, `xlsx`), preview rendering converts to PDF via headless LibreOffice (`soffice`) and streams the generated PDF from server storage.

## Main files

- `app/Http/Controllers/DocumentController.php`
- `app/Services/DocumentPreviewService.php`
- `app/Http/Middleware/EnsureUserHasRole.php`
- `app/Models/Document.php`
- `routes/web.php`

## Setup (on top of a standard Laravel app)

1. Ensure Laravel dependencies are installed.
2. Add the files from this repo into a Laravel project.
3. Configure auth scaffolding and login pages.
4. Run migrations and seeders:
   - `php artisan migrate --seed`
5. Install LibreOffice on the server for Office-to-PDF conversion.

## Demo users (seeded)

- `uploader@example.com` / `password`
- `viewer@example.com` / `password`
