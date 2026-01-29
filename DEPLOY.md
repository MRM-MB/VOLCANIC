# Render Demo Deployment (Docker + SQLite)

This guide keeps local MySQL unchanged, while using SQLite for Render.

## 1) Render Blueprint
- Commit the Dockerfile, render.yaml, and docker/entrypoint.sh.
- In Render, choose **New +** → **Blueprint** and select this repo.
- Render will create a Docker web service using render.yaml.

## 2) Required Environment Variables
Set these in Render (Dashboard → Environment):
- APP_KEY (generate with `php artisan key:generate --show` locally)
- APP_URL (your Render URL)

Optional feature keys (server-side only):
- GEMINI_API_KEY (Chatbot)
- AMBEE_API_KEY (Real-Time Activity)

## 3) Database
Render uses SQLite by default via render.yaml:
- DB_CONNECTION=sqlite
- DB_DATABASE=/var/www/html/database/database.sqlite

Local dev remains MySQL using your `.env`.

## 4) Migrations/Seed
The container runs migrations automatically and seeds when `RUN_SEED=true`.

## Notes
- Free tier sleeps on inactivity; first request may be slow.
- Do not commit API keys to the repo.
