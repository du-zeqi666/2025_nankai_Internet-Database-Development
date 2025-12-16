# 🧩 Component Library Documentation

## 1. Navigation Components

### 1.1 MainNav (`components/Navigation/MainNav.js`)
The primary navigation bar, responsive and accessible.
-   **Features**: Mega-menu support, sticky positioning, scroll-aware transparency.
-   **States**: Default, Scrolled, Mobile-Open.
-   **Accessibility**: ARIA roles, keyboard navigation support.

### 1.2 Breadcrumb (`components/Navigation/Breadcrumb.js`)
Indicates current page location hierarchy.
-   **Props**: `items` (Array of {label, url}).
-   **Schema.org**: Generates JSON-LD structured data.

## 2. Card Components

### 2.1 HeroCard (`components/Cards/HeroCard.js`)
Displays summary information for a war hero.
-   **Visuals**: Portrait photo, Name, Rank, Dates.
-   **Interactions**: Hover lift effect, "Read More" button.
-   **Variants**: `default`, `compact`, `featured`.

### 2.2 BattleCard (`components/Cards/BattleCard.js`)
Summary of a major battle or campaign.
-   **Visuals**: Map thumbnail/Battle scene, Date range, Outcome.
-   **Data**: Casualties, Commanders.

### 2.3 RelicCard (`components/Cards/RelicCard.js`)
Showcase for historical artifacts.
-   **Features**: 3D preview toggle, Zoom icon.
-   **Metadata**: Era, Material, Location found.

## 3. Timeline Components

### 3.1 TimelineMain (`components/Timeline/TimelineMain.js`)
The container for the historical timeline.
-   **Modes**: `Horizontal` (Desktop), `Vertical` (Mobile), `3D` (WebGL).
-   **Controls**: Zoom in/out, Jump to year, Auto-play.

### 3.2 TimelineNode (`components/Timeline/TimelineNode.js`)
Individual event point on the timeline.
-   **Types**: `Major Event` (Large), `Minor Event` (Small).
-   **Content**: Date, Title, Thumbnail.
-   **Interaction**: Click to expand details.

## 4. Map Components

### 4.1 ChinaMap (`components/Map/ChinaMap.js`)
Interactive SVG/Canvas map of China.
-   **Layers**: Provinces, Major Cities, Battle Sites.
-   **Interactivity**: Hover tooltips, Click to filter.

### 4.2 BattleMap (`components/Map/BattleMap.js`)
Detailed tactical map for specific battles.
-   **Features**: Troop movement arrows, Front lines, Key locations.
-   **Animation**: Time-lapse of battle progression.

## 5. Gallery Components

### 5.1 ImageGallery (`components/Gallery/ImageGallery.js`)
Masonry or Grid layout for historical photos.
-   **Features**: Lazy loading, Filter by category.

### 5.2 ImageViewer (`components/Gallery/ImageViewer.js`)
Lightbox modal for high-res image viewing.
-   **Controls**: Zoom, Pan, Rotate, Caption toggle.
-   **Keyboard**: Arrow keys navigation, Esc to close.

## 6. Interactive Components

### 6.1 FlowerOffering (`components/Interactive/FlowerOffering.js`)
Virtual tribute system.
-   **Actions**: Select flower type, Drag and drop to monument.
-   **Feedback**: Particle effect upon placement, Counter increment.

### 6.2 MessageWall (`components/Interactive/MessageWall.js`)
Real-time guestbook display.
-   **Layout**: Masonry grid or Scrolling ticker.
-   **Features**: Profanity filter, Emoji support.

## 7. Media Components

### 7.1 VideoPlayer (`components/Media/VideoPlayer.js`)
Custom HTML5 video player skin.
-   **Theme**: Matches site design (Red/Gold).
-   **Features**: Captions (VTT), Quality selector, Picture-in-Picture.

### 7.2 AudioPlayer (`components/Media/AudioPlayer.js`)
Background music and oral history player.
-   **Features**: Persistent playback across navigation (SPA mode), Playlist support.

## 8. Form Components

### 8.1 SearchBox (`components/Form/SearchBox.js`)
Global search with autocomplete.
-   **Features**: Debounced input, Recent searches, Categorized results.

### 8.2 FormValidator (`components/Form/FormValidator.js`)
Client-side validation logic.
-   **Rules**: Required, Email, Phone, Length.
-   **Feedback**: Inline error messages, Field highlighting.
