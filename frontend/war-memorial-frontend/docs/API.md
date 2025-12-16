# 🔌 API Documentation

## 1. General Standards

-   **Base URL**: `/api/v1`
-   **Format**: JSON
-   **Encoding**: UTF-8
-   **Date Format**: ISO 8601 (`YYYY-MM-DDTHH:mm:ssZ`)

### 1.1 Response Structure
```json
{
  "code": 200,
  "message": "Success",
  "data": { ... },
  "meta": {
    "timestamp": 1735689600,
    "version": "1.0.0"
  }
}
```

### 1.2 Error Structure
```json
{
  "code": 400,
  "message": "Invalid Parameter",
  "errors": [
    {
      "field": "email",
      "code": "INVALID_FORMAT",
      "message": "Please enter a valid email address."
    }
  ]
}
```

## 2. Endpoints

### 2.1 Heroes (`/heroes`)

#### `GET /heroes`
List heroes with pagination and filtering.
-   **Params**:
    -   `page` (int): Page number (default: 1)
    -   `limit` (int): Items per page (default: 20)
    -   `q` (string): Search query
    -   `province` (string): Filter by origin
    -   `rank` (string): Filter by rank
-   **Response**: List of `Hero` objects.

#### `GET /heroes/{id}`
Get detailed information for a specific hero.
-   **Response**: Single `HeroDetail` object.

### 2.2 Battles (`/battles`)

#### `GET /battles`
List major battles.
-   **Params**:
    -   `year` (int): Filter by year
    -   `type` (string): 'campaign', 'skirmish', etc.
-   **Response**: List of `Battle` objects.

#### `GET /battles/{id}`
Get battle details including map data.
-   **Response**: `BattleDetail` object with `map_coordinates`.

### 2.3 Timeline (`/timeline`)

#### `GET /timeline`
Get all timeline events.
-   **Params**:
    -   `start_year` (int)
    -   `end_year` (int)
-   **Response**: List of `TimelineEvent` objects.

### 2.4 Relics (`/relics`)

#### `GET /relics`
List historical artifacts.
-   **Params**:
    -   `category` (string): 'weapon', 'document', 'clothing'
-   **Response**: List of `Relic` objects.

#### `GET /relics/{id}/model`
Get 3D model data for a relic.
-   **Response**: GLTF/GLB file URL and configuration.

### 2.5 Sites (`/sites`)

#### `GET /sites`
List memorial sites.
-   **Params**:
    -   `region` (string)
-   **Response**: List of `Site` objects.

### 2.6 Guestbook (`/guestbook`)

#### `GET /guestbook`
Get recent messages.
-   **Params**:
    -   `cursor` (string): For infinite scroll
-   **Response**: List of `Message` objects.

#### `POST /guestbook`
Submit a new message.
-   **Body**:
    -   `name` (string, required)
    -   `content` (string, required)
    -   `offering_type` (string): 'flower', 'candle', 'none'
-   **Response**: Created `Message` object.

#### `POST /guestbook/offer`
Perform a virtual offering (flower/candle) without a message.
-   **Body**:
    -   `type` (string, required): 'flower', 'candle'
    -   `target_id` (string, optional): Hero ID or Monument ID
-   **Response**: Updated stats.

## 3. Data Models

### 3.1 Hero
```json
{
  "id": 1,
  "name": "Yang Jingyu",
  "title": "National Hero",
  "birth_date": "1905-02-26",
  "death_date": "1940-02-23",
  "birthplace": "Que Shan, Henan",
  "rank": "General",
  "photo_url": "/assets/images/heroes/1.jpg",
  "summary": "Commander-in-chief of the First Route Army..."
}
```

### 3.2 Battle
```json
{
  "id": 101,
  "name": "Battle of Taierzhuang",
  "start_date": "1938-03-24",
  "end_date": "1938-04-07",
  "location": "Taierzhuang, Shandong",
  "result": "Chinese Victory",
  "coordinates": { "lat": 34.56, "lng": 117.73 }
}
```
