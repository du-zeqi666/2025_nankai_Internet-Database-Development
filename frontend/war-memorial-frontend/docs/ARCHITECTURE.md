# 🏗️ Technical Architecture Documentation

## 1. System Overview

The **Anti-Japanese War 80th Anniversary Memorial Website** is a national-level digital monument designed to commemorate the victory of the Chinese People's War of Resistance Against Japanese Aggression and the World Anti-Fascist War.

### 1.1 Design Philosophy
-   **Solemnity**: The visual language must convey respect and gravity.
-   **Immersiveness**: Utilizing 3D, audio, and interactive timelines to transport users back to history.
-   **Accessibility**: Ensuring the site is usable by all citizens, including the elderly and disabled (WCAG 2.1 AA).
-   **Performance**: High-performance rendering for complex media and 3D scenes.

## 2. Frontend Architecture

### 2.1 Technology Stack
-   **Core**: HTML5, SCSS, Vanilla JavaScript (ES6+)
-   **Build Tool**: Webpack 5
-   **Animation**: GSAP 3.x (ScrollTrigger, Flip)
-   **3D Engine**: Three.js
-   **Maps**: Leaflet / ECharts
-   **Templating**: PHP (Server-Side Rendering for SEO)

### 2.2 Directory Structure
The project follows a strict modular architecture:

```
war-memorial-frontend/
├── assets/             # Static Assets
├── config/             # Configuration
├── scripts/            # Logic Layer
│   ├── core/           # Kernel (Router, State, API)
│   ├── components/     # UI Components (Classes)
│   ├── pages/          # Page Controllers
│   ├── animations/     # Animation Configs
│   ├── 3d/             # WebGL Scenes
│   └── services/       # Data Services
├── styles/             # Presentation Layer
│   ├── base/           # Variables, Mixins, Reset
│   ├── components/     # Component Styles (BEM)
│   ├── layouts/        # Grid, Header, Footer
│   ├── pages/          # Page-specific Styles
│   └── themes/         # Theming (Memorial, Celebration, Mourning)
├── templates/          # View Layer
│   ├── layouts/        # Master Layouts
│   ├── pages/          # Page Views
│   └── partials/       # Reusable Fragments
└── docs/               # Documentation
```

## 3. Core Modules

### 3.1 State Management (`scripts/core/state.js`)
A lightweight, reactive state management system based on the Observer pattern.
-   **Global State**: User session, Theme, Language, Audio playback status.
-   **Page State**: Current view, Filters, Pagination.

### 3.2 Routing & Navigation (`scripts/core/router.js`)
Handles client-side navigation enhancements while respecting server-side routing.
-   **Transitions**: Smooth page transitions (Fade, Slide).
-   **Prefetching**: Intelligent preloading of linked resources.
-   **Scroll Restoration**: Maintains scroll position history.

### 3.3 API Layer (`scripts/core/api.js`)
Centralized HTTP client for communicating with the backend.
-   **Interceptors**: Request/Response transformation.
-   **Caching**: LocalStorage/SessionStorage caching strategies.
-   **Error Handling**: Unified error reporting and UI feedback.

## 4. Performance Strategy

### 4.1 Loading Optimization
-   **Critical CSS**: Inline critical styles for First Contentful Paint (FCP).
-   **Lazy Loading**: Images, Videos, and 3D models loaded on demand using IntersectionObserver.
-   **Code Splitting**: Route-based chunking via Webpack.

### 4.2 Rendering Optimization
-   **GPU Acceleration**: Use `transform` and `opacity` for animations.
-   **Virtual DOM**: (If applicable for complex lists) or efficient DOM diffing.
-   **Debouncing/Throttling**: Scroll and Resize event handlers.

## 5. Security & Reliability

### 5.1 Security
-   **XSS Protection**: Strict output escaping in PHP templates.
-   **CSRF Protection**: Token validation for all forms.
-   **CSP**: Content Security Policy headers.

### 5.2 Error Handling
-   **Global Error Boundary**: Catch unhandled JS exceptions.
-   **Fallback UI**: Graceful degradation for failed components (e.g., 3D viewer fallback to image).
-   **Logging**: Client-side error reporting service.

## 6. Deployment Pipeline

### 6.1 Build Process
1.  **Linting**: ESLint & Stylelint check.
2.  **Testing**: Unit tests (Jest) & E2E tests (Cypress).
3.  **Bundling**: Webpack production build (Minification, Tree-shaking).
4.  **Assets**: Image optimization (WebP conversion).

### 6.2 Environment
-   **Development**: Hot Module Replacement (HMR), Source Maps.
-   **Staging**: Replica of production with debug flags.
-   **Production**: CDN integration, Gzip/Brotli compression.
