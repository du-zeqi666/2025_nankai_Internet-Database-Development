# War Memorial Frontend

Anti-Japanese War 80th Anniversary Memorial Website Frontend.

## Project Structure

```
war-memorial-frontend/
├── assets/             # Static assets (images, fonts)
├── config/             # Webpack configuration
├── scripts/            # JavaScript source
│   ├── components/     # UI Components
│   ├── core/           # Core logic
│   ├── pages/          # Page-specific logic
│   └── main.js         # Entry point
├── styles/             # SCSS source
│   ├── base/           # Variables, reset, typography
│   ├── components/     # Component styles
│   ├── layouts/        # Header, footer, grid
│   ├── pages/          # Page-specific styles
│   └── main.scss       # Main stylesheet
├── templates/          # PHP Templates (View layer)
│   ├── layouts/        # Master layouts
│   └── pages/          # Page templates
├── package.json        # Dependencies
└── webpack.config.js   # Build config
```

## Development

1.  Install dependencies:
    ```bash
    npm install
    ```

2.  Start development server:
    ```bash
    npm start
    ```

3.  Build for production:
    ```bash
    npm run build
    ```

## Design System

-   **Primary Color**: Memorial Red (`#8B0000`)
-   **Secondary Color**: Golden Victory (`#D4AF37`)
-   **Typography**: Source Han Serif (Titles), Source Han Sans (Body)

## Features

-   **Heroes**: List and detail views with filtering.
-   **Battles**: Timeline and Map views.
-   **Relics**: Grid view with 3D viewer integration.
-   **Sites**: List and VR tour links.
-   **Guestbook**: Interactive form and message list.
