# 🌋 Volcanic by Group 3

Volcanic is a comprehensive web application for exploring and tracking volcanic activity worldwide. It combines real-time data and interactive tools to provide an engaging experience for volcano enthusiasts.

<div align="center">
  <img src="Images/volcanic.png" alt="Volcanic App" width="100%">
</div>

## About the Project

For full setup instructions, including local environment configuration, database setup, and API key requirements (for features like the Chatbot and Real-Time Activity), please refer to the [SETUP.md](SETUP.md) guide.

For Render demo deployment (Docker + SQLite), see [DEPLOY.md](DEPLOY.md).

### 🔑 Login Credentials

Once the application is running and seeded, you can log in with the following credentials:

| Role | Username | Password |
|------|----------|----------|
| **Admin** | `admin` | `Volcanic!Demo#2026` |
| **User** | `MarioR` | `Volcanic!User#2026` |

## 🧪 Live Demo (Render)

Try the hosted demo here: https://volcanic.onrender.com/

### Demo features

- Log in as admin or user
- Browse volcanoes, apply filters/sorting, and view profiles
- Use the admin dashboard to manage volcanoes, achievements, and users
- Explore the interactive map and real-time activity (when API keys are configured)

### Demo limitations

- Demo data resets periodically (ephemeral storage). This demo is for demonstration only.
- Free-tier deployments may sleep when idle; the first request can be slow.
- To use external APIs, set `GEMINI_API_KEY` and `AMBEE_API_KEY` in the Render environment.

## Features and Ownership

| Feature | Contributor | Description |
| :--- | :--- | :--- |
| Admin Forms | [Carolina](https://github.com/chaeyrie) | Manage volcanoes, achievements, and users |
| Chatbot | [Gabriele](https://github.com/Gabbo693) | Interactive assistant using REST API |
| Real-Time Activity | [Luigi](https://github.com/Lucol24) | Integration of Ambee API for live data |
| Advanced Search | Manish | Sophisticated filtering for volcanoes |
| Interactive Map | [Lara](https://github.com/Lara-Ghi) | Custom Leaflet-based map with real-time status updates |
| Filter and Sorting System | [Mats](https://github.com/mqts241) | Filter or sort volcanoes by specific criteria |
