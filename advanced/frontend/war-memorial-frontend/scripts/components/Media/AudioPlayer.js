/**
 * 🎵 Audio Player Component
 * Handles audio playback for oral histories and background music.
 */

import Component from '../Component';

export default class AudioPlayer extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.audio = this.element.querySelector('audio');
        this.playBtn = this.element.querySelector('.play-btn');
        this.progressBar = this.element.querySelector('.progress-bar');
        
        this.init();
    }

    init() {
        if (!this.audio) return;
        this.bindEvents();
    }

    bindEvents() {
        if (this.playBtn) {
            this.playBtn.addEventListener('click', () => this.togglePlay());
        }
        
        this.audio.addEventListener('timeupdate', () => this.updateProgress());
    }

    togglePlay() {
        if (this.audio.paused) {
            this.audio.play();
            this.element.classList.add('playing');
        } else {
            this.audio.pause();
            this.element.classList.remove('playing');
        }
    }

    updateProgress() {
        if (!this.progressBar) return;
        const percent = (this.audio.currentTime / this.audio.duration) * 100;
        this.progressBar.style.width = `${percent}%`;
    }
}
