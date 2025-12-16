# Reflection Log - Round 6

## Current Status
- **Phase**: Phase 5: Backend Integration & Phase 4: Webpack & Components
- **Progress**: 
    - Created package.json and webpack.config.js for frontend asset management.
    - Updated pp.js to handle dynamic routing for /timeline, /hero, and /hero-detail.
    - Implemented HeroService and HeroCard dynamic imports.
    - Backend SiteController is ready with actions for all major pages.
    - View files (	imeline.php, hero.php, hero-detail.php, etc.) are created.
    - Navigation in header.php is updated.

## Technical Decisions
- **Webpack**: Configured to output to rontend/web/assets/build so Yii2 can serve the assets directly.
- **Dynamic Imports**: Used import() syntax in pp.js to split code for 3D timeline and Hero service, reducing initial load time.
- **GSAP**: Integrated for page transitions and scroll animations.

## Next Steps
1. **Install Dependencies**: Run 
pm install in rontend/war-memorial-frontend.
2. **Build Assets**: Run 
pm run build to generate the bundles.
3. **Verify Integration**: Check if the generated bundles are correctly loaded in the Yii2 layout.
4. **3D Timeline Implementation**: The 3d-timeline.js file needs to be implemented (currently mocked in pp.js import).

## Challenges
- **File System**: Encountered "File already exists" errors, resolved by using PowerShell Set-Content.
- **Pathing**: Ensuring Webpack output paths align with Yii2's AppAsset or manual script inclusion.

