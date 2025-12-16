/**
 * Custom Video Player Component
 */
export class VideoPlayer {
    constructor(selector) {
        this.container = document.querySelector(selector);
        if (!this.container) return;

        this.video = this.container.querySelector('video');
        this.playBtn = this.container.querySelector('.play-btn');
        this.progressBar = this.container.querySelector('.progress-bar');
        this.progress = this.container.querySelector('.progress');
        this.volumeBtn = this.container.querySelector('.volume-btn');
        this.fullscreenBtn = this.container.querySelector('.fullscreen-btn');
        
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        // Play/Pause
        this.playBtn.addEventListener('click', () => this.togglePlay());
        this.video.addEventListener('click', () => this.togglePlay());
        
        // Update UI on play/pause
        this.video.addEventListener('play', () => this.updatePlayBtn(true));
        this.video.addEventListener('pause', () => this.updatePlayBtn(false));

        // Progress
        this.video.addEventListener('timeupdate', () => this.updateProgress());
        
        // Seek
        this.progressBar.addEventListener('click', (e) => this.seek(e));

        // Volume
        this.volumeBtn.addEventListener('click', () => this.toggleMute());

        // Fullscreen
        this.fullscreenBtn.addEventListener('click', () => this.toggleFullscreen());
    }

    togglePlay() {
        if (this.video.paused) {
            this.video.play();
        } else {
            this.video.pause();
        }
    }

    updatePlayBtn(isPlaying) {
        this.playBtn.textContent = isPlaying ? '❚❚' : '►';
        this.container.classList.toggle('playing', isPlaying);
    }

    updateProgress() {
        const percent = (this.video.currentTime / this.video.duration) * 100;
        this.progress.style.width = `${percent}%`;
    }

    seek(e) {
        const rect = this.progressBar.getBoundingClientRect();
        const pos = (e.clientX - rect.left) / rect.width;
        this.video.currentTime = pos * this.video.duration;
    }

    toggleMute() {
        this.video.muted = !this.video.muted;
        this.volumeBtn.textContent = this.video.muted ? '🔇' : '🔊';
    }

    toggleFullscreen() {
        if (!document.fullscreenElement) {
            this.container.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }
}
